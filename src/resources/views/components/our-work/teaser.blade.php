@props(["work"])
@php($showUrl = route('web.our-works.show', ['work' => $work]))
<div class="flex flex-col h-full p-indent-xs border border-stroke rounded-base bg-white">
    @if ($work->image)
        <div class="mb-indent xs:h-[200px] sm:h-[240px] md:h-[314px] lg:h-[202px] xl:h-[258px] 2xl:h-[320px]">
            <picture>
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
    <div class="flex-1 flex flex-col justify-between px-indent-half">
        <div>
            <a href="{{ $showUrl }}" class="text-h4-mobile sm:text-h4 font-semibold hover:text-primary-hover">
                {{ $work->title }}
            </a>
            @if ($work->author_name)
                <div class="text-sm text-body/60">{{ $work->author_name }}</div>
            @endif
            @if ($work->labels->count())
                <div class="flex flex-wrap">
                    @foreach($work->labels as $workLabel)
                        <div class="flex items-center justify-center h-7.5 px-indent-sm mr-indent-xs mt-indent-xs bg-light rounded-base text-nowrap text-sm font-medium">
                            {{ $workLabel->title }}
                        </div>
                    @endforeach
                </div>
            @endif
            @if ($work->short)
                <div class="text-sm text-body/60 mt-indent-sm">{{ $work->short }}</div>
            @endif
            @if ($work->description)
                <div class="prose leading-tight max-w-none mt-indent">{!! $work->markdown !!}</div>
            @endif
            @if ($work->date_from || $work->date_to)
                <div class="flex flex-wrap xs:flex-nowrap mt-indent space-y-indent-xs xs:space-y-0 xs:space-x-indent-xs">
                    @if ($work->date_from)
                        <div class="w-full xs:flex-1 p-indent-xs xs:space-y-indent-xs bg-light rounded-base">
                            <div class="text-sm text-body/60">Дата начала работ:</div>
                            <div class="text-base xs:text-lg">
                                {{ $work->human_from }}
                            </div>
                        </div>
                    @endif
                    @if ($work->date_to)
                        <div class="w-full xs:flex-1 p-indent-xs xs:space-y-indent-xs bg-light rounded-base">
                            <div class="text-sm text-body/60">Дата окончания работ:</div>
                            <div class="text-base xs:text-lg">
                                {{ $work->human_to }}
                            </div>
                        </div>
                    @endif
                </div>
            @endif
        </div>
        <a href="{{ $showUrl }}" class="btn btn-primary w-full mt-indent">
            {{ config("our-work-pages.showBtnText") }}
        </a>
    </div>
</div>
