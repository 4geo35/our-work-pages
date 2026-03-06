@if ($labelList && $labelList->count())
    <div class="flex flex-wrap px-indent-xs pt-indent-xs mb-indent-lg rounded-base bg-white">
        @foreach($labelList as $labelItem)
            <label for="label-{{ $labelItem->slug }}"
                   class="btn btn-sm not-checked:btn-outline-secondary has-checked:btn-secondary mr-indent-xs mb-indent-xs has-disabled:opacity-25">
                {{ $labelItem->title }}
                <input type="checkbox" value="{{ $labelItem->slug }}"
                       id="label-{{ $labelItem->slug }}" class="hidden"
                       wire:model.live="searchLabel" wire:loading.attr="disabled" />
            </label>
        @endforeach
    </div>
@endif
