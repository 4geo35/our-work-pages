@if (config("our-work-pages.useH1"))
    <div class="container">
        <x-tt::h1 class="mb-indent">{{ $work->title }}</x-tt::h1>
    </div>
@endif
