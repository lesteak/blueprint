<?php

namespace App\Crud\Rows;

use Illuminate\Support\Collection;
use Yadda\Enso\Crud\Forms\Fields\FileUploadFieldResumable;
use Yadda\Enso\Crud\Forms\Fields\TextField;
use Yadda\Enso\Crud\Forms\FlexibleContentSection;
use Yadda\Enso\Crud\Handlers\FlexibleRow;

/**
 * Represents a purely text row withing a flexible content collection.
 */
class ImageRow extends FlexibleContentSection
{
    /**
     * Default name for this section
     *
     * @param string
     */
    const DEFAULT_NAME = 'image';

    public function __construct(string $name = 'image')
    {
        parent::__construct($name);

        $this->addFields([
            FileUploadFieldResumable::make('images')
                ->setLabel('Image'),
        ]);
    }

    /**
     * Unpack Row-specific fields. Should be overriden in Rowspecs that extend
     * this class.
     *
     * If style is not selected, default to the first style in the config array
     *
     * @param FlexibleRow $row
     *
     * @return array
     */
    protected static function getRowContent(FlexibleRow $row): array
    {
        return [
            'image' => $row->block('images') ? $row->blockContent('images')->first() : null,
        ];
    }
}
