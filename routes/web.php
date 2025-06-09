<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\Usercontroller;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\ExcursionController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\LocalController;
use App\Models\Destination;
use App\Http\Controllers\OptimizationController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\VoyageController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [UserController::class, 'Index']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Group Middleware
Route::middleware(['auth','roles:admin'])->group(function(){
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/password/update', [AdminController::class, 'AdminPasswordUpdate'])->name('admin.password.update');


   
   
    //Blog Category All Route
    Route::controller(BlogController::class)->group(function(){
        Route::get('/blog/category','BlogCategory')->name('blog.category');
        Route::post('/store/blog/category','StoreBlogCategory')->name('store.blog.category');
        Route::get('/edit/blog/category/{id}','EditBlogCategory');
        Route::post('/update/blog/category','UpdateBlogCategory')->name('update.blog.category');
        Route::get('/delete/blog/category/{id}','DeteleBlogCategory')->name('delete.blog.category');
    });
     //Blog Post  All Route
     Route::controller(BlogController::class)->group(function(){
        Route::get('/all/blog/post','AllBlogPost')->name('all.blog.post');
        Route::get('/add/blog/post','AddBlogPost')->name('add.blog.post');
        Route::post('/store/blog/post','StoreBlogPost')->name('store.blog.post');
        Route::get('/edit/blog/post/{id}','EditBlogPost')->name('edit.blog.post');
        Route::post('/update/blog/post','UpdateBlogPost')->name('update.blog.post');
        Route::get('/delete/blog/post/{id}','DeleteBlogPost')->name('delete.blog.post');



        //programme
        Route::controller(DestinationController::class)->group(function(){
            Route::get('/all/destination/','AllDestination')->name('all.destinations');
            Route::get('/add/destination/','AddDestination')->name('add.destination');
            Route::post('/store/destination/','StoreDestination')->name('store.destination');
            Route::get('/edit/destination/{id}','EditDestination')->name('edit.destination');
            Route::post('/update/destination','UpdateDestination')->name('update.destination');
            Route::get('/delete/destination/{id}','DeleteDestination')->name('delete.destination');
             Route::get('/delete/multiimage/{id}','DeleteMultiImage')->name('multi.image.delete');

        });

          //programme
          Route::controller(ExcursionController::class)->group(function(){
            Route::get('/all/excursion/','AllExcursion')->name('all.excursion');
            Route::get('/add/excursion/','AddExcursion')->name('add.excursion');
            Route::post('/store/excursion/','StoreExcursion')->name('store.excursion');
            Route::get('/edit/excursion/{id}','EditExcursion')->name('edit.excursion');
            Route::post('/update/excursion','UpdateExcursion')->name('update.excursion');
            Route::get('/delete/excursion/{id}','DeleteExcursion')->name('delete.excursion');
            Route::get('/delete/multiimage/{id}','DeleteMultiImage')->name('multi.image.delete');

        });

           //voyage
          Route::controller(VoyageController::class)->group(function(){
            Route::get('/all/voyagegroupe/','AllVoyages')->name('all.voyage');
            Route::get('/add/voyagegroupe/','AddVoyage')->name('add.voyage');
            Route::post('/store/voyage/','StoreVoyage')->name('store.voyage');
            Route::get('/edit/voyage/{id}','EditVoyage')->name('edit.voyage');
            Route::post('/update/voyage','UpdateVoyage')->name('update.voyage');
            Route::get('/delete/voyage/{id}','DeleteVoyage')->name('delete.voyage');
            // Route::get('/delete/multiimage/{id}','DeleteMultiImage')->name('multi.image.delete');

        });




        Route::get('/optimize', [OptimizationController::class, 'optimize']);
   
    });

    

});

// Guide Group Middleware 
Route::middleware(['auth','guide:guide'])->group(function(){
    Route::get('/guide/dashboard', [GuideController::class, 'GuideDashboard'])->name('guide.dashboard');
    
});

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');
Route::get('/apropos', [AboutController::class, 'Apropos'])->name('apropos');


//Blog Frontend
Route::controller(BlogController::class)->group(function(){
    Route::get('blog/detail/{slug}','BlogDetail');
    Route::get('blog/cat/list/{id}','BlogCatList');
    Route::get('blog/','BlogList')->name('blog.list');
});

//Destination Frontend
Route::controller(DestinationController::class)->group(function(){
    Route::get('destination/detail/{id}','DestinationDetail');  
    Route::get('destination/','Destination')->name('destination');
    Route::get('vehicule/','Vehicule')->name('vehicule');
});

//Excursion Frontend
Route::controller(ExcursionController::class)->group(function(){
    Route::get('excursion/detail/{id}','ExcursionDetail');  
    Route::get('excursion/','Excursion')->name('excursion');
    
});

//Voyage Groupe Frontend
Route::controller(VoyageController::class)->group(function(){
    Route::get('voyage/detail/{id}','VoyageDetail');  
    // Route::get('destination/','Destination')->name('destination');
    Route::get('vehicule/','Vehicule')->name('vehicule');
    Route::get('formulaire/voyage/','FormulaireVoyage')->name('formulaire.voyage');

});
//Evoie
Route::controller(FormController::class)->group(function(){
    Route::post('/envoie/form','Envoie')->name('envoie.form');
     Route::get('/Contact',  'Contact')->name('contact');
     Route::post('/sendmail',  'SendMail')->name('send.mail');
}); 


//Langue



Route::controller(LocalController::class)->group(function(){
    Route::get('/en','Ang')->name('ang');
    Route::get('/fr','Fr')->name('fr');
    Route::get('/es','Es')->name('es');


     
}); 

Route::get('/reservation-guide', [ReservationController::class, 'create'])->name('reservation.form');
Route::post('/reservation-guide', [ReservationController::class, 'store'])->name('reservation.store');




Route::get('/quill', function () {
    return view('frontend.formulaire.guidejourne');
})->name('test.form');









require __DIR__.'/auth.php';
