<?php
namespace ATW\ElementalBase\Extensions;

use DNADesign\Elemental\Models\ElementalArea;
use DNADesign\Elemental\Extensions\ElementalAreasExtension;
use SilverStripe\Core\Extension;

class MenuContentControllerExtension extends Extension
{
    public function FilteredMenu($menu="main", $level=1) {
        return $this->owner->getMenu($level)->filter("Menu", $menu);
    }
}