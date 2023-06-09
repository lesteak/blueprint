<?php

namespace App\Crud\Fields;

use App\Crud\Rows\CtaRow;
use Yadda\Enso\Crud\Forms\Fields\FlexibleContentField;

class CtasField extends FlexibleContentField
{
    public function __construct(string $name = 'main')
    {
        parent::__construct($name);

        $this->addRowSpecs([
            CtaRow::make(),
        ])->addRowLabel('Add Cta');
    }
}
