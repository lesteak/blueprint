<?php

namespace App\Crud;


use App\Crud\Rows\TextRow;
use Illuminate\Support\Facades\Config as ConfigFacade;
use Yadda\Enso\Crud\Config;
use Yadda\Enso\Crud\Contracts\Config\IsPublishable as ConfigIsPublishable;
use Yadda\Enso\Crud\Forms\Fields\BelongsToManyField;
use Yadda\Enso\Crud\Forms\Fields\DateTimeField;
use Yadda\Enso\Crud\Forms\Fields\FileUploadFieldResumable;
use Yadda\Enso\Crud\Forms\Fields\FlexibleContentField;
use Yadda\Enso\Crud\Forms\Fields\SlugField;
use Yadda\Enso\Crud\Forms\Fields\TextField;
use Yadda\Enso\Crud\Forms\Fields\WysiwygField;
use Yadda\Enso\Crud\Forms\Form;
use Yadda\Enso\Crud\Forms\Section;
use Yadda\Enso\Crud\Tables\Text;
use Yadda\Enso\Crud\Traits\Config\IsPublishable;
use Yadda\Enso\Facades\EnsoCrud;
use Yadda\Enso\Meta\Crud\MetaSection;

class TrainerCrud extends Config implements ConfigIsPublishable
{
    use IsPublishable;

    public function configure()
    {
        $this->model(EnsoCrud::modelClass('trainer'))
            ->route('admin.trainers')
            ->views('trainer')
            ->name('Trainer')
            ->columns([
                Text::make('name'),
                $this->isPublishablePublishTableCell(),
            ])
            ->filters([
                'classes' => \App\Crud\Filters\ClassFilter::make()
                    ->label('Class')
                    ->relationshipName('classes'),
                'locations' => \App\Crud\Filters\LocationFilter::make()
                    ->label('Location')
                    ->relationshipName('locations'),
                'search' => \App\Crud\Filters\TrainerFilter::make(),
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
                    TextField::make('role')
                        ->addFieldsetClass('is-one-third'),
                    SlugField::make('slug'),
                    WysiwygField::make('description')
                        ->setModules(ConfigFacade::get('enso.crud.' . EnsoCrud::crudName($this) . '.modules', [])),
                ]),
            Section::make('content')
                ->addFields([
                    FlexibleContentField::make('content')
                        ->addRowSpecs([
                            TextRow::make(),
                            \App\Crud\Rows\ClassesRow::make(),
                        ]),
                ]),
            Section::make('relationships')
                ->addFields([
                    BelongsToManyField::make('classes')
                        ->useAjax(route('admin.classes.index'), EnsoCrud::modelClass('class')),
                    BelongsToManyField::make('locations')
                        ->useAjax(route('admin.locations.index'), EnsoCrud::modelClass('location')),
                ]),
            MetaSection::make('meta'),
        ]);

        return $form;
    }
}
