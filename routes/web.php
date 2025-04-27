<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\CheckDetailsComplete;

Route::get('/download-receipt/{filename}', [UserController::class, 'downloadReceipt'])->middleware('auth');

Route::post('/store-donation-pdf', [UserController::class, 'storeDonationPdf'])->name('user.donationpdf');
Route::post('/store-booking-pdf', [UserController::class, 'storebookingPdf'])->name('user.bookingpdf');
// --------------------------***** Routes for Authantication *****--------------------------
Route::view('/login-form', 'auth.login')->name('login');
Route::post('/login-action', [AuthController::class, 'loginAction'])->name('login.action');
Route::view('/registration-form','auth.register')->name('register');
Route::post('/registration-action' ,[AuthController::class,'registrationAction'])->name('register.action');
Route::get('/check-email', [AuthController::class, 'checkEmail'])->name('check.email');
Route::get('/verify-email/{code}', [AuthController::class, 'verifyEmail'])->name('verify.email');
Route::get('logout', [AuthController::class,'logout'])->name('logout');
Route::post('/send-passwordmail', [AuthController::class, 'sendPasswordmail'])->name('send.passwordmail');
Route::get('/check-password-email', [AuthController::class, 'checkemailforpassword'])->name('check.emailforpassword');
Route::get('/reset-password/{code}', [AuthController::class, 'resetPassword'])->name('rest.password');
Route::get('forgot-password', [AuthController::class,'forgotPasswordForm'])->name('password.form');
Route::post('/reset-password/action', [AuthController::class, 'resetPasswordAction'])->name('reset.password.action');




// --------------------------***** Routes for Admin *****--------------------------


// Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin-dashboard', [AdminController::class,'adminDashboard'])->name('admin.dashboard');
    Route::get('/userdetails/{id}/', [AdminController::class,'userdetails'])->name('admin.viewUserDetails');
    Route::get('temples', [AdminController::class, 'indexTemples'])->name('admin.temples');
    Route::get('addtemple', [AdminController::class, 'addTemple'])->name('admin.addtemple');
    Route::post('temples', [AdminController::class, 'storeTemple'])->name('admin.storeTemple');
    Route::get('temples/{id}/edit', [AdminController::class, 'editTemple'])->name('admin.editTemple');
    Route::get('temples/{id}/view', [AdminController::class, 'viewTemple'])->name('admin.viewTemple');
    Route::post('temples/{id}', [AdminController::class, 'updateTemple'])->name('admin.updateTemple');
    Route::delete('temple-images/{id}', [AdminController::class, 'deleteTempleImage'])->name('admin.deleteTempleImage');
    Route::post('update-basicdetails/{id}/', [AuthController::class, 'updatebasicdetails'])->name('user.updatebasic');
    Route::get('/admin-dashboard', [AdminController::class,'adminDashboard'])->name('admin.dashboard');
    Route::get('/bookings', [AdminController::class, 'indexBookings'])->name('admin.bookings.index');
    Route::get('/view-booking/{id}', [AdminController::class, 'viewBooking'])->name('admin.viewbooking');
    Route::post('/bookings', [AdminController::class, 'storeBooking'])->name('admin.bookings.store');
    Route::get('/bookings/{id}/edit', [AdminController::class, 'editBooking'])->name('admin.bookings.edit');
    Route::put('/bookings/{id}', [AdminController::class, 'updateBooking'])->name('admin.bookings.update');
    Route::get('/bookings/create', [AdminController::class, 'createBooking'])->name('admin.bookings.create');
    Route::get('/donations', [AdminController::class, 'indexDonations'])->name('admin.donations.index');
    Route::get('/view-donation/{id}', [AdminController::class, 'viewDonation'])->name('admin.viewDonation');
    Route::get('/festivals', [AdminController::class, 'indexFestivals'])->name('admin.festivals.index');
    Route::get('/view-festival/{id}', [AdminController::class, 'viewfestival'])->name('admin.viewfestival');
    Route::post('/festivals/store', [AdminController::class, 'storeFestival'])->name('admin.festivals.store');
    Route::get('/festivals/{id}/edit', [AdminController::class, 'editFestival'])->name('admin.festivals.edit');
    Route::get('/users', [AdminController::class, 'indexUsers'])->name('admin.users.index');
    Route::get('/inquiries', [AdminController::class, 'inquiries'])->name('admin.inquiries');
    Route::get('/view-inquiries/{id}', [AdminController::class, 'viewInquiries'])->name('admin.view.inquiries');
    // Route::get('/adminprofile', [UserController::class,'userProfile'])->name('admin.profile');
    // Route::get('/reports/donations', [AdminController::class, 'donationReports']);
    // Route::post('/reports/donations', [AdminController::class, 'generateDonationReport']);
    // Route::get('/reports/bookings', [AdminController::class, 'bookingReports']);
    // Route::post('/reports/bookings', [AdminController::class, 'generateBookingReport']);
    // Route::get('/profile', [AdminController::class, 'editProfile'])->name('admin.profile.edit');
    // Route::post('/profile', [AdminController::class, 'updateProfile']);
    // Route::get('/change-password', [AdminController::class, 'changePassword'])->name('admin.profile.change_password');
    // Route::post('/change-password', [AdminController::class, 'updatePassword']);
