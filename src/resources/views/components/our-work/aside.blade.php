@props(["work"])
@php($fullData = config("our-work-pages.fullAside"))
<div class="p-indent-xs lg:p-indent rounded-base bg-white">
    @if ($fullData && $work->image)
        <div class="mb-indent lg:h-[164px] xl:h-[216px] 2xl:h-[275px]">
            <picture>
                <source media="(min-width: 1024px)"
                        srcset="{{ route('thumb-img', ['template' => "our-work-aside", 'filename' => $work->image->filename]) }}">
                <source media="(min-width: 768px)"
                        srcset="{{ route('thumb-img', ['template' => "our-work-teaser", 'filename' => $work->image->filename]) }}">
                <source media="(min-width: 480px)"
                        srcset="{{ route('thumb-img', ['template' => "tablet-our-work-teaser", 'filename' => $work->image->filename]) }}">
                <img src="{{ route("thumb-img", ["template" => "mobile-our-work-teaser", "filename" => $work->image->filename]) }}"
                     class="rounded-base"
                     alt="">
            </picture>
        </div>
    @endif
    @if ($work->author_name)
        <div class="text-sm text-body/60">{{ $work->author_name }}</div>
    @endif
    @if ($work->labels->count())
        <div class="flex flex-wrap">
            @foreach($work->labels as $workLabel)
                <a href="{{ route("web.our-works.index") }}?{{ config("our-work-pages.queryLabelKey") }}[0]={{ $workLabel->slug }}"
                   class="btn btn-sm btn-outline-secondary mr-indent-xs mt-indent-xs">
                    {{ $workLabel->title }}
                </a>
            @endforeach
        </div>
    @endif
    @if ($work->short)
        <div class="text-sm text-body/60 mt-indent-sm">{{ $work->short }}</div>
    @endif
    @if ($fullData && $work->description)
        <div class="prose leading-tight max-w-none mt-indent">{!! $work->markdown !!}</div>
    @endif
    @if ($fullData && ($work->date_from || $work->date_to))
        <div class="flex flex-wrap xs:flex-nowrap lg:flex-wrap 2xl:flex-nowrap mt-indent space-y-indent-xs xs:space-y-0 xs:space-x-indent-xs lg:space-y-indent-xs lg:space-x-0 2xl:space-y-0 2xl:space-x-indent-xs">
            @if ($work->date_from)
                <div class="w-full xs:flex-1 lg:flex-auto 2xl:flex-1 p-indent-xs xs:space-y-indent-xs bg-white rounded-base shadow-[0_0_40px_0_rgba(0,0,0,0.1)]">
                    <div class="text-sm text-body/60">Дата начала работ:</div>
                    <div class="text-base xs:text-lg">
                        {{ $work->human_from }}
                    </div>
                </div>
            @endif
            @if ($work->date_to)
                <div class="w-full xs:flex-1 lg:flex-auto 2xl:flex-1 p-indent-xs xs:space-y-indent-xs bg-white rounded-base shadow-[0_0_40px_0_rgba(0,0,0,0.1)]">
                    <div class="text-sm text-body/60">Дата окончания работ:</div>
                    <div class="text-base xs:text-lg">
                        {{ $work->human_to }}
                    </div>
                </div>
            @endif
        </div>
    @endif
</div>
