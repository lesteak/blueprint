<?php

namespace App\Crud\Rows;

use App\Crud\Fields\FlexCheckboxField;
use Illuminate\Support\Arr;
use Yadda\Enso\Crud\Forms\Fields\SelectField;
use Yadda\Enso\Crud\Forms\Fields\TextField;
use Yadda\Enso\Crud\Forms\FlexibleContentSection;
use Yadda\Enso\Crud\Handlers\FlexibleRow;
use Yadda\Enso\Facades\EnsoCrud;

/**
 * Represents a purely text row withing a flexible content collection.
 */
class ClassesRow extends FlexibleContentSection
{
    /**
     * Default name for this section
     *
     * @param string
     */
    const DEFAULT_NAME = 'classes';

    /**
     * Create a new instance of Classes
     */
    public function __construct(string $name = 'classes')
    {
        parent::__construct($name);

        $this
            ->setLabel('Classes')
            ->excerptField('title')
            ->addFields([
                TextField::make('title')
                    ->addFieldsetClass('is-three-quarters'),
                FlexCheckboxField::make('group_by_category')
                    ->addFieldsetClass('is-one-quarter')
                    ->setHelpText('When selected, this will group the classes by their category'),
                SelectField::make('trainer')
                    ->useAjax(route('admin.trainers.index'), EnsoCrud::modelClass('trainer'))
                    ->addFieldsetClass('is-half')
                    ->setHelpText('Fill this in to limit the displayed classes to only those taught by this trainer'),
                SelectField::make('location')
                    ->useAjax(route('admin.locations.index'), EnsoCrud::modelClass('location'))
                    ->addFieldsetClass('is-half')
                    ->setHelpText('Fill this in to limit the displayed classes to only those held at this location'),
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
        $trainer_id = Arr::get($row->blockContent('trainer'), $instance->getField('trainer')->getSetting('track_by'), null);

        return [
            'group_by_category' => Arr::get($row->blockContent('group_by_category'), 'group_by_category', false),
            'location' => $location_id ? EnsoCrud::modelClass('location')::find($location_id) : null,
            'title' => $row->blockContent('title'),
            'trainer' => $trainer_id ? EnsoCrud::modelClass('trainer')::find($trainer_id) : null,
        ];
    }
}
