@if (config("our-work-pages.useBreadcrumbs"))
    @php($homeUrl = \Illuminate\Support\Facades\Route::has("web.home") ? route("web.home") : "/")
    <x-tt::breadcrumbs>
        <x-tt::breadcrumbs.item :url="$homeUrl">Главная</x-tt::breadcrumbs.item>
        <x-tt::breadcrumbs.item :url="route('web.our-works.index')">
            {{ config("our-work-pages.pageTitle") }}
        </x-tt::breadcrumbs.item>
        <x-tt::breadcrumbs.item>{{ $work->title }}</x-tt::breadcrumbs.item>
    </x-tt::breadcrumbs>
@endif
