<?php

namespace ATW\ElementalBase\Models;

use DNADesign\Elemental\Models\BaseElement as ElementalBase;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldList;

class BaseElement extends ElementalBase
{
    private static $description = 'Base element class';

    private static $db = [
        'Variant' => 'Varchar(255)'
    ];

    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function (FieldList $fields) {
            $variants = $this->config()->get('variants');

            if ($variants && count($variants) > 0) {
                $variantDropdown = DropdownField::create('Variant', _t(__CLASS__.'.VARIANT', 'Variants'), $variants);

                $fields->addFieldToTab('Root.Main', $variantDropdown, "TitleAndDisplayed");

                $variantDropdown->setEmptyString(_t(__CLASS__.'.CHOOSE_VARIANT', 'Choose variant'));
            } else {
                $fields->removeByName('Variant');
            }

        });

        return parent::getCMSFields();
    }
}