// });

Route::post('/user/donations', [UserController::class, 'donate'])->name('user.donations.store');
Route::post('/user/bookings', [UserController::class, 'bookTemple'])->name('user.bookings.store');
// --------------------------***** Routes for User *****--------------------------
Route::middleware(['auth'])->group(function () {

    Route::post('/user-details', [UserController::class,'userDetails'])->name('user.details');
    Route::get('/userprofile', [UserController::class,'userProfile'])->name('user.profile');
    Route::get('/get-location-data/{type}/{parentId?}', [UserController::class,'getLocationData'])->name('get.location.data');
    Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile.show');
    Route::put('/user/profile', [UserController::class, 'updateProfile'])->name('user.profile.update');
    Route::middleware([CheckDetailsComplete::class])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    // Temples
    Route::get('/user/temples', [UserController::class, 'temples'])->name('user.temples');
    Route::get('/user/temples/{id}', [UserController::class, 'showTemple'])->name('user.temples.show');

    // Bookings
    Route::get('/user/bookings', [UserController::class, 'bookings'])->name('user.bookings');
    // Route::post('/user/bookings', [UserController::class, 'bookTemple'])->name('user.bookings.store');
    Route::get('/user/bookings/{id}', [UserController::class, 'showBooking'])->name('user.bookings.show');

    // Donations
    Route::get('/user/donations', [UserController::class, 'donations'])->name('user.donations');
    // Route::post('/user/donations', [UserController::class, 'donate'])->name('user.donations.store');
    Route::get('/user/donations/{id}', [UserController::class, 'showDonation'])->name('user.donations.show');

    // Profile

    // Route::group(['middleware' => CheckDetailsComplete::class], function () {
    // });
});
});

// --------------------------***** Routes for Common use *****--------------------------


Route::post('/update-profile-picture', [UserController::class, 'updateProfilePicture'])->name('user.updateProfilePicture');




Route::get('/', [HomeController::class, 'indexHome'])->name('home');
Route::get('/view-temple/{id}', [HomeController::class, 'viewtemple'])->name('home.viewtemple');
Route::get('/allFestivals', [HomeController::class, 'festivals'])->name('home.festivals');
Route::get('/allTemples', [HomeController::class, 'temples'])->name('home.temples');
Route::get('/singlefestival/{id}', [HomeController::class, 'singlefestival'])->name('home.singlefestival');
Route::post('/contact', [HomeController::class, 'contactstore'])->name('contact.store');
Route::get('/mahakhumb', [HomeController::class, 'mahakhumb'])->name('home.mahakhumb');



