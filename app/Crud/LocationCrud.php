<?php

namespace App\Crud;

use Illuminate\Support\Facades\Config as ConfigFacade;
use Yadda\Enso\Crud\Config;
use Yadda\Enso\Crud\Contracts\Config\IsPublishable as ConfigIsPublishable;
use Yadda\Enso\Crud\Forms\Fields\BelongsToManyField;
use Yadda\Enso\Crud\Forms\Fields\DateTimeField;
use Yadda\Enso\Crud\Forms\Fields\FileUploadFieldResumable;
use Yadda\Enso\Crud\Forms\Fields\FlexibleContentField;
use Yadda\Enso\Crud\Forms\Fields\SlugField;
use Yadda\Enso\Crud\Forms\Fields\TextareaField;
use Yadda\Enso\Crud\Forms\Fields\TextField;
use Yadda\Enso\Crud\Forms\Fields\WysiwygField;
use Yadda\Enso\Crud\Forms\Form;
use Yadda\Enso\Crud\Forms\Section;
use Yadda\Enso\Crud\Tables\Text;
use Yadda\Enso\Crud\Traits\Config\IsPublishable;
use Yadda\Enso\Facades\EnsoCrud;
use Yadda\Enso\Meta\Crud\MetaSection;

class LocationCrud extends Config implements ConfigIsPublishable
{
    use IsPublishable;

    public function configure()
    {
        $this->model(EnsoCrud::modelClass('location'))
            ->route('admin.locations')
            ->views('location')
            ->name('Location')
            ->columns([
                Text::make('name'),
                $this->isPublishablePublishTableCell(),
            ])
            ->filters([
                'classes' => \App\Crud\Filters\ClassFilter::make()
                    ->label('Class')
                    ->relationshipName('classes'),
                'trainer' => \App\Crud\Filters\TrainerFilter::make()
                    ->label('Trainer')
                    ->relationshipName('trainers'),
                'search' => \App\Crud\Filters\LocationFilter::make(),
            ])
            ->rules([
                'main.name' => 'required',
            ]);
    }

    public function create(Form $form)
    {
        $form->addSections([
            Section::make('main')
                ->addFields([
                    FileUploadFieldResumable::make('thumbnail')
                        ->addFieldsetClass('is-half'),
                    FileUploadFieldResumable::make('heroImage')
                        ->addFieldsetClass('is-half'),
                    DateTimeField::make('publish_at'),
                    TextField::make('name')
                        ->addFieldsetClass('is-two-thirds'),
                    TextField::make('glowfox_id')
                        ->addFieldsetClass('is-one-third'),
                    SlugField::make('slug')
                        ->setRoute(route('locations.show', '%SLUG%')),
                    WysiwygField::make('description')
                        ->setModules(ConfigFacade::get('enso.crud.' . EnsoCrud::crudName($this) . '.modules', []))
                        ->addFieldsetClass('is-half'),
                    TextareaField::make('address')
                        ->addFieldsetClass('is-half'),
                    TextField::make('email')
                        ->addFieldsetClass('is-half'),
                    TextField::make('phone')
                        ->addFieldsetClass('is-half'),
                ]),
            Section::make('content')
                ->addFields([
                    FlexibleContentField::make('content')
                        ->addRowSpecs([
                            \App\Crud\Rows\TextRow::make(),
                            \App\Crud\Rows\ClassesRow::make(),
                        ]),
                ]),
            Section::make('relationships')
                ->addFields([
                    BelongsToManyField::make('classes')
                        ->useAjax(route('admin.classes.index'), EnsoCrud::modelClass('class')),
                    BelongsToManyField::make('trainers')
                        ->useAjax(route('admin.trainers.index'), EnsoCrud::modelClass('trainer')),
                ]),
            MetaSection::make('meta'),
        ]);

        return $form;
    }
}
