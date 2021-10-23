<?php

namespace App\Http\Controllers\Admin;

use App\BindItems;
use App\Comparison;
use App\Helpers\Helper;
use App\Http\Requests\ProductsRequest;
use App\ItemKey;
use App\Models\Category;
use App\Models\Keys;
use App\Models\ProductCharacteristics;
use App\Models\Products;
use App\Models\ProductsType;
use App\Wishlist;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ProductsCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ProductsCrudController extends CrudController
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

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Products::class);
        CRUD::setRoute(config('backpack.base.route_prefix','admin') . '/products');
        CRUD::setEntityNameStrings('products', 'Products');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
       // CRUD::setFromDb(); // columns
        $this->crud->addColumn(['name' => 'title', 'type' => 'text', 'label' => 'Title']);
        $this->crud->addColumn(['name' => 'price', 'type' => 'text', 'label' => 'Price']);
        $this->crud->addColumn(['name' => 'status', 'type' => 'text', 'label' => 'Status']);
        $this->crud->addColumn([
            'name' => 'featured',
            'label' => 'Featured',
            'type' => 'check',
        ]);
       $this->crud->addColumn(['name' => 'category_id', 'type' => 'select',
           'label' => 'Category', 'model' => "App\Categories",'attribute' => 'name','entity' => 'category',
           'key'=>'categoryName']);
        $this->crud->addColumn(['name' => 'type', 'type' => 'select',
            'label' => 'Type', 'model' => "App\ProductsType",'attribute' => 'name','entity' => 'productType',
            'key'=>'typeName']);
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
        CRUD::setValidation(ProductsRequest::class);

//        CRUD::setFromDb(); // fields
        $statuses = Helper::$statuses;
        $this->crud->addField(['name' => 'status', 'label' => 'Status',
            'type' => 'select_from_array',
            'options' => $statuses,
            'allows_null' => false,
            // 'default' => 1,
        ]);

        $this->crud->addField(['name' => 'type', 'label' => 'Type',
            'type' => 'select_from_array',
            'options' => ProductsType::getType(),
            'allows_null' => false,
            // 'default' => 1,
        ]);

        CRUD::addField(['name' => 'title', 'type' => 'text','tab' => 'Text', 'label'=>'Title (H1 Title)']);
        CRUD::addField(['name' => 'bg_text', 'type' => 'text','tab' => 'Text']);
        CRUD::addField(['name' => 'slug', 'type' => 'text','tab' => 'Text']);
        CRUD::addField(['name' => 'subtitle', 'type' => 'text','tab' => 'Text', 'label'=>'Subtitle (H2 Subtitle)']);
        CRUD::addField(['name' => 'text', 'type' => 'ckeditor','tab' => 'Text','extra_plugins' => ['justify']]);

        $this->crud->addField(['name' => 'seo_title', 'type' => 'text', 'label' => 'Seo Title','tab' => 'Text']);
        $this->crud->addField(['name' => 'seo_description', 'type' => 'ckeditor', 'label' => 'Seo Description','tab' => 'Text','extra_plugins' => ['justify']]);

        CRUD::addField(['name' => 'price', 'type' => 'text', 'label' => 'Price']);
      //  CRUD::addField(['name' => 'op_temp', 'type' => 'text', 'label' => 'Operational Temperature']);
      //  CRUD::addField(['name' => 'protection', 'type' => 'text', 'label' => 'Ingress Protection']);
      //  CRUD::addField(['name' => 'weight', 'type' => 'text', 'label' => 'Weight (including batteries)']);
     //   CRUD::addField(['name' => 'op_volt', 'type' => 'text', 'label' => 'Operational Voltage']);
        //CRUD::addField(['name' => 'ingr_prot', 'type' => 'text', 'label' => 'Ingress Protection']);

        $this->crud->addField([
            'label' => 'Category',
            'type' => 'relationship',
            'name' => 'category_id',
            'entity' => 'category',
            'attribute' => 'name',
            'inline_create' => true,
            'ajax' => true,
        ]);

