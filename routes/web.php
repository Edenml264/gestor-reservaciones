<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('services.index');
});

Route::get('/services', function () {
    return view('services.index');
})->name('services.index');

Route::get('/services/{service}', function (App\Models\Service $service) {
    return view('services.show', compact('service'));
})->name('services.show');
