<?php

namespace GIS\OurWorkPages;

use GIS\OurWorkPages\Interfaces\OurWorkInterface;
use GIS\OurWorkPages\Models\OurWork;
use GIS\OurWorkPages\Observers\OurWorkObserver;
use GIS\UserManagement\Traits\ExpandPoliciesTrait;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use GIS\OurWorkPages\Livewire\Admin\OurWorks\IndexWire as AdminOurWorksIndexWire;
use GIS\OurWorkPages\Livewire\Admin\OurWorks\ShowWire as AdminOurWorksShowWire;
use Livewire\Livewire;

class OurWorkPagesServiceProvider extends ServiceProvider
{
    use ExpandPoliciesTrait;

    public function register(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        $this->mergeConfigFrom(__DIR__ . '/config/our-work-pages.php', 'our-work-pages');

        $this->loadRoutesFrom(__DIR__ . '/routes/admin.php');
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');

        $this->bindInterfaces();
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'owp');

        $this->expandConfiguration();
        $this->observeModels();
        $this->setPolicies();

        $this->addLivewireComponents();
    }

    protected function expandConfiguration(): void
    {
        $owp = app()->config["our-work-pages"];
        $this->expandPolicies($owp, ["ourWorkPolicy"]);

        $eb = app()->config["editable-blocks"];
        $models = $eb["models"];
        $models["our_works"] = [
            "allowedTypes" => $owp["allowedBlocks"],
        ];
        app()->config["editable-blocks.models"] = $models;
    }

    protected function setPolicies(): void
    {
        Gate::policy(config("our-work-pages.customOurWorkModel") ?? OurWork::class, config("our-work-pages.ourWorkPolicy"));
    }

    protected function addLivewireComponents(): void
    {
        $component = config("our-work-pages.customAdminOurWorkIndexComponent");
        Livewire::component(
            "owp-admin-our-works-index",
            $component ?? AdminOurWorksIndexWire::class
        );

        $component = config("our-work-pages.customAdminOurWorkShowComponent");
        Livewire::component(
            "owp-admin-our-works-show",
            $component ?? AdminOurWorksShowWire::class
        );
    }

    protected function bindInterfaces(): void
    {
        $modelClass = config("our-work-pages.customOurWorkModel") ?? OurWork::class;
        $this->app->bind(OurWorkInterface::class, $modelClass);
    }

    protected function observeModels(): void
    {
        $modelClass = config("our-work-pages.customOurWorkModel") ?? OurWork::class;
        $observerClass = config("our-work-pages.customOurWorkModelObserver") ?? OurWorkObserver::class;
        $modelClass::observe($observerClass);
    }
}
