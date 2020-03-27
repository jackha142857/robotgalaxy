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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Home Controller *
Route::get('/', 'HomeController@welcome')->name('welcome');
Route::get('/introduction', 'HomeController@introduction')->name('introduction');
Route::get('/features', 'HomeController@features')->name('features');
Route::get('/contact', 'HomeController@contact')->name('contact');
Route::get('/thanks', 'HomeController@thanks')->name('thanks');

// Authentication Controller *
Auth::routes();

// User Controller *
Route::get('/profile/{userId}', 'UsersController@profile')->name('profile');
Route::put('/updateProfile/{userId}', 'UsersController@updateProfile')->name('updateProfile');
Route::get('/changepassword/{userId}', 'UsersController@changepassword')->name('changepassword');
Route::put('/updatePassword/{userId}', 'UsersController@updatePassword')->name('updatePassword');
Route::get('/statistic', 'UsersController@statistic')->name('statistic');
Route::get('/source', 'UsersController@source')->name('source');
Route::get('/saved', 'UsersController@saved')->name('saved');
Route::get('/shared', 'UsersController@shared')->name('shared');
Route::get('/upload', 'UsersController@upload')->name('upload');
Route::get('/robotdetail/{robotId}', 'UsersController@robotDetail')->name('robotDetail');
Route::get('/addSavedList', 'UsersController@addSavedList')->name('addSavedList');
Route::post('/comment', 'UsersController@comment')->name('comment');
Route::get('/getComment/{robotId}', 'UsersController@getComment')->name('getComment');
Route::get('/banned', 'UsersController@banned')->name('banned');


// Admin Controller *
Route::get('/dashboard', 'AdminController@dashboard')->name('dashboard');
Route::get('/contentCustomisation', 'AdminController@contentCustomisation')->name('contentCustomisation');
Route::get('/utilities', 'AdminController@utilities')->name('utilities');
Route::delete('/deleteComment/{commentId}', 'AdminController@deleteComment')->name('deleteComment');

// Robot Controller *
Route::group([
    'prefix' => 'robots',
], function () {
    Route::get('/', 'RobotsController@index')
    ->name('robots.robot.index');
    Route::get('/create','RobotsController@create')
    ->name('robots.robot.create');
    Route::get('/show/{robot}','RobotsController@show')
    ->name('robots.robot.show');
    Route::get('/{robot}/edit','RobotsController@edit')
    ->name('robots.robot.edit');
    Route::post('/store', 'RobotsController@store')
    ->name('robots.robot.store');
    Route::put('robot/{robot}', 'RobotsController@update')
    ->name('robots.robot.update');
    Route::delete('/robot/{robot}','RobotsController@destroy')
    ->name('robots.robot.destroy');    
    Route::post('/', 'RobotsController@upload')
    ->name('robots.robot.upload');
});
Route::get('/filter', 'RobotsController@filter')->name('filter');
Route::get('/filterSavedList', 'RobotsController@filterSavedList')->name('filterSavedList');
Route::get('/filterShared', 'RobotsController@filterShared')->name('filterShared');

// User Account Controller *
Route::group([
    'prefix' => 'users',
], function () {
    Route::get('/', 'UsersController@index')
    ->name('users.user.index');
    Route::get('/create','UsersController@create')
    ->name('users.user.create');
    Route::get('/changepass/{user}','UsersController@changepass')
    ->name('users.user.changepass');
    Route::get('/show/{user}','UsersController@show')
    ->name('users.user.show');
    Route::get('/{user}/edit','UsersController@edit')
    ->name('users.user.edit');
    Route::post('/', 'UsersController@store')
    ->name('users.user.store');
    Route::put('user/{user}', 'UsersController@update')
    ->name('users.user.update');   
    Route::put('user/updatepass/{user}', 'UsersController@updatepass')
    ->name('users.user.updatepass');
    Route::delete('/user/{user}','UsersController@destroy')
    ->name('users.user.destroy');
});

// Property Controller *
Route::post('/addProperty', 'PropertiesController@store')->name('addProperty');
Route::put('/updateProperty/{propertyId}', 'PropertiesController@update')->name('updateProperty');
Route::get('/getProperties', 'PropertiesController@getProperties')->name('getProperties');
Route::get('/getPropertyConfig', 'PropertiesController@getPropertyConfig')->name('getPropertyConfig');
Route::delete('/deleteProperty/{propertyId}', 'PropertiesController@destroy')->name('deleteProperty');

// Option Controller *
Route::post('/addOption', 'OptionsController@store')->name('addOption');
Route::put('/updateOption/{optionId}', 'OptionsController@update')->name('updateOption');
Route::get('/getOptions', 'OptionsController@getOptions')->name('getOptions');
Route::get('/getOptionConfig', 'OptionsController@getOptionConfig')->name('getOptionConfig');
Route::delete('/deleteOption/{optionId}', 'OptionsController@destroy')->name('deleteOption');

// Comment Controller =
// Route::group([
//     'prefix' => 'comments',
// ], function () {
//     Route::get('/', 'CommentsController@index')
//     ->name('comments.comment.index');
//     Route::get('/create','CommentsController@create')
//     ->name('comments.comment.create');
//     Route::get('/show/{comment}','CommentsController@show')
//     ->name('comments.comment.show');
//     Route::get('/{comment}/edit','CommentsController@edit')
//     ->name('comments.comment.edit');
//     Route::post('/', 'CommentsController@store')
//     ->name('comments.comment.store');
//     Route::put('comment/{comment}', 'CommentsController@update')
//     ->name('comments.comment.update');
//     Route::delete('/comment/{comment}','CommentsController@destroy')
//     ->name('comments.comment.destroy');
// });

