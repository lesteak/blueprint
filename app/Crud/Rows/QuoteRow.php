<?php

namespace App\Crud\Rows;

use Illuminate\Support\Facades\Config;
use Yadda\Enso\Crud\Forms\Fields\TextField;
use Yadda\Enso\Crud\Forms\Fields\WysiwygField;
use Yadda\Enso\Crud\Forms\FlexibleContentSection;
use Yadda\Enso\Crud\Handlers\FlexibleRow;

/**
 * Represents a purely text row withing a flexible content collection.
 */
class QuoteRow extends FlexibleContentSection
{
    /**
     * Default name for this section
     *
     * @param string
     */
    const DEFAULT_NAME = 'quote';

    /**
     * Array of style options
     *
     * @var array
     */
    protected $styles;

    public function __construct(string $name = 'quote')
    {
        parent::__construct($name);

        $this
            ->excerptField('author')
            ->addFields([
                TextField::make('title'),
                WysiwygField::make('quote')
                    ->setModules(Config::get('enso.flexible-content.rows.quote.modules', [])),
                TextField::make('source')
                    ->addFieldsetClass('is-half is-offset-half'),
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
            'quote' => static::getWysiwygHtml($row->getBlocks(), 'quote'),
            'source' => $row->blockContent('source'),
            'title' => $row->blockContent('title'),
        ];
    }
}
