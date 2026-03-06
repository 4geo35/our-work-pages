<?php

use Illuminate\Support\Facades\Route;
use GIS\OurWorkPages\Http\Controllers\Web\OurWorkController;

Route::middleware(["web"])
    ->as("web.")
    ->group(function () {
        Route::prefix(config("our-work-pages.urlPrefix"))
            ->as("our-works.")
            ->group(function () {
                $controllerClass = config("our-work-pages.customOurWorkWebController") ?? OurWorkController::class;
                Route::get("/", [$controllerClass, "index"])->name("index");
                Route::get("/{work}", [$controllerClass, "show"])->name("show");
            });
    });
