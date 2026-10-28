<?php

use Illuminate\Support\Facades\Route;

/*
 |--------------------------------------------------------------------------
 | Web Routes
 |--------------------------------------------------------------------------
 |
 | Here is where you can register web routes for your application.
 |
 */

// The plugin's upgrade links (Licensing::PRO_URL) point at /pro/. Until there's a Pro page, they
// land on the pricing section; temporary, so it can become a page later.
Route::redirect('/pro', '/#pricing', 302);
