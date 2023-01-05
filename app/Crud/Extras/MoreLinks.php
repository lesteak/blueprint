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

class MoreLinks implements ExtraSettings
{
    /**
     * Settings that should be accessible via Api requests
     */
    const PUBLIC_SETTINGS = [
        'more-links',
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
        if (!$section = $form->getSection('more-links')) {
            $section = CollectionSection::make('more-links');
            $form->addSectionAfter('main', $section);
        }

        $section
            ->addFields([
                DividerField::make('more_links_trainers_divider')
                    ->setTitle('Trainers'),
                TextField::make('more_links_trainers_title'),
                TextField::make('more_links_trainers_url'),
                FileUploadFieldResumable::make('more_links_trainers_image'),
                DividerField::make('more_links_timetable_divider')
                    ->setTitle('Timetable'),
                TextField::make('more_links_timetable_title'),
                TextField::make('more_links_timetable_url'),
                FileUploadFieldResumable::make('more_links_timetable_image'),
                DividerField::make('more_links_classes_divider')
                    ->setTitle('Classes'),
                TextField::make('more_links_classes_title'),
                TextField::make('more_links_classes_url'),
                FileUploadFieldResumable::make('more_links_classes_image')
                
            ]);

        return $form;
    }

}
