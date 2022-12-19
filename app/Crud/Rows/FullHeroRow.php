<?php

namespace App\Crud\Rows;

use App\Crud\Fields\ButtonsField;
use Illuminate\Support\Facades\Config;
use Yadda\Enso\Crud\Forms\Fields\FileUploadFieldResumable;
use Yadda\Enso\Crud\Forms\Fields\TextField;
use Yadda\Enso\Crud\Forms\Fields\WysiwygField;
use Yadda\Enso\Crud\Forms\FlexibleContentSection;
use Yadda\Enso\Crud\Handlers\FlexibleRow;

/**
 * Represents a purely text row withing a flexible content collection.
 */
class FullHeroRow extends FlexibleContentSection
{
    /**
     * Default name for this section
     *
     * @param string
     */
    const DEFAULT_NAME = 'fullhero';

    /**
     * Array of style options
     *
     * @var array
     */
    protected $styles;

    public function __construct(string $name = 'fullhero')
    {
        parent::__construct($name);

        $this
            ->setLabel('Full Hero')
            ->excerptField('title')
            ->addFields([
                TextField::make('title'),
                WysiwygField::make('content')
                    ->setModules(Config::get('enso.flexible-content.rows.fullhero.modules', [])),
                FileUploadFieldResumable::make('desktop_images')
                    ->setLabel('Desktop Image')
                    ->addFieldsetClass('is-half'),
                FileUploadFieldResumable::make('mobile_images')
                    ->setLabel('Mobile Image')
                    ->addFieldsetClass('is-half'),
                ButtonsField::make('buttons'),
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
            'buttons' => static::make()->getFlexibleContentFieldContent('buttons', $row),
            'content' => static::getWysiwygHtml($row->getBlocks(), 'content'),
            'desktop_image' => $desktop_image ?? $mobile_image,
            'divider' => [  // Full Hero always has a bottom divider.
                'bottom' => true,
            ],
            'mobile_image' => $mobile_image ?? $desktop_image,
            'title' => $row->block('title') ? $row->blockContent('title') : '',
        ];
    }
}
