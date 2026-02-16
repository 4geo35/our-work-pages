<?php

namespace GIS\OurWorkPages\Livewire\Admin\OurWorkLabels;

use GIS\OurWorkPages\Interfaces\OurWorkLabelInterface;
use GIS\OurWorkPages\Models\OurWorkLabel;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class ListWire extends Component
{
    public bool $displayList = false;
    public bool $displayData = false;
    public bool $displayDelete = false;

    public int|null $labelId = null;

    public string $title = "";
    public string $slug = "";
    public string $updateTitle = "";
    public string $updateSlug = "";

    public function rules(): array
    {
        if ($this->labelId) {
            return [
                "updateTitle" => ["required", "string", "max:50"],
                "updateSlug" => ["nullable", "string", "max:50", "unique:our_work_labels,slug,{$this->labelId}"],
            ];
        } else {
            return [
                "title" => ["required", "string", "max:50"],
                "slug" => ["nullable", "string", "max:50", "unique:our_work_labels,slug"],
            ];
        }
    }

    public function validationAttributes(): array
    {
        return [
            "title" => "Заголовок",
            "updateTitle" => "Заголовок",
            "slug" => "Адресная строка",
            "updateSlug" => "Адресная строка",
        ];
    }

    public function render(): View
    {
        $modelClass = config("our-work-pages.customOurWorkLabelModel") ?? OurWorkLabel::class;
        $labels = $modelClass::query()
            ->orderBy("priority")
            ->get();
        return view("owp::livewire.admin.our-work-labels.list-wire", compact("labels"));
    }

    #[On("show-label-list")]
    public function showList(): void
    {
        $this->resetFields();
        if (! $this->checkAuth("viewAny")) { return; }
        $this->displayList = true;
    }

    public function store(): void
    {
        if (! $this->checkAuth("create")) { return; }
        $this->validate();

        $modelClass = config("our-work-pages.customOurWorkLabelModel") ?? OurWorkLabel::class;
        $modelClass::query()->create([
            "title" => $this->title,
            "slug" => $this->slug,
        ]);

        session()->flash("labels-success", "Метка успешно добавлена");
        $this->closeData();
        $this->dispatch("update-list");
    }

    public function closeData(): void
    {
        $this->resetFields();
        $this->displayData = false;
    }

    public function showEdit(int $modelId): void
    {
        $this->resetFields();
        $this->labelId = $modelId;
        $model = $this->findModel();
        if (! $model) { return; }
        if (! $this->checkAuth("update", $model)) { return; }

        $this->updateTitle = $model->title;
        $this->updateSlug = $model->slug;
        $this->displayData = true;
    }

    public function update(): void
    {
        $model = $this->findModel();
        if (! $model) { return; }
        if (! $this->checkAuth("update", $model)) { return; }
        $this->validate();

        $model->update([
            "title" => $this->updateTitle,
            "slug" => $this->updateSlug,
        ]);

        session()->flash("labels-success", "Метка успешно обновлена");
        $this->closeData();
        $this->dispatch("update-list");
    }

    public function closeDelete(): void
    {
        $this->resetFields();
        $this->displayDelete = false;
    }

    public function showDelete(int $modelId): void
    {
        $this->resetFields();
        $this->labelId = $modelId;
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
            session()->flash("labels-error", "Ошибка при удалении метки");
            $this->closeDelete();
            return;
        }

        session()->flash("labels-success", "Метка успешно удалена");
        $this->closeDelete();
    }

    public function reorderItems(array $newOrder): void
    {
        if (! $this->checkAuth("order")) { return; }

        foreach ($newOrder as $priority => $id) {
            $this->labelId = $id;
            $model = $this->findModel();
            if (! $model) { continue; }
            $model->priority = $priority;
            $model->save();
        }

        $this->resetFields();
    }

    protected function resetFields(): void
    {
        $this->reset("labelId", "title", "slug", "updateTitle", "updateSlug");
    }

    protected function findModel(): ?OurWorkLabelInterface
    {
        $modelClass = config("our-work-pages.customOurWorkLabelModel") ?? OurWorkLabel::class;
        $model = $modelClass::query()->find($this->labelId);
        if (! $model) {
            session()->flash("labels-error", "Метка не найдена");
            $this->closeData();
            $this->closeDelete();
            return null;
        }
        return $model;
    }

    protected function checkAuth(string $action, OurWorkLabelInterface $modelObject = null): bool
    {
        try {
            $modelClass = config("our-work-pages.customOurWorkLabelModel") ?? OurWorkLabel::class;
            $this->authorize($action, $modelObject ?? $modelClass);
            return true;
        } catch (AuthorizationException $e) {
            session()->flash("labels-error", "Неавторизованное действие");
            $this->closeData();
            $this->closeDelete();
            return false;
        }
    }
}
