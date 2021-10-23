<?php
/*#SID - 44-new-website-page-knowledge */
namespace App\Http\Controllers\Admin;

use App\Models\BlogCategory;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Backpack\NewsCRUD\app\Http\Requests\BlogCategoryRequest;

class BlogCategoryCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation { update as traitUpdate; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ReorderOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\InlineCreateOperation;

    public function setup()
    {
        CRUD::setModel(BlogCategory::class);
        CRUD::setRoute(config('backpack.base.route_prefix', 'admin').'/blogcategory');
        CRUD::setEntityNameStrings('blog category', 'Blog categories');
    }

    protected function setupListOperation()
    {
        CRUD::addColumn('name');
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
    }

    protected function setupShowOperation()
    {
        $this->setupListOperation();

        CRUD::addColumn('created_at');
        CRUD::addColumn('updated_at');
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(BlogCategoryRequest::class);

        CRUD::addField([
            'name' => 'name',
            'label' => 'Name',
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->crud->addField([
            'name' => 'name',
            'label' => 'Name',
        ]);
        $this->setupCreateOperation();
    }

    protected function setupReorderOperation()
    {
        CRUD::set('reorder.label', 'name');
        CRUD::set('reorder.max_level', 1);
    }

    /**
     * @param \App\Http\Requests\CategoryRequest $request
     * @return \Backpack\CRUD\app\Http\Controllers\Operations\Response
     */
    public function update(\App\Http\Requests\BlogCategoryRequest $request)
    {
        $response = $this->traitUpdate();
        return $response;
    }
}
