<?php

namespace App\Crud\Traits;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Yadda\Enso\Crud\Forms\Fields\SelectField;
use Yadda\Enso\Crud\Handlers\FlexibleRow;

trait HasSelection
{
    /**
     * Field for selectingn Selection
     *
     * @param string $field_name
     *
     * @return SelectField
     */
    protected function selectionField(string $field_name = 'selection'): SelectField
    {
        return SelectField::make($field_name)
            ->setLabel('Selection')
            ->setDefaultValue($this->getDefaultSelectionValue($field_name))
            ->setOptions($this->getSelectionOptions($field_name))
            ->setSettings([
                'allow_empty' => false,
                'show_labels' => false,
            ]);
    }

    /**
     * Options for the Style dropdown field
     *
     * @return array
     */
    protected function getSelectionOptions(string $field_name = 'selection'): array
    {
        if (!empty(Config::get('enso.flexible-content.rows.' . $this->getName() . '.selections.' . $field_name))) {
            $options = Config::get('enso.flexible-content.rows.' . $this->getName() . '.selections.' . $field_name, []);
        } else {
            $options = Config::get('enso.flexible-content.options.selections.' . $field_name, []);
        }

        return (new Collection($options))
            ->map(function ($item, $key) {
                return SelectField::makeOption($key, $item);
            })->values()->toArray();
    }

    /**
     * Default Selection
     *
     * @return string
     */
    protected function getDefaultSelection(string $field_name = 'selection'): string
    {
        $fallback = !empty(Config::get('enso.flexible-content.rows.' . $this->getName() . '.selections.' . $field_name))
            ? Arr::first(array_keys(Config::get('enso.flexible-content.rows.' . $this->getName() . '.selections.' . $field_name, [])))
            : Arr::first(array_keys(Config::get('enso.flexible-content.options.selections.' . $field_name, [])));

        $fallback = $fallback ?? 'undefined';

        if (!empty(Config::get('enso.flexible-content.rows.' . $this->getName() . '.default-selection.' . $field_name))) {
            return Config::get('enso.flexible-content.rows.' . $this->getName() . '.default-selection.' . $field_name, $fallback);
        } else {
            return Config::get('enso.flexible-content.options.default-selection.' . $field_name, $fallback);
        }
    }

    /**
     * Default values of the Selection dropdown box
     *
     * @return array
     */
    protected function getDefaultSelectionValue(string $field_name = 'selection'): array
    {
        $fallback = !empty(Config::get('enso.flexible-content.rows.' . $this->getName() . '.selections.' . $field_name))
            ? Arr::first(Config::get('enso.flexible-content.rows.' . $this->getName() . '.selections.' . $field_name, []))
            : Arr::first(Config::get('enso.flexible-content.options.selections.' . $field_name, []));

        $fallback = $fallback ?? 'Undefined';

        $default_selection = $this->getDefaultSelection($field_name);

        if (!empty(Config::get('enso.flexible-content.rows.' . $this->getName() . '.selections'))) {
            $default_selection_name = Config::get('enso.flexible-content.rows.' . $this->getName() . '.selections.' . $default_selection, $fallback);
        } else {
            $default_selection_name = Config::get('enso.flexible-content.options.selections.' . $default_selection, $fallback);
        }

        return SelectField::makeOption(
            $default_selection,
            $default_selection_name
        );
    }

    /**
     * Get the selected Selection from the row
     *
     * @param FlexibleRow $row
     * @param string $field_name
     *
     * @return string
     */
    protected function getSelectedSelection(FlexibleRow $row, string $field_name = 'selection'): string
    {
        $instance = static::make();

        $track_by = $instance->getField($field_name)->getSetting('track_by');

        return Arr::get(
            $row->blockContent($field_name),
            $track_by,
            $instance->getDefaultSelection($field_name)
        );
    }
}
