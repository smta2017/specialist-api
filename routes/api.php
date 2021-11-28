<?php

use App\Http\Controllers\API\AreaAPIController;
use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\Auth\ForgotPasswordController;
use App\Http\Controllers\API\Auth\SocialAuthController;
use App\Http\Controllers\API\Auth\VerificationController;
use App\Http\Controllers\API\Authorize\AuthorizeController;
use App\Http\Controllers\API\CityAPIController;
use App\Http\Controllers\API\CountryAPIController;
use App\Http\Controllers\API\CustomerAddressAPIController;
use App\Http\Controllers\API\OrderAPIController;
use App\Http\Controllers\API\OrderCommentAPIController;
use App\Http\Controllers\API\PlanAPIController;
use App\Http\Controllers\API\RatingAPIController;
use App\Http\Controllers\API\SliderAPIController;
use App\Http\Controllers\API\SliderImageAPIController;
use App\Http\Controllers\API\SpecialistAreaAPIController;
use App\Http\Controllers\API\SpecialistTypeAPIController;
use App\Http\Controllers\API\SpecialTypeAPIController;
use App\Http\Controllers\API\SubscriptionAPIController;
use App\Http\Controllers\API\User\UserController;
use App\Http\Controllers\API\UserTypeAPIController;
use App\Http\Controllers\NotificationController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'en'], function () {
    Route::group(['prefix' => 'v1'], function () {
        Route::group(['prefix' => 'auth'], function () {
            Route::post('login', [AuthController::class, 'login']);
            Route::post('register', [AuthController::class, 'register']);
            Route::post('logout', [AuthController::class, 'logout']);
            Route::post('refresh', [AuthController::class, 'refresh']);
            Route::post('me', [AuthController::class, 'me']);

            Route::post('forgot-password', [ForgotPasswordController::class, 'forgotPassword']);
            Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'resetView'])->middleware('guest')->name('password.reset');
            Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword']);

            // facebook
            Route::get('/facebook/login', [SocialAuthController::class, 'facebookLogin']);
            Route::get('/facebook/callback', [SocialAuthController::class, 'facebookCallback']);
            // google
            Route::get('/google/login', [SocialAuthController::class, 'googleLogin']);
            Route::get('/google/callback', [SocialAuthController::class, 'googleCallback']);
        });

        Route::group(['prefix' => 'verify'], function () {
            Route::get('/email/{id}', [VerificationController::class, 'verifyEmail'])->name('verification.verify');
            Route::get('/send-otp/{phone_number}', [VerificationController::class, 'sendMobileOTP']);
            Route::get('/confirm-otp/{phone_number}/{otp}', [VerificationController::class, 'confirmOTP']);
        });

        Route::group(['prefix' => 'authorize'], function () {
            Route::get('/roles', [AuthorizeController::class, 'roles']);
            Route::post('/roles', [AuthorizeController::class, 'createRole']);
            Route::get('/permissions', [AuthorizeController::class, 'permissions']);
            Route::post('/permissions', [AuthorizeController::class, 'createPermission']);
            Route::post('/permission-to-role', [AuthorizeController::class, 'assignRoleToPermission']);
            Route::get('/role-permissions/{id}', [AuthorizeController::class, 'rolePermissions']);
            Route::post('/role-to-user', [AuthorizeController::class, 'assignRoleToUser']);
            Route::get('/user-permissions/{id}', [AuthorizeController::class, 'userPermissions']);
            Route::post('/revoke', [AuthorizeController::class, 'revoke']);
        });


        Route::group(['middleware' => 'auth:sanctum'], function () {
            Route::group(['prefix' => '/users'], function () {

                Route::get('/notifications', [NotificationController::class, 'notifications']);
                Route::get('/unread-notifications', [NotificationController::class, 'unReadNotifications']);
                Route::get('/notifications/{id}/mark-read', [NotificationController::class, 'markAsRead']);
            });
            Route::post('/users/{id}/avatar', [UserController::class, 'updateAvatar']);
            Route::post('/users/{id}/edu', [UserController::class, 'updateEdu']);
            Route::apiResource('/users', UserController::class);

            Route::group(['prefix' => 'plans'], function () {
                Route::get('/user', [PlanAPIController::class, 'userPlans']);
            });


            Route::get('/plan/specialist', [PlanApiController::class, 'subscripe'])->name('testing');



            Route::resource('specialist_areas', SpecialistAreaAPIController::class);

            Route::resource('orderStates', App\Http\Controllers\API\OrderStateAPIController::class);


            Route::put('/customerAddresses/default/{id}', [CustomerAddressAPIController::class, 'setDefault']);
            Route::resource('/customerAddresses', CustomerAddressAPIController::class);

            Route::put('/orders/complete/{id}', [OrderAPIController::class, 'complete']);
            Route::get('/orders/detail/{id}', [OrderAPIController::class, 'detail']);
            Route::post('/orders/sp', [OrderAPIController::class, 'spIndex']);
            Route::get('/orders/sp-detail/{id}', [OrderAPIController::class, 'spDetail']);
            Route::resource('orders', OrderAPIController::class);


            Route::resource('orderComments', OrderCommentAPIController::class);
            Route::resource('subscriptions', SubscriptionAPIController::class);
            Route::post('user-subscribe/{id}', [SubscriptionAPIController::class, 'UserSubscribe']);

            Route::get('/user/rate/{id}', [RatingAPIController::class, 'getRate']);
            Route::post('/user/rate/{id}', [RatingAPIController::class, 'store']);
            Route::put('/user/rate/{user_id}/{rate_id}', [RatingAPIController::class, 'update']);

            // Route::resource('chats', App\Http\Controllers\API\ChatAPIController::class);
            Route::get('chats', [App\Http\Controllers\API\ChatAPIController::class, 'conversations']);
            Route::post('chats/send', [App\Http\Controllers\API\ChatAPIController::class, 'send']);
            Route::get('chats/{user_id}', [App\Http\Controllers\API\ChatAPIController::class, 'conversation']);
        });
        Route::get('/contactus', [UserController::class, 'contactus']);
        Route::get('/links', [UserController::class, 'links']);

        Route::resource('specialistTypes', SpecialistTypeAPIController::class);

        Route::resource('SpecialType', SpecialTypeAPIController::class);


        Route::resource('countries', CountryAPIController::class);

        Route::resource('sliders', SliderAPIController::class);

        Route::get('/sliderDetails/{slider_id}', [SliderAPIController::class, 'sliderDetails']);
        Route::resource('sliderImages', SliderImageAPIController::class);


        Route::apiResource('/cities', CityAPIController::class);
        Route::resource('areas', AreaAPIController::class);
        Route::get('/specialist/{area_id}', [UserController::class, 'getSpcByArea']);


        Route::resource('userTypes', UserTypeAPIController::class);

        Route::resource('plans', PlanAPIController::class);

        Route::post('/test2', [PlanApiController::class, 'test']);
    });
});


Route::get('/allusers', function () {


    foreach (User::whereNotNull('user_type_id')->get() as $value) {
        echo $value->id . '-' . $value->email . ' -> ' . $value->UserType->name . '<br/>';
    }
});
