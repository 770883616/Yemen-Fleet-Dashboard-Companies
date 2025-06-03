<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Driver;
use App\Models\Task;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['customer', 'items.product', 'destination']);

        // بحث بالرقم أو اسم العميل
        if ($request->filled('search')) {
            $query->where('id', $request->search)
                  ->orWhereHas('customer', function($q) use ($request) {
                      $q->where('customer_name', 'like', '%' . $request->search . '%');
                  });
        }

        // فلترة الحالة
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // فلترة التاريخ
        if ($request->filled('date')) {
            $query->whereDate('order_date', $request->date);
        }

        // فلترة المنطقة (من الوجهة)
        if ($request->filled('region')) {
            $query->whereHas('destination', function($q) use ($request) {
                $q->where('end_point', 'like', '%' . $request->region . '%');
            });
        }

        $orders = $query->latest()->paginate(20);

        // إحصائيات سريعة
        $today = now()->toDateString();
        $ordersToday = Order::whereDate('order_date', $today)->count();
        $activeOrders = Order::where('status', 'قيد التنفيذ')->count();

        return view('pages.Orders.index', compact('orders', 'ordersToday', 'activeOrders'));
    }

    public function show($id)
    {
        $order = Order::with(['customer', 'items.product', 'destination', 'payment'])->findOrFail($id);
        $drivers = Driver::all();
        return view('pages.Orders.show', compact('order', 'drivers'));
    }

    public function assignDriver(Request $request, $orderId)
    {
        $request->validate([
            'driver_id' => 'required|exists:drivers,id'
        ]);

        $order = Order::with('customer', 'destination')->findOrFail($orderId);
        $destination = $order->destination;

        Task::create([
            'name'          => 'توصيل طلب رقم ' . $order->id,
            'description'   => 'مهمة توصيل الطلب للعميل "' . ($order->customer->customer_name ?? '-') . '"',
            'status'        => 'قيد التنفيذ',
            'driver_id'     => $request->driver_id,
            'destination_id'=> $destination ? $destination->id : null,
            'deadline'      => now()->addDays(1),
        ]);

        $order->update(['status' => 'قيد التنفيذ']);

        return redirect()->route('orders.show', $order->id)->with('success', 'تم تعيين السائق بنجاح!');
    }

    public function tracking($orderId)
    {
        $order = Order::with(['destination'])->findOrFail($orderId);

        // جلب آخر مهمة مرتبطة بوجهة الطلب لمعرفة السائق
        $task = null;
        if ($order->destination) {
            $task = Task::where('destination_id', $order->destination->id)->latest()->first();
        }

        // جلب آخر موقع GPS من sensor_data (حسب السائق أو الشاحنة أو الطلب حسب نظامك)
        $lastLocation = null;
        if ($task) {
            $sensorData = \App\Models\SensorData::where('driver_id', $task->driver_id)
                ->orderByDesc('timestamp')->first();
            $lastLocation = $sensorData ? $sensorData->value : null;
        }

        return view('pages.Orders.tracking', compact('order', 'task', 'lastLocation'));
    }

    public function store(Request $request)
    {
        // ... تحقق من البيانات

        $order = \App\Models\Order::create([
            // ... بيانات الطلب
        ]);

        // إرسال إشعار للشركة (أو للمدير أو من تريد)
        \App\Models\Notification::create([
            'message' => 'تم إضافة طلب جديد برقم #' . $order->id,
            'notifiable_id' => $order->company_id ?? 1, // عدل حسب منطقك
            'notifiable_type' => \App\Models\Company::class, // أو User::class حسب النظام
            'is_read' => false,
            'is_group_message' => false,
            'data' => json_encode([
                'order_id' => $order->id,
                'customer_name' => $order->customer->customer_name ?? '-',
                'status' => $order->status,
            ]),
            'created_at' => now(),
          'type' => 'order', // أو 'task' حسب النظام
        ]);

        // ... باقي الكود (رد أو تحويل)
        return redirect()->route('orders.index')->with('success', 'يوجد طلب جديد!');
    }
}
