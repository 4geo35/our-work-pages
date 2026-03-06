<?php

namespace GIS\OurWorkPages\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use GIS\Metable\Facades\MetaActions;
use GIS\OurWorkPages\Interfaces\OurWorkInterface;
use Illuminate\View\View;

class OurWorkController extends Controller
{
    public function index(): View
    {
        $metas = MetaActions::renderByPage(config("our-work-pages.urlPrefix"));
        return view('owp::web.our-works.index', compact('metas'));
    }

    public function show(OurWorkInterface $work): View
    {
        if (! $work->published_at) { abort(404); }
        $metas = MetaActions::renderByModel($work);
        $blocks = $work->blocks()->orderBy("priority")->get();
        return view("owp::web.our-works.show", compact('work', 'metas', 'blocks'));
    }
}
