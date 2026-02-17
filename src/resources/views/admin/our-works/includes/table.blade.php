<x-tt::table>
    <x-slot name="head">
        <tr>
            <x-tt::table.heading class="text-left text-nowrap">Заголовок</x-tt::table.heading>
            <x-tt::table.heading class="text-left text-nowrap">Адресная строка</x-tt::table.heading>
            <x-tt::table.heading class="text-left text-nowrap">Дополнительно</x-tt::table.heading>
            <x-tt::table.heading class="text-left text-nowrap">Метки</x-tt::table.heading>
            <x-tt::table.heading>Действия</x-tt::table.heading>
        </tr>
    </x-slot>
    <x-slot name="body">
        @foreach($works as $item)
            <tr>
                <td>{{ $item->title }}</td>
                <td>{{ $item->slug }}</td>
                <td>
                    <ul>
                        <li><span class="font-semibold">Дата от:</span> {{ $item->date_from }}</li>
                        <li><span class="font-semibold">Дата до:</span> {{ $item->date_to }}</li>
                        <li><span class="font-semibold">Автор:</span> {{ $item->author_name }}</li>
                    </ul>
                </td>
                <td>
                    <ul class="list-disc">
                        @foreach($item->labels as $labelItem)
                            <li>{{ $labelItem->title }}</li>
                        @endforeach
                    </ul>
                </td>
                <td>
                    <div class="flex justify-center">
                        @if ($item->image_id)
                            <a href="{{ route('thumb-img', ['filename' => $item->image->filename, 'template' => 'original']) }}"
                               class="btn btn-primary px-btn-x-ico mr-indent-half" target="_blank">
                                <x-tt::ico.image/>
                            </a>
                        @endif

                        @can("viewAny", $item::class)
                            <a href="{{ route('admin.our-works.show', ['work' => $item]) }}"
                               class="btn btn-primary px-btn-ico-text rounded-e-none">
                                <x-tt::ico.eye/>
                            </a>
                        @else
                            <button type="button" class="btn btn-primary px-btn-x-ico rounded-e-none" disabled>
                                <x-tt::ico.eye/>
                            </button>
                        @endcan
                        <button type="button" class="btn btn-dark px-btn-x-ico rounded-none"
                                @cannot("update", $item) disabled
                                @else wire:loading.attr="disabled"
                                @endcannot
                                wire:click="showEdit({{ $item->id }})">
                            <x-tt::ico.edit/>
                        </button>
                        <button type="button" class="btn btn-danger px-btn-x-ico rounded-s-none"
                                @cannot("delete", $item) disabled
                                @else wire:loading.attr="disabled"
                                @endcannot
                                wire:click="showDelete({{ $item->id }})">
                            <x-tt::ico.trash/>
                        </button>

                        <button type="button"
                                class="btn {{ $item->published_at ? 'btn-success' : 'btn-danger' }} px-btn-x-ico ml-indent-half"
                                @cannot("update", $item) disabled
                                @else wire:loading.attr="disabled"
                                @endcannot
                                wire:click="switchPublish({{ $item->id }})">
                            @if ($item->published_at)
                                <x-tt::ico.toggle-on/>
                            @else
                                <x-tt::ico.toggle-off/>
                            @endif
                        </button>
                    </div>
                </td>
            </tr>
        @endforeach
    </x-slot>
</x-tt::table>
