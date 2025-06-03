<?php

namespace App\Http\Controllers;

use App\Models\ObdDevice;
use App\Models\Truck;
use App\Models\Company;
use Illuminate\Http\Request;

class ObdDeviceController extends Controller
{
    // عرض كل الأجهزة
    public function index()
    {
        $devices = ObdDevice::with(['truck', 'company'])->get();
        return view('pages.ObdDevice.index', compact('devices'));
    }

    // عرض فورم الإضافة
    public function create()
    {
        $companies = Company::all();
        $trucks = Truck::doesntHave('obdDevice')->get(); // كل شاحنة ما عندها جهاز
        return view('pages.ObdDevice.create', compact('companies', 'trucks'));
    }

    // حفظ جهاز جديد
    public function store(Request $request)
    {
        $validated = $request->validate([
            'device_name' => 'required|string|max:100',
            'device_type' => 'required|in:OBD-II,ELM327,MCP2515',
            'truck_id' => 'required|exists:trucks,id|unique:obd_devices,truck_id',
            'company_id' => 'required|exists:companies,id',
        ]);

        ObdDevice::create($validated);

        return redirect()->route('obd.index')->with('success', 'تمت إضافة الجهاز بنجاح!');
    }

    // عرض تفاصيل جهاز (اختياري)
    public function show($id)
    {
        $device = ObdDevice::with(['truck', 'company'])->findOrFail($id);
        return view('pages.ObdDevice.show', compact('device'));
    }

    // عرض فورم التعديل
    public function edit($id)
    {
        $device = ObdDevice::findOrFail($id);
        $companies = Company::all();
        $trucks = Truck::all();
        return view('pages.ObdDevice.edit', compact('device', 'companies', 'trucks'));
    }

    // تحديث بيانات الجهاز
    public function update(Request $request, $id)
    {
        $device = ObdDevice::findOrFail($id);

        $validated = $request->validate([
            'device_name' => 'required|string|max:100',
            'device_type' => 'required|in:OBD-II,ELM327,MCP2515',
            'truck_id' => 'required|exists:trucks,id|unique:obd_devices,truck_id,' . $device->id,
            'company_id' => 'required|exists:companies,id',
        ]);

        $device->update($validated);

        return redirect()->route('obd.index')->with('success', 'تم تعديل بيانات الجهاز بنجاح!');
    }

    // حذف الجهاز
    public function destroy($id)
    {
        $device = ObdDevice::findOrFail($id);
        $device->delete();

        return redirect()->route('obd.index')->with('success', 'تم حذف الجهاز بنجاح!');
    }
}
