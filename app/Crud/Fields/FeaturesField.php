<?php

namespace App\Crud\Fields;

use App\Crud\Rows\FeatureRow;
use Yadda\Enso\Crud\Forms\Fields\FlexibleContentField;

class FeaturesField extends FlexibleContentField
{
    public function __construct(string $name = 'main')
    {
        parent::__construct($name);

        $this->addRowSpecs([
            FeatureRow::make(),
        ])->addRowLabel('Add Feature');
    }
}
