<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use App\Models\Area;
use App\Models\City;
use App\Models\Plan;
use App\Models\UserType;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class UserCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class UserCrudController extends CrudController
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
        CRUD::setModel(\App\Models\User::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/user');
        CRUD::setEntityNameStrings('user', 'users');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('id');
        CRUD::column('name');


        $this->crud->addColumn([
            'name'         => 'UserType', // name of relationship method in the model
            'type'         => 'relationship',
            'label'        => trans('backpack::crud.model.user_type'), // Table column heading
        ]);

        $this->crud->addColumn([
            'name'         => 'gender', // name of relationship method in the model
            'type'         => 'enum',
            'label'        => trans('backpack::crud.model.gender'), // Table column heading
        ]);
        // CRUD::column('sms_notification');
        CRUD::column('is_active');


        // ============================================ FILTERS ============================================

        // dropdown filter
        $this->crud->addFilter([
            'name'  => 'user_type_id',
            'type'  => 'dropdown',
            'label' => trans('backpack::crud.model.user_type')
        ], UserType::pluck('name', 'id')->toArray(), function ($value) { // if the filter is active
            $this->crud->query = $this->crud->query->where('user_type_id', $value);
        });

        // dropdown filter
        $this->crud->addFilter([
            'name'  => 'useri',
            'type'  => 'dropdown',
            'label' => trans('backpack::crud.model.city')
        ], City::pluck('city_name_ar', 'id')->toArray(), function ($value) { // if the filter is active
            $this->crud->query = $this->crud->query->whereHas('CustomerAddresses.City', function ($query) use ($value) {
                $query->where('city_id', $value);
            });
        });

        // dropdown filter
        $this->crud->addFilter([
            'name'  => 'userid',
            'type'  => 'dropdown',
            'label' => trans('backpack::crud.model.area')
        ], Area::pluck('area_name_ar', 'id')->toArray(), function ($value) { // if the filter is active
            $this->crud->query = $this->crud->query->whereHas('CustomerAddresses.Area', function ($query) use ($value) {
                $query->where('id', $value);
            });
        });

        // dropdown filter
        $this->crud->addFilter([
            'name'  => 'userplan',
            'type'  => 'dropdown',
            'label' => trans('backpack::crud.model.plan')
        ], Plan::pluck('name', 'id')->toArray(), function ($value) { // if the filter is active
            $this->crud->query = $this->crud->query->whereHas('Subscriptions', function ($query) use ($value) {
                $query->where('plan_id', $value)->active();
            });
        });




        // ========================================= BUTTONS ==================================================

        CRUD::button('work_area')->stack('line')->modelFunction('workArea')->makeFirst();

        // user address

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    protected function setupShowOperation()
    {
        $this->crud->set('show.setFromDb', false);

        CRUD::column('id');
          // image
          $this->crud->addColumn([
            'label' => trans('backpack::crud.model.photo'),
            'name' => "avatar",
            'type' => 'image',
            'crop' => false, // set to true to allow cropping, false to disable
            'aspect_ratio' => 1, // omit or set to 0 to allow any aspect ratio
            // 'disk'      => 's3_bucket', // in case you need to show images from a different disk
            // 'prefix'    => 'uploads/images/profile_pictures/' // in case your db value is only the file name (no path), you can use this to prepend your path to the image src (in HTML), before it's shown to the user;
        ]);

        CRUD::column('name');
        $this->crud->addColumn([
            'name'         => 'UserType', // name of relationship method in the model
            'type'         => 'relationship',
            'label'        => trans('backpack::crud.model.user_type'), // Table column heading
        ]);

        CRUD::column('email');
        CRUD::column('phone');
        CRUD::column('email_verified_at')->type('text')->attributes(['readonly'  => 'readonly']);
        CRUD::column('phone_verified_at')->type('text')->attributes(['readonly'  => 'readonly']);
        CRUD::column('phone');
        CRUD::column('gender');
        CRUD::column('is_active');
        // CRUD::column('user_type_id');
        CRUD::column('dob')->type('date')->label('Date of bairth');

        CRUD::column('created_at')->label(trans('backpack::crud.model.created_at'));
    }


    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(UserRequest::class);

        // image
        $this->crud->addField([
            'label' => trans('backpack::crud.model.photo'),
            'name' => "avatar",
            'type' => 'image',
            'crop' => false, // set to true to allow cropping, false to disable
            'aspect_ratio' => 1, // omit or set to 0 to allow any aspect ratio
            // 'disk'      => 's3_bucket', // in case you need to show images from a different disk
            // 'prefix'    => 'uploads/images/profile_pictures/' // in case your db value is only the file name (no path), you can use this to prepend your path to the image src (in HTML), before it's shown to the user;
        ]);
        CRUD::field('name');
        CRUD::field('email');
        CRUD::field('phone');
        CRUD::field('email_verified_at')->type('text')->attributes(['readonly'  => 'readonly']);
        CRUD::field('phone_verified_at')->type('text')->attributes(['readonly'  => 'readonly']);
        CRUD::field('phone');
        CRUD::field('gender')->type('enum');
        CRUD::field('dob')->type('date')->label('Date of bairth');

        $this->crud->addField([
            'name'         => 'UserType', // name of relationship method in the model
            'type'         => 'select',
            'label'        =>  trans('backpack::crud.model.user_type'), // Table column heading
        ]);


        CRUD::field('sms_notification');
        CRUD::field('is_active');

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
