<?php

use App\Http\Controllers\API\AreaAPIController;
use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\Auth\ForgotPasswordController;
use App\Http\Controllers\API\Auth\SocialAuthController;
use App\Http\Controllers\API\Auth\VerificationController;
use App\Http\Controllers\API\Authorize\AuthorizeController;
use App\Http\Controllers\API\CityAPIController;
use App\Http\Controllers\API\CustomerAddressAPIController;
use App\Http\Controllers\API\OrderAPIController;
use App\Http\Controllers\API\UserTypesAPIController;
use App\Http\Controllers\API\OrderCommentAPIController;
use App\Http\Controllers\API\PlanAPIController;
use App\Http\Controllers\API\SpecialistAreaAPIController;
use App\Http\Controllers\API\SpecialistTypeAPIController;
use App\Http\Controllers\API\SpecialTypesAPIController;
use App\Http\Controllers\API\SubscriptionAPIController;
use App\Http\Controllers\API\User\UserController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\AreaController;
use Illuminate\Http\Request;
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
            Route::group(['prefix' => 'users'], function () {

                Route::get('/profile/{id}', [UserController::class, 'tuserProfile']);
                Route::get('/', [UserController::class, 'tuserProfile']);
                Route::get('/notifications', [CustomerController::class, 'notifications']);
                Route::get('/unread-notifications', [CustomerController::class, 'unReadNotifications']);
                Route::get('/notifications/{id}/mark-read', [CustomerController::class, 'markAsRead']);
            });
            Route::apiResource('/users', UserController::class);

            Route::group(['prefix' => 'plans'], function () {
                Route::get('/all', [PlanAPIController::class, 'getAllPlans']);
            });
        });



        Route::apiResource('/cities', CityAPIController::class);
        Route::resource('areas', AreaAPIController::class);
        Route::get('/specialist/{area_id}', [UserController::class, 'getSpcByArea']);
    });
});







Route::group(['prefix' => 'en/v1'], function () {
    Route::resource('userTypes', UserTypesAPIController::class);
    Route::get('/orders/status', [OrderAPIController::class, 'orderStatus']);
    Route::resource('plans', PlanAPIController::class);

    Route::post('/test2', [PlanApiController::class, 'test']);
    Route::group(['middleware' => 'auth:sanctum'], function () {



        Route::resource('specialTypes', SpecialTypesAPIController::class);
        Route::get('/plan/specialist', [PlanApiController::class, 'subscripe']);




        Route::resource('specialist_areas', SpecialistAreaAPIController::class);


        Route::resource('specialistTypes', SpecialistTypeAPIController::class);


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
    });
});
