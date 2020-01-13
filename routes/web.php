<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/', 'LandingController@index')->name('landing');
Route::get('/articles', function () { abort(404); })->name('articles');
Route::get('/articles/{slug}', function () { abort(404); })->name('articles.detail');
Route::get('/contacts', function () { abort(404); })->name('contacts');
Route::get('/faqs', function () { abort(404); })->name('faqs');
Route::get('/docs/{version}', function () { abort(404); })->name('docs');
Route::get('/helps', function () { abort(404); })->name('helps');
Route::get('/helps/{topic}', function () { abort(404); })->name('help.detail');

Auth::routes([
    'register' => (isset(app_settings()['site_auth_registration']->value)) ? app_settings()['site_auth_registration']->value : true,
    'reset' => (isset(app_settings()['site_auth_password_reset']->value)) ? app_settings()['site_auth_password_reset']->value : true,
    'verify' => (isset(app_settings()['site_auth_email_verify']->value)) ? app_settings()['site_auth_email_verify']->value : true,
]);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/route-verify', function () {
        if (Auth::user()->hasRole('admin'))
            return redirect('admin/home');
        if (Auth::user()->hasRole('staff'))
            return redirect('staff/home');
    })->name('route-verify');

    Route::group([
        'prefix'=>'account',
        'as' => 'account.',
        'namespace' => 'Account'
    ], function () {
        Route::get('/', function() { return redirect('account/profile'); });
        Route::group(['prefix' => 'activity'], function () {
            Route::get('/', 'ActivityController@index')->name('activity');
            Route::get('/cleared', ['uses' => 'ActivityController@showClearedActivityLog'])->name('cleared');
            Route::get('/log/{id}', 'ActivityController@show');
            Route::get('/cleared/log/{id}', 'ActivityController@showClearedAccessLogEntry');
            Route::delete('/clear-activity', ['uses' => 'ActivityController@clearActivityLog'])->name('clear-activity');
            Route::delete('/destroy-activity', ['uses' => 'ActivityController@destroyAccessActivityLog'])
                ->name('destroy-activity')
                ->middleware('password.confirm');
            Route::post('/restore-log', ['uses' => 'ActivityController@restoreClearedAccessActivityLog'])->name('restore-activity');
        });
        Route::group([
            'middleware' => ['access.log']
        ], function () {
            Route::get('/profile', 'ProfileController@index')->name('profile');
            Route::put('/profile/password', 'ProfileController@setPassword')->name('password');
            Route::put('/profile/basic', 'ProfileController@setBasicInfo')->name('basic');
        });
    });

    Route::group([
        'prefix'=>'admin',
        'as' => 'admin.',
        'namespace' => 'Admin',
        'middleware' => ['role:admin', 'access.log']
    ], function () {

        Route::get('/', function () { return redirect('admin/home'); });

        Route::get('/home', 'HomeController@index')->name('home');

        Route::group([
            'namespace' => 'Data\User'
        ], function () {
            Route::resource('users', 'UserController')
            ->only(['index', 'create', 'store', 'show', 'edit', 'update']);;
            Route::get('users/{id}/delete', 'UserController@destroy');
            Route::resource('roles', 'RoleController')
            ->only(['index', 'create', 'store', 'show', 'edit', 'update']);
            Route::get('/roles/{id}/delete', 'RoleController@destroy');
            Route::resource('permissions', 'PermissionController')
            ->only(['index', 'store']);
            Route::get('/permissions/{id}/delete', 'PermissionController@destroy');
        });

        Route::group([
            'namespace' => 'Site'
        ], function () {
            Route::get('/settings', 'SettingController@index')->name('app.setting');
            Route::put('/settings/generals', 'SettingController@updateGeneralData')->name('app.setting.generals');
            Route::put('/settings/contacts', 'SettingController@updateContactData')->name('app.setting.contacts');
            Route::put('/settings/auth', 'SettingController@updateAuthData')->name('app.setting.auth');
            Route::get('/settings/databases/backup', 'DatabaseSettingController@create')->name('setting.database.backup');
            Route::get('/settings/databases/download/{file_name}', 'DatabaseSettingController@download')->name('setting.database.download');
            Route::get('/settings/databases/delete/{file_name}', 'DatabaseSettingController@delete')->name('setting.database.delete');
            Route::put('/settings/databases/restore', 'DatabaseSettingController@restore')->name('setting.database.restore');
        });

    });


});