//        $this->crud->addField([
//            'name' => 'size',
//            'label' => 'Size',
//            'type' => 'text',
//            'placeholder' => 'Size',
//        ]);


        $this->crud->addField([
            'label' => 'Keys',
            'type' => 'relationship',
            'name' => 'keys', // the method that defines the relationship in your Model
            'entity' => 'keys', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'pivot' => true, // on create&update, do you need to add/delete pivot table entries?
            'inline_create' => ['entity' => 'keys'],
            'ajax' => true,
        ]);


        // image
        $this->crud->addField([
            'name' => 'images',
            'label' => 'Additional Images',
            'type' => 'browse_multiple_custom',
            'multiple' => true,
            'sortable' => true,
            'tab' => 'image'
        ]);

        $this->crud->addField([
            'name' => 'spec_sheet',
            'label' => 'Spec Sheet',
            'type' => 'browse_multiple',
            'multiple' => false,
            'sortable' => false,
            'tab' => 'image'
        ]);

        /* #SID : 40-new-tab-on-product-page */
        $this->crud->addField([
            'name' => 'compliance_sheet',
            'label' => 'Compliance Statements',
            'type' => 'browse_multiple',
            'multiple' => false,
            'sortable' => false,
            'tab' => 'image'
        ]);
        
        $this->crud->addField([
            'name' => 'fcc_compliance',
            'label' => 'FCC Compliance',
            'type' => 'browse_multiple',
            'multiple' => false,
            'sortable' => false,
            'tab' => 'image'
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

        $this->crud->addField([   // Table
            'name'            => 'options',
            'label'           => 'Options',
            'type'            => 'table',
            'entity_singular' => 'option', // used on the "Add X" button
            'columns'         => [
                'name'  => 'Name',
                'desc'  => 'value',
                'id'  => 'id',
            ],
            'max' => 5, // maximum rows allowed in the table
            'min' => 0, // minimum rows allowed in the table
            'tab' => 'Main information'
        ]);

        $this->crud->addField([   // Table
            'name'            => 'options_characteristics',
            'label'           => 'Characteristics',
            'type'            => 'table_custom',
            'entity_singular' => 'option', // used on the "Add X" button
            'max' => 160, // maximum rows allowed in the table
            'min' => 0, // minimum rows allowed in the table
            'tab' => 'Characteristic'
        ]);

//        $this->crud->addField([
//            'label' => 'Characteristics',
//            'type' => 'select2_multiple',
//            'name' => 'characteristics', // the method that defines the relationship in your Model
//            'entity' => 'characteristics', // the method that defines the relationship in your Model
//            'attribute' => 'name', // foreign key attribute that is shown to user
//            'pivot' => true,
//            'inline_create' => ['entity' => 'propductcharacteristics'],
//            'ajax' => true,
//            'tab' => 'Characteristic',
//            'select_all' => true, // show Select All and Clear buttons?
//        ]);


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
        $this->crud->addField([
            'name' => 'binds',
            'label' => 'Bind items',
            'type' => 'select2_grouped_custom',
            'attribute' => 'name',
            'model'     => "App\Binds",
            'type_resources' => ItemKey::TYPE_PRODUCT,
        ]);
        $this->setupCreateOperation();
    }

    /**
     * Respond to AJAX calls from the select2 with entries from the Category model.
     * @return JSON
     */
    public function fetchCategory()
    {
        return $this->fetch(\Backpack\NewsCRUD\app\Models\Category::class);
    }

    /**
     * Respond to AJAX calls from the select2 with entries from the Tag model.
     * @return JSON
     */
    public function fetchCharacteristics()
    {
        return $this->fetch(ProductCharacteristics::class);
    }

    /**
     * Respond to AJAX calls from the select2 with entries from the Tag model.
     * @return JSON
     */
    public function fetchKeys()
    {
        return $this->fetch(Keys::class);
    }

    /**
     * @param ProductsRequest $request
     * @return \Backpack\CRUD\app\Http\Controllers\Operations\Response
     */
    public function update(ProductsRequest $request)
    {
        $response = $this->traitUpdate();
        (new BindItems())->bind($request);
        return $response;
    }


    public function destroy($id)
    {

        $this->crud->hasAccessOrFail('delete');

        $wishlists = Wishlist::where('product_id',$id)
            ->get();
        if(!empty($wishlists)) {
            foreach ($wishlists as $wishlist) {
                $wishlist->delete();
            }
        }
        $compares = Comparison::where('product_id',$id)
            ->get();
        if(!empty($compares)) {
            foreach ($compares as $compare) {
                $compare->delete();
            }
        }

        return $this->crud->delete($id);
    }

}
