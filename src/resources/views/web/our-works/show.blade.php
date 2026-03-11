<x-app-layout>
    @include("owp::web.our-works.includes.show-metas")
    @include("owp::web.our-works.includes.show-breadcrumbs")
    @include("owp::web.our-works.includes.show-h1")

    @if ($showTeaser)
        @if ($isFullPage)
            @include("owp::web.our-works.includes.show-full")
        @else
            @include("owp::web.our-works.includes.show-thirds")
        @endif
    @else
        <div class="container">
            @include("owp::web.our-works.includes.show-blocks")
        </div>
    @endif
</x-app-layout>
