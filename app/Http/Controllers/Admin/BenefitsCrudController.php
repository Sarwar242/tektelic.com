<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Http\Requests\BenefitsRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class BenefitsCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class BenefitsCrudController extends CrudController
{

    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

   // use \Backpack\CRUD\app\Http\Controllers\Operations\InlineCreateOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Benefits::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/benefits');
        CRUD::setEntityNameStrings('benefits', 'benefits');

        $this->crud->setHeading('Benefits');
        $this->crud->setSubheading('Benefit');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->removeButton('create');

        $this->crud->addColumn(['name' => 'id', 'type' => 'text', 'label' => 'Id']);

        $this->crud->addColumn(['name' => 'status', 'type' => 'text', 'label' => 'Status']);
        $this->crud->addColumn(['name' => 'image', 'type' => 'image', 'label' => 'Image']);

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(BenefitsRequest::class);

        /*$this->crud->addField([
            'type' => "relationship",
            'name' => 'benefitsLang', // the method on your model that defines the relationship
            'ajax' => true,
            'inline_create' => [ // specify the entity in singular
                'entity' => 'benefitlang', // the entity in singular
                // OPTIONALS
                'force_select' => true, // should the inline-created entry be immediately selected?
                'modal_class' => 'modal-dialog modal-xl', // use modal-sm, modal-lg to change width
             //   'modal_route' => route('benefitlang-inline-create'), // InlineCreate::getInlineCreateModal()
              //  'create_route' =>  route('benefitlang-inline-create-save'), // InlineCreate::storeInlineCreate()
               // 'include_main_form_fields' => ['field1', 'field2'], // pass certain fields from the main form to the modal
            ]
        ]);*/

        $statuses = Helper::$statuses;
        $types = Helper::$types;
        $section_types = Helper::$common_section_types;

        $this->crud->addField(['name' => 'section_type', 'label' => 'Section Type',
            'type' => 'select_from_array',
            'options' => $section_types,
            'allows_null' => false,
            //'default' => 1,
        ]);


        $this->crud->addField(['name' => 'type', 'label' => 'Type',
            'type' => 'select_from_array',
            'options' => $types,
            'allows_null' => false,
            //'default' => 1,

        ]);

        $this->crud->addField(['name' => 'status', 'label' => 'Status',
            'type' => 'select_from_array',
            'options' => $statuses,
            'allows_null' => false,
            'default' => 1,
        ]);
        $this->crud->addField(['name' => 'image', 'type' => 'upload', 'label' => 'Image','upload'=> true
        ]);


        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
