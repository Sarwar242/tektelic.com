<?php

namespace App\Http\Controllers\Admin;

use App\BindItems;
use App\Http\Requests\PortfolioLangRequest;
use App\ItemKey;
use App\Models\Langs;
use App\Models\PortfolioLang;
use App\Models\Portfolios;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class PortfolioLangCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PortfolioLangCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
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
        CRUD::setModel(\App\Models\PortfolioLang::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/portfoliolang');
        CRUD::setEntityNameStrings('portfoliolang', 'portfolio_lang');

       // $this->crud->setListView('vendor.portfolio');
        $this->crud->setEditView('vendor.portfolio.portfolio-edit');
       // $this->crud->addButtonFromView('line', 'update-portfolio', 'update-portfolio', 'beginning');
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
        $this->crud->addColumn(['name' => 'portfolio_id', 'type' => 'text', 'label' => 'Portfolio Id']);
       // $this->crud->addColumn(['name' => 'category_id', 'type' => 'text', 'label' => 'Category']);
//        $this->crud->addColumn(['name' => 'portfolio_id', 'type' => 'select',
//            'label' => 'Category', 'model' => "App\Categories",'attribute' => 'name','entity' => 'portfolio.category',
//            'key'=>'categoryName']);
        $this->crud->addColumn(['name' => 'title', 'type' => 'text', 'label' => 'Title']);
        $this->crud->addColumn(['name' => 'text', 'type' => 'text', 'label' => 'Text']);
        $this->crud->addColumn([
            'name' => 'featured',
            'label' => 'Featured',
            'type' => 'check',
        ]);

    //    $this->crud->addColumn(['name' => 'status', 'type' => 'text', 'label' => 'Status']);

        $this->crud->addColumn(['name' => 'portfolio_id', 'type' => 'select', 'label' =>
            'Status', 'model' => "App\Models\Portfolios",'attribute' => 'status','entity' => 'portfolio',
            'key'=>'statusValue']);

       /* $this->crud->addColumn(['name' => 'portfolio_id', 'type' => 'select',
            'label' => 'Image', 'model' => "App\Models\Portfolios",'attribute' => 'image','entity' => 'portfolio',
            'key'=>'imageName']);*/

        $this->crud->setHeading('Portfolio');
        $this->crud->addColumn([
            'name' => 'featured',
            'label' => 'Featured',
            'type' => 'check',
        ]);
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
        CRUD::setValidation(PortfolioLangRequest::class);

        $statuses = PortfolioLang::$statuses;
        $langs = Langs::getLangsArray();

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

//        $this->crud->addField(['name' => 'category_id', 'type' => 'select', 'label' => 'Category',
//            'entity' => 'categories',
//            'model' => "App\Categories", // related model
//            'attribute' => 'name', // foreign key attribute that is shown to user
//        ]);

        $this->crud->addField(['name' => 'lang', 'label' => 'Lang',
            'type' => 'select_from_array',
            'options' => $langs,
            'allows_null' => false,
            //'default' => 1,

        ]);

        $this->crud->addField(['name' => 'title', 'type' => 'text', 'label' => 'Title (H1 Title)']);
        $this->crud->addField(['name' => 'bg_text', 'type' => 'text', 'label' => 'BG Text']);
        $this->crud->addField(['name' => 'sub_title', 'type' => 'text', 'label' => 'Sub Title (H2 Subtitle)']);
        $this->crud->addField(['name' => 'text', 'type' => 'ckeditor', 'label' => 'Text','extra_plugins' => ['justify']]);
        $this->crud->addField(['name' => 'text2', 'type' => 'ckeditor', 'label' => 'Text 2','extra_plugins' => ['justify']]);
       /* $this->crud->addField(['name' => 'sub_title2', 'type' => 'text', 'label' => 'Sub Title 2']);
        $this->crud->addField(['name' => 'text2', 'type' => 'text', 'label' => 'Text 2']);*/


      //  $this->crud->addField(['name' => 'portfolio_id', 'type' => 'hidden', 'label' => 'Portfolio']);
        $this->crud->addField(['name' => 'status', 'label' => 'Status',
            'type' => 'select_from_array',
            'options' => $statuses,
            'allows_null' => false,
            'default' => 1,
        ]);
        $this->crud->addField(['name' => 'image', 'type' => 'image', 'label' => 'Image',
            'crop' => true, // set to true to allow cropping, false to disable
           // 'aspect_ratio' => 1, // ommit or set to 0 to allow any aspect ratio
        ]);
        $this->crud->addField(['name' => 'alt', 'type' => 'text', 'label' => 'Alt']);
        $this->crud->addField(['name' => 'pic_title', 'type' => 'text', 'label' => 'Picture Title']);

        $this->crud->addField(['name' => 'seo_title', 'type' => 'text', 'label' => 'Seo Title']);
        $this->crud->addField(['name' => 'seo_description', 'type' => 'ckeditor', 'label' => 'Seo Description','extra_plugins' => ['justify']]);
        $this->crud->addField(['name' => 'search_field', 'type' => 'ckeditor', 'label' => 'Search Field','extra_plugins' => ['justify']]);

        $this->crud->setHeading('Portfolio', 'create');

        //CRUD::setFromDb(); // fields

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

        CRUD::setValidation(PortfolioLangRequest::class);

       $id = \Route::current()->parameter('id');
        $portfolio = PortfolioLang::where(
            'id', '=', $id
        )->with(['portfolio' => function ($query) {
        }])->first();


        $statuses = PortfolioLang::$statuses;
        $langs = Langs::getLangsArray();

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
        $this->crud->addField(['name' => 'lang', 'label' => 'Lang',
            'type' => 'select_from_array',
            'options' => $langs,
            'allows_null' => false,
            // 'default' => 1,

        ]);

        $this->crud->addField([
            'name' => 'key_id',
            'label' => 'Keys',
            'type' => 'select2_key',

            // optional
            'model'     => "App\Models\Keys", // foreign key model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'select_all' => true, // show Select All and Clear buttons?
//            'entity' => false,
//            'pivot' => false,
            'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
        ]);

        $this->crud->addField([
            'name' => 'binds',
            'label' => 'Bind items',
            'type' => 'select2_grouped_custom',
            'attribute' => 'name',
            'model'     => "App\Binds",
            'type_resources' => ItemKey::TYPE_PORTFOLIO,
        ]);

        /*$this->crud->addField(['name' => 'category_id', 'type' => 'select', 'label' => 'Category',
            'entity' => 'categories',
            'model' => "App\Categories", // related model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'default' => $portfolio->portfolio->category_id,
        ]);*/
        $this->crud->addField(['name' => 'status', 'label' => 'Status',
            'type' => 'select_from_array',
            'options' => $statuses,
            'allows_null' => false,
            'default' => $portfolio->portfolio->status,
        ]);

        $this->crud->addField(['name' => 'title', 'type' => 'text', 'label' => 'Title (H1 Title)']);
        $this->crud->addField(['name' => 'bg_text', 'type' => 'text', 'label' => 'BG Text']);
        $this->crud->addField(['name' => 'sub_title', 'type' => 'text', 'label' => 'Sub Title (H2 Subtitle)']);
        $this->crud->addField(['name' => 'slug', 'type' => 'text', 'label' => 'Slug']);
        $this->crud->addField(['name' => 'text', 'type' => 'ckeditor', 'label' => 'Text','extra_plugins' => ['justify']]);

      /*  $this->crud->addField(['name' => 'sub_title2', 'type' => 'text', 'label' => 'Sub Title 2']);
        $this->crud->addField(['name' => 'text2', 'type' => 'ckeditor', 'label' => 'Text 2']);*/

        $this->crud->addField(['name' => 'text2', 'type' => 'ckeditor', 'label' => 'Text 2','extra_plugins' => ['justify']]);

        $this->crud->addField(['name' => 'portfolio_id', 'type' => 'hidden', 'label' => 'Portfolio']);

        $this->crud->addField(['name' => 'seo_title', 'type' => 'text', 'label' => 'Seo Title']);
        $this->crud->addField(['name' => 'seo_description', 'type' => 'ckeditor', 'label' => 'Seo Description','extra_plugins' => ['justify']]);
        $this->crud->addField(['name' => 'search_field', 'type' => 'ckeditor', 'label' => 'Search Field','extra_plugins' => ['justify']]);

        $this->crud->addField(['name' => 'image', 'type' => 'image', 'label' => 'Image','value'=>$portfolio->portfolio->image,
            'crop' => true, // set to true to allow cropping, false to disable
            // 'aspect_ratio' => 1, // ommit or set to 0 to allow any aspect ratio
        ]);
        $this->crud->addField(['name' => 'alt', 'type' => 'text', 'label' => 'Alt']);
        $this->crud->addField(['name' => 'pic_title', 'type' => 'text', 'label' => 'Picture Title']);

        $this->crud->setHeading('Portfolio', 'update');

        // $this->setupCreateOperation();
    }


    public function store(PortfolioLangRequest $request)
    {
        $input = $request->all();
        // var_dump($input['category_id']);

        $portfolios = new Portfolios();
//        $portfolios->category_id = $input['category_id'];
        $portfolios->status = $input['status'];
        $portfolios->image = $input['image'];
        $portfolios->save();


        $portfolio_lang = PortfolioLang::where(
            'lang', '=', $input['lang']
        )->where('portfolio_id', '=', $portfolios->id)->first();

        if (empty($portfolio_lang)) {
            $portfolio_lang = new PortfolioLang();
        }
        $portfolio_lang->title = $input['title'];
        $portfolio_lang->bg_text = $input['bg_text'];
        $portfolio_lang->sub_title = $input['sub_title'];
        $portfolio_lang->text = $input['text'];
        $portfolio_lang->lang = $input['lang'];
       /* $portfolio_lang->sub_title2 = $input['sub_title2'];
        $portfolio_lang->text2 = $input['text2'];*/
        $portfolio_lang->text2 = $input['text2'];
        $portfolio_lang->search_field = $input['search_field'];
        $portfolio_lang->portfolio_id = $portfolios->id;
        $portfolio_lang->featured = $input['featured'];
        $portfolio_lang->position = $input['position'];

        $portfolio_lang->alt = $input['alt'];
        $portfolio_lang->pic_title = $input['pic_title'];

        $portfolio_lang->save();
        return redirect('admin/portfoliolang');
    }

    public function update(PortfolioLangRequest $request)
    {
        $response = $this->traitUpdate();
        $input = $request->all();
        (new ItemKey())->setKeyAndItem($request,ItemKey::TYPE_PORTFOLIO);
        (new BindItems())->bind($request);
        $portfolio_id = $request->input('portfolio_id');

        $portfolios =  Portfolios::where('id',$portfolio_id)->first();
//        $portfolios->category_id = $input['category_id'];
        $portfolios->status = $input['status'];
        if(empty($input['image'])){
            $input['image']=$portfolios->image;
        }
        $portfolios->image = $input['image'];
        $portfolios->save();

        $portfolio_lang = PortfolioLang::where(
            'lang', '=', $input['lang']
        )->where('portfolio_id', '=', $portfolio_id)->first();

        if (empty($portfolio_lang)) {
            $portfolio_lang = new PortfolioLang();
        }
        $portfolio_lang->title = $input['title'];
        $portfolio_lang->bg_text = $input['bg_text'];
        $portfolio_lang->sub_title = $input['sub_title'];
        $portfolio_lang->seo_title = $input['seo_title'];
        $portfolio_lang->text = $input['text'];
        $portfolio_lang->text2 = $input['text2'];
        $portfolio_lang->seo_description = $input['seo_description'];
        $portfolio_lang->lang = $input['lang'];
        $portfolio_lang->search_field = $input['search_field'];
        $portfolio_lang->portfolio_id = $portfolio_id;
        $portfolio_lang->slug = $input['slug'];
        $portfolio_lang->featured = $input['featured'];
        $portfolio_lang->position = $input['position'];
        $portfolio_lang->alt = $input['alt'];
        $portfolio_lang->pic_title = $input['pic_title'];
        $portfolio_lang->save();
        return $response;
    }

    public function destroy($id)
    {
        /*$this->crud->hasAccessOrFail('delete');*/
        $entity_lang = PortfolioLang::where(
            'id', '=', $id
        )->with(['portfolio' => function ($query) {
        }])->first();

        $entity_langs = PortfolioLang::where(
            'portfolio_id', '=', $entity_lang->portfolio_id
        )->with(['portfolio' => function ($query) {
        }])->get();

        $count = $entity_langs->count();

        if($count>1) {
            return $this->crud->delete($id);
        }
        else{

            $entity = Portfolios::where(
                'id', '=', $entity_lang->portfolio_id
            )->first();

            if(!empty($entity)){
                $entity_lang->delete($id);
                $entity->delete();
            }
            return 1;
        }
    }
}
