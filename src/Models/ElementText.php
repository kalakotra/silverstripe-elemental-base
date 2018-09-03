<?php

namespace ATW\ElementalBase\Models;

use ATW\ElementalBase\Models\BaseElement;
use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\FieldType\DBField;

class ElementText extends BaseElement
{
    private static $icon = 'font-icon-block-content';

    private static $db = [
        'Text' => 'HTMLText'
    ];

    private static $table_name = 'ElementText';

    private static $singular_name = 'text element';

    private static $plural_name = 'text element';

    private static $description = 'text element';

    /**
     * Re-title the HTML field to Content
     *
     * {@inheritDoc}
     */
    public function getCMSFields()
    {
        $this->beforeUpdateCMSFields(function (FieldList $fields) {
            $fields
                ->fieldByName('Root.Main.Text')
                ->setTitle(_t(__CLASS__ . '.ContentLabel', 'Content'));
        });
        return parent::getCMSFields();
    }

    public function getSummary()
    {
        return DBField::create_field('HTMLText', $this->Text)->Summary(20);
    }

    public function getType()
    {
        return _t(__CLASS__ . '.BlockType', 'Text');
    }
}
