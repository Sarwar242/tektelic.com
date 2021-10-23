<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Helper;
use App\Models\MenuItem;
use Backpack\CRUD\app\Http\Controllers\CrudController;

class MenuItemCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
//    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
//    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
   // use \Backpack\CRUD\app\Http\Controllers\Operations\ReorderOperation;

    public function setup()
    {
        $this->crud->setModel("App\Models\MenuItem");
        $this->crud->setRoute(config('backpack.base.route_prefix').'/menu-item');
        $this->crud->setEntityNameStrings('menu item', 'menu items');

      //  $this->crud->enableReorder('title', 1);

        $this->crud->operation('list', function () {
            $this->crud->addColumn([
                'name' => 'id',
                'label' => 'Id',
            ]);
            $this->crud->addColumn([
                'name' => 'title',
                'label' => 'Label',
            ]);
            $this->crud->addColumn([
                'name' => 'position',
                'label' => 'Position in menu',
            ]);
            $this->crud->addColumn([
                'label' => 'Parent',
                'type' => 'select',
                'name' => 'parent_id',
                'entity' => 'parent',
                'attribute' => 'name',
                'model' => "\App\Models\MenuItem",
            ]);

            $this->crud->addColumn([
                'name' => 'pos',
                'label' => 'Position',
            ]);
        });

        $this->crud->operation(['create', 'update'], function () {

            $menu_positions = Helper::$menu_positions;
            $this->crud->addField(['name' => 'pos', 'label' => 'Position on page',
                'type' => 'select_from_array',
                'options' => $menu_positions,
                'allows_null' => false,
                'default' => 'top',
            ]);


            $this->crud->addField([
                'name' => 'title',
                'label' => 'Label',
            ]);

            $this->crud->addField([
                'name' => 'position',
                'label' => 'Position item',
                'tab' => 'Breadcrumbs settings'
            ]);
            $this->crud->addField([
                'name' => 'set_crumbs',
                'type' => 'checkbox',
                'label' => 'Set for crumbs',
                'tab' => 'Breadcrumbs settings'
            ]);
            $this->crud->addField([
                'name'        => 'type_page',
                'label'       => "Type page",
                'type'        => 'select_from_array',
                'options'     => MenuItem::$types,
                'allows_null' => false,
                'tab' => 'Breadcrumbs settings'
            ]);
           /* $this->crud->addField([
                'label' => 'Parent',
                'type' => 'select',
                'name' => 'parent_id',
                'entity' => 'parent',
                'attribute' => 'name',
                'model' => "\App\Models\MenuItem",
            ]);*/
          /*  $this->crud->addField([
                'name' => ['type', 'link', 'page_id'],
                'label' => 'Type',
                'type' => 'page_or_link',
                'page_model' => '\App\Models\Page',
            ]);*/
        });
    }
}
