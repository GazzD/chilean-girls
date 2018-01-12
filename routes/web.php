<?php
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactAdminMail;

/*
 * |--------------------------------------------------------------------------
 * | Web Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register web routes for your application. These
 * | routes are loaded by the RouteServiceProvider within a group which
 * | contains the "web" middleware group. Now create something great!
 * |
 */
Route::get('/', 'Frontend\HomeController@index')->name('home');
Route::get('/perfil/{nickname}', 'Frontend\GirlModelsController@index')->name('models');
Route::get('contacto', 'Frontend\ContactController@index')->name('contact');
Route::post('contacto', 'Frontend\ContactController@store')->name('contact');

// Authentication Routes...
$this->get('iniciar-sesion', 'Auth\LoginController@showLoginForm')->name('flogin');
$this->post('iniciar-sesion', 'Auth\LoginController@login')->name('flogin');
$this->get('cerrar-sesion', 'Auth\LoginController@logout')->name('flogout');

// Registration Routes...
$this->get('registrar', 'Auth\RegisterController@showRegistrationForm')->name('register');
$this->post('registrar', 'Auth\RegisterController@register');

// Password Reset Routes...
$this->get('contrasena/resetear', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
$this->post('contrasena/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
$this->get('contrasena/resetear/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('contrasena/resetear', 'Auth\ResetPasswordController@reset');

/*TEST ROUTES*/
Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    // return what you want
});
Route::get('/mail-test', function () {
    $invoice = App\Models\Contact::find(1);
    Mail::to('cardozo.anibal@gmail.com')->send(new ContactAdminMail($invoice));
    return new App\Mail\ContactAdminMail($invoice);
});
Route::group([
    'prefix' => 'admin',
    'middleware' => [
        'web',
        'admin.auth'
    ],
    'namespace' => 'Admin'
], function () {
    
    Route::get('/', function () {
        if (session()->has('admin.auth.admin-user.id')) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('sign-in');
        }
    })->name('admin');
    
    // Account
    Route::get('account', 'Account@index')->name('account');
    Route::post('account', 'Account@update')->name('account');
    Route::get('account/change-password', 'Account@changePassword')->name('account/change-password');
    Route::post('account/change-password', 'Account@updatePassword')->name('account/change-password');
    
    // Admin user
    Route::get('management/admin-users', 'Management\AdminUsers@index')->name('management/admin-users');
    Route::get('management/admin-users/add', 'Management\AdminUsers@add')->name('management/admin-users/add');
    Route::get('management/admin-users/edit/{id}', 'Management\AdminUsers@edit')->name('management/admin-users/edit');
    Route::get('management/admin-users/detail/{id}', 'Management\AdminUsers@detail')->name('management/admin-users/detail');
    Route::get('management/admin-users/delete/{id}', 'Management\AdminUsers@delete')->name('management/admin-users/delete');
    Route::get('management/admin-users/change-password/{id}', 'Management\AdminUsers@changePassword')->name('management/admin-users/change-password');
    Route::post('management/admin-users/add', 'Management\AdminUsers@store')->name('management/admin-users/add');
    Route::post('management/admin-users/edit/{id}', 'Management\AdminUsers@update')->name('management/admin-users/edit');
    Route::post('management/admin-users/change-password/{id}', 'Management\AdminUsers@updatePassword')->name('management/admin-users/change-password');
    
    // Carousel item
    Route::get('management/carousel-items', 'Management\CarouselItems@index')->name('management/carousel-items');
    Route::get('management/carousel-items/add', 'Management\CarouselItems@add')->name('management/carousel-items/add');
    Route::get('management/carousel-items/detail/{id}', 'Management\CarouselItems@detail')->name('management/carousel-items/detail');
    Route::get('management/carousel-items/delete/{id}', 'Management\CarouselItems@delete')->name('management/carousel-items/delete');
    Route::get('management/carousel-items/edit/{id}', 'Management\CarouselItems@edit')->name('management/carousel-items/edit');
    Route::post('management/carousel-items/add', 'Management\CarouselItems@store')->name('management/carousel-items/add');
    Route::post('management/carousel-items/edit/{id}', 'Management\CarouselItems@update')->name('management/carousel-items/edit');
    
    // Gallery
    Route::get('management/galleries', 'Management\Galleries@index')->name('management/galleries');
    Route::get('management/galleries/add', 'Management\Galleries@add')->name('management/galleries/add');
    Route::get('management/galleries/detail/{id}', 'Management\Galleries@detail')->name('management/galleries/detail');
    Route::get('management/galleries/delete/{id}', 'Management\Galleries@delete')->name('management/galleries/delete');
    Route::get('management/galleries/edit/{id}', 'Management\Galleries@edit')->name('management/galleries/edit');
    Route::post('management/galleries/add', 'Management\Galleries@store')->name('management/galleries/add');
    Route::post('management/galleries/edit/{id}', 'Management\Galleries@update')->name('management/galleries/edit');
    
    // Models
    Route::get('management/models', 'Management\GirlModels@index')->name('management/models');
    Route::get('management/models/add', 'Management\GirlModels@add')->name('management/models/add');
    Route::get('management/models/detail/{id}', 'Management\GirlModels@detail')->name('management/models/detail');
    Route::get('management/models/delete/{id}', 'Management\GirlModels@delete')->name('management/models/delete');
    Route::get('management/models/edit/{id}', 'Management\GirlModels@edit')->name('management/models/edit');
    Route::post('management/models/add', 'Management\GirlModels@store')->name('management/models/add');
    Route::post('management/models/edit/{id}', 'Management\GirlModels@update')->name('management/models/edit');
    
    // Videos
    Route::get('management/videos', 'Management\Videos@index')->name('management/videos');
    Route::get('management/videos/add', 'Management\Videos@add')->name('management/videos/add');
    Route::get('management/videos/detail/{id}', 'Management\Videos@detail')->name('management/videos/detail');
    Route::get('management/videos/delete/{id}', 'Management\Videos@delete')->name('management/videos/delete');
    Route::get('management/videos/edit/{id}', 'Management\Videos@edit')->name('management/videos/edit');
    Route::post('management/videos/add', 'Management\Videos@store')->name('management/videos/add');
    Route::post('management/videos/edit/{id}', 'Management\Videos@update')->name('management/videos/edit');
    
    // Dashboard
    Route::get('dashboard', 'Dashboard@index')->name('dashboard');
    
    // Password recovery
    Route::get('password-recovery', 'PasswordRecovery@index')->name('password-recovery');
    Route::post('password-recovery', 'PasswordRecovery@passwordRecovery')->name('password-recovery');
    Route::get('password-recovery/change-password/{code}', 'PasswordRecovery@changePassword')->name('password-recovery/change-password');
    Route::post('password-recovery/change-password/{code}', 'PasswordRecovery@storeChangePassword')->name('password-recovery/change-password');
    Route::get('password-recovery/message-password-changed', 'PasswordRecovery@messagePasswordChanged')->name('password-recovery/message-password-changed');
    
    // Sign In
    Route::get('sign-in', 'SignIn@index')->name('sign-in');
    Route::post('sign-in', 'SignIn@authenticate')->name('sign-in/authenticate');
    
    // Logout
    Route::get('logout', 'Logout@index')->name('logout');
    
    
});