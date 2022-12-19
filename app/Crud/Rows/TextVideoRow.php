<?php

namespace App\Crud\Rows;

use App\Crud\Fields\ButtonsField;
use App\Crud\Traits\HasAlignment;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Yadda\Enso\Crud\Forms\Fields\FileUploadFieldResumable;
use Yadda\Enso\Crud\Forms\Fields\TextField;
use Yadda\Enso\Crud\Forms\Fields\VideoEmbedField;
use Yadda\Enso\Crud\Forms\Fields\WysiwygField;
use Yadda\Enso\Crud\Forms\FlexibleContentSection;
use Yadda\Enso\Crud\Handlers\FlexibleRow;

/**
 * Represents a purely text row withing a flexible content collection.
 */
class TextVideoRow extends FlexibleContentSection
{
    use HasAlignment;

    /**
     * Default name for this section
     *
     * @param string
     */
    const DEFAULT_NAME = 'textvideo';

    public function __construct(string $name = 'textvideo')
    {
        parent::__construct($name);

        $this
            ->setLabel('Text / Video')
            ->addFields([
                TextField::make('title')
                    ->addFieldsetClass('is-three-quarters'),
                static::alignmentField()
                    ->setLabel('Image alignment')
                    ->addFieldsetClass('is-3'),
                VideoEmbedField::make('video')
                    ->addFieldsetClass('is-two-thirds'),
                FileUploadFieldResumable::make('image')
                    ->addFieldsetClass('is-one-third'),
                WysiwygField::make('content')
                    ->setModules(Config::get('enso.flexible-content.rows.textvideo.modules', [])),
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
        $instance = static::make();

        return [
            'alignment' => static::calculateAlignment($row),
            'buttons' => $instance->getFlexibleContentFieldContent('buttons', $row),
            'content' => static::getWysiwygHtml($row->getBlocks(), 'content'),
            'image' => $row->block('image') ? $row->blockContent('image')->first() : null,
            'title' => $row->blockContent('title'),
            'video' => ($row->block('video') && Arr::get($row->blockContent('video'), 'id'))
                ? ((array)$row->blockContent('video'))
                : null,
        ];
    }
}
