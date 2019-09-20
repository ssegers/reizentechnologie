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



/*
 * -----------------------------------------------------------------------------
 * ---------------------------   Always available   ----------------------------
 * -----------------------------------------------------------------------------
 */
//test page



//home page
Route::get('/', 'GuestAccess\HomeController@home')->name('home');

//information pages
Route::get('/page/{page_name}','GuestAccess\HomeController@showPage');

//contact page
Route::get('contact','GuestAccess\ContactPageController@getInfo')->name('contact');
Route::post('contact', 'GuestAccess\ContactPageController@sendMail');
Route::get('refresh_captcha', 'GuestAccess\ContactPageController@refreshCaptcha')->name('refresh_captcha');

//login
Route::get('/log','Auth\AuthController@showView')->name("log");
Route::post('/auth', 'Auth\AuthController@login');

// Password reset link request routes
Route::get('password/setmail', 'Auth\ForgotPasswordController@ShowEnterEmailForm')->name('showreset');
Route::post('password/setmail', 'Auth\ForgotPasswordController@EnterEmailFormPost');

// Password reset routes
Route::get('password/resetpassword/{token}', 'Auth\ResetPasswordController@ShowResetPasswordForm')->name('resetpass');
Route::post('password/resetpassword', 'Auth\ResetPasswordController@ResetPassword');

/*
 * -----------------------------------------------------------------------------
 * --------------------------- loggedin as  Guest   ----------------------------
 * -----------------------------------------------------------------------------
 */
Route::middleware(['auth','guest'])->group(function () {

    Route::prefix('user')->group(function () {
        Route::prefix('registrationform')->group(function() {
            route::get('step-0', 'Auth\RegisterController@step0')->name('registerTripMessage');
            route::post('step-0', 'Auth\RegisterController@step0Post');
            
            route::get('step-1', 'Auth\RegisterController@step1')->name('registerTrip');
            route::post('step-1', 'Auth\RegisterController@step1Post');
            
            route::get('step-2', 'Auth\RegisterController@step2');
            route::post('step-2', 'Auth\RegisterController@step2Post');
            route::post('step-add-zip', 'Auth\RegisterController@createZip');
            
            route::get('step-3', 'Auth\RegisterController@step3');
            route::post('step-3', 'Auth\RegisterController@step3Post');
            
        });
    });
});
//--------------------------------------END-------------------------------------

/*
 * -----------------------------------------------------------------------------
 * ----------------   authenticated user    ----------------
 * -----------------------------------------------------------------------------
 */
Route::middleware(['auth','checkloggedin'])->group(function () {
    //get data
    Route::get('majors/get/{id}', 'DataController@getMajorsByStudy');
    //export data
    Route::get('/export/payments/{id}', 'ExportController@paymentsExport')->name('exportpayments');
    //User profile
    Route::prefix('/user/profile')->group(function() {
        Route::get('', 'Traveller\ProfileController@showProfile')->name('profile');
        Route::get('/edit', 'Traveller\ProfileController@editProfile');
        Route::post('/update', 'Traveller\ProfileController@updateProfile');
    });
    Route::get('/logout','Auth\AuthController@logout')->name("logout");
});

//--------------------------------------END-------------------------------------

/*
 * -----------------------------------------------------------------------------
 * --------------------------- Specific Organisator   --------------------------
 * -----------------------------------------------------------------------------
 */
Route::middleware(['auth','guide'])->group(function () {
    Route::prefix('organiser')->group(function () {
        Route::get('partisipantslist/{trip?}', 'Organiser\Partisipants@showFilteredList')->name("partisipantslist");
        Route::post('partisipantslist/{trip?}', 'Organiser\Partisipants@showFilteredList');
        Route::get('showpartisipant/{trip?}/{username?}','Organiser\Partisipants@showPartisipantsProfile');
        Route::get('editpartisipant/{trip?}/{username?}','Organiser\Partisipants@editPartisipantsProfile');
        Route::post('updatepartisipant/{trip?}/{username?}', 'Organiser\Partisipants@updatePartisipantsProfile');
        Route::delete('deletepartisipant/{trip?}/{username?}','Organiser\Partisipants@destroyPartisipantsProfile')->name("userdestroy");
    });
    Route::prefix('payments')->group(function () {
        Route::get('overview/{trip?}','Organiser\Payments@showPaymentsTable')->name("paymentslist");
        Route::get('get/{tripId}/{travellerId}','DataController@getPaymentsFromUserByTrip');
        Route::post('delete', 'DataController@deletePayment');
        Route::post('add','DataController@addPayment')->name("addPayment");
    });
});

/*
 * -----------------------------------------------------------------------------
 * -------------------------------   ADMIN rights ------------------------------
 * -----------------------------------------------------------------------------
 */
Route::middleware(['auth','admin'])->group(function () {

    Route::prefix('admin')->group(function() {
        Route::get('/', 'Admin\DashboardController@index');
        Route::get('/dashboard', 'Admin\DashboardController@index')->name('dashboard');
        Route::get('/homepage', 'Admin\HomePageController@getInfo')->name('homePage');
        Route::post('/homepage', 'Admin\HomePageController@updateInfo')->name('updateHomePage');
        
        Route::get('overviewPages', 'Admin\InfoPagesController@index')->name('infoPages');
        Route::post('createPage', 'Admin\InfoPagesController@createPage');
        Route::post('updatePage','Admin\InfoPagesController@updateContent');
        Route::post('editPage','Admin\InfoPagesController@editPage');
        Route::post('deletePage','Admin\InfoPagesController@deletePage');
        
        Route::get('trips','Admin\TripController@showAllTrips')->name('showtrips');
        Route::post('trips', 'Admin\TripController@UpdateOrCreateTrip');
        
        Route::get('organizer/{trip?}', 'Admin\OrganizerController@show')->name('showorganizers');
        Route::get('organizers/get/{tripId}','DataController@getOrganizersByTrip');
        Route::post('organizers/add','DataController@addOrganizersToTrip');
        Route::delete('organizer/delete','DataController@removeOrganizerFromTrip');
    });
});
