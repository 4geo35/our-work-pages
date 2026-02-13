<?php

namespace GIS\OurWorkPages\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use GIS\OurWorkPages\Interfaces\OurWorkInterface;
use GIS\OurWorkPages\Models\OurWork;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class OurWorkController extends Controller
{
    public function index(): View
    {
        $modelClass = config("our-work-pages.customOurWorkModel") ?? OurWork::class;
        Gate::authorize("viewAny", $modelClass);
        return view("owp::admin.our-works.index");
    }

    public function show(OurWorkInterface $work): View
    {
        Gate::authorize("viewAny", $work);
        return view("owp::admin.our-works.show", compact("work"));
    }
}
