<?php

namespace App\Crud;

use Yadda\Enso\Crud\Forms\Fields\FlexibleContentField;
use Yadda\Enso\Crud\Forms\Form;
use Yadda\Enso\Pages\Crud\Page as BaseCrud;

class Page extends BaseCrud
{
    /**
     * Default form configuration.
     *
     * @return \Yadda\Enso\Crud\Forms\Form
     */
    public function create(Form $form)
    {
        $form = parent::create($form);

        $form->getSection('content')->addFieldAfter(
            'excerpt',
            FlexibleContentField::make('header')
                ->addRowSpecs([
                    \App\Crud\Rows\FullHeroRow::make(),
                    \App\Crud\Rows\HeroRow::make(),
                ])
                ->setMaxRows(1)
        );

        return $form;
    }

    /**
     * Array of Site-wide default row specs.
     *
     * @return array
     */
    protected function defaultRowSpecs(): array
    {
        return [
            \App\Crud\Rows\ArticlesRow::make(),
            \App\Crud\Rows\CarouselRow::make(),
            \App\Crud\Rows\ClassesRow::make(),
            \App\Crud\Rows\CtasRow::make(),
            \App\Crud\Rows\FeaturesRow::make(),
            \App\Crud\Rows\QuoteRow::make(),
            \App\Crud\Rows\TextImageRow::make(),
            \App\Crud\Rows\TextRow::make(),
            \App\Crud\Rows\TextVideoRow::make(),
            \App\Crud\Rows\TrainersRow::make(),
        ];
    }
}
