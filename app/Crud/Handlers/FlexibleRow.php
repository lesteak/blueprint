<?php

namespace App\Crud\Handlers;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Yadda\Enso\Crud\Handlers\FlexibleRow as BaseClass;

class FlexibleRow extends BaseClass
{
    /**
     * The next row
     *
     * @var static|null
     */
    public $next_row;

    /**
     * The previous row
     *
     * @var static|null
     */
    public $previous_row;

    /**
     * Unpacked data from this row.
     */
    protected $unpacked;

    /**
     * Determines the next row's selection
     *
     * @param string $selection_name
     *
     * @return bool
     */
    public function nextRowComponent(string $selection_name): bool
    {
        list($component_set, $component) = explode('.', $selection_name, '2');

        if ($this->next_row && !empty($this->next_row->unpack()->{$component_set})) {
            return Arr::get($this->next_row->unpack()->{$component_set}, $component, []);
        }

        return Config::get('enso.flexible-content.options.default-component.' . $selection_name);
    }

    /**
     * Determines the next row's selection
     *
     * @param string $selection_name
     *
     * @return string
     */
    public function nextRowSelection(string $selection_name): string
    {
        if ($this->next_row && !empty($this->next_row->unpack()->{$selection_name})) {
            return $this->next_row->unpack()->{$selection_name};
        }

        return Config::get('enso.flexible-content.options.default-selection.' . $selection_name);
    }

    /**
     * Determines the next row's selection
     *
     * @param string $selection_name
     *
     * @return bool
     */
    public function previousRowComponent(string $selection_name): bool
    {
        list($component_set, $component) = explode('.', $selection_name, '2');

        if ($this->previous_row && !empty($this->previous_row->unpack()->{$component_set})) {
            return Arr::get($this->previous_row->unpack()->{$component_set}, $component, []);
        }

        return Config::get('enso.flexible-content.options.default-component.' . $selection_name);
    }

    /**
     * Determines the previous row's selection
     *
     * @param string $selection_name
     *
     * @return string
     */
    public function previousRowSelection(string $selection_name): string
    {
        if ($this->previous_row && !empty($this->previous_row->unpack()->{$selection_name})) {
            return $this->previous_row->unpack()->{$selection_name};
        }

        return Config::get('enso.flexible-content.options.default-selection.' . $selection_name);
    }

    /**
     * Removes a single class from the current list, if it is present
     *
     * @note - This is overriden to properly return 'this'. Should be back-ported
     *         to Ensō.
     *
     * @param string $class Class to remove
     *
     * @return self
     */
    public function removeClass(string $class)
    {
        if (($class_index = array_search($class, $this->array_classes)) !== false) {
            unset($this->array_classes[$class_index]);
        }

        return $this;
    }

    /**
     * Unpacks data from from this Flexible row based on configuration.
     *
     * @return object
     */
    public function unpack(): object
    {
        if (is_null($this->unpacked)) {
            if (array_key_exists($this->getType(), Config::get('enso.flexible-content.options.rows'))) {
                $this->unpacked = Config::get('enso.flexible-content.options.rows.' . $this->getType())::unpack($this);
            } else {
                $this->unpacked = (object) [];
            }
        }

        return $this->unpacked;
    }
}
