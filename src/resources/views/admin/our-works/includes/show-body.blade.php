<div class="row">
    <div class="col w-full md:w-1/2 mb-indent-half md:mb-0 flex flex-col gap-indent-half">
        <div class="row">
            <div class="col w-full xs:w-2/5 mb-indent-half xs:mb-0">
                <h3 class="font-semibold">Адресная строка</h3>
            </div>
            <div class="col w-full xs:w-3/5">{{ $work->slug }}</div>
        </div>

        <div class="row">
            <div class="col w-full xs:w-2/5 mb-indent-half xs:mb-0">
                <h3 class="font-semibold">Краткое описание</h3>
            </div>
            <div class="col w-full xs:w-3/5">{{ $work->short }}</div>
        </div>

        <div class="row">
            <div class="col w-full xs:w-2/5 mb-indent-half xs:mb-0">
                <h3 class="font-semibold">Метки</h3>
            </div>
            <div class="col w-full xs:w-3/5">
                <ul class="list-disc">
                    @foreach($work->labels as $labelItem)
                        <li>{{ $labelItem->title }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col w-full xs:w-2/5 mb-indent-half xs:mb-0">
                <h3 class="font-semibold">Дата от</h3>
            </div>
            <div class="col w-full xs:w-3/5">{{ $work->human_from }}</div>
        </div>

        <div class="row">
            <div class="col w-full xs:w-2/5 mb-indent-half xs:mb-0">
                <h3 class="font-semibold">Дата до</h3>
            </div>
            <div class="col w-full xs:w-3/5">{{ $work->human_to }}</div>
        </div>

        <div class="row">
            <div class="col w-full xs:w-2/5 mb-indent-half xs:mb-0">
                <h3 class="font-semibold">Имя автора</h3>
            </div>
            <div class="col w-full xs:w-3/5">{{ $work->author_name }}</div>
        </div>

    </div>

    <div class="col w-full md:w-1/2 mb-indent-half md:mb-0 flex flex-col gap-indent-half">
        <div>
            <h3 class="font-semibold">Описание</h3>
            <div class="prose max-w-none">{!! $work->markdown !!}</div>
        </div>
    </div>
</div>
