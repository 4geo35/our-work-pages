<?php

namespace GIS\OurWorkPages;

use GIS\OurWorkPages\Interfaces\OurWorkInterface;
use GIS\OurWorkPages\Models\OurWork;
use GIS\OurWorkPages\Observers\OurWorkObserver;
use GIS\UserManagement\Traits\ExpandPoliciesTrait;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

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
    }

    protected function setPolicies(): void
    {
        Gate::policy(config("our-work-pages.customOurWorkModel") ?? OurWork::class, config("our-work-pages.ourWorkPolicy"));
    }

    protected function addLivewireComponents(): void
    {
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
