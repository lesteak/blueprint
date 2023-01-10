<?php

namespace App\Crud\Extras;

use Yadda\Enso\Crud\Forms\Fields\TextField;
use Yadda\Enso\Crud\Forms\Form;
use Yadda\Enso\Settings\Contracts\ExtraSettings;

class PixelAnalyticsCode implements ExtraSettings
{
    /**
     * Settings that should be accessible via Api requests
     */
    const PUBLIC_SETTINGS = [
        'pixel-code',
    ];

    /**
     * Take a form and process it by adding, removing
     * or updating sections or fields.
     *
     * @param Form $form
     *
     * @return Form
     */
    public static function updateForm(Form $form): Form
    {
        $form
            ->getSection('analytics')
            ->addFieldsAfter(
                'google-tag-manager-code',
                [
                    TextField::make('pixel-code')
                        ->setLabel('Pixel Tracking Code')
                        ->addFieldsetClass('is-full')
                        ->setPlaceholder('E.g. 12345678910'),
                ]
            );

        return $form;
    }

}
