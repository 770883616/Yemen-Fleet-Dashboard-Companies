<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AlertController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TruckController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ObdDataController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AccidentController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\ObdDeviceController;
use App\Http\Controllers\SensorDataController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\CompanyOrderController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\Auth\CompanyLoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Models\Destination;
use App\Models\Sensor;
use App\Models\Task;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return redirect('/company/login'); // إعادة التوجيه إلى صفحة تسجيل الدخول
});
Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
Route::resource('companies', CompanyController::class);
Route::resource('obd', ObdDeviceController::class);
Route::resource('obd_data', ObdDataController::class);
Route::resource('tasks', TaskController::class);
Route::resource('destinations', DestinationController::class);
Route::resource('accidents', AccidentController::class);
Route::resource('customers', CustomerController::class);
Route::resource('reports', ReportController::class);
Route::resource('alerts', AlertController::class);
Route::resource('shipments', ShipmentController::class);
// Route::resource('subscriptions', SubscriptionController::class)->except(['show']);
Route::resource('subscriptions', SubscriptionController::class);
Route::resource('payments', PaymentController::class)->only(['index']);
Route::resource('orders', OrderController::class)->only(['index', 'show']);
Route::resource('invoices', InvoiceController::class)->only(['index', 'show']);
// Route::post('/orders/{order}/assign-driver', [OrderController::class, 'assignDriver'])->name('orders.assignDriver');
// Route::post('/orders/{order}/update-status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
// Route::get('/orders/{order}/invoice', [OrderController::class, 'showInvoice'])->name('orders.showInvoice');

Route::resource('products', ProductController::class);
Route::resource('drivers', DriverController::class);
Route::resource('maintenances',MaintenanceController::class);

// صفحة تسجيل الدخول
Route::get('/company/login', [App\Http\Controllers\Auth\CompanyLoginController::class, 'showLoginForm'])->name('company.login');
Route::post('/company/login', [CompanyLoginController::class, 'login'])->name('company.login.submit');

// صفحة إنشاء حساب شركة
Route::get('/company/register', [CompanyController::class, 'create'])->name('company.register');
Route::post('/company/register', [CompanyController::class, 'store'])->name('company.register.submit');

// لوحة التحكم
Route::get('/dashboard', [CompanyLoginController::class, 'dashboard'])->name('company.dashboard')->middleware('auth:company');

// عرض صفحة طلب إعادة تعيين كلمة المرور
Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');

// إرسال رابط إعادة تعيين كلمة المرور
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// عرض صفحة إعادة تعيين كلمة المرور
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');

// معالجة طلب إعادة تعيين كلمة المرور
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::middleware(['auth:company'])->group(function () {
    Route::resource('trucks', TruckController::class);
});

Route::get('/gps/fetch', [SensorDataController::class, 'fetchFromGpsAndStore']);
Route::get('/weather/fetch', [SensorDataController::class, 'fetchWeatherAndStore']);
Route::get('drivers/{driver}/tasks', [DriverController::class, 'tasks'])->name('drivers.tasks');
Route::post('/orders/{order}/assign-driver', [OrderController::class, 'assignDriver'])->name('orders.assignDriver');
Route::get('/orders/{order}/tracking', [OrderController::class, 'tracking'])->name('orders.tracking');
Route::post('/payments/pay-online', [\App\Http\Controllers\PaymentController::class, 'payOnline'])->name('payments.payOnline');
Route::post('/payments/upload-proof', [\App\Http\Controllers\PaymentController::class, 'uploadProof'])->name('payments.uploadProof');
Route::get('/fleet/log', [\App\Http\Controllers\FleetLogController::class, 'index'])->name('fleet.log');
Route::get('notifications', [\App\Http\Controllers\NotificationController::class, 'index'])->name('notifications.index');
Route::post('notifications/{id}/read', [\App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('notifications.read');
Route::delete('notifications/{id}', [\App\Http\Controllers\NotificationController::class, 'destroy'])->name('notifications.destroy');
Route::post('notifications/read-all', [\App\Http\Controllers\NotificationController::class, 'markAllAsRead'])->name('notifications.readAll');
Route::get('alerts', [\App\Http\Controllers\NotificationController::class, 'index'])->name('alerts.index');
Route::prefix('drivers')->group(function () {
    Route::get('/', [DriverController::class, 'index'])->name('drivers.index');
    Route::get('/create', [DriverController::class, 'create'])->name('drivers.create');
    Route::post('/', [DriverController::class, 'store'])->name('drivers.store');
    Route::get('/{id}', [DriverController::class, 'show'])->name('drivers.show');
    Route::get('/{id}/edit', [DriverController::class, 'edit'])->name('drivers.edit');
    Route::put('/{id}', [DriverController::class, 'update'])->name('drivers.update');
    Route::delete('/{id}', [DriverController::class, 'destroy'])->name('drivers.destroy');
    Route::get('/{id}/tasks', [DriverController::class, 'tasks'])->name('drivers.tasks');
});

// إذا كنت تستخدم auth الافتراضي:
Route::post('logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');
Route::group(['middleware' => ['auth']], function() {
    // طلبات الشركة
    Route::get('company-orders', [App\Http\Controllers\CompanyOrderController::class, 'index'])->name('company-orders.index');
    Route::get('company-orders/{id}', [App\Http\Controllers\CompanyOrderController::class, 'show'])->name('company-orders.show');
    Route::post('company-orders/{id}/approve', [App\Http\Controllers\CompanyOrderController::class, 'approve'])->name('company-orders.approve');
    Route::post('company-orders/{id}/suspend', [App\Http\Controllers\CompanyOrderController::class, 'suspend'])->name('company-orders.suspend');
    Route::post('company-orders/{id}/unsuspend', [App\Http\Controllers\CompanyOrderController::class, 'unsuspend'])->name('company-orders.unsuspend');
});


Route::get('/subscription/expired', function () {
    return view('subscription.expired');
})->name('subscription.expired');


Route::get('/sensors/{sensor}/latest-location', function(Sensor $sensor) {
    $latestLocation = $sensor->sensorData()
        ->whereNotNull('location')
        ->orderByDesc('timestamp')
        ->first();

    if (!$latestLocation) {
        return response()->json(['error' => 'No location data found'], 404);
    }

    return response()->json([
        'location' => $latestLocation->location,
        'location_name' => \App\Models\Destination::getLocationNameFromCoords($latestLocation->location)
    ]);
});


// routes/web.php
Route::get('/admin/tasks/{task}/location', [TaskController::class, 'getLocation'])->name('admin.tasks.location');

