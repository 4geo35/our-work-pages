<div class="flex justify-between mb-indent-half">
    <div class="flex flex-col space-y-indent-half md:flex-row md:space-x-indent-half md:space-y-0">
        <input type="text" aria-label="Заголовок" placeholder="Заголовок" class="form-control"
               wire:model.live="searchTitle">
        <select class="form-select" aria-label="Статус публикации" wire:model.live="searchPublished">
            <option value="all">Любая публикация</option>
            <option value="yes">Опубликовано</option>
            <option value="no">Снято с публикации</option>
        </select>
        <button type="button" class="btn btn-outline-primary" wire:click="clearSearch">
            Очистить
        </button>
    </div>

    <div class="flex items-center space-x-2 ml-indent-half">
        @can("create", config("our-work-pages.customOurWorkModel") ?? \GIS\OurWorkPages\Models\OurWork::class)
            <button type="button" class="btn btn-primary px-btn-x-ico lg:px-btn-x" wire:click="showCreate">
                <x-tt::ico.circle-plus/>
                <span class="hidden lg:inline-block pl-btn-ico-text">Добавить</span>
            </button>
        @endcan
        @can("order", config("our-work-pages.customOurWorkModel") ?? \GIS\OurWorkPages\Models\OurWork::class)
            <button type="button" class="btn btn-primary px-btn-x-ico lg:px-btn-x" wire:click="showOrder">
                <x-tt::ico.bars />
                <span class="hidden lg:inline-block pl-btn-ico-text">Порядок</span>
            </button>
        @endcan
        <button type="button" class="btn btn-primary px-btn-x-ico lg:px-btn-x" wire:click="showList">
            <x-owp::ico.new-label />
            <span class="hidden lg:inline-block pl-btn-ico-text">Метки</span>
        </button>
    </div>
</div>
