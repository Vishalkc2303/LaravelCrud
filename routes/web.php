<?php

use App\Http\Controllers\AdPositionController;
use App\Http\Controllers\AdvertisementController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserdetailsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SocailmediaController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserqueryController;
use App\Http\Controllers\WebsitedetailController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\NewsbookmarkController;
use App\Http\Controllers\NewslikedislikeController;
use App\Http\Controllers\UserHistoryController;
use App\Models\News;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $newsItems = News::where('status', 1)->inRandomOrder()->take(4)->get();

    return view('home', compact('newsItems'));
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/term', [HomeController::class, 'term'])->name('term');
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::post('/contact', [UserqueryController::class, 'store'])->name('contact.store');
Route::get('news/{slug}', [NewsController::class, 'showNews'])->name('news.show');
Route::get('category/{id}/{name}', [CategoryController::class, 'categoryNews'])->name('news.category');
Route::get('subcategory/{id}/{name}', [CategoryController::class, 'subcategoryNews'])->name('news.subcategory');


Route::middleware(['auth'])->group(function () {
    Route::get('user/index', [HomeController::class, 'profilepage'])->name('profile');
    Route::get('user/updatePassword', [HomeController::class, 'updatePasswordpage'])->name('updatePassword');
    Route::post('user/updatePassword', [HomeController::class, 'updatePassword'])->name('updatePassword');
    Route::get('user/commentPost', [HomeController::class, 'commentPost'])->name('commentPost');
    Route::get('user/historyPost', [HomeController::class, 'historyPost'])->name('historyPost');
    Route::delete('/history/{id}/remove', [UserHistoryController::class, 'remove'])->name('history.remove');
    Route::delete('/history/delete-all', [UserHistoryController::class, 'removeAllHistory'])->name('history.deleteAll');


    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
    // Route::get('/comment/{id}/edit', [CommentController::class, 'edit'])->name('comment.edit');
    Route::delete('/comment/{id}/delete', [CommentController::class, 'delete'])->name('comment.delete');
    Route::get('user/bookmarkPost', [HomeController::class, 'bookmarkPost'])->name('bookmarkPost');
    Route::post('/bookmark/{id}', [NewsbookmarkController::class, 'add'])->name('bookmark.add');
    Route::delete('/bookmark/{id}', [NewsbookmarkController::class, 'remove'])->name('bookmark.remove');
    Route::post('/like/add/{id}', [NewslikedislikeController::class, 'add'])->name('like.add');
    Route::delete('/like/remove/{id}', [NewslikedislikeController::class, 'remove'])->name('like.remove');
    Route::post('/news/{id}', [UserHistoryController::class, 'viewNews'])->name('news.view');


    Route::post('/userdetail-update', [UserdetailsController::class, 'updateUserDetails'])->name('userdetailUpdate');

    Route::post('/user-update', [HomeController::class, 'updateUserProfile'])->name('userUpdate');

    Route::middleware(['role:editor,admin'])->group(function () {

        Route::patch('/users/{id}/update-status', [Controller::class, 'updateUserStatus'])->name('User.updateRoleStatus');

        Route::get('/admin/clear-cache', [Controller::class, 'clearCache'])->name('admin.clearCache');
        Route::get('/admin/storage-link', [Controller::class, 'createStorageLink'])->name('admin.createStorageLink');
        Route::get('/admin/npm-run-dev', [Controller::class, 'npmRunDev'])->name('admin.npmRunDev');
        Route::get('/admin/npm-run-build', [Controller::class, 'npmRunBuild'])->name('admin.npmRunBuild');
        // Route::resource('news', NewsController::class)->except(['destroy', 'approve']);
        Route::get('admin/index', [HomeController::class, 'admin'])->name('admin.panel');
        Route::get('admin/all-news', [NewsController::class, 'AllNews'])->name('AllNews');
        Route::get('admin/add-news', [NewsController::class, 'AddNews'])->name('AddNews');
        Route::get('admin/edit-news', [NewsController::class, 'EditNews'])->name('EditNews');
        Route::get('admin/draft-news', [NewsController::class, 'DraftNews'])->name('DraftNews');
        Route::get('admin/addcategory', [CategoryController::class, 'addcategory'])->name('addcategory');
        Route::get('admin/websitedetail', [WebsitedetailController::class, 'websitedetail'])->name('websiteDetail');
        Route::get('admin/socailmedia', [SocailmediaController::class, 'socialmedia'])->name('socailmedialinks');
        Route::get('admin/advertisement', [AdvertisementController::class, 'advertisement'])->name('advertisement');
        Route::get('admin/allPosition', [AdPositionController::class, 'allPosition'])->name('allPosition');

        Route::get('admin/alluser', [HomeController::class, 'alluser'])->name('alluser');
        Route::patch('/user/update-status/{id}', [HomeController::class, 'updateUserStatus'])->name('User.updateUserStatus');
        Route::get('admin/userquery', [UserQueryController::class, 'userquery'])->name('userquery');
        Route::patch('/userquery/update-status/{id}', [UserQueryController::class, 'updateUserQueryStatus'])->name('User.updateUserqueryStatus');

        Route::post('/admin/news', [NewsController::class, 'store'])->name('news.store');
        Route::patch('/news/update-status/{id}', [NewsController::class, 'updateStatus'])->name('news.updateStatus');
        Route::get('/news/{id}/edit', [NewsController::class, 'EditNews'])->name('news.edit');
        Route::put('/news/{id}/draft', [NewsController::class, 'deleteNews'])->name('news.destroy');
        Route::delete('/admin/news/{news}', [NewsController::class, 'permanentlydestroy'])->name('news.destroy.permanently');
        Route::patch('/admin/news/{news}', [NewsController::class, 'updatenews'])->name('admin.news.update');

        // Route for storing a new category
        Route::post('/admin/categories', [CategoryController::class, 'store'])->name('category.store');
        Route::put('/categories/{id}', [CategoryController::class, 'updatecategory'])->name('categories.update');

        Route::post('/admin/subcategories', [CategoryController::class, 'storesubcategory'])->name('subcategory.store');
        Route::put('/subcategories/{id}', [CategoryController::class, 'subcategoryupdate'])->name('subcategories.update');

        Route::post('/admin/settings/update', [WebsitedetailController::class, 'update'])->name('admin.settings.update');

        // Route::get('/social-media', [SocialMediaController::class, 'edit'])->name('admin.social-media.edit');
        Route::post('/social-media', [SocailmediaController::class, 'update'])->name('admin.social-media.update');

        Route::post('admin/add-ad-space', [AdvertisementController::class, 'adadvertisement'])->name('admin.add-ad-space');
        Route::patch('/admin/update-ad-status/{id}', [AdvertisementController::class, 'updateStatus'])->name('updateAdStatus');


        Route::get('/admin/edit-ad/{id}', [AdvertisementController::class, 'edit'])->name('admin.editAd');
        Route::patch('/admin/update-ad/{id}', [AdvertisementController::class, 'update'])->name('updateAd');
    });

    Route::middleware(['role:admin'])->group(function () {
        // Route::delete('news/{news}', [NewsController::class, 'destroy'])->name('news.destroy');
        // Route::post('news/{news}/approve', [NewsController::class, 'approve'])->name('news.approve');
    });
});
