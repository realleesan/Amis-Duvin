<?php

use Core\Router;
use App\Controllers\HomeController;
use App\Controllers\BookingController;
use App\Controllers\WorkshopController;
use App\Controllers\Admin\AuthController;
use App\Controllers\Admin\AdminDashboardController;
use App\Controllers\Admin\AdminBookingController;
use App\Controllers\Admin\AdminContentController;
use App\Controllers\Admin\AdminGoogleSheetsController;

// Web Routes
Router::get('/', [HomeController::class, 'index']);
Router::get('/under-18', [HomeController::class, 'under18']);

// API & Form Submissions
Router::get('/api/availability', [BookingController::class, 'getAvailability']);
Router::post('/api/booking', [BookingController::class, 'store']);
Router::post('/api/workshop-register', [WorkshopController::class, 'store']);

// Admin CMS Routes
Router::get('/admin/login', [AuthController::class, 'showLogin']);
Router::post('/admin/login', [AuthController::class, 'login']);
Router::get('/admin/logout', [AuthController::class, 'logout']);

Router::get('/admin', [AdminDashboardController::class, 'index']);
Router::get('/admin/bookings', [AdminBookingController::class, 'index']);
Router::post('/admin/bookings/update', [AdminBookingController::class, 'update']);
Router::post('/admin/bookings/sync', [AdminBookingController::class, 'syncSheets']);

Router::get('/admin/content', [AdminContentController::class, 'index']);
Router::post('/admin/content/hero', [AdminContentController::class, 'updateHero']);
Router::post('/admin/content/service-intro', [AdminContentController::class, 'updateServiceIntro']);
Router::post('/admin/content/pairing', [AdminContentController::class, 'updatePairing']);

Router::get('/admin/google-sheets', [AdminGoogleSheetsController::class, 'index']);
Router::post('/admin/google-sheets/update', [AdminGoogleSheetsController::class, 'update']);
Router::post('/admin/google-sheets/test', [AdminGoogleSheetsController::class, 'testConnection']);
