<?php
/*#SID - 44-new-website-page-knowledge */
namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use App\Models\BlogCategory;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\NewsCRUD\app\Http\Requests\BlogRequest;

class BlogCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation { update as traitUpdate; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\InlineCreateOperation;

    public function setup()
    {
        CRUD::setModel(Blog::class);
        CRUD::setRoute(config('backpack.base.route_prefix', 'admin').'/blogs');
        CRUD::setEntityNameStrings('blog', 'Blogs');
    
//        CRUD::addColumn('parent');
        /*CRUD::addColumn([   // select_multiple: n-n relationship (with pivot table)
            'label'     => 'Articles', // Table column heading
            'type'      => 'relationship_count',
            'name'      => 'articles', // the method that defines the relationship in your Model
            'wrapper'   => [
                'href' => function ($crud, $column, $entry, $related_key) {
                    return backpack_url('article?category_id='.$entry->getKey());
                },
            ],
        ]);*/
        /*
        |--------------------------------------------------------------------------
        | LIST OPERATION
        |--------------------------------------------------------------------------
        */
        $this->crud->operation('list', function () {
            $this->crud->addColumn(['name' => 'banner_image', 'type' => 'image', 'label' => 'Image']);
            $this->crud->addColumn(['name' => 'title', 'type' => 'text', 'label' => 'Title']);
            $this->crud->addColumn(['name' => 'author', 'type' => 'text', 'label' => 'Author']);
            $this->crud->addColumn(['name' => 'reading_time', 'type' => 'text', 'label' => 'Reading Time']);
            $this->crud->addColumn(['name' => 'status', 'label' => 'Status', 'type' => 'check',
            ]);
        });

        /*
        |--------------------------------------------------------------------------
        | CREATE & UPDATE OPERATIONS
        |--------------------------------------------------------------------------
        */
        $this->crud->operation(['create', 'update'], function () {
            $this->crud->setValidation(BlogRequest::class);
            $this->crud->addField(['name' => 'blog_category_id', 'label' => 'Category', 'type' => 'select_from_array','options' => BlogCategory::getCRUDCategories(), 'allows_null' => false]);
            $this->crud->addField(['name' => 'title', 'label' => 'Title (H1 Title)', 'type' => 'text']);
            $this->crud->addField(['name' => 'subtitle', 'label' => 'Subtitle (H2 Subtitle)', 'type' => 'text']);
            $this->crud->addField(['name' => 'slug', 'type' => 'text', 'label' => 'Slug (URL)']);
            $this->crud->addField(['name' => 'author', 'type' => 'text', 'label' => 'Author']);
            $this->crud->addField(['name' => 'reading_time', 'type' => 'text', 'label' => 'Reading Time']);
            $this->crud->addField(['name' => 'added_date', 'type' => 'date_picker', 'label' => 'Date']);
            $this->crud->addField(['name' => 'content_top', 'label' => 'Content Top', 'type' => 'ckeditor']);
            $this->crud->addField(['name' => 'content_middle', 'label' => 'Content Middle', 'type' => 'ckeditor']);
            $this->crud->addField(['name' => 'content_bottom', 'label' => 'Content Bottom', 'type' => 'ckeditor']);
            $this->crud->addField(['name' => 'conclusion', 'label' => 'Conclusion', 'type' => 'ckeditor']);
            $this->crud->addField(['name' => 'banner_image', 'type' => 'image', 'label' => 'Banner Image']);
            $this->crud->addField(['name' => 'pdf_url', 'type' => 'browse', 'label' => 'Pdf', 'disk' => 'public']);
            // dropdown filter
            $this->crud->addField(['name' => 'status', 'type' => 'select2_from_array', 'label' => 'Status', 'options'     => ['1' => 'PUBLISHED', '0' => 'DRAFT'], 'allows_null' => false, 'default' => '1', ]);
        });
    }

    public function update(BlogRequest $request)
    {
        $response = $this->traitUpdate();
        return $response;
    }
}
