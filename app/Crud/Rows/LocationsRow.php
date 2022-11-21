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
class LocationsRow extends FlexibleContentSection
{
    /**
     * Default name for this section
     *
     * @param string
     */
    const DEFAULT_NAME = 'locations';

    /**
     * Create a new instance of Classes
     */
    public function __construct(string $name = 'locations')
    {
        parent::__construct($name);

        $this
            ->setLabel('Locations')
            ->excerptField('title')
            ->addFields([
                TextField::make('title'),
                SelectField::make('class')
                    ->useAjax(route('admin.classes.index'), EnsoCrud::modelClass('class'))
                    ->addFieldsetClass('is-half')
                    ->setHelpText('Fill this in to limit the displayed locations to only those that host this class'),
                SelectField::make('trainer')
                    ->useAjax(route('admin.trainers.index'), EnsoCrud::modelClass('trainer'))
                    ->addFieldsetClass('is-half')
                    ->setHelpText('Fill this in to limit the displayed locations to only where this trainer works'),
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
        $trainer_id = Arr::get($row->blockContent('trainer'), $instance->getField('trainer')->getSetting('track_by'), null);

        return [
            'class' => $class_id ? EnsoCrud::modelClass('class')::find($class_id) : null,
            'title' => $row->blockContent('title'),
            'trainer' => $trainer_id ? EnsoCrud::modelClass('trainer')::find($trainer_id) : null,
        ];
    }
}
