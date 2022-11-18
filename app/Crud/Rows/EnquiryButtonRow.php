<?php

namespace App\Crud\Rows;

use App\Crud\Traits\HasComponents;
use Yadda\Enso\Crud\Forms\Fields\TextField;
use Yadda\Enso\Crud\Forms\FlexibleContentSection;
use Yadda\Enso\Crud\Handlers\FlexibleRow;

class EnquiryButtonRow extends FlexibleContentSection
{
    use HasComponents;

    /**
     * Default name for this section
     *
     * @param string
     */
    const DEFAULT_NAME = 'enquirybutton';

    public function __construct(string $name = 'enquirybutton')
    {
        parent::__construct($name);

        $this->setLabel('Enquiry Button')
            ->excerptField('label')
            ->addFields([
                TextField::make('label')
                    ->setLabel('Text')
                    ->addFieldsetClass('is-5'),
                TextField::make('hover')
                    ->setLabel('Hover Text')
                    ->addFieldsetClass('is-5'),
                static::componentsField('button_components')
                    ->setLabel('Modifiers')
                    ->addFieldsetClass('is-2'),
            ]);
    }

    /**
     * Unpack Row-specific fields.
     *
     * @param FlexibleRow $row
     *
     * @return array
     */
    protected static function getRowContent(FlexibleRow $row): array
    {
        $instance = static::make();

        return [
            'button_components' => $instance->getSelectedComponents($row, 'button_components'),
            'hover' => $row->blockContent('hover'),
            'label' => $row->blockContent('label'),
        ];
    }
}
