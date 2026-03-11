@props(["work"])
<div class="p-indent-xs bg-white rounded-base border border-stroke">
    <div class="row">
        <div class="col w-full lg:w-1/2 xl:w-7/12 lg:order-last">
            @if ($work->image)
                <div class="xs:h-[200px] sm:h-[240px] md:h-[314px] lg:h-[530px]">
                    <picture>
                        <source media="(min-width: 1024px)"
                                srcset="{{ route('thumb-img', ['template' => "our-work-full", 'filename' => $work->image->filename]) }}">
                        <source media="(min-width: 768px)"
                                srcset="{{ route('thumb-img', ['template' => "our-work-teaser", 'filename' => $work->image->filename]) }}">
                        <source media="(min-width: 480px)"
                                srcset="{{ route('thumb-img', ['template' => "tablet-our-work-teaser", 'filename' => $work->image->filename]) }}">
                        <img src="{{ route("thumb-img", ["template" => "mobile-our-work-teaser", "filename" => $work->image->filename]) }}"
                             class="rounded-base h-full object-cover object-center"
                             alt="">
                    </picture>
                </div>
            @endif
        </div>
        <div class="col w-full lg:w-1/2 xl:w-5/12">
            <div class="flex flex-col justify-between h-full pt-indent-half pl-indent-half space-y-indent-half">
                <div>
                    @if ($work->author_name)
                        <div class="text-sm text-body/60">{{ $work->author_name }}</div>
                    @endif
                    @if ($work->labels->count())
                        <div class="flex flex-wrap">
                            @foreach($work->labels as $workLabel)
                                <a href="{{ $workLabel->index_link }}"
                                   class="btn btn-sm btn-outline-secondary mr-indent-xs mt-indent-xs">
                                    {{ $workLabel->title }}
                                </a>
                            @endforeach
                        </div>
                    @endif
                    @if ($work->short)
                        <div class="text-sm text-body/60 mt-indent-sm">{{ $work->short }}</div>
                    @endif
                    @if ($work->description)
                        <div class="prose leading-tight max-w-none mt-indent">{!! $work->markdown !!}</div>
                    @endif
                </div>

                @if ($work->date_from || $work->date_to)
                    <div class="flex flex-wrap xs:flex-nowrap mt-indent space-y-indent-xs xs:space-y-0 xs:space-x-indent-xs">
                        @if ($work->date_from)
                            <div class="w-full xs:flex-1 p-indent-xs xs:space-y-indent-xs bg-body-bg rounded-base">
                                <div class="text-sm text-body/60">Дата начала работ:</div>
                                <div class="text-base xs:text-lg">
                                    {{ $work->human_from }}
                                </div>
                            </div>
                        @endif
                        @if ($work->date_to)
                            <div class="w-full xs:flex-1 p-indent-xs xs:space-y-indent-xs bg-body-bg rounded-base">
                                <div class="text-sm text-body/60">Дата окончания работ:</div>
                                <div class="text-base xs:text-lg">
                                    {{ $work->human_to }}
                                </div>
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
