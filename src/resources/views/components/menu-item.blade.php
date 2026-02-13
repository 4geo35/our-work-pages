@can("viewAny", config("our-work-pages.customOurWorkModel") ?? \GIS\OurWorkPages\Models\OurWork::class)
    <x-tt::admin-menu.item
        href="{{ route('admin.our-works.index') }}"
        :active="in_array(\Illuminate\Support\Facades\Route::currentRouteName(), ['admin.our-works.index', 'admin.our-works.show'])">
        <x-slot name="ico"><x-owp::ico.work-history /></x-slot>
        Наши работы
    </x-tt::admin-menu.item>
@endcan
