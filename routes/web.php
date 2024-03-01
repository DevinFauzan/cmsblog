<?php

use App\Http\Controllers\Auth\DashboardController;
use App\Http\Controllers\Auth\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\DashboarTechController;
use App\Http\Controllers\DashboardUserController;
use App\Http\Controllers\TaskController; // Import your TaskController
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ChatController;


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
    auth()->logout();
    return view('auth.login');
});

//Admin Web Miracle
use App\Http\Controllers\AdminController;

// Blog Routes
Route::get('/blog', [AdminController::class, 'showBlog'])->name('blog');
Route::get('/form_blog', [AdminController::class, 'showBlogForm'])->name('form_blog');
Route::post('/blog/submit', [AdminController::class, 'submitNewBlog'])->name('blog.submit');
Route::get('/blog/fetch', [AdminController::class, 'fetchBlogData'])->name('blog.fetch');


// Landing Page Routes
Route::get('/landing_page', [AdminController::class, 'showLandingPage'])->name('landing_page');
Route::get('/form_landing_page', [AdminController::class, 'showLandingPageForm'])->name('form_landing_page');

// Aktivitas Routes
Route::get('/aktivitas', [AdminController::class, 'showAktivitas'])->name('aktivitas');
Route::get('/form_aktivitas', [AdminController::class, 'showAktivitasForm'])->name('form_aktivitas');

// Kelas Routes
Route::get('/kelas', [AdminController::class, 'showKelas'])->name('kelas');
Route::get('/form_kelas', [AdminController::class, 'showKelasForm'])->name('form_kelas');

// Testimoni Routes
Route::get('/testimoni', [AdminController::class, 'showTestimoni'])->name('testimoni');
Route::get('/form_testimoni', [AdminController::class, 'showTestimoniForm'])->name('form_testimoni');

// About Us Routes
Route::get('/about_us', [AdminController::class, 'showAboutUs'])->name('about_us');
Route::get('/form_about_us', [AdminController::class, 'showAboutUsForm'])->name('form_about_us');

// Pendaftaran Route
Route::get('/pendaftaran', [AdminController::class, 'showPendaftaran'])->name('pendaftaran');


Auth::routes();

// Route::get('auth/dashboard', [DashboardController::class, 'dashboard'])->name('auth.dashboard')->middleware('auth');
Route::resource('auth/posts', PostController::class);


// Route::get('/refresh-table', [DashboardController::class, 'refreshTable'])->name('refresh.table');
// Route::get('/refresh-table-progress', [DashboardController::class, 'refreshTableProgress'])->name('refresh.table_progress');
// Route::get('/refresh-table-pending', [DashboardController::class, 'refreshTablePending'])->name('refresh.table_pending');
// Route::get('/refresh-table-solved', [DashboardController::class, 'refreshTableSolved'])->name('refresh.table_solved');
// Route::get('/refresh-table-tech-person', [DashboarTechController::class, 'refreshTableTechPerson'])
//     ->name('refresh.table_tech_person');
// Route::get('/refresh-ticket-counts', [DashboardController::class, 'refreshTicketCounts'])->name('refresh.ticket_counts');
// Route::get('/refresh-table-user-tech', 'DashboardController@refreshTableUserTech')->name('refresh.table_user_tech');
// Route::get('/refresh-table-user', [DashboardUserController::class, 'refreshTableUser'])
//     ->name('refresh.table_user');
// Route::get('/refresh-table-onhold', [DashboardController::class, 'refreshTableonhold'])
//     ->name('refresh.table_onhold');



//Admin
// Route::middleware(['auth', 'admin'])->group(function () {
//     Route::get('auth/dashboard', [DashboardController::class, 'index'])->name('auth.dashboard');
//     Route::resource('detail_ticket-admin', DashboardController::class);
//     Route::get('admin_ticket_detail/{id}/edit', [DashboardController::class, 'edit'])->name('admin_ticket_detail.edit');
//     Route::put('/assign-ticket/{ticket}', [TicketController::class, 'assign'])->name('assign.ticket');
//     Route::get('/refresh-assigned-table/{ticket}', [DashboardController::class, 'refreshAssignedTable'])->name('refresh.assigned.table');
// });

//User
// Route::group(['middleware' => 'user'], function () {
//     // Your custom routes go here
//     Route::get('/my_ticket', [DashboardUserController::class, 'myTickets'])->name('my_ticket');
//     Route::get('/my_ticket/detail_ticket_user/{id}/edit', [DashboardUserController::class, 'edit'])->name('detail_ticket_user.edit');
//     Route::get('/new_ticket/{user}', [DashboardUserController::class, 'showNewTicketForm'])->name('new_ticket');
//     Route::post('/submit_ticket', [DashboardUserController::class, 'submitTicket'])->name('submit_ticket');
//     Route::get('/profile/update', [DashboardUserController::class, 'updateProfile'])->name('user.profile.update');
//     Route::post('/profile/update-password', [DashboardUserController::class, 'updatePassword'])->name('user.update.password');
//     Route::post('/profile/redeem', [DashboardUserController::class, 'redeemCode'])->name('user.redeem_code');
//     // Then add the resourceful route
//     //Route::resource('dashboard-user', DashboardUserController::class);
// });


// Route::resource('dashboard-user', DashboardUserController::class);
//Route::get('/detail_ticket_user', [DashboardUserController::class, 'show'])->name('detail_ticket_user');
//Route::get('/my_ticket', [DashboardUserController::class, 'create'])->name('my_ticket');

//Route::get('/new_ticket', [DashboardUserController::class, 'show'])->name('new_ticket');

//Admin

// Route::get('auth/dashboard', [DashboardController::class, 'index'])->name('auth.dashboard')->middleware('auth');
// Route::resource('detail_ticket-admin', DashboardController::class);
// Route::get('admin_ticket_detail/{id}/edit', [DashboardController::class, 'edit'])->name('admin_ticket_detail.edit');
// Route::put('/assign-ticket/{ticket}', [TicketController::class, 'assign'])->name('assign.ticket');

// // Route to load chat messages
// Route::get('/chat/{ticketId}', [ChatController::class, 'index'])->name('chat.index');

// // Route to send chat messages
// Route::post('/chat/{ticketId}', [ChatController::class, 'store'])->name('chat.store');
