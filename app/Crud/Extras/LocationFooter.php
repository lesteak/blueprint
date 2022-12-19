<?php

namespace App\Crud\Extras;

use Yadda\Enso\Crud\Forms\Form;
use Yadda\Enso\Settings\Contracts\ExtraSettings;
use Yadda\Enso\Crud\Forms\CollectionSection;
use Yadda\Enso\Crud\Forms\Fields\DividerField;
use Yadda\Enso\Crud\Forms\Fields\FlexibleContentField;
use Yadda\Enso\Crud\Forms\Fields\TextField;
use Yadda\Enso\Crud\Forms\Fields\TextareaField;
use Yadda\Enso\Crud\Forms\Fields\ButtonsField;
use Yadda\Enso\Crud\Forms\Fields\FileUploadFieldResumable;

class LocationFooter implements ExtraSettings
{
    /**
     * Settings that should be accessible via Api requests
     */
    const PUBLIC_SETTINGS = [
        'location-footer',
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
        if (!$section = $form->getSection('location-footer')) {
            $section = CollectionSection::make('location-footer');
            $form->addSectionAfter('main', $section);
        }

        $section
            ->addFields([
                DividerField::make('location_footer_content_divider')
                    ->setTitle('Location Footer Content'),
                TextField::make('location_footer_title'),
                TextareaField::make('location_footer_content'),
                ButtonsField::make('location_footer_button')
                    ->singleButton(),
                FileUploadFieldResumable::make('location_footer_image')
                
            ]);

        return $form;
    }

}
