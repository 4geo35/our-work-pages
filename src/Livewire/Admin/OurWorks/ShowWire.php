<?php

namespace GIS\OurWorkPages\Livewire\Admin\OurWorks;

use GIS\OurWorkPages\Interfaces\OurWorkInterface;
use GIS\OurWorkPages\Traits\OurWorkEditActions;
use Illuminate\View\View;
use Livewire\Component;

class ShowWire extends Component
{
    use OurWorkEditActions;

    public OurWorkInterface $work;

    public function render(): View
    {
        return view("owp::livewire.admin.our-works.show-wire");
    }
}
