<?php

namespace App\Crud;

use App\Crud\Rows\TextRow;
use Yadda\Enso\Crud\Config;
use Yadda\Enso\Crud\Contracts\Config\IsPublishable as ConfigIsPublishable;
use Yadda\Enso\Crud\Forms\Fields\BelongsToManyField;
use Yadda\Enso\Crud\Forms\Fields\DateTimeField;
use Yadda\Enso\Crud\Forms\Fields\FileUploadFieldResumable;
use Yadda\Enso\Crud\Forms\Fields\FlexibleContentField;
use Yadda\Enso\Crud\Forms\Fields\SlugField;
use Yadda\Enso\Crud\Forms\Fields\TextField;
use Yadda\Enso\Crud\Forms\Form;
use Yadda\Enso\Crud\Forms\Section;
use Yadda\Enso\Crud\Tables\Text;
use Yadda\Enso\Crud\Traits\Config\IsPublishable;
use Yadda\Enso\Facades\EnsoCrud;
use Yadda\Enso\Meta\Crud\MetaSection;

class ClassCrud extends Config implements ConfigIsPublishable
{
    use IsPublishable;

    public function configure()
    {
        $this->model(EnsoCrud::modelClass('class'))
            ->route('admin.classes')
            ->views('class')
            ->name('Class')
            ->columns([
                Text::make('name'),
                $this->isPublishablePublishTableCell(),
            ])
            ->filters([
                'location' => \App\Crud\Filters\LocationFilter::make()
                    ->label('Location')
                    ->relationshipName('locations'),
                'trainer' => \App\Crud\Filters\TrainerFilter::make()
                    ->label('Trainer')
                    ->relationshipName('trainers'),
                'search' => \App\Crud\Filters\ClassFilter::make(),
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
                    TextField::make('name'),
                    SlugField::make('slug'),
                ]),
            Section::make('content')
                ->addFields([
                    FlexibleContentField::make('content')
                        ->addRowSpecs([
                            TextRow::make(),
                        ]),
                ]),
            Section::make('relationships')
                ->addFields([
                    BelongsToManyField::make('locations')
                        ->useAjax(route('admin.locations.index'), EnsoCrud::modelClass('location')),
                    BelongsToManyField::make('trainers')
                        ->useAjax(route('admin.trainers.index'), EnsoCrud::modelClass('trainer')),
                ]),
            MetaSection::make('meta'),
        ]);

        return $form;
    }
}
