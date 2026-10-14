<?php

namespace GIS\OurWorkPages\Traits;

use GIS\OurWorkPages\Interfaces\OurWorkInterface;
use GIS\OurWorkPages\Models\OurWork;
use GIS\OurWorkPages\Models\OurWorkLabel;
use GIS\TraitsHelpers\Traits\WireDeleteImageTrait;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

trait OurWorkEditActions
{
    use WithFileUploads, WireDeleteImageTrait;

    public bool $displayDelete = false;
    public bool $displayData = false;

    public int|null $workId = null;

    public string $title = "";
    public string $slug = "";
    public string $short = "";
    public string $description = "";

    public string $dateFrom = "";
    public string $dateTo = "";
    public string $authorName = "";

    public TemporaryUploadedFile|null $cover = null;
    public string|null $coverUrl = null;

    public Collection|null $labelList = null;
    public array $labels = [];

    public function rules(): array
    {
        $uniqueCondition = "unique:our_works,slug";
        if ($this->workId) { $uniqueCondition .= ",$this->workId"; }
        return [
            "title" => ["required", "string", "max:250"],
            "slug" => ["nullable", "string", "max:250", $uniqueCondition],
            "short" => ["nullable", "string", "max:250"],
            "dateFrom" => ["nullable", "date"],
            "dateTo" => ["nullable", "date"],
            "authorName" => ["nullable", "string", "max:250"],
            "cover" => ["nullable", "image", "mimes:jpg,jpeg,png,webp"],
        ];
    }

    public function validationAttributes(): array
    {
        return [
            "title" => "Заголовок",
            "slug" => "Адресная строка",
            "short" => "Краткое описание",
            "dateFrom" => "Дата от",
            "dateTo" => "Дата до",
            "authorName" => "Имя автора",
            "cover" => "Изображение",
        ];
    }

    public function closeData(): void
    {
        $this->resetFields();
        $this->displayData = false;
    }

    public function showEdit(int $modelId): void
    {
        $this->resetFields();
        $this->workId = $modelId;
        $model = $this->findModel();
        if (! $model) { return; }
        if (! $this->checkAuth("update", $model)) { return; }

        $this->title = $model->title;
        $this->slug = $model->slug;
        $this->short = $model->short;
        $this->description = $model->description;
        $this->dateFrom = (string) $model->date_from;
        $this->dateTo = (string) $model->date_to;
        $this->authorName = $model->author_name;
        if ($model->image_id) {
            $model->load("image");
            $this->coverUrl = route("thumb-img", ["filename" => $model->image->filename, "template" => "original"]);
        } else { $this->coverUrl = null; }
        $model->load("labels:id");
        foreach ($model->labels as $label) {
            $this->labels[] = $label->id;
        }

        $this->displayData = true;
        $this->setLabelList();
    }

    public function update(): void
    {
        $model = $this->findModel();
        if (! $model) { return; }
        if (! $this->checkAuth("update", $model)) { return; }
        $this->validate();

        $slugHasChanged = $this->slug !== $model->slug;

        $model->update([
            "title" => $this->title,
            "slug" => $this->slug,
            "short" => $this->short,
            "description" => $this->description,
            "date_from" => empty($this->dateFrom) ? null : $this->dateFrom,
            "date_to" => empty($this->dateTo) ? null : $this->dateTo,
            "author_name" => $this->authorName,
        ]);
        $model->livewireImage($this->cover);
        $model->labels()->sync($this->labels);

        session()->flash("success", "Работа успешно обновлена");
        $this->closeData();
        if (isset($this->work)) {
            $this->work = $model;
            if ($slugHasChanged) {
                $this->redirectRoute("admin.our-works.show", ["work" => $this->work]);
            }
        }
    }

    public function closeDelete(): void
    {
        $this->resetFields();
        $this->displayDelete = false;
    }

    public function showDelete(int $modelId): void
    {
        $this->resetFields();
        $this->workId = $modelId;
        $model = $this->findModel();
        if (! $model) { return; }
        if (! $this->checkAuth("delete", $model)) { return; }
        $this->displayDelete = true;
    }

    public function confirmDelete(): void
    {
        $model = $this->findModel();
        if (! $model) { return; }
        if (! $this->checkAuth("delete", $model)) { return; }

        try {
            $model->delete();
        } catch (\Exception $exception) {
            session()->flash("error", "Ошибка при удалении работы");
            $this->closeDelete();
            return;
        }

        session()->flash("success", "Работа успешно удалена");
        $this->closeDelete();
        if (isset($this->work)) {
            $this->redirectRoute("admin.our-works.index");
        }
    }

    public function switchPublish(int $modelId): void
    {
        $this->resetFields();
        $this->workId = $modelId;
        $model = $this->findModel();
        if (! $model) { return; }
        if (! $this->checkAuth("update", $model)) { return; }
        $model->update([
            "published_at" => $model->published_at ? null : now(),
        ]);
        if (isset($this->work)) { $this->work = $model; }
    }

    protected function resetFields(): void
    {
        $this->reset(
            "title", "slug", "short", "description",
            "dateFrom", "dateTo", "authorName",
            "workId",
            "cover", "coverUrl",
            "labelList", "labels"
        );
    }

    protected function checkAuth(string $action, ?OurWorkInterface $modelObject = null): bool
    {
        try {
            $modelClass = config("our-work-pages.customOurWorkModel") ?? OurWork::class;
            $this->authorize($action, $modelObject ?? $modelClass);
            return true;
        } catch (AuthorizationException $e) {
            session()->flash("error", "Неавторизованное действие");
            $this->closeData();
            $this->closeDelete();
            return false;
        }
    }

    protected function findModel(): ?OurWorkInterface
    {
        $modelClass = config("our-work-pages.customOurWorkModel") ?? OurWork::class;
        $modelObject = $modelClass::query()->find($this->workId);
        if (! $modelObject) {
            session()->flash("error", "Работа не найдена");
            $this->closeData();
            $this->closeDelete();
            return null;
        }
        return $modelObject;
    }

    protected function setLabelList(): void
    {
        $modelClass = config("our-work-pages.customOurWorkLabelModel") ?? OurWorkLabel::class;
        $this->labelList = $modelClass::query()
            ->orderBy("priority")
            ->get();
    }
}
