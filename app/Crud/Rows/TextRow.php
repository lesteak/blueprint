<?php

namespace App\Crud\Rows;

use App\Crud\Fields\ButtonsField;
use Illuminate\Support\Facades\Config;
use Yadda\Enso\Crud\Forms\Fields\TextField;
use Yadda\Enso\Crud\Forms\Fields\WysiwygField;
use Yadda\Enso\Crud\Forms\FlexibleContentSection;
use Yadda\Enso\Crud\Handlers\FlexibleRow;

/**
 * Represents a purely text row withing a flexible content collection.
 */
class TextRow extends FlexibleContentSection
{
    /**
     * Default name for this section
     *
     * @param string
     */
    const DEFAULT_NAME = 'text';

    /**
     * Array of style options
     *
     * @var array
     */
    protected $styles;

    public function __construct(string $name = 'text')
    {
        parent::__construct($name);

        parent::__construct($name);

        $this->addFields([
            TextField::make('title'),
            WysiwygField::make('content')
                ->setModules(Config::get('enso.flexible-content.rows.text.modules', [])),
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
            'buttons' => $instance->getFlexibleContentFieldContent('buttons', $row),
            'content' => static::getWysiwygHtml($row->getBlocks(), 'content'),
            'title' => $row->blockContent('title'),
        ];
    }
}
