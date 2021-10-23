<?php

//sd
namespace App\Http\Controllers\Admin;


use App\Models\Pdfs;
use App\Http\Requests\PdfRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class PdfCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PdfCrudController extends CrudController
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
        $this->crud->setModel(Pdfs::class);
        $this->crud->setRoute(config('backpack.base.route_prefix', 'admin').'/whitepapers');
        $this->crud->setEntityNameStrings('whitepaper', 'Whitepapers');
        $this->crud->enableExportButtons();

        /*
        |--------------------------------------------------------------------------
        | LIST OPERATION
        |--------------------------------------------------------------------------
        */
        $this->crud->operation('list', function () {
            $this->crud->addColumn(['name' => 'title', 'type' => 'text', 'label' => 'Title']);
            $this->crud->addColumn(['name' => 'slug', 'type' => 'text', 'label' => 'Slug (URL)']);
            $this->crud->addColumn(['name' => 'short_description', 'type' => 'text', 'label' => 'Short Description']);
            $this->crud->addColumn(['name' => 'image', 'type' => 'image', 'label' => 'Image']);
        });

        /*
        |--------------------------------------------------------------------------
        | CREATE & UPDATE OPERATIONS
        |--------------------------------------------------------------------------
        */
        $this->crud->operation(['create', 'update'], function () {
            $this->crud->setValidation(PdfRequest::class);
            $this->crud->addField([
                'name' => 'title',
                'label' => 'Title (H1 Title)',
                'type' => 'text',
                'placeholder' => 'Your title here',
            ]);
            $this->crud->addField(['name' => 'slug', 'type' => 'text', 'label' => 'Slug (URL)']);
            $this->crud->addField([
                'name' => 'short_description',
                'label' => 'Short Description',
                'type' => 'textarea',
                'placeholder' => 'Your description here',
            ]);
            $this->crud->addField(['name' => 'image', 'type' => 'image', 'label' => 'Image']);
            $this->crud->addField(['name' => 'file', 'type' => 'browse', 'label' => 'Pdf', 'disk' => 'public']);
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
    public function update(PdfRequest $request)
    {
        $response = $this->traitUpdate();
        return $response;
    }

}
