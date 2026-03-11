<div class="flex justify-between items-center overflow-x-auto beautify-scrollbar">
    <h2 class="font-medium text-2xl text-nowrap mr-indent-half">
        {{ $work->title }}
    </h2>

    <div class="flex justify-end">
        @if ($work->image_id && $work->image)
            <a href="{{ route('thumb-img', ['filename' => $work->image->filename, 'template' => 'original']) }}"
               class="btn btn-primary px-btn-x-ico mr-indent-half" target="_blank">
                <x-tt::ico.image/>
            </a>
        @endif

        <button type="button" class="btn btn-dark px-btn-x-ico rounded-e-none"
                @cannot("update", $work) disabled
                @else wire:loading.attr="disabled"
                @endcannot
                wire:click="showEdit({{ $work->id }})">
            <x-tt::ico.edit/>
        </button>
        <button type="button" class="btn btn-danger px-btn-x-ico rounded-s-none"
                @cannot("delete", $work) disabled
                @else wire:loading.attr="disabled"
                @endcannot
                wire:click="showDelete({{ $work->id }})">
            <x-tt::ico.trash/>
        </button>

        <button type="button"
                class="btn {{ $work->published_at ? 'btn-success' : 'btn-danger' }} px-btn-x-ico ml-indent-half"
                @cannot("update", $work) disabled
                @else wire:loading.attr="disabled"
                @endcannot
                wire:click="switchPublish({{ $work->id }})">
            @if ($work->published_at)
                <x-tt::ico.toggle-on/>
            @else
                <x-tt::ico.toggle-off/>
            @endif
        </button>
    </div>
</div>
