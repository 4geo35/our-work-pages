<x-app-layout>
    @include("owp::web.our-works.includes.show-metas")
    @include("owp::web.our-works.includes.show-breadcrumbs")
    @include("owp::web.our-works.includes.show-h1")

    @if ($isFullPage)
        @include("owp::web.our-works.includes.show-full")
    @else
        @include("owp::web.our-works.includes.show-thirds")
    @endif
</x-app-layout>
