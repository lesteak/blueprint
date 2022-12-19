<?php

namespace App\Crud\Fields;

use Yadda\Enso\Crud\Forms\Fields\CheckboxField;

/**
 * This field has extends the CheckboxField to allow it's use in Flexible content
 * for the specific purpose of the Proficiency Test, and shouldn't be used
 * outside of that as it is not otherwise tested
 */
class FlexCheckboxField extends CheckboxField
{
    /**
     * Can this field be used inside a flexible content field
     *
     * @var boolean
     */
    protected static $flexible_field = true;
}
