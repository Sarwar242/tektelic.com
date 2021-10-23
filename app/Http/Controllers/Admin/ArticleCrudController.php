<?php


namespace App\Http\Controllers\Admin;


use App\ArticleTag;
use App\BindItems;
use App\Http\Requests\KeysAreaLangRequest;
use App\ItemKey;
use App\Models\Articles;
use App\Models\Category;
use App\Models\Keys;
use App\Models\Tag;
use App\Http\Requests\ArticleRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ArticleCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ArticleCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation { update as traitUpdate; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CloneOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\BulkCloneOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\BulkDeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\FetchOperation;

    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | BASIC CRUD INFORMATION
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel(Articles::class);
        $this->crud->setRoute(config('backpack.base.route_prefix', 'admin').'/article');
        $this->crud->setEntityNameStrings('article', 'Articles');

        /*
        |--------------------------------------------------------------------------
        | LIST OPERATION
        |--------------------------------------------------------------------------
        */
        $this->crud->operation('list', function () {
            $this->crud->addColumn('title');
            $this->crud->addColumn([
                'name' => 'date',
                'label' => 'Date',
                'type' => 'date',
            ]);
            $this->crud->addColumn('status');
            $this->crud->addColumn([
                'name' => 'featured',
                'label' => 'Featured',
                'type' => 'check',
            ]);
            /*$this->crud->addColumn([
                'label' => 'Category',
                'type' => 'select',
                'name' => 'category_id',
                'entity' => 'category',
                'attribute' => 'name',
                'wrapper'   => [
                    'href' => function ($crud, $column, $entry, $related_key) {
                        return backpack_url('category/'.$related_key.'/show');
                    },
                ],
            ]);*/
            $this->crud->addColumn('tags');

            /*$this->crud->addFilter([ // select2 filter
                'name' => 'category_id',
                'type' => 'select2',
                'label'=> 'Category',
            ], function () {
                return Category::all()->keyBy('id')->pluck('name', 'id')->toArray();
            }, function ($value) { // if the filter is active
                $this->crud->addClause('where', 'category_id', $value);
            });*/

            $this->crud->addFilter([ // select2_multiple filter
                'name' => 'tags',
                'type' => 'select2_multiple',
                'label'=> 'Tags',
            ], function () {
                return Tag::all()->keyBy('id')->pluck('name', 'id')->toArray();
            }, function ($values) { // if the filter is active
                $this->crud->query = $this->crud->query->whereHas('tags', function ($q) use ($values) {
                    foreach (json_decode($values) as $key => $value) {
                        if ($key == 0) {
                            $q->where('tags.id', $value);
                        } else {
                            $q->orWhere('tags.id', $value);
                        }
                    }
                });
            });

        });

        /*
        |--------------------------------------------------------------------------
        | CREATE & UPDATE OPERATIONS
        |--------------------------------------------------------------------------
        */
        $this->crud->operation(['update'],function () {
            $this->crud->addField([
                'name' => 'binds',
                'label' => 'Bind items',
                'type' => 'select2_grouped_custom',
                'attribute' => 'name',
                'model'     => "App\Binds",
                'type_resources' => ItemKey::TYPE_ARTICLES,
            ]);
        });

        $this->crud->operation(['create', 'update'], function () {
            $this->crud->setValidation(ArticleRequest::class);

            $this->crud->addField([
                'name' => 'title',
                'label' => 'Title (H1 Title)',
                'type' => 'text',
                'placeholder' => 'Your title here',
            ]);

            $this->crud->addField(['name' => 'bg_text', 'type' => 'text', 'label' => 'BG Text']);

            $this->crud->addField([
                'name' => 'subtitle',
                'label' => 'Subtitle (H2 Subtitle)',
                'type' => 'text',
                'placeholder' => 'Your subtitle here',
            ]);
            $this->crud->addField([
                'name' => 'slug',
                'label' => 'Slug (URL)',
                'type' => 'text',
                'hint' => 'Will be automatically generated from your title, if left empty.',
                // 'disabled' => 'disabled'
            ]);
//            $this->crud->addField([
//                'name'        => 'type',
//                'label'       => "Type",
//                'type'        => 'select_from_array',
//                'options'     => Keys::all()->keyBy('id')->pluck('name', 'id')->toArray(),
//                'allows_null' => false,
//            ]);
            $this->crud->addField([
                'name' => 'date',
                'label' => 'Date',
                'type' => 'date',
                'default' => date('Y-m-d'),
            ]);
            $this->crud->addField([
                'name' => 'content',
                'label' => 'Content',
                'type' => 'ckeditor',
                'placeholder' => 'Your textarea text here',
                'extra_plugins' => ['justify']
            ]);

//            $this->crud->addField([
//                'name' => 'image',
//                'label' => 'Image',
//                'type' => 'browse',
//            ]);
            $this->crud->addField(['name' => 'image', 'type' => 'image', 'label' => 'Image',
                'crop' => true, // set to true to allow cropping, false to disable
                'aspect_ratio' => 1, // ommit or set to 0 to allow any aspect ratio
            ]);

            $this->crud->addField([
                'name' => 'alt',
                'label' => 'Alt',
                'type' => 'text',
                'placeholder' => 'Alt',
            ]);
            $this->crud->addField([
                'name' => 'pic_title',
                'label' => 'Picture Title',
                'type' => 'text',
                'placeholder' => 'Picture Title',
            ]);

//            $this->crud->addField([
//                'label' => 'Categories',
//                'type' => 'relationship',
//                'name' => 'categories',
//                'entity' => 'categories',
//                'attribute' => 'name',
//                'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
////                'inline_create' => ['entity' => 'tag'],
////                'inline_create' => true,
//                'ajax' => true,
//            ]);
            $this->crud->addField([
                'label' => 'Tags',
                'type' => 'relationship',
                'name' => 'tags', // the method that defines the relationship in your Model
                'entity' => 'tags', // the method that defines the relationship in your Model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
                'inline_create' => ['entity' => 'tag'],
                'ajax' => true,
            ]);

            $this->crud->addField([
                'name' => 'key_id',
                'label' => 'Keys',
                'type' => 'select2_key',
                'model'     => "App\Models\Keys", // foreign key model
                'attribute' => 'name', // foreign key attribute that is shown to user
                'select_all' => true, // show Select All and Clear buttons?
//                'pivot' => false,
                'options'   => (function ($query) {
                    return $query->orderBy('name', 'ASC')->get();
                }),
            ]);

            $this->crud->addField([
                'name' => 'status',
                'label' => 'Status',
                'type' => 'enum',
            ]);
            $this->crud->addField([
                'name' => 'featured',
                'label' => 'Featured item',
                'type' => 'checkbox',
            ]);
            $this->crud->addField([
                'name' => 'position',
                'label' => 'Position',
                'type' => 'text',
            ]);
            $this->crud->addField([
                'name' => 'search_field',
                'label' => 'Search Field',
                'type' => 'ckeditor',
                'placeholder' => '',
                'extra_plugins' => ['justify']
            ]);

            $this->crud->addField(['name' => 'seo_title', 'type' => 'text', 'label' => 'Seo Title']);
            $this->crud->addField(['name' => 'seo_description', 'type' => 'ckeditor', 'label' => 'Seo Description']);
        });
    }

    /**
     * Respond to AJAX calls from the select2 with entries from the Category model.
     * @return JSON
     */
    public function fetchcategories()
    {
        return $this->fetch(\Backpack\NewsCRUD\app\Models\Category::class);
    }

    /**
     * Respond to AJAX calls from the select2 with entries from the Tag model.
     * @return JSON
     */
    public function fetchTags()
    {
        return $this->fetch(\Backpack\NewsCRUD\app\Models\Tag::class);
    }

    /**
     * @param ArticleRequest $request
     * @return \Backpack\CRUD\app\Http\Controllers\Operations\Response
     */
    public function update(ArticleRequest $request)
    {
        $response = $this->traitUpdate();
        (new ItemKey())->setKeyAndItem($request,ItemKey::TYPE_ARTICLES);
        (new BindItems())->bind($request);
        return $response;
    }

}
