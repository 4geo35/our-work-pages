<?php

namespace GIS\OurWorkPages\Livewire\Admin\OurWorks;

use GIS\OurWorkPages\Interfaces\OurWorkInterface;
use GIS\OurWorkPages\Models\OurWork;
use GIS\OurWorkPages\Traits\OurWorkEditActions;
use GIS\TraitsHelpers\Facades\BuilderActions;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Component;

class IndexWire extends Component
{
    use OurWorkEditActions;

    public string $searchTitle = "";
    public string $searchPublished = "all";

    public bool $displayOrder = false;

    public Collection|null $list = null;
    public bool $hasSearch = false;

    protected function queryString(): array
    {
        return [
            "searchTitle" => ["as" => "title", "except" => ""],
            "searchPublished" => ["as" => "published", "except" => "all"],
        ];
    }

    public function render(): View
    {
        $modelClass = config("our-work-pages.customOurWorkModel") ?? OurWork::class;
        $query = $modelClass::query();
        BuilderActions::extendLike($query, $this->searchTitle, "title");
        BuilderActions::extendPublished($query, $this->searchPublished);
        $query->orderBy("priority");
        $works = $query->get();

        return view("owp::livewire.admin.our-works.index-wire", compact("works"));
    }

    public function clearSearch(): void
    {
        $this->reset("searchTitle", "searchPublished");
    }

    public function showCreate(): void
    {
        $this->resetFields();
        if (! $this->checkAuth("create")) { return; }
        $this->displayData = true;
    }

    public function store(): void
    {
        if (! $this->checkAuth("create")) { return; }
        $this->validate();

        $modelClass = config("our-work-pages.customOurWorkModel") ?? OurWork::class;
        $model = $modelClass::query()->create([
            "title" => $this->title,
            "slug" => $this->slug,
            "short" => $this->short,
            "description" => $this->description,
            "date_from" => empty($this->dateFrom) ? null : $this->dateFrom,
            "date_to" => empty($this->dateTo) ? null : $this->dateTo,
            "author_name" => $this->authorName,
        ]);
        /**
         * @var OurWorkInterface $model
         */
        $model->livewireImage($this->cover);

        session()->flash("success", "Работа успешно добавлена");
        $this->closeData();
    }

    public function showOrder(): void
    {
        if (! $this->checkAuth("order")) { return; }
        $this->displayOrder = true;
        $this->setWorkList();
        $this->dispatch("update-list");
    }

    public function reorderItems(array $newOrder): void
    {
        if (! $this->checkAuth("order")) { return; }

        foreach ($newOrder as $priority => $id) {
            $this->workId = $id;
            $model = $this->findModel();
            if (! $model) { continue; }
            $model->priority = $priority;
            $model->save();
        }

        $this->resetFields();
        $this->setWorkList();
    }

    protected function setWorkList(): void
    {
        $modelClass = config("our-work-pages.customOurWorkModel") ?? OurWork::class;
        $this->list = $modelClass::query()
            ->select("id", "title")
            ->orderBy("priority")
            ->get();
    }
}
