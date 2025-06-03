<?php

namespace App\Http\Controllers;

use App\Models\Sensor;
use App\Models\Truck;
use Illuminate\Http\Request;

class SensorController extends Controller
{
    public function index()
    {
        $sensors = Sensor::with('truck')->latest()->paginate(20);
        return view('pages.Sensors.index', compact('sensors'));
    }

    public function create()

    {
        $trucks = Truck::all();
        return view('pages.Sensors.create', compact('trucks'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'truck_id' => 'required|exists:trucks,id',
            'name'     => 'required|string|max:100',
            'type'     => 'required|string|max:100',
        ]);
        Sensor::create($validated);
        return redirect()->route('sensors.index')->with('success', 'تمت إضافة الحساس بنجاح!');
    }

    public function edit($id)
    {
        $sensor = Sensor::findOrFail($id);
        $trucks = Truck::all();
        return view('pages.Sensors.edit', compact('sensor', 'trucks'));
    }

    public function update(Request $request, $id)
    {
        $sensor = Sensor::findOrFail($id);
        $validated = $request->validate([
            'truck_id' => 'required|exists:trucks,id',
            'name'     => 'required|string|max:100',
            'type'     => 'required|string|max:100',
        ]);
        $sensor->update($validated);
        return redirect()->route('sensors.index')->with('success', 'تم تعديل بيانات الحساس بنجاح!');
    }

    public function destroy($id)
    {
        $sensor = Sensor::findOrFail($id);
        $sensor->delete();
        return redirect()->route('sensors.index')->with('success', 'تم حذف الحساس بنجاح!');
    }
}
