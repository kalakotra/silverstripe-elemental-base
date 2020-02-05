<?php
namespace ATW\ElementalBase\Extensions;

use DNADesign\Elemental\Extensions\ElementalPageExtension as BaseExtension;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldList;

class MenuPageExtension extends BaseExtension {

    private static $db = [
        "Menu" => "Varchar(50)"
    ];

    private static $defaults = [
        "Menu" => "main"
    ];

    private static $headless_fields = [
        "Menu" => "menu",
    ];

    public function updateCMSFields(FieldList $fields)
    {
        $menus = $this->owner->config()->get('menus');
        $menus_name = $this->owner->config()->get('menus-name');

        if (!$this->owner->ParentID && $menus && count($menus) > 0) {
            $variantDropdown = DropdownField::create('Menu',
                $menus_name?$menus_name:_t(__CLASS__.'.MENU', 'Menu'), $menus);

            $fields->addFieldToTab('Root.Main', $variantDropdown, "Content");

            $variantDropdown->setEmptyString(_t(__CLASS__.'.CHOOSE_MENU', 'Choose menu'));
        } else {
            $fields->removeByName('Menu');
        }
    }

}
