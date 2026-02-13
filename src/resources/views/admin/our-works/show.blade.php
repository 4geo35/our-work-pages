<x-admin-layout>
    <x-slot name="title">Просмотр работы</x-slot>
    <x-slot name="pageTitle">Просмотр работы</x-slot>

    <div class="space-y-indent-half">
        <livewire:owp-admin-our-works-show :$work />
        <livewire:eb-manage-blocks :model="$work" />
        <livewire:eb-block-list :model="$work" />
        <livewire:ma-metas :model="$work" />
    </div>
</x-admin-layout>
