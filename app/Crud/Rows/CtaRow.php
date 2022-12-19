<?php

namespace App\Crud\Rows;

use App\Crud\Fields\ButtonsField;
use Yadda\Enso\Crud\Forms\Fields\FileUploadFieldResumable;
use Yadda\Enso\Crud\Forms\Fields\TextField;
use Yadda\Enso\Crud\Forms\FlexibleContentSection;
use Yadda\Enso\Crud\Handlers\FlexibleRow;

/**
 * Represents a purely text row withing a flexible content collection.
 */
class CtaRow extends FlexibleContentSection
{
    /**
     * Default name for this section
     *
     * @param string
     */
    const DEFAULT_NAME = 'cta';

    /**
     * Constructor
     *
     * @param string $name
     */
    public function __construct(string $name = 'cta')
    {
        parent::__construct($name);

        $this
            ->excerptField('title')
            ->addFields([
                TextField::make('title')
                    ->addFieldsetClass('is-two-thirds'),
                FileUploadFieldResumable::make('images')
                    ->setLabel('Image')
                    ->addFieldsetClass('is-one-third'),
                ButtonsField::make('buttons'),
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
            'buttons' => $instance->getFlexibleContentFieldContent('buttons', $row),
            'image' => $row->block('images') ? $row->blockContent('images')->first() : null,
            'title' => $row->block('images') ? $row->blockContent('title') : '',
        ];
    }
}
