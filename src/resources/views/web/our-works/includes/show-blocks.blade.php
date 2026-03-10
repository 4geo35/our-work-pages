@if ($blocks)
    @foreach($blocks as $block)
        <x-dynamic-component :component="$block->render_type_component" :$block class="mb-indent" :$isFullPage />
    @endforeach
@endif
