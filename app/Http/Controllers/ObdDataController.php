<?php

namespace App\Http\Controllers;

use App\Models\ObdData;
use App\Models\ObdDevice;
use Illuminate\Http\Request;

class ObdDataController extends Controller
{
    // عرض كل البيانات
    public function index()
    {
        $data = ObdData::with('device')->latest()->get();
        return view('pages.Obd_data.index', compact('data'));
    }

    // عرض فورم الإضافة
    public function create()
    {
        $devices = ObdDevice::all();
        return view('pages.Obd_data.create', compact('devices'));
    }

    // حفظ بيانات جديدة
    public function store(Request $request)
    {
        $validated = $request->validate([
            'rpm' => 'required|integer|min:0',
            'engine_temp' => 'required|numeric',
            'error_codes' => 'required|array',
            'device_id' => 'required|exists:obd_devices,id',
        ]);

        $validated['error_codes'] = json_encode($validated['error_codes']);
        $validated['timestamp'] = now();

        ObdData::create($validated);

        return redirect()->route('obd_data.index')->with('success', 'تمت إضافة البيانات بنجاح!');
    }

    // عرض تفاصيل سجل واحد (اختياري)
    public function show($id)
    {
        $record = ObdData::with('device')->findOrFail($id);
        return view('pages.Obd_data.show', compact('record'));
    }

    // عرض فورم التعديل
    public function edit($id)
    {
        $record = ObdData::findOrFail($id);
        $devices = ObdDevice::all();
        return view('pages.Obd_data.edit', compact('record', 'devices'));
    }

    // تعديل البيانات
    public function update(Request $request, $id)
    {
        $record = ObdData::findOrFail($id);

        $validated = $request->validate([
            'rpm' => 'required|integer|min:0',
            'engine_temp' => 'required|numeric',
            'error_codes' => 'required|array',
            'device_id' => 'required|exists:obd_devices,id',
        ]);

        $validated['error_codes'] = json_encode($validated['error_codes']);
        $validated['timestamp'] = now();

        $record->update($validated);

        return redirect()->route('obd_data.index')->with('success', 'تم تحديث البيانات بنجاح!');
    }

    // حذف السجل
    public function destroy($id)
    {
        $record = ObdData::findOrFail($id);
        $record->delete();

        return redirect()->route('obd_data.index')->with('success', 'تم حذف السجل بنجاح!');
    }
}
