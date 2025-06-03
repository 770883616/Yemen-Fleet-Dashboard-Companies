<?php
namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Services\NotificationService;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = \App\Models\Driver::with(['truck', 'tasks'])->get();
        return view('drivers.index', compact('drivers'));
    }

    public function create()
    {
        $trucks = \App\Models\Truck::where('company_id', auth()->guard('company')->id())->get();
        return view('pages.drivers.create', compact('trucks'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'driver_name' => 'required|string|max:255',
            'email'       => 'required|email|unique:drivers,email',
            'phone'       => 'required|string|max:20|unique:drivers,phone',
            'address'     => 'nullable|string|max:255',
            'password'    => 'required|string|min:6|confirmed',
            'truck_id'    => 'nullable|exists:trucks,id',
        ]);

        $validated['password'] = bcrypt($validated['password']);
        $validated['company_id'] = auth()->guard('company')->id();

        $driver = \App\Models\Driver::create($validated);

        \App\Http\Controllers\NotificationController::create(
            'system',
            "👤 تمت إضافة السائق [{$driver->driver_name}] إلى أسطولكم",
            $driver->company_id,
            \App\Models\Company::class
        );

        return redirect()->route('drivers.index')->with('success', 'تمت إضافة السائق بنجاح!');
    }

    public function tasks($id)
    {
        $driver = Driver::with('tasks')->findOrFail($id);
        $tasks = $driver->tasks;
        return view('pages.drivers.tasks', compact('driver', 'tasks'));
    }
    public function show($id)
    {
        $driver = \App\Models\Driver::with(['company', 'truck', 'tasks'])->findOrFail($id);
        return view('drivers.show', compact('driver'));
    }
    public function edit($id)
    {
        $driver = \App\Models\Driver::findOrFail($id);
        $trucks = \App\Models\Truck::where('company_id', auth()->guard('company')->id())->get();
        return view('pages.drivers.edit', compact('driver', 'trucks'));
    }
    public function destroy($id)
    {
        $driver = \App\Models\Driver::findOrFail($id);
        $driver->delete();
        return redirect()->route('drivers.index')->with('success', 'تم حذف السائق بنجاح!');
    }
    public function update(Request $request, $id)
    {
        $driver = \App\Models\Driver::findOrFail($id);

        $validated = $request->validate([
            'driver_name' => 'required|string|max:255',
            'email'       => 'required|email|unique:drivers,email,' . $driver->id,
            'phone'       => 'required|string|max:20|unique:drivers,phone,' . $driver->id,
            'address'     => 'nullable|string|max:255',
            'truck_id'    => 'nullable|exists:trucks,id',
            'password'    => 'nullable|string|min:6|confirmed',
        ]);

        if ($request->filled('password')) {
            $validated['password'] = bcrypt($request->password);
        } else {
            unset($validated['password']);
        }

        $driver->update($validated);

        return redirect()->route('drivers.index')->with('success', 'تم تحديث بيانات السائق بنجاح!');
    }
}

