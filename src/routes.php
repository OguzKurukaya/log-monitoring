<?php

use Illuminate\Support\Facades\Route;

Route::get("/", function () {
        echo' no;l';
});

Route::delete("/{id}", function () {
        echo request()->id;
});
