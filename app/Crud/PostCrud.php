<?php

namespace App\Crud;

use Yadda\Enso\Blog\Crud\Post;
use Yadda\Enso\Crud\Contracts\Config\IsPublishable as ConfigIsPublishable;
use Yadda\Enso\Crud\Forms\Fields\BelongsToManyField;
use Yadda\Enso\Crud\Forms\Fields\CheckboxField;
use Yadda\Enso\Crud\Forms\Fields\DateTimeField;
use Yadda\Enso\Crud\Forms\Fields\FlexibleContentField;
use Yadda\Enso\Crud\Forms\Fields\SelectField;
use Yadda\Enso\Crud\Forms\Fields\SlugField;
use Yadda\Enso\Crud\Forms\Fields\TextField;
use Yadda\Enso\Crud\Forms\Form;
use Yadda\Enso\Crud\Forms\Section;
use Yadda\Enso\Crud\Tables\Publish;
use Yadda\Enso\Crud\Tables\Text;
use Yadda\Enso\Crud\Traits\Config\IsPublishable;
use Yadda\Enso\Facades\EnsoCrud;
use Yadda\Enso\Meta\Crud\MetaSection;
use Yadda\Enso\Utilities\Helpers;

/**
 * @note - Enso Problem.
 *
 * Have to override whole functions because much of this code is implemented as
 * part of or called withing the constructor. E.g, a "Publish" table cell is
 * added to the table during construct, which implicitly calls the getRoute()
 * command. As such, you can't chance the route after the fact.
 */
class PostCrud extends Post implements ConfigIsPublishable
{
    use IsPublishable;

    /**
     * Configure the CRUD
     *
     * @return void
     */
    public function configure()
    {
        $this
            ->model(EnsoCrud::modelClass('post'))
            ->route('admin.articles')
            ->views('posts')
            ->name('Article')
            ->searchColumns(['title'])
            ->order('id', 'DESC')
            ->paginate(static::DEFAULT_PAGINATION)
            ->columns([
                Text::make('title'),
                Text::make('publish_at')
                    ->setFormatter(function ($value) {
                        if ($value) {
                            return $value->format('jS M Y G:i');
                        }

                        return '—';
                    }),
                Publish::make('is_published', $this)
                    ->setLabel('Published')
                    ->addThClass('is-narrow has-text-centered'),
            ])
            ->rules([
                'main.title' => 'required|string|max:255',
                'main.template' => 'required',
            ])
            ->filters([
                'search' => \Yadda\Enso\Blog\Crud\Filters\PostFilter::make(),
                'user' => \Yadda\Enso\Crud\Filters\UserFilter::make()
                    ->label('Author')
                    ->relationshipName('user'),
            ]);
    }

    /**
     * Default form configuration.
     */
    public function create(Form $form)
    {
        $post_model = EnsoCrud::modelClass('post');
        $post_category_class = Helpers::getConcreteClass(PostCategory::class);

        $form->addSections([
            Section::make('main')
                ->addFields([
                    TextField::make('title')
                        ->addFieldsetClass('is-half'),
                    SlugField::make('slug')
                        ->addFieldsetClass('is-half')
                        ->setRoute($this->slugRoute())
                        ->setSource('title'),
                    DateTimeField::make('publish_at'),
                    SelectField::make('template')
                        ->setLabel('Page Template')
                        ->setOptions($this->hasTemplatesList($post_model)),
                    CheckboxField::make('featured')
                        ->setOptions([
                            'featured' => 'This post should appear before other posts',
                        ]),
                    $this->getHeroImageField(),
                    $this->getThumbnailImageField(),
                    BelongsToManyField::make('categories')
                        ->addFieldsetClass('is-half-desktop')
                        ->useAjax(
                            route('admin.categories.index'),
                            $post_category_class
                        ),
                    BelongsToManyField::make('related')
                        ->setLabel('Related Posts')
                        ->addFieldsetClass('is-half-desktop')
                        ->setSetting('max', config('enso.blog.max_related_posts'))
                        ->useAjax(
                            $this->getRoute('index'),
                            $post_category_class
                        ),
                ]),
            Section::make('content')
                ->addFields([
                    FlexibleContentField::make('content')
                        ->addRowSpecs(
                            $this->defaultRowSpecs(),
                        ),
                ]),
            MetaSection::make(),
        ]);

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
            \App\Crud\Rows\TextRow::make(),
        ];
    }
}
