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
use App\Controllers\Admin\AdminWorkshopController;
use App\Controllers\SeoController;
use App\Middleware\AuthMiddleware;

use App\Controllers\AnalyticsController;
use App\Controllers\Admin\AdminNotificationController;
use App\Controllers\Admin\TrashController;

// Public Web Routes
Router::get('/', [HomeController::class, 'index']);
Router::get('/under-18', [HomeController::class, 'under18']);
Router::get('/robots.txt', [SeoController::class, 'robots']);
Router::get('/sitemap.xml', [SeoController::class, 'sitemap']);

// API & Form Submissions
Router::get('/api/availability', [BookingController::class, 'getAvailability']);
Router::post('/api/booking', [BookingController::class, 'store']);
Router::post('/api/workshop-register', [WorkshopController::class, 'store']);
Router::post('/api/track-pageview', [AnalyticsController::class, 'trackPageview']);
Router::post('/api/track-click', [AnalyticsController::class, 'trackClick']);

// Admin Auth Routes
Router::get(admin_url('login'), [AuthController::class, 'showLogin']);
Router::post(admin_url('login'), [AuthController::class, 'login']);
Router::get(admin_url('logout'), [AuthController::class, 'logout']);

// Admin CMS Protected Routes (with AuthMiddleware RBAC)
Router::get(admin_url(), [AdminDashboardController::class, 'index'], [
    AuthMiddleware::class => []
]);

Router::get(admin_url('api/notifications/unread'), [AdminNotificationController::class, 'getUnreadApi'], [
    AuthMiddleware::class => []
]);
Router::post(admin_url('api/notifications/mark-read'), [AdminNotificationController::class, 'markAsReadApi'], [
    AuthMiddleware::class => []
]);
Router::post(admin_url('api/notifications/mark-all-read'), [AdminNotificationController::class, 'markAllAsReadApi'], [
    AuthMiddleware::class => []
]);
Router::get(admin_url('notifications'), [AdminNotificationController::class, 'index'], [
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

// Workshop Protected Routes
Router::get(admin_url('workshops'), [AdminWorkshopController::class, 'index'], [
    AuthMiddleware::class => ['admin', 'cskh']
]);
Router::post(admin_url('workshops/registration/update'), [AdminWorkshopController::class, 'updateRegistration'], [
    AuthMiddleware::class => ['admin', 'cskh']
]);
Router::post(admin_url('workshops/registration/manual-create'), [AdminWorkshopController::class, 'manualCreateRegistration'], [
    AuthMiddleware::class => ['admin', 'cskh']
]);
Router::post(admin_url('workshops/create'), [AdminWorkshopController::class, 'createWorkshop'], [
    AuthMiddleware::class => ['admin']
]);
Router::post(admin_url('workshops/update'), [AdminWorkshopController::class, 'updateWorkshop'], [
    AuthMiddleware::class => ['admin']
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
Router::post(admin_url('content/workshop'), [AdminContentController::class, 'updateWorkshop'], [
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
Router::post(admin_url('users/delete'), [AdminUserController::class, 'delete'], [
    AuthMiddleware::class => ['admin']
]);

// Soft Delete Routes for Admin
Router::post(admin_url('notifications/delete'), [AdminNotificationController::class, 'delete'], [
    AuthMiddleware::class => ['admin']
]);
Router::post(admin_url('notifications/bulk-delete'), [AdminNotificationController::class, 'bulkDelete'], [
    AuthMiddleware::class => ['admin']
]);
Router::post(admin_url('api/notifications/bulk-mark-read'), [AdminNotificationController::class, 'bulkMarkReadApi'], [
    AuthMiddleware::class => []
]);
Router::post(admin_url('api/upload-image'), [\App\Controllers\Admin\AdminUploadController::class, 'uploadImage'], [
    AuthMiddleware::class => []
]);
Router::post(admin_url('bookings/delete'), [AdminBookingController::class, 'delete'], [
    AuthMiddleware::class => ['admin']
]);
Router::post(admin_url('bookings/bulk-delete'), [AdminBookingController::class, 'bulkDelete'], [
    AuthMiddleware::class => ['admin']
]);
Router::post(admin_url('workshops/registration/delete'), [AdminWorkshopController::class, 'deleteRegistration'], [
    AuthMiddleware::class => ['admin']
]);
Router::post(admin_url('workshops/registration/bulk-delete'), [AdminWorkshopController::class, 'bulkDeleteRegistration'], [
    AuthMiddleware::class => ['admin']
]);
Router::post(admin_url('users/bulk-delete'), [AdminUserController::class, 'bulkDelete'], [
    AuthMiddleware::class => ['admin']
]);

// Unified Admin Trash Routes
Router::get(admin_url('trash'), [TrashController::class, 'index'], [
    AuthMiddleware::class => ['admin']
]);
Router::post(admin_url('trash/restore'), [TrashController::class, 'restore'], [
    AuthMiddleware::class => ['admin']
]);
Router::post(admin_url('trash/force-delete'), [TrashController::class, 'forceDelete'], [
    AuthMiddleware::class => ['admin']
]);
Router::post(admin_url('trash/bulk-restore'), [TrashController::class, 'bulkRestore'], [
    AuthMiddleware::class => ['admin']
]);
Router::post(admin_url('trash/bulk-force-delete'), [TrashController::class, 'bulkForceDelete'], [
    AuthMiddleware::class => ['admin']
]);

