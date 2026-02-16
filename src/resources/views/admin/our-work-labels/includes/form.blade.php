<div class="space-y-indent-half mb-indent">
    @can("create", config("our-work-pages.customOurWorkLabelModel") ?? \GIS\OurWorkPages\Models\OurWorkLabel::class)
        <form wire:submit.prevent="store" id="ourWorkLabelStoreForm"
              class="flex flex-col space-y-indent-half md:flex-row md:space-x-indent-half md:space-y-0">
            <div>
                <input type="text" aria-label="Заголовок" placeholder="Заголовок*" required
                       class="form-control {{ $errors->has('title') ? 'border-danger' : '' }}"
                       wire:model="title" wire:loading.arrt="disabled">
                <x-tt::form.error name="title" />
            </div>

            <div>
                <input type="text" aria-label="Адресная строка" placeholder="Адресная строка"
                       class="form-control {{ $errors->has('slug') ? 'border-danger' : '' }}"
                       wire:model="slug" wire:loading.arrt="disabled">
                <x-tt::form.error name="slug" />
            </div>


            <button type="submit" form="ourWorkLabelStoreForm" class="btn btn-primary"
                    wire:loading.attr="disabled">
                Добавить
            </button>
        </form>
    @endcan
    <x-tt::notifications.error prefix="labels-" />
    <x-tt::notifications.success prefix="labels-" />
</div>
