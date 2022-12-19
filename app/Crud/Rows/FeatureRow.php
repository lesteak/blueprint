<?php

namespace App\Crud\Rows;

use App\Crud\Fields\ButtonsField;
use App\Crud\Traits\HasAlignment;
use Illuminate\Support\Facades\Config;
use Yadda\Enso\Crud\Forms\Fields\FileUploadFieldResumable;
use Yadda\Enso\Crud\Forms\Fields\TextField;
use Yadda\Enso\Crud\Forms\Fields\WysiwygField;
use Yadda\Enso\Crud\Forms\FlexibleContentSection;
use Yadda\Enso\Crud\Handlers\FlexibleRow;

/**
 * Represents a purely text row withing a flexible content collection.
 */
class FeatureRow extends FlexibleContentSection
{
    use HasAlignment;

    /**
     * Default name for this section
     *
     * @param string
     */
    const DEFAULT_NAME = 'feature';

    /**
     * Create a new instance of Features
     */
    public function __construct(string $name = 'feature')
    {
        parent::__construct($name);

        $this
            ->setLabel('Features')
            ->excerptField('title')
            ->addFields([
                TextField::make('title')
                    ->addFieldsetClass('is-9'),
                static::alignmentField()
                    ->setLabel('Image alignment')
                    ->addFieldsetClass('is-3'),
                FileUploadFieldResumable::make('images')
                    ->setLabel('Image')
                    ->addFieldsetClass('is-one-third'),
                WysiwygField::make('content')
                    ->setModules(Config::get('enso.flexible-content.rows.feature.modules', []))
                    ->addFieldsetClass('is-two-thirds'),
                ButtonsField::make('buttons'),
            ]);
    }

    /**
     * Unpack Row-specific fields.
     *
     * Should be overriden in Rowspecs that extend this class.
     */
    protected static function getRowContent(FlexibleRow $row): array
    {
        return [
            'alignment' => static::calculateAlignment($row),
            'buttons' => static::make()->getFlexibleContentFieldContent('buttons', $row),
            'content' => static::getWysiwygHtml($row->getBlocks(), 'content'),
            'image' => $row->block('images') ? $row->blockContent('images')->first() : null,
            'title' => $row->blockContent('title'),
        ];
    }
}
