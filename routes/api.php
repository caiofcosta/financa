<?php

use App\Http\Controllers\LancamentoController;
use Illuminate\Support\Facades\Route;

Route::apiResource('lancamentos', LancamentoController::class); 