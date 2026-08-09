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
use App\Controllers\Admin\AdminUserController;
use App\Controllers\SeoController;
use App\Middleware\AuthMiddleware;

// Public Web Routes
Router::get('/', [HomeController::class, 'index']);
Router::get('/under-18', [HomeController::class, 'under18']);
Router::get('/robots.txt', [SeoController::class, 'robots']);
Router::get('/sitemap.xml', [SeoController::class, 'sitemap']);

// API & Form Submissions
Router::get('/api/availability', [BookingController::class, 'getAvailability']);
Router::post('/api/booking', [BookingController::class, 'store']);
Router::post('/api/workshop-register', [WorkshopController::class, 'store']);

// Admin Auth Routes
Router::get('/admin/login', [AuthController::class, 'showLogin']);
Router::post('/admin/login', [AuthController::class, 'login']);
Router::get('/admin/logout', [AuthController::class, 'logout']);

// Admin CMS Protected Routes (with AuthMiddleware RBAC)
Router::get('/admin', [AdminDashboardController::class, 'index'], [
    AuthMiddleware::class => []
]);

Router::get('/admin/bookings', [AdminBookingController::class, 'index'], [
    AuthMiddleware::class => ['admin', 'cskh']
]);
Router::post('/admin/bookings/update', [AdminBookingController::class, 'update'], [
    AuthMiddleware::class => ['admin', 'cskh']
]);
Router::post('/admin/bookings/manual-create', [AdminBookingController::class, 'manualCreate'], [
    AuthMiddleware::class => ['admin', 'cskh']
]);
Router::post('/admin/bookings/sync', [AdminBookingController::class, 'syncSheets'], [
    AuthMiddleware::class => ['admin', 'cskh']
]);

Router::get('/admin/content', [AdminContentController::class, 'index'], [
    AuthMiddleware::class => ['admin', 'marketing']
]);
Router::post('/admin/content/hero', [AdminContentController::class, 'updateHero'], [
    AuthMiddleware::class => ['admin', 'marketing']
]);
Router::post('/admin/content/service-intro', [AdminContentController::class, 'updateServiceIntro'], [
    AuthMiddleware::class => ['admin', 'marketing']
]);
Router::post('/admin/content/pairing', [AdminContentController::class, 'updatePairing'], [
    AuthMiddleware::class => ['admin', 'marketing']
]);
Router::post('/admin/content/benefit', [AdminContentController::class, 'updateBenefit'], [
    AuthMiddleware::class => ['admin', 'marketing']
]);
Router::post('/admin/content/testimonial', [AdminContentController::class, 'updateTestimonial'], [
    AuthMiddleware::class => ['admin', 'marketing']
]);
Router::post('/admin/content/testimonial/create', [AdminContentController::class, 'createTestimonial'], [
    AuthMiddleware::class => ['admin', 'marketing']
]);
Router::post('/admin/content/testimonial/delete', [AdminContentController::class, 'deleteTestimonial'], [
    AuthMiddleware::class => ['admin', 'marketing']
]);
Router::post('/admin/content/faq', [AdminContentController::class, 'updateFaq'], [
    AuthMiddleware::class => ['admin', 'marketing']
]);
Router::post('/admin/content/faq/create', [AdminContentController::class, 'createFaq'], [
    AuthMiddleware::class => ['admin', 'marketing']
]);
Router::post('/admin/content/faq/delete', [AdminContentController::class, 'deleteFaq'], [
    AuthMiddleware::class => ['admin', 'marketing']
]);
Router::post('/admin/content/seo', [AdminContentController::class, 'updateSeo'], [
    AuthMiddleware::class => ['admin', 'marketing']
]);

Router::get('/admin/google-sheets', [AdminGoogleSheetsController::class, 'index'], [
    AuthMiddleware::class => ['admin']
]);
Router::post('/admin/google-sheets/update', [AdminGoogleSheetsController::class, 'update'], [
    AuthMiddleware::class => ['admin']
]);
Router::post('/admin/google-sheets/test', [AdminGoogleSheetsController::class, 'testConnection'], [
    AuthMiddleware::class => ['admin']
]);

Router::get('/admin/users', [AdminUserController::class, 'index'], [
    AuthMiddleware::class => ['admin']
]);
Router::post('/admin/users/create', [AdminUserController::class, 'create'], [
    AuthMiddleware::class => ['admin']
]);
Router::post('/admin/users/update', [AdminUserController::class, 'update'], [
    AuthMiddleware::class => ['admin']
]);
