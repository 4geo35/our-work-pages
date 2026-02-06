<?php

namespace GIS\OurWorkPages;

use Illuminate\Support\ServiceProvider;

class OurWorkPagesServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        $this->mergeConfigFrom(__DIR__ . '/config/our-work-pages.php', 'our-work-pages');

        $this->loadRoutesFrom(__DIR__ . '/routes/admin.php');
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
    }

    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'owp');

        $this->expandConfiguration();
        $this->setPolicies();

        $this->addLivewireComponents();
    }

    protected function expandConfiguration(): void
    {
    }

    protected function setPolicies(): void
    {
    }

    protected function addLivewireComponents(): void
    {
    }
}
