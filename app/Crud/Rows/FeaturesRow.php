<?php

namespace App\Crud\Rows;

use App\Crud\Fields\FeaturesField;
use App\Crud\Traits\HasComponents;
use App\Crud\Traits\HasSelection;
use Yadda\Enso\Crud\Forms\Fields\TextField;
use Yadda\Enso\Crud\Forms\FlexibleContentSection;
use Yadda\Enso\Crud\Handlers\FlexibleRow;

/**
 * Represents a purely text row withing a flexible content collection.
 */
class FeaturesRow extends FlexibleContentSection
{
    use HasComponents,
        HasSelection;

    /**
     * Default name for this section
     *
     * @param string
     */
    const DEFAULT_NAME = 'features';

    /**
     * Create a new instance of Features
     */
    public function __construct(string $name = 'features')
    {
        parent::__construct($name);

        $this
            ->setLabel('Features')
            ->addFields([
                TextField::make('title')
                    ->addFieldsetClass('is-half'),
                static::selectionField('background')
                    ->setLabel('Background Colour')
                    ->addFieldsetClass('is-one-quarter'),
                static::componentsField('divider')
                    ->setLabel('Divider')
                    ->addFieldsetClass('is-one-quarter'),
                FeaturesField::make('features'),
            ]);
    }

    /**
     * Unpack Row-specific fields.
     *
     * Should be overriden in Rowspecs that extend this class.
     */
    protected static function getRowContent(FlexibleRow $row): array
    {
        $instance = static::make();

        return [
            'background' => $instance->getSelectedSelection($row, 'background'),
            'divider' => $instance->getSelectedComponents($row, 'divider'),
            'features' => $instance->getFlexibleContentFieldContent('features', $row),
            'title' => $row->blockContent('title'),
        ];
    }
}
