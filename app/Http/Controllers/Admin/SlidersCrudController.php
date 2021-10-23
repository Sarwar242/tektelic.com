<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SlidersRequest;
use App\Models\Sliders;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\Response;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class SlidersCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class SlidersCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation { store as traitStore; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation { update as traitUpdate; }
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Sliders::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/sliders');
        CRUD::setEntityNameStrings('sliders', 'sliders');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->addClause('where', 'type', '=', 1);
//        CRUD::setFromDb(); // columns
        CRUD::column('title')->type('text');
        CRUD::column('text')->type('text');
        CRUD::addColumn([
            'name' => 'image',
            'type' => 'image',
            'height' => '100px',
            'width' => '100px',
        ]);
//        CRUD::addColumn(['name' => 'title', 'type' => 'text']);
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
        CRUD::setValidation(SlidersRequest::class);

        $this->crud->addField(['name' => 'text', 'type' => 'ckeditor', 'label' => 'Text',]);
        $this->crud->addField(['name' => 'title', 'type' => 'ckeditor', 'label' => 'Title',]);
        $this->crud->addField(['name' => 'image', 'type' => 'image', 'label' => 'Image',
            'crop' => true, // set to true to allow cropping, false to disable
            'aspect_ratio' => 1, // ommit or set to 0 to allow any aspect ratio
        ]);
        $this->crud->addField(['name' => 'link_product', 'type' => 'text', 'label' => 'Link']);
        $this->crud->addField(['name' => 'button_text', 'type' => 'text', 'label' => 'Button Text']);
        $this->crud->addField(['name' => 'position', 'type' => 'text', 'label' => 'Position']);
        $this->crud->addField(['name' => 'type', 'type' => 'hidden', 'value' => 1]);
//        CRUD::setFromDb(); // fields


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

//    /**
//     * @param SlidersRequest $request
//     * @return Response
//     */
//    public function update(SlidersRequest $request)
//    {
//        $response = $this->traitUpdate();
//        $id = $request->input('id');
//        $entity = Sliders::find($id);
//        $entity->type = 1;
//        $entity->save();
//        return $response;
//    }
}
