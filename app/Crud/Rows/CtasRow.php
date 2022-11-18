<?php

namespace App\Crud\Rows;

use App\Crud\Fields\CtasField;
use Yadda\Enso\Crud\Forms\Fields\TextField;
use Yadda\Enso\Crud\Forms\FlexibleContentSection;
use Yadda\Enso\Crud\Handlers\FlexibleRow;

/**
 * Represents a purely text row withing a flexible content collection.
 */
class CtasRow extends FlexibleContentSection
{
    /**
     * Default name for this section
     *
     * @param string
     */
    const DEFAULT_NAME = 'ctas';

    /**
     * Constructor
     *
     * @param string $name
     */
    public function __construct(string $name = 'ctas')
    {
        parent::__construct($name);

        $this
            ->setLabel('Ctas')
            ->excerptField('title')
            ->addFields([
                TextField::make('title'),
                CtasField::make('ctas')
                    ->setLabel('Ctas'),
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
            'ctas' => $instance->getFlexibleContentFieldContent('ctas', $row),
            'title' => $row->blockContent('title'),
        ];
    }
}
