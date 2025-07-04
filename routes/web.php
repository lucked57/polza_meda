<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Posts;
use App\Models\Image;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use App\Models\User;
use App\Models\Gallery;
use App\Models\Usertext;

Route::middleware(['auth', 'admin', 'locked'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index']);
    Route::get('/all-users', function () {
        return view('admin.allusers');
    });
    Route::get('/api/get-users', function () {
        return response()->json(User::all());
    });
    Route::get('/add-new-image', function () {
        return view('admin.addimage');
    });
    Route::put('/block-users', [AdminController::class, 'blockUsers']);
    Route::put('/unlock-users', [AdminController::class, 'unLockUsers']);
    Route::post('/upload-new-image', [AdminController::class, 'uploadNewImage']);

    //registration will be for the admin only
    
    Route::get('/register',[AuthController::class, 'showRegister'])->name("show.register");
    Route::post('/register',[AuthController::class, 'register'])->middleware('throttle:5,1')->name("register");
});

Route::get('/register/{id}/{code}', [AuthController::class, 'verifyRegistrationCode'])->middleware('throttle:5,1')->name('register.verify');

Route::get('/', function () {
    $images = Image::all(); 
    $text = Usertext::all();
    return view('home', compact('images','text')); 
})->name('home');

Route::get('/api/images', function () {
    return response()->json(Image::all());
});

Route::get('/nopagehere', function () {
    return redirect('/');
});

//Auth users who logged in

/*Route::middleware('auth')->group(function () {
    Route::get('/gallery', function () {
        return view('gallery');
    });
    Route::get('/api/gallery', function () {
    return response()->json(Gallery::all());
});
    Route::get('/contact', function () {
        return view('contact');
    });
});*/



//Register

Route::middleware('guest')->group(function () {
    //Route::get('/register/{id}/{code}', [AuthController::class, 'verifyRegistrationCode'])->middleware('throttle:5,1')->name('register.verify');
    Route::get('/resetpass/{id}/{code}', [AuthController::class, 'verifyResetPassCode'])->middleware('throttle:5,1')->name('resetpass.verify');
    //Route::get('/register',[AuthController::class, 'showRegister'])->name("show.register");
    Route::get('/resetpass',[AuthController::class, 'showResetPass'])->name("show.resetpass");
    Route::get('/login',[AuthController::class, 'showLogin'])->name("show.login");
    //Route::post('/register',[AuthController::class, 'register'])->middleware('throttle:5,1')->name("register");
    Route::post('/verify-email-code', [AuthController::class, 'verifyEmailCode'])
    ->middleware('throttle:5,1')
    ->name("verify.email.code");

    Route::post('/resetpass', [AuthController::class, 'SendNewPass'])->middleware('throttle:5,1')->name("send.newpass");

    //Route::post('/login',[AuthController::class, 'login'])->name("login");
    Route::post('/login', [AuthController::class, 'login'])
    ->middleware('throttle:5,1') //attemps/minuteslock
    ->name("login");
});

//no auth access

Route::post('/logout',[AuthController::class, 'logout'])->name("logout");


    Route::get('/gallery', function () {
        return view('gallery');
    });

    Route::get('/single-post/{id}', function ($id) {
        $post = Posts::findOrFail($id);
        return view('single_post', ['post' => $post]);
    });

    Route::get('/api/gallery', function () {
        return response()->json(Gallery::orderBy('id', 'desc')->get());
    });
    Route::get('/api/posts', function () {
        return response()->json(Posts::where('type', 'post')->orderBy('id', 'desc')->get());
    });
    Route::get('/api/market', function () {
        return response()->json(Posts::where('type', 'market')->orderBy('id', 'desc')->get());
    });
    Route::get('/contact', function () {
        return view('contact');
    });
    Route::get('/posts', function () {
        return view('posts');
    });
    Route::get('/market', function () {
        return view('market');
    });
    Route::get('/about', function () {
        return view('about');
    });

//end no auth access

Route::middleware('auth', 'locked')->group(function () {


    Route::post('/updatepass',[AuthController::class, 'UpdatePassword'])->name("update.password");

    //Route::post('/formsubmitted', [PostController::class, 'create']);
    Route::post('/upload-post', [PostController::class, 'uploadNewPost']);
    Route::post('/upload-post-withid', [PostController::class, 'uploadNewPostWithID']);
    Route::post('/update-post-new', [PostController::class, 'updatePost']);
    //Route::post('/upload-image', [PostController::class, 'uploadWithImage']);
    Route::post('/upload-gallery', [PostController::class, 'uploadWithImagesGallery']);
    Route::post('/upload-gallery-byid', [PostController::class, 'uploadWithImagesGalleryByID']);
    Route::post('/change-gallery', [PostController::class, 'changeWithImageGallery']);
    Route::post('/change-img-images', [PostController::class, 'changeImageImages']);
    Route::post('/change-img-post', [PostController::class, 'changeWithImagePosts']);
    Route::delete('/delete-image/{id}', [PostController::class, 'deleteImagePost']);
    Route::delete('/delete-image-gallery/{id}', [PostController::class, 'deleteImageGallery']);
    Route::delete('/delete-post/{id}', [PostController::class, 'deletePost']);
    Route::delete('/delete-post-img/{id}/{img_path_number}', [PostController::class, 'deletePostImg']);
    Route::put('/update-post/{id}', [PostController::class, 'update']);
    Route::post('/updatetext', [PostController::class, 'updateText']);
    Route::delete('/delete-multiple-gallery', [PostController::class, 'deleteMultipleGallery']);
    Route::delete('/delete-multiple-posts', [PostController::class, 'deleteMultiplePosts']);

});



//POST routes

/*Route::middleware(['web'])->group(function () {
    Route::post('/formsubmitted', function(Request $request) {
        $fullname = $request->input("fullname");
        $email = $request->input("email");
        return "Form submitted ".$fullname;
    });
});*/



Route::get('/clear-cache', function () {
        Cache::flush();
    return "Cache cleared successfully!";
});

