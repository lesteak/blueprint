<?php

namespace App\Crud\Rows;

use Yadda\Enso\Crud\Forms\Fields\FileUploadFieldResumable;
use Yadda\Enso\Crud\Forms\Fields\TextField;
use Yadda\Enso\Crud\Forms\FlexibleContentSection;
use Yadda\Enso\Crud\Handlers\FlexibleRow;

/**
 * Represents a purely text row withing a flexible content collection.
 */
class HeroRow extends FlexibleContentSection
{
    /**
     * Default name for this section
     *
     * @param string
     */
    const DEFAULT_NAME = 'hero';

    /**
     * Array of style options
     *
     * @var array
     */
    protected $styles;

    public function __construct(string $name = 'hero')
    {
        parent::__construct($name);

        $this->addFields([
            TextField::make('title'),
            FileUploadFieldResumable::make('desktop_images')
                ->setLabel('Desktop Image')
                ->addFieldsetClass('is-half'),
            FileUploadFieldResumable::make('mobile_images')
                ->setLabel('Mobile Image')
                ->addFieldsetClass('is-half'),
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
        $desktop_image = $row->block('desktop_images') ? $row->blockContent('desktop_images')->first() : null;
        $mobile_image = $row->block('mobile_images') ? $row->blockContent('mobile_images')->first() : null;

        return [
            'desktop_image' => $desktop_image ?? $mobile_image,
            'mobile_image' => $mobile_image ?? $desktop_image,
            'title' => $row->block('title') ? $row->blockContent('title') : '',
        ];
    }
}
