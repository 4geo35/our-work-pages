<div class="container">
    @include("owp::web.our-works.includes.label-list")

    <div class="row">
        @foreach($works as $work)
            <div class="col w-full md:w-1/2 mb-indent">
                <x-owp::our-work.teaser :$work />
            </div>
        @endforeach
    </div>

    <div class="flex justify-between">
        <div>Всего: {{ $works->total() }}</div>
        {{ $works->links("tt::pagination.web-live") }}
    </div>
</div>
