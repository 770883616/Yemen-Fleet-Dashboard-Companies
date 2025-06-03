<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Truck;
use App\Models\Driver;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $tasks = Task::with(['driver', 'destination']);

        if ($request->filled('driver')) {
            $tasks->whereHas('driver', function($q) use ($request) {
                $q->where('driver_name', 'like', '%' . $request->driver . '%');
            });
        }
        if ($request->filled('start_point')) {
            $tasks->whereHas('destination', function($q) use ($request) {
                $q->where('start_point', 'like', '%' . $request->start_point . '%');
            });
        }
        if ($request->filled('end_point')) {
            $tasks->whereHas('destination', function($q) use ($request) {
                $q->where('end_point', 'like', '%' . $request->end_point . '%');
            });
        }

        $tasks = $tasks->latest()->paginate(20);
        return view('pages.Task.index', compact('tasks'));
    }

    public function create()
    {
        $company = auth()->guard('company')->user();
        $tasks = Task::with('truck')->get();
        $trucks = Truck::all();
        $drivers = Driver::all(); // أضف هذا السطر
            $destinations = Destination::all(); // إضافة هذا السطر

        return view('pages.Task.create', compact('tasks', 'trucks', 'drivers', 'destinations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
        'name' => 'required|string|max:255', // تأكد من وجود هذه القاعدة
            'deadline' => 'required|date',
            'description' => 'nullable|string',
            'status' => 'required|in:معلقة,قيد التنفيذ,تم انجازالمهمه',
            'driver_id' => 'required|exists:drivers,id',
        ]);

        $task = \App\Models\Task::create($validated);

        // إشعار للسائق والشركة
        $company = auth('company')->user();
        \App\Models\Notification::create([
            'message' => "📋 تم تعيين مهمة [{$task->name}] للسائق [{$task->driver->driver_name}]",
            'is_read' => false,
            'is_group_message' => false,
            'notifiable_id' => $company->id,
            'notifiable_type' => get_class($company),
            'sender_type' => get_class($company),
            'sender_id' => $company->id,
        ]);

        return redirect()->route('tasks.index')->with('success', 'تم إضافة المهمة بنجاح ✅');
    }

    public function show(Task $task)
    {
        return view('pages.Task.show', compact('task'));
    }

    public function edit(Task $task)
    {
        $company = auth()->guard('company')->user();
        $drivers = Driver::whereHas('truck', function($q) use ($company) {
            $q->where('company_id', $company->id);
        })->get();
        return view('pages.Task.edit', compact('task', 'drivers'));
    }

    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'task_name' => 'required|string|max:255',
            'deadline' => 'required|date',
            'description' => 'nullable|string',
            'status' => 'required|in:معلقة,قيد التنفيذ,تم انجازالمهمه', // تحديث القيم المسموح بها
            'driver_id' => 'required|exists:drivers,id',
        ]);

        $task->update($validated);

        return redirect()->route('tasks.index')->with('success', 'تم تعديل المهمة بنجاح ✏️');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'تم حذف المهمة بنجاح 🗑️');
    }

    // App\Http\Controllers\API\TaskController.php

public function getLocation(Task $task)
{
    Log::info("جلب موقع الشاحنة للمهمة ID: {$task->id}");

    $truck = $task->truck;
    if (!$truck) {
        Log::error("المهمة لا تحتوي على شاحنة.");
        return response()->json(['error' => 'المهمة لا تحتوي على شاحنة'], 404);
    }

    $sensor = $truck->gpsSensor;
    if (!$sensor) {
        Log::error("لا يوجد حساس GPS مرتبط بالشاحنة ID: {$truck->id}");
        return response()->json(['error' => 'لا يوجد حساس GPS مرتبط بهذه الشاحنة'], 404);
    }

    $latestData = $sensor->sensorData()->latest()->first();
    if (!$latestData || !$latestData->location) {
        Log::error("لا توجد بيانات GPS صالحة للحساس ID: {$sensor->id}");
        return response()->json(['error' => 'لا توجد بيانات GPS صالحة'], 404);
    }

    $locationData = json_decode($latestData->location, true);
    if (!isset($locationData['latitude']) || !isset($locationData['longitude'])) {
        Log::error("تنسيق الموقع غير صالح: " . $latestData->location);
        return response()->json(['error' => 'تنسيق موقع غير صالح'], 422);
    }

    Log::info("تم جلب الموقع بنجاح: " . json_encode($locationData));

    return response()->json([
        'coordinates' => "{$locationData['latitude']},{$locationData['longitude']}",
        'location' => "خط العرض: {$locationData['latitude']}، خط الطول: {$locationData['longitude']}"
    ]);
}



}

