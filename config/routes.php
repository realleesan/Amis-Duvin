<?php

use Core\Router;
use App\Controllers\HomeController;
use App\Controllers\BookingController;
use App\Controllers\WorkshopController;

// Web Routes
Router::get('/', [HomeController::class, 'index']);
Router::get('/under-18', [HomeController::class, 'under18']);

// API & Form Submissions
Router::get('/api/availability', [BookingController::class, 'getAvailability']);
Router::post('/api/booking', [BookingController::class, 'store']);
Router::post('/api/workshop-register', [WorkshopController::class, 'store']);
