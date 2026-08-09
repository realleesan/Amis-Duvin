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
Router::get(admin_url('login'), [AuthController::class, 'showLogin']);
Router::post(admin_url('login'), [AuthController::class, 'login']);
Router::get(admin_url('logout'), [AuthController::class, 'logout']);

// Admin CMS Protected Routes (with AuthMiddleware RBAC)
Router::get(admin_url(), [AdminDashboardController::class, 'index'], [
    AuthMiddleware::class => []
]);

Router::get(admin_url('bookings'), [AdminBookingController::class, 'index'], [
    AuthMiddleware::class => ['admin', 'cskh']
]);
Router::post(admin_url('bookings/update'), [AdminBookingController::class, 'update'], [
    AuthMiddleware::class => ['admin', 'cskh']
]);
Router::post(admin_url('bookings/manual-create'), [AdminBookingController::class, 'manualCreate'], [
    AuthMiddleware::class => ['admin', 'cskh']
]);
Router::post(admin_url('bookings/sync'), [AdminBookingController::class, 'syncSheets'], [
    AuthMiddleware::class => ['admin', 'cskh']
]);

Router::get(admin_url('content'), [AdminContentController::class, 'index'], [
    AuthMiddleware::class => ['admin', 'marketing']
]);
Router::post(admin_url('content/hero'), [AdminContentController::class, 'updateHero'], [
    AuthMiddleware::class => ['admin', 'marketing']
]);
Router::post(admin_url('content/service-intro'), [AdminContentController::class, 'updateServiceIntro'], [
    AuthMiddleware::class => ['admin', 'marketing']
]);
Router::post(admin_url('content/pairing'), [AdminContentController::class, 'updatePairing'], [
    AuthMiddleware::class => ['admin', 'marketing']
]);
Router::post(admin_url('content/benefit'), [AdminContentController::class, 'updateBenefit'], [
    AuthMiddleware::class => ['admin', 'marketing']
]);
Router::post(admin_url('content/testimonial'), [AdminContentController::class, 'updateTestimonial'], [
    AuthMiddleware::class => ['admin', 'marketing']
]);
Router::post(admin_url('content/testimonial/create'), [AdminContentController::class, 'createTestimonial'], [
    AuthMiddleware::class => ['admin', 'marketing']
]);
Router::post(admin_url('content/testimonial/delete'), [AdminContentController::class, 'deleteTestimonial'], [
    AuthMiddleware::class => ['admin', 'marketing']
]);
Router::post(admin_url('content/faq'), [AdminContentController::class, 'updateFaq'], [
    AuthMiddleware::class => ['admin', 'marketing']
]);
Router::post(admin_url('content/faq/create'), [AdminContentController::class, 'createFaq'], [
    AuthMiddleware::class => ['admin', 'marketing']
]);
Router::post(admin_url('content/faq/delete'), [AdminContentController::class, 'deleteFaq'], [
    AuthMiddleware::class => ['admin', 'marketing']
]);
Router::post(admin_url('content/seo'), [AdminContentController::class, 'updateSeo'], [
    AuthMiddleware::class => ['admin', 'marketing']
]);

Router::get(admin_url('google-sheets'), [AdminGoogleSheetsController::class, 'index'], [
    AuthMiddleware::class => ['admin']
]);
Router::post(admin_url('google-sheets/update'), [AdminGoogleSheetsController::class, 'update'], [
    AuthMiddleware::class => ['admin']
]);
Router::post(admin_url('google-sheets/test'), [AdminGoogleSheetsController::class, 'testConnection'], [
    AuthMiddleware::class => ['admin']
]);

Router::get(admin_url('users'), [AdminUserController::class, 'index'], [
    AuthMiddleware::class => ['admin']
]);
Router::post(admin_url('users/create'), [AdminUserController::class, 'create'], [
    AuthMiddleware::class => ['admin']
]);
Router::post(admin_url('users/update'), [AdminUserController::class, 'update'], [
    AuthMiddleware::class => ['admin']
]);
