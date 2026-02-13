<div>
    <div class="card">
        <div class="card-header">
            <div class="space-y-indent-half">
                @include("owp::admin.our-works.includes.show-title")
                <x-tt::notifications.error />
                <x-tt::notifications.success />
            </div>
        </div>
        <div class="card-body">
            @include("owp::admin.our-works.includes.show-body")
        </div>
    </div>

    @include("owp::admin.our-works.includes.table-modals")
</div>
