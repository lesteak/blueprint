<?php

namespace App\Crud\Traits;

use App\Crud\Fields\FlexCheckboxField;
use Illuminate\Support\Facades\Config;
use Yadda\Enso\Crud\Handlers\FlexibleRow;

trait HasComponents
{
    /**
     * Field for selecting Components
     *
     * @param string $field_name
     *
     * @return FlexCheckboxField
     */
    protected function componentsField(string $field_name = 'components'): FlexCheckboxField
    {
        return FlexCheckboxField::make($field_name)
            ->setLabel('Display components?')
            ->setOptions($this->getComponentOptions($field_name))
            ->setDefaultValue($this->getDefaultComponents($field_name));
    }

    /**
     * Options for the Component checkbox field
     *
     * @return array
     */
    protected function getComponentOptions(string $field_name = 'components'): array
    {
        if (!empty(Config::get('enso.flexible-content.rows.' . $this->getName() . '.components.' . $field_name))) {
            return Config::get('enso.flexible-content.rows.' . $this->getName() . '.components.' . $field_name, []);
        } else {
            return Config::get('enso.flexible-content.options.components.' . $field_name, []);
        }
    }

    /**
     * Default values for the Component checkbox field
     *
     * @return array
     */
    protected function getDefaultComponents(string $field_name = 'components'): array
    {
        if (!empty(Config::get('enso.flexible-content.rows.' . $this->getName() . '.default-component.' . $field_name))) {
            return Config::get('enso.flexible-content.rows.' . $this->getName() . '.default-component.' . $field_name, []);
        } else {
            return Config::get('enso.flexible-content.options.default-component.' . $field_name, []);
        }
    }

    /**
     * Get the selected Component from the row
     *
     * @param FlexibleRow $row
     * @param string $field_name
     *
     * @return array
     */
    protected function getSelectedComponents(FlexibleRow $row, string $field_name = 'curve'): array
    {
        return $row->blockContent($field_name) ?? (new static)->getDefaultComponents($field_name);
    }
}
