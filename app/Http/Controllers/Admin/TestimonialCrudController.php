<?php
//#SID - 46-testimonials-slider-section-for-the-homepage
namespace App\Http\Controllers\Admin;


use App\Models\Testimonials;
use App\Http\Requests\TestimonialRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class TestimonialCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TestimonialCrudController extends CrudController
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
        $this->crud->setModel(Testimonials::class);
        $this->crud->setRoute(config('backpack.base.route_prefix', 'admin').'/testimonials');
        $this->crud->setEntityNameStrings('testimonial', 'Testimonials');
        $this->crud->enableExportButtons();

        /*
        |--------------------------------------------------------------------------
        | LIST OPERATION
        |--------------------------------------------------------------------------
        */
        $this->crud->operation('list', function () {
            $this->crud->addColumn(['name' => 'logo', 'type' => 'image', 'label' => 'Logo']);
            $this->crud->addColumn(['name' => 'company_name', 'type' => 'text', 'label' => 'Company Name']);
            $this->crud->addColumn(['name' => 'speaker_name', 'type' => 'text', 'label' => 'Speaker Name']);
            //$this->crud->addColumn(['name' => 'speaker_pic', 'type' => 'image', 'label' => 'Speaker Photo']);
            $this->crud->addColumn(['name' => 'position', 'type' => 'text', 'label' => 'Position']);
            $this->crud->addColumn(['name' => 'quote', 'type' => 'textarea', 'label' => 'Quote']);
            $this->crud->addColumn(['name' => 'website_link', 'type' => 'text', 'label' => 'Website Link']);
        });

        /*
        |--------------------------------------------------------------------------
        | CREATE & UPDATE OPERATIONS
        |--------------------------------------------------------------------------
        */
        $this->crud->operation(['create', 'update'], function () {
            $this->crud->setValidation(TestimonialRequest::class);
            $this->crud->addField(['name' => 'company_name','label' => 'Company Name','type' => 'text','placeholder' => 'Company name here',
            ]);
            $this->crud->addField(['name' => 'logo', 'type' => 'image', 'label' => 'Logo', 'disk' => 'public']);
            $this->crud->addField(['name' => 'speaker_name', 'type' => 'text', 'label' => 'Speaker Name']);
            //$this->crud->addField(['name' => 'speaker_pic', 'type' => 'image', 'label' => 'Speaker Photo', 'disk' => 'public']);
            $this->crud->addField(['name' => 'position', 'type' => 'text', 'label' => 'Position']);
            $this->crud->addField(['name' => 'quote', 'type' => 'textarea', 'label' => 'Quote']);
            $this->crud->addField(['name' => 'website_link', 'type' => 'text', 'label' => 'Website Link']);
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
    public function update(TestimonialRequest $request)
    {
        $response = $this->traitUpdate();
        return $response;
    }

}