// Input Type Controller =
// Route::group([
//     'prefix' => 'input_types',
// ], function () {
//     Route::get('/', 'InputTypesController@index')
//     ->name('input_types.input_type.index');
//     Route::get('/create','InputTypesController@create')
//     ->name('input_types.input_type.create');
//     Route::get('/show/{inputType}','InputTypesController@show')
//     ->name('input_types.input_type.show');
//     Route::get('/{inputType}/edit','InputTypesController@edit')
//     ->name('input_types.input_type.edit');
//     Route::post('/', 'InputTypesController@store')
//     ->name('input_types.input_type.store');
//     Route::put('input_type/{inputType}', 'InputTypesController@update')
//     ->name('input_types.input_type.update');
//     Route::delete('/input_type/{inputType}','InputTypesController@destroy')
//     ->name('input_types.input_type.destroy');
// });

// Mail Controller =*
// Route::group([
//     'prefix' => 'mails',
// ], function () {
//     Route::get('/', 'MailsController@index')
//     ->name('mails.mail.index');
//     Route::get('/create','MailsController@create')
//     ->name('mails.mail.create');
//     Route::get('/show/{mail}','MailsController@show')
//     ->name('mails.mail.show');
//     Route::get('/{mail}/edit','MailsController@edit')
//     ->name('mails.mail.edit');
//     Route::post('/', 'MailsController@store')
//     ->name('mails.mail.store');
//     Route::put('mail/{mail}', 'MailsController@update')
//     ->name('mails.mail.update');
//     Route::delete('/mail/{mail}','MailsController@destroy')
//     ->name('mails.mail.destroy');
// });
Route::get('/feedback', 'MailsController@sendMail')->name('sendmail');

// Report Controller =
// Route::group([
//     'prefix' => 'reports',
// ], function () {
//     Route::get('/', 'ReportsController@index')
//     ->name('reports.report.index');
//     Route::get('/create','ReportsController@create')
//     ->name('reports.report.create');
//     Route::get('/show/{report}','ReportsController@show')
//     ->name('reports.report.show');
//     Route::get('/{report}/edit','ReportsController@edit')
//     ->name('reports.report.edit');
//     Route::post('/', 'ReportsController@store')
//     ->name('reports.report.store');
//     Route::put('report/{report}', 'ReportsController@update')
//     ->name('reports.report.update');
//     Route::delete('/report/{report}','ReportsController@destroy')
//     ->name('reports.report.destroy');
// });

// Robot Info Controller =
// Route::group([
//     'prefix' => 'robot_infos',
// ], function () {
//     Route::get('/', 'RobotInfosController@index')
//     ->name('robot_infos.robot_info.index');
//     Route::get('/create','RobotInfosController@create')
//     ->name('robot_infos.robot_info.create');
//     Route::get('/show/{robotInfo}','RobotInfosController@show')
//     ->name('robot_infos.robot_info.show');
//     Route::get('/{robotInfo}/edit','RobotInfosController@edit')
//     ->name('robot_infos.robot_info.edit');
//     Route::post('/', 'RobotInfosController@store')
//     ->name('robot_infos.robot_info.store');
//     Route::put('robot_info/{robotInfo}', 'RobotInfosController@update')
//     ->name('robot_infos.robot_info.update');
//     Route::delete('/robot_info/{robotInfo}','RobotInfosController@destroy')
//     ->name('robot_infos.robot_info.destroy');
// });

// Save List Controller = 
// Route::group([
//     'prefix' => 'saved_lists',
// ], function () {
//     Route::get('/', 'SavedListsController@index')
//     ->name('saved_lists.saved_list.index');
//     Route::get('/create','SavedListsController@create')
//     ->name('saved_lists.saved_list.create');
//     Route::get('/show/{savedList}','SavedListsController@show')
//     ->name('saved_lists.saved_list.show');
//     Route::get('/{savedList}/edit','SavedListsController@edit')
//     ->name('saved_lists.saved_list.edit');
//     Route::post('/', 'SavedListsController@store')
//     ->name('saved_lists.saved_list.store');
//     Route::put('saved_list/{savedList}', 'SavedListsController@update')
//     ->name('saved_lists.saved_list.update');
//     Route::delete('/saved_list/{savedList}','SavedListsController@destroy')
//     ->name('saved_lists.saved_list.destroy');
// });

// Subscribe Controller = 
// Route::group([
//     'prefix' => 'subscribes',
// ], function () {
//     Route::get('/', 'SubscribesController@index')
//     ->name('subscribes.subscribe.index');
//     Route::get('/create','SubscribesController@create')
//     ->name('subscribes.subscribe.create');
//     Route::get('/show/{subscribe}','SubscribesController@show')
//     ->name('subscribes.subscribe.show');
//     Route::get('/{subscribe}/edit','SubscribesController@edit')
//     ->name('subscribes.subscribe.edit');
//     Route::post('/', 'SubscribesController@store')
//     ->name('subscribes.subscribe.store');
//     Route::put('subscribe/{subscribe}', 'SubscribesController@update')
//     ->name('subscribes.subscribe.update');
//     Route::delete('/subscribe/{subscribe}','SubscribesController@destroy')
//     ->name('subscribes.subscribe.destroy');
// });

