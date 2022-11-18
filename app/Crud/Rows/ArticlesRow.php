<?php

namespace App\Crud\Rows;

use App\Crud\Traits\HasSelection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Yadda\Enso\Crud\Forms\Fields\ButtonsField;
use Yadda\Enso\Crud\Forms\Fields\TextField;
use Yadda\Enso\Crud\Forms\Fields\WysiwygField;
use Yadda\Enso\Crud\Forms\FlexibleContentSection;
use Yadda\Enso\Crud\Handlers\FlexibleRow;
use Yadda\Enso\Facades\EnsoCrud;

/**
 * Represents a purely text row withing a flexible content collection.
 */
class ArticlesRow extends FlexibleContentSection
{
    use HasSelection;

    /**
     * Default name for this section
     *
     * @param string
     */
    const DEFAULT_NAME = 'articles';

    /**
     * Create a new instance of Articles
     */
    public function __construct(string $name = 'articles')
    {
        parent::__construct($name);

        $this
            ->setLabel('Articles')
            ->addFields([
                TextField::make('title')
                    ->addFieldsetClass('is-half'),
                TextField::make('limit')
                    ->addFieldsetClass('is-one-quarter')
                    ->setHelpText('Number of Articles to show')
                    ->setDefaultValue(3),
                static::selectionField('more_content')
                    ->setLabel('More Content')
                    ->addFieldsetClass('is-one-quarter'),
                WysiwygField::make('content')
                    ->setModules(Config::get('enso.flexible-content.rows.articles.modules', [])),
            ]);
    }

    /**
     * Unpack Row-specific fields.
     *
     * Should be overriden in Rowspecs that extend this class.
     */
    protected static function getRowContent(FlexibleRow $row): array
    {
        $instance = static::make();

        $limit = $row->block('limit') ? $row->blockContent('limit') : 3;

        return [
            'articles' => $instance->getArticles($limit),
            'content' => static::getWysiwygHtml($row->getBlocks(), 'content'),
            'limit' => $limit,
            'more_content' => $instance->getSelectedSelection($row, 'more_content'),
            'title' => $row->blockContent('title'),
        ];
    }

    /**
     * Gets Articles for this row.
     *
     * @param string $limit
     *
     * @return Collection
     */
    public function getArticles(string $limit): Collection
    {
        return EnsoCrud::query('post')
            ->accessibleToUser()
            ->orderBy('featured', 'DESC')
            ->orderBy('publish_at', 'DESC')
            ->limit(intval($limit))
            ->get();
    }
}
