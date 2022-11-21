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
                TextField::make('title')
                    ->addFieldsetClass('is-half'),
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

        $location_id = Arr::get($row->blockContent('location'), $instance->getField('location')->getSetting('track_by'), null);

        return [
            'location' => $location_id ? EnsoCrud::modelClass('location')::find($location_id) : null,
            'title' => $row->blockContent('title'),
        ];
    }
}
