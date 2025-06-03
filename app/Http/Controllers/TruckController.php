<?php

namespace App\Http\Controllers;

use App\Models\Truck;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TruckController extends Controller
{
    /**
     * عرض قائمة جميع الشاحنات
     */
    public function index()
    {
        $company = auth()->guard('company')->user(); // الشركة الحالية
        $trucks = Truck::where('company_id', $company->id)->get(); // مركبات الشركة فقط
        return view('pages.Trucks.index', compact('trucks'));
    }


    /**
     * عرض نموذج إضافة شاحنة جديدة
     */
    public function create()
    {
        $companies = Company::all();
        return view('pages.Trucks.create', compact('companies'));
    }

    // حفظ الشاحنة في قاعدة البيانات
    public function store(Request $request)
    {
        $company = auth()->guard('company')->user();

        $validated = $request->validate([
            'truck_name'      => 'required|string|max:255',
            'plate_number'    => 'required|string|unique:trucks,plate_number',
            'chassis_number'  => 'required|string|unique:trucks,chassis_number',
            'vehicle_status'  => 'required|in:نشطة,متوقفة,تحت الصيانة',
            // لا تطلب company_id من الفورم، اربطه بالشركة الحالية
        ]);
        $validated['company_id'] = $company->id;

        $truck = \App\Models\Truck::create($validated);

        \App\Http\Controllers\NotificationController::create(
            'system',
            "🚚 تمت إضافة الشاحنة [{$truck->truck_name}] إلى الأسطول",
            $truck->company_id,
            \App\Models\Company::class
        );

        return redirect()->route('trucks.index')->with('success', 'تمت إضافة الشاحنة بنجاح!');
    }

    // عرض تفاصيل شاحنة واحدة
    public function show($id)
    {
        $truck = Truck::with('sensors.sensorData')->findOrFail($id);


            $obdData = \App\Models\SensorData::whereIn('sensor_id', $truck->sensors->pluck('id'))
        ->whereNotNull('obd_code')
        ->orderBy('obd_code')
        ->orderByDesc('timestamp')
        ->get()
        ->unique('obd_code')
        ->values();

        // آخر بيانات GPS
        $gpsSensor = $truck->sensors()->where('name', 'gps')->first();
        $gpsData = $gpsSensor ? $gpsSensor->sensorData()->latest('timestamp')->first() : null;

        // آخر بيانات الطقس
        $weatherSensor = $truck->sensors()->where('name', 'weather')->first();
        $weatherData = $weatherSensor ? $weatherSensor->sensorData()->latest('timestamp')->first() : null;

        // آخر بيانات نبض القلب
        $heartSensor = $truck->sensors()->where('name', 'heart_rate')->first();
        $heartData = $heartSensor ? $heartSensor->sensorData()->latest('timestamp')->first() : null;

        return view('pages.Trucks.show', compact('truck', 'gpsData', 'weatherData', 'heartData', 'obdData'));
    }

    // عرض فورم تعديل الشاحنة
    public function edit($id)
    {
        $truck = Truck::findOrFail($id);
        $companies = Company::all();
        return view('pages.Trucks.edit', compact('truck', 'companies'));
    }

    // تحديث بيانات الشاحنة
    public function update(Request $request, $id)
    {
        $truck = Truck::findOrFail($id);

        $validated = $request->validate([
            'truck_name' => 'required|string|max:255',
            'plate_number' => 'required|string|unique:trucks,plate_number,' . $truck->id,
            'chassis_number' => 'required|string',
            'company_id' => 'required|exists:companies,id',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'vehicle_status' => 'nullable|in:نشطة,متوقفة,تحت الصيانة',
        ]);

        $truck->update($validated);

        return redirect()->route('trucks.index')->with('success', 'تم تعديل بيانات الشاحنة بنجاح!');
    }

    // حذف الشاحنة
    public function destroy($id)
    {
        $truck = Truck::findOrFail($id);
        $truck->delete();

        return redirect()->route('trucks.index')->with('success', 'تم حذف الشاحنة بنجاح!');
    }

    // عرض قائمة الشاحنات عبر API
    public function apiIndex()
    {
        $trucks = \App\Models\Truck::with('company')->get();
        return response()->json(['trucks' => $trucks]);
    }
}
