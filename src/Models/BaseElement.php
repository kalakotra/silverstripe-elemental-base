<?php

namespace ATW\ElementalBase\Models;

use DNADesign\Elemental\Models\BaseElement as ElementalBase;
use SilverStripe\Forms\CheckboxSetField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldList;

class BaseElement extends ElementalBase
{
    private static $description = 'Base element class';

    private static $table_name = 'ElementBase';

    private static $db = [
        'Variant' => 'Varchar(255)',
        'Options' => 'Varchar(255)',
    ];

    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function (FieldList $fields) {
            $variants = $this->config()->get('variants');
            $variants_name = $this->config()->get('variants-name');

            if ($variants && count($variants) > 0) {
                $variantDropdown = DropdownField::create('Variant',
                    $variants_name?$variants_name:_t(__CLASS__.'.VARIANT', 'Variants'), $variants);

                $fields->addFieldToTab('Root.Main', $variantDropdown, "TitleAndDisplayed");

                $variantDropdown->setEmptyString(_t(__CLASS__.'.CHOOSE_VARIANT', 'Choose variant'));
            } else {
                $fields->removeByName('Variant');
            }

            $options = $this->config()->get('options');
            $options_name = $this->config()->get('options-name');

            if ($options && count($options) > 0) {
                $optionsField = CheckboxSetField::create('Options',
                    $options_name?$options_name:_t(__CLASS__.'.VARIANT', 'Variants'), $options);

                $fields->addFieldToTab('Root.Main', $optionsField, "TitleAndDisplayed");
            } else {
                $fields->removeByName('Options');
            }

        });

        return parent::getCMSFields();
    }

    public function getVariantClasses() {
        $classes = [];
        if($this->Variant)
            $classes[] = $this->Variant;
        if($options = $this->Options) {
            $options = json_decode(trim($options));
            $classes = array_merge($classes, $options);
        }
        return implode(" ", $classes);
    }
}
