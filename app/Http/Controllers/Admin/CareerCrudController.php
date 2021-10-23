<?php
//#SID - #z3c3nz - Career page On Tektelic
namespace App\Http\Controllers\Admin;


use App\Models\Careers;
use App\Http\Requests\CareerRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class TestimonialCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CareerCrudController extends CrudController
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
        $this->crud->setModel(Careers::class);
        $this->crud->setRoute(config('backpack.base.route_prefix', 'admin').'/career');
        $this->crud->setEntityNameStrings('career', 'Career');
        $this->crud->enableExportButtons();

        /*
        |--------------------------------------------------------------------------
        | LIST OPERATION
        |--------------------------------------------------------------------------
        */
        $this->crud->operation('list', function () {
            $this->crud->addColumn(['name' => 'short_description', 'type' => 'ckeditor', 'label' => 'Short Description']);
            $this->crud->addColumn(['name' => 'link', 'type' => 'text', 'label' => 'Link']);
        });

        /*
        |--------------------------------------------------------------------------
        | CREATE & UPDATE OPERATIONS
        |--------------------------------------------------------------------------
        */
        $this->crud->operation(['create', 'update'], function () {
            $this->crud->setValidation(CareerRequest::class);
            $this->crud->addField(['name' => 'short_description','label' => 'Short Description','type' => 'ckeditor','placeholder' => 'Short Description',
            ]);
            $this->crud->addField(['name' => 'link', 'type' => 'text', 'label' => 'Link']);
        });
    }

    /**
     * Respond to AJAX calls from the select2 with entries from the Category model.
     * @return JSON
     */

    /**
     * @param ArticleRequest $request
     * @return \Backpack\CRUD\app\Http\Controllers\Operations\Response
     */
    public function update(CareerRequest $request)
    {
        $response = $this->traitUpdate();
        return $response;
    }

}
