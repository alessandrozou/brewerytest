<?php
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/', function () {
        return view('breweries');
    });

    Route::get('/breweries', function () {
        return view('breweries');
    });

    Route::get('/brewery/{id}', function ($id) {

        $data = array(
            'id' => $id,
        );
    
        return view('brewery', $data);
    });

});

Route::get('/test/{par1?}', function ($par1 = null) {

    $data = array(
        'par1' => $par1,
    );

    return view('test', $data);
});
