<?php

use Illuminate\Support\Facades\Route;
use GIS\OurWorkPages\Http\Controllers\Admin\OurWorkController;

Route::middleware(["web", "auth", "app-management"])
    ->prefix("admin")
    ->as("admin.")
    ->group(function () {
        Route::prefix("our-works")
            ->as("our-works.")
            ->group(function () {
                $controllerClass = config("our-work-pages.customOurWorkAdminController") ?? OurWorkController::class;
                Route::get("/", [$controllerClass, "index"])->name("index");
            });
    });
