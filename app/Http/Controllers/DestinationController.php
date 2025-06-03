<?php

namespace App\Http\Controllers;

use App\Models\CompanyOrder;
use App\Models\Task;
use App\Models\Order;
use App\Models\Truck;
use App\Models\Driver;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DestinationController extends Controller
{
    // عرض قائمة الوجهات
 public function index()
{
    $destinations = Destination::with(['task.truck.gpsSensor', 'task.driver'])
        ->get()
        ->map(function ($destination) {
            if ($destination->task && $destination->task->truck && $destination->task->truck->gpsSensor) {
                $latestGps = DB::table('sensor_data')
                    ->where('sensor_id', $destination->task->truck->gpsSensor->id)
                    ->whereNotNull('location')
                    ->orderByDesc('timestamp')
                    ->first();

                if ($latestGps) {
                    $destination->truck_location = $latestGps->location;
                }
            }
            return $destination;
        });

    return view('pages.Destination.index', compact('destinations'));
}
    // عرض نموذج إنشاء وجهة جديدة
public function create()
{
    $companyId = auth('company')->id();

    $tasks = Task::with(['truck.gpsSensor', 'driver'])
        ->whereHas('truck', fn($q) => $q->where('company_id', $companyId))
        ->get()
        ->filter(function ($task) {
            if (!$task->truck || !$task->truck->gpsSensor) return false;

            // التحقق من وجود بيانات موقع حديثة (خلال آخر ساعة)
            $hasRecentData = DB::table('sensor_data')
                ->where('sensor_id', $task->truck->gpsSensor->id)
                ->where('timestamp', '>', now()->subHour())
                ->exists();

            return $hasRecentData;
        });

    $companyOrders = CompanyOrder::with(['order.customer'])
        ->where('company_id', $companyId)
        ->get();

    return view('pages.Destination.create', compact('tasks', 'companyOrders'));
}

public function store(Request $request)
{
    $validated = $request->validate([
        'task_id' => 'required|exists:tasks,id',
        'order_id' => 'required|exists:orders,id',
        'start_point' => 'required|string|max:255',
        'start_coordinates' => 'required|string|regex:/^-?\d+(\.\d+)?,-?\d+(\.\d+)?$/',
        'end_point' => 'required|string|max:255',
        'end_lat' => 'required|numeric|between:-90,90',
        'end_lng' => 'required|numeric|between:-180,180',
        'date' => 'required|date',
    ]);

    // استخراج خطوط الطول والعرض من start_coordinates
    [$startLat, $startLng] = explode(',', $validated['start_coordinates']);

    try {
        DB::beginTransaction();

        $destination = Destination::create([
            'start_point' => $validated['start_point'],
            'start_latitude' => floatval($startLat),
            'start_longitude' => floatval($startLng),
            'end_point' => $validated['end_point'],
            'end_latitude' => $validated['end_lat'],
            'end_longitude' => $validated['end_lng'],
            'end_address' => $validated['end_point'], // أو يمكن إضافة حقل منفصل في الفورم للعنوان الكامل
            'date' => $validated['date'],
            'task_id' => $validated['task_id'],
            'order_id' => $validated['order_id'],
        ]);

        DB::commit();

        return redirect()->route('destinations.index')
            ->with('success', 'تم إنشاء الوجهة بنجاح');

    } catch (\Exception $e) {
        DB::rollBack();
        return back()->withInput()
            ->with('error', 'حدث خطأ أثناء حفظ البيانات: ' . $e->getMessage());
    }
}



    // عرض نموذج تعديل وجهة موجودة
    public function edit(Destination $destination)
    {
        $trucks = Truck::all();
        $tasks = Task::all();
        $drivers = Driver::all();
        return view('pages.Destination.edit', compact('destination', 'trucks', 'tasks', 'drivers'));
    }

    // تحديث بيانات وجهة موجودة
    public function update(Request $request, Destination $destination)
    {
        $validated = $request->validate([
            'start_point' => 'required|string|max:255',
            'end_point' => 'required|string|max:255',
            'estimated_time' => 'required|integer',
            'date' => 'required|date',+
            'truck_id' => 'required|exists:trucks,id',
            'task_id' => 'required|exists:tasks,id',
            'driver_id' => 'required|exists:drivers,id',
        ]);

        $destination->update($validated);

        return redirect()->route('destinations.index')->with('success', 'تم تحديث الوجهة بنجاح!');
    }

    // حذف وجهة موجودة
    public function destroy(Destination $destination)
    {
        $destination->delete();
        return redirect()->route('destinations.index')->with('success', 'تم حذف الوجهة بنجاح!');
    }
}
