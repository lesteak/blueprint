<?php

namespace App\Crud\Rows;

use Illuminate\Support\Arr;
use Yadda\Enso\Crud\Forms\Fields\SelectField;
use Yadda\Enso\Crud\Forms\Fields\TextField;
use Yadda\Enso\Crud\Forms\FlexibleContentSection;
use Yadda\Enso\Crud\Handlers\FlexibleRow;
use Yadda\Enso\Facades\EnsoCrud;

/**
 * Represents a purely text row withing a flexible content collection.
 */
class TrainersRow extends FlexibleContentSection
{
    /**
     * Default name for this section
     *
     * @param string
     */
    const DEFAULT_NAME = 'trainers';

    /**
     * Create a new instance of Classes
     */
    public function __construct(string $name = 'trainers')
    {
        parent::__construct($name);

        $this
            ->setLabel('Trainers')
            ->excerptField('title')
            ->addFields([
                TextField::make('title'),
                SelectField::make('class')
                    ->useAjax(route('admin.classes.index'), EnsoCrud::modelClass('class'))
                    ->addFieldsetClass('is-half')
                    ->setHelpText('Fill this in to limit the displayed trainers to only those who teach this class'),
                SelectField::make('location')
                    ->useAjax(route('admin.locations.index'), EnsoCrud::modelClass('location'))
                    ->addFieldsetClass('is-half')
                    ->setHelpText('Fill this in to limit the displayed trainers to only those who work at this location'),
            ]);
    }

    /**
     * Unpack Row-specific fields.
     *
     * Should be overriden in Rowspecs that extend this class.
     */
    protected static function getRowContent(FlexibleRow $row): array
    {
        $instance = new static();

        $class_id = Arr::get($row->blockContent('class'), $instance->getField('class')->getSetting('track_by'), null);
        $location_id = Arr::get($row->blockContent('location'), $instance->getField('location')->getSetting('track_by'), null);

        return [
            'class' => $class_id ? EnsoCrud::modelClass('class')::find($class_id) : null,
            'location' => $location_id ? EnsoCrud::modelClass('location')::find($location_id) : null,
            'title' => $row->blockContent('title'),
        ];
    }
}
