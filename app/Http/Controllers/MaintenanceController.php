<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\Truck;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    // عرض جميع عمليات الصيانة
    public function index()
    {
        $maintenances = Maintenance::with('truck')->orderByDesc('date')->paginate(15);
        return view('pages.Maintenance.index', compact('maintenances'));
    }

    // عرض نموذج إضافة صيانة جديدة
    public function create()
    {
        $trucks = Truck::all();
        return view('pages.Maintenance.create', compact('trucks'));
    }

    // حفظ عملية الصيانة الجديدة
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string|max:255',
            'cost' => 'required|numeric|min:0',
            'date' => 'required|date',
            'description' => 'nullable|string',
            'truck_id' => 'required|exists:trucks,id',
        ]);

        $maintenance = Maintenance::create($request->all());

        return redirect()->route('maintenances.index')->with('success', 'تمت إضافة عملية الصيانة بنجاح');
    }

    // عرض تفاصيل عملية صيانة واحدة
    public function show($id)
    {
        $maintenance = Maintenance::with('truck')->findOrFail($id);
        return view('pages.Maintenance.show', compact('maintenance'));
    }

    // عرض نموذج تعديل عملية صيانة
    public function edit($id)
    {
        $maintenance = Maintenance::findOrFail($id);
        $trucks = Truck::all();
        return view('pages.Maintenance.edit', compact('maintenance', 'trucks'));
    }

    // تحديث بيانات عملية الصيانة
    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required|string|max:255',
            'cost' => 'required|numeric|min:0',
            'date' => 'required|date',
            'description' => 'nullable|string',
            'truck_id' => 'required|exists:trucks,id',
        ]);

        $maintenance = Maintenance::findOrFail($id);
        $maintenance->update($request->all());

        return redirect()->route('maintenances.index')->with('success', 'تم تحديث بيانات الصيانة بنجاح');
    }

    // حذف عملية صيانة
    public function destroy($id)
    {
        $maintenance = Maintenance::findOrFail($id);
        $maintenance->delete();

        return redirect()->route('maintenances.index')->with('success', 'تم حذف عملية الصيانة بنجاح');
    }
}
