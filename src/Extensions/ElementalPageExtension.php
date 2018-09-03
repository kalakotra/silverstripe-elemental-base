<?php
namespace ATW\ElementalBase\Extensions;

use DNADesign\Elemental\Extensions\ElementalPageExtension as BaseExtension;
use DNADesign\Elemental\Models\ElementalArea;
use SilverStripe\ORM\ArrayList;
use SilverStripe\View\ArrayData;

class ElementalPageExtension extends BaseExtension {

    public function getSubMenu() {
        $menu = new ArrayList();

        $menu_items = $this->getElementsForMenu();
        foreach($menu_items as $element) {
            $menu->push(new ArrayData([
                "Link" => "#".$element->getAnchor(),
                "Title" => $element->getMenuTitle()
            ]));
        }

        return $menu;
    }

    public function getElementsForMenu()
    {
        $menu_items = [];
        foreach ($this->owner->hasOne() as $key => $class) {
            if ($class !== ElementalArea::class) {
                continue;
            }

            /** @var ElementalArea $area */
            $area = $this->owner->$key();
            if ($area) {
                /* @var $element \ATW\ElementalBase\Models\BaseElement */
                foreach($area->Elements() as $element) {
                    if($element->ShowInMenu) {
                        $menu_items[] = $element;
                    }
                }
            }
        }
        return $menu_items;
    }

}