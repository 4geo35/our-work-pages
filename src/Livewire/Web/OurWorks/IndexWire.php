<?php

namespace GIS\OurWorkPages\Livewire\Web\OurWorks;

use GIS\OurWorkPages\Models\OurWork;
use GIS\OurWorkPages\Models\OurWorkLabel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class IndexWire extends Component
{
    use WithPagination;

    public Collection|null $labelList = null;
    public mixed $searchLabel = [];

    protected function queryString(): array
    {
        return [
            "searchLabel" => ["except" => "", "as" => config("our-work-pages.queryLabelKey")],
        ];
    }

    public function updatedSearchLabel($value, $key): void
    {
        $this->resetPage();
    }

    public function mount(): void
    {
        if (! empty($this->searchLabel) && !is_array($this->searchLabel)) {
            $this->searchLabel = [$this->searchLabel];
        }
        $this->setLabelList();
    }

    public function render(): View
    {
        $modelClass = config("our-work-pages.customOurWorkModel") ?? OurWork::class;
        $query = $modelClass::query()
            ->whereNotNull("published_at");
        if (! empty($this->searchLabel)) {
            $query->whereHas(
                "labels",
                fn($q) => $q->whereIn("slug", $this->searchLabel)
            );
        }
        $query->with(["labels", "image"]);
        $query->orderBy("priority");
        $works = $query->paginate();

        return view("owp::livewire.web.our-works.index-wire", compact("works"));
    }

    protected function setLabelList(): void
    {
        $modelClass = config("our-work-pages.customOurWorkLabelModel") ?? OurWorkLabel::class;
        $this->labelList = $modelClass::query()
            ->select("id", "title", "slug")
            ->orderBy("priority")
            ->get();
    }
}
