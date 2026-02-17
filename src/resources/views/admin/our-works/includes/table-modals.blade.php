<x-tt::modal.confirm wire:model="displayDelete">
    <x-slot name="title">Удалить работу</x-slot>
    <x-slot name="text">Будет невозможно восстановить работу!</x-slot>
</x-tt::modal.confirm>

<x-tt::modal.dialog wire:model="displayData">
    <x-slot name="title">{{ $workId ? "Редактировать" : "Добавить" }} работу</x-slot>
    <x-slot name="content">
        <form wire:submit.prevent="{{ $workId ? 'update' : 'store' }}" class="space-y-indent-half" id="ourWorkDataForm">

            <div>
                <label for="ourWorkTitle" class="inline-block mb-2">
                    Заголовок<span class="text-danger">*</span>
                </label>
                <input type="text" id="ourWorkTitle"
                       class="form-control {{ $errors->has("title") ? "border-danger" : "" }}"
                       required
                       wire:loading.attr="disabled"
                       wire:model="title">
                <x-tt::form.error name="title"/>
            </div>

            <div>
                <label for="ourWorkSlug" class="inline-block mb-2">
                    Адресная строка
                </label>
                <input type="text" id="ourWorkSlug"
                       class="form-control {{ $errors->has("slug") ? "border-danger" : "" }}"
                       wire:loading.attr="disabled"
                       wire:model="slug">
                <x-tt::form.error name="slug"/>
            </div>

            <div>
                <label for="ourWorkShort" class="inline-block mb-2">
                    Краткое описание
                </label>
                <input type="text" id="ourWorkShort"
                       class="form-control {{ $errors->has("short") ? "border-danger" : "" }}"
                       wire:loading.attr="disabled"
                       wire:model="short">
                <x-tt::form.error name="short"/>
            </div>

            <div>
                <label for="ourWorkCover" class="inline-block mb-2">Изображение</label>
                <input type="file" id="ourWorkCover"
                       class="form-control {{ $errors->has('cover') ? 'border-danger' : '' }}"
                       wire:loading.attr="disabled"
                       wire:model.lazy="cover">
                <x-tt::form.error name="cover"/>
                @include("tt::admin.delete-image-button")
            </div>

            <div>
                <div class="inline-block mb-2">Метки</div>
                @isset($labelList)
                    <div class="space-y-2">
                        @foreach($labelList as $labelItem)
                            <div class="form-check">
                                <input type="checkbox" wire:model="labels"
                                       class="form-check-input" id="ourWorkLabel-{{ $labelItem->id }}"
                                       value="{{ $labelItem->id }}">
                                <label for="ourWorkLabel-{{ $labelItem->id }}" class="form-check-label">
                                    {{ $labelItem->title }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                @endisset
            </div>

            <div>
                <label for="ourWorkDateFrom" class="inline-block mb-2">
                    Дата от
                </label>
                <input type="date" id="ourWorkDateFrom"
                       class="form-control {{ $errors->has("dateFrom") ? "border-danger" : "" }}"
                       wire:loading.attr="disabled"
                       wire:model="dateFrom">
                <x-tt::form.error name="dateFrom"/>
            </div>

            <div>
                <label for="ourWorkDateTo" class="inline-block mb-2">
                    Дата до
                </label>
                <input type="date" id="ourWorkDateTo"
                       class="form-control {{ $errors->has("dateTo") ? "border-danger" : "" }}"
                       wire:loading.attr="disabled"
                       wire:model="dateTo">
                <x-tt::form.error name="dateTo"/>
            </div>

            <div>
                <label for="ourWorkAuthorName" class="inline-block mb-2">
                    Имя автора
                </label>
                <input type="text" id="ourWorkAuthorName"
                       class="form-control {{ $errors->has("authorName") ? "border-danger" : "" }}"
                       wire:loading.attr="disabled"
                       wire:model="authorName">
                <x-tt::form.error name="authorName"/>
            </div>

            <div>
                <label for="ourWorkDescription" class="flex justify-start items-center mb-2">
                    Описание
                    @include("tt::admin.description-button", ["id" => "ourWorkDescriptionHidden"])
                </label>
                @include("tt::admin.description-info", ["id" => "ourWorkDescriptionHidden"])
                <textarea id="ourWorkDescription" class="form-control !min-h-52 {{ $errors->has('description') ? 'border-danger' : '' }}"
                          rows="10"
                          wire:model.live="description">
                        {{ $description }}
                    </textarea>
                <x-tt::form.error name="description" />

                <div class="prose prose-sm mt-indent-half">
                    {!! \Illuminate\Support\Str::markdown($description) !!}
                </div>
            </div>

            <div class="flex items-center space-x-indent-half">
                <button type="button" class="btn btn-outline-dark" wire:click="closeData">
                    Отмена
                </button>
                <button type="submit" form="ourWorkDataForm" class="btn btn-primary"
                        wire:loading.attr="disabled">
                    {{ $workId ? "Обновить" : "Добавить" }}
                </button>
            </div>
        </form>
    </x-slot>
</x-tt::modal.dialog>
