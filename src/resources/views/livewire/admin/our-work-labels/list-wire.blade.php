<x-tt::modal.dialog wire:model="displayList">
    <x-slot name="title">Доступные метки</x-slot>
    <x-slot name="content">
        @include("owp::admin.our-work-labels.includes.form")
        @include("owp::admin.our-work-labels.includes.table")
    </x-slot>
</x-tt::modal.dialog>
