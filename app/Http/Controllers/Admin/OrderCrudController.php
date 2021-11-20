<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\OrderRequest;
use App\Models\Area;
use App\Models\City;
use App\Models\Order;
use App\Models\OrderState;
use App\Models\UserType;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Http\Request;
use Backpack\CRUD\app\Library\Widget;

/**
 * Class OrderCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class OrderCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Order::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/order');
        CRUD::setEntityNameStrings('order', 'orders');

        Widget::add()->to('before_content')->type('div')->class('row')->content([
            Widget::add()
                ->type('progress')
                ->class('card border-0 text-white bg-success')
                // ->progressClass('progress-bar')
                // ->progress(80)
                ->value( Order::count())
                ->description('All orders')
                // ->hint('Great! Don\'t stop.')
                ->onlyHere(),
            Widget::add()
                ->type('progress')
                ->class('card border-0 text-white bg-primary')
                // ->progressClass('progress-bar')
                // ->progress(80)
                ->value(Order::where('order_state_id',1)->count())
                ->description('Pending orders')
                // ->hint('Great! Don\'t stop.')
                ->onlyHere(),

        ]);
    }




    protected function setupListOperation()
    {



        CRUD::column('id');
        CRUD::column('title');
        CRUD::column('user_id')->label(trans('backpack::crud.model.user'));

        $this->crud->addColumn([
            'name'         => 'SpecialType', // name of relationship method in the model
            'type'         => 'relationship',
            'label'        =>  trans('backpack::crud.model.special'), // Table column heading
        ]);

        $this->crud->addColumn([
            'name'         => 'CustomerAddress.Area', // name of relationship method in the model
            'type'         => 'relationship',
            'attribute' => env('LANG') == 'en' ? 'area_name_en' : 'area_name_ar',
            'label'        => trans('backpack::crud.model.area'), // Table column heading

        ]);

        $this->crud->addColumn([
            'name'         => 'User.UserType', // name of relationship method in the model
            'type'         => 'relationship',
            'label'        => trans('backpack::crud.model.user_type'), // Table column heading
        ]);

        CRUD::column('created_at')->type('datetime')->label(trans('backpack::crud.model.created_at'));

        $this->crud->addColumn([
            'name'         => 'OrderState', // name of relationship method in the model
            'type'         => 'relationship',
            'label'        => trans('backpack::crud.model.state'), // Table column heading
        ]);


        // ============================================ FILTERS ============================================

        // dropdown filter
        $this->crud->addFilter([
            'name'  => 'order_state_id',
            'type'  => 'dropdown',
            'label' => trans('backpack::crud.model.state')
        ], OrderState::pluck('name', 'id')->toArray(), function ($value) { // if the filter is active
            $this->crud->addClause('where', 'order_state_id', $value);
        });

        // dropdown filter
        $this->crud->addFilter([
            'name'  => 'user_id',
            'type'  => 'dropdown',
            'label' => trans('backpack::crud.model.user_type')
        ], UserType::pluck('name', 'id')->toArray(), function ($value) { // if the filter is active
            $this->crud->query = $this->crud->query->whereHas('User', function ($query) use ($value) {
                $query->where('user_type_id', $value);
            });
        });

        // dropdown filter
        $this->crud->addFilter([
            'name'  => 'useri',
            'type'  => 'dropdown',
            'label' => trans('backpack::crud.model.city')
        ], City::pluck('city_name_ar', 'id')->toArray(), function ($value) { // if the filter is active
            $this->crud->query = $this->crud->query->whereHas('CustomerAddress.Area', function ($query) use ($value) {
                $query->where('city_id', $value);
            });
        });

        // dropdown filter
        $this->crud->addFilter([
            'name'  => 'userid',
            'type'  => 'dropdown',
            'label' => trans('backpack::crud.model.area')
        ], Area::pluck('area_name_ar', 'id')->toArray(), function ($value) { // if the filter is active
            $this->crud->query = $this->crud->query->whereHas('CustomerAddress.Area', function ($query) use ($value) {
                $query->where('id', $value);
            });
        });




        // ========================================= BUTTONS ==================================================

        CRUD::button('comments')->stack('line')->modelFunction('comments')->makeFirst();
        CRUD::button('approv')->stack('line')->modelFunction('approv')->makeFirst();

        // $this->crud->addButton('line', $name, 'openGoogle', $content, $position);

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }



    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupShowOperation()
    {

        $this->crud->set('show.setFromDb', false);

        CRUD::column('title');
        CRUD::column('body');
        CRUD::column('user_id')->label(trans('backpack::crud.model.user'));

        $this->crud->addColumn([
            'name'         => 'SpecialType', // name of relationship method in the model
            'type'         => 'relationship',
            'label'        =>  trans('backpack::crud.model.type'), // Table column heading
        ]);

        $this->crud->addColumn([
            'name'         => 'OrderState', // name of relationship method in the model
            'type'         => 'relationship',
            'label'        => trans('backpack::crud.model.state'), // Table column heading
        ]);

        $this->crud->addColumn([
            'name'         => 'CustomerAddress.Area', // name of relationship method in the model
            'type'         => 'relationship',
            'label'        => trans('backpack::crud.model.area'), // Table column heading
        ]);

        $this->crud->addColumn([
            'name'         => 'User.UserType', // name of relationship method in the model
            'type'         => 'relationship',
            'label'        => trans('backpack::crud.model.user_type'), // Table column heading
        ]);
        CRUD::column('created_at')->type('date')->format('Y-m-d / h A')->label(trans('backpack::crud.model.created_at'));
    }




    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(OrderRequest::class);
        CRUD::field('title');
        CRUD::field('body');
        CRUD::field('user_id')->attribute('name_id')->label(trans('backpack::crud.model.user'));

        $this->crud->addField([
            'name'         => 'SpecialType', // name of relationship method in the model
            'type'         => 'relationship',
            'label'        =>  trans('backpack::crud.model.type'), // Table column heading
        ]);

        $this->crud->addField([
            'name'         => 'OrderState', // name of relationship method in the model
            'type'         => 'relationship',
            'label'        => trans('backpack::crud.model.state'), // Table column heading
        ]);

        $this->crud->addField([
            'name'         => 'CustomerAddress', // name of relationship method in the model
            'type'         => 'relationship',
            'attribute' => 'cust_add',
            'label'        => trans('backpack::crud.model.customer_address'), // Table column heading
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
        // $this->setupCreateOperation();

        CRUD::field('title');
        CRUD::field('body');
        CRUD::field('user_id')->label(trans('backpack::crud.model.user'));

        $this->crud->addField([
            'name'         => 'SpecialType', // name of relationship method in the model
            'type'         => 'relationship',
            'label'        =>  trans('backpack::crud.model.type'), // Table column heading
        ]);

        $this->crud->addField([
            'name'         => 'OrderState', // name of relationship method in the model
            'type'         => 'relationship',
            'label'        => trans('backpack::crud.model.state'), // Table column heading
        ]);

        $this->crud->addField([
            'name'         => 'CustomerAddress', // name of relationship method in the model
            'type'         => 'relationship',
            'label'        => trans('backpack::crud.model.customer_address'), // Table column heading
        ]);
    }


    public function active(Request $request)
    {
        Order::find($request->order_id)->update(['order_state_id' => 2]);
        return \redirect('admin/order');
    }
}
