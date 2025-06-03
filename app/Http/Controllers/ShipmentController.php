<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use App\Models\Truck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShipmentController extends Controller
{
    // عرض قائمة الشحنات مع الإحصائيات
    public function index(Request $request)
    {
        $query = Shipment::with('truck');

        // فلترة حسب الشاحنة
        if ($request->filled('truck_id')) {
            $query->where('truck_id', $request->truck_id);
        }

        // فلترة حسب التاريخ
        if ($request->filled('shipping_date')) {
            $query->whereDate('shipping_date', $request->shipping_date);
        }

        // بحث عام (مثلاً برقم الشحنة)
        if ($request->filled('search')) {
            $query->where('id', $request->search);
        }

        $shipments = $query->latest()->paginate(15);
        $trucks = Truck::all();

        return view('pages.Shipment.index', compact('shipments', 'trucks'));
    }

    // صفحة إضافة شحنة
    public function create()
    {
        $trucks = \App\Models\Truck::all();
        $drivers = \App\Models\Driver::all();
        return view('pages.Shipment.create', compact('trucks', 'drivers'));
    }

    // حفظ شحنة جديدة
    public function store(Request $request)
    {
        $validated = $request->validate([
            'shipment_type' => 'required',
            'status'        => 'required',
            'destination'   => 'required',
            'truck_id'      => 'required|exists:trucks,id',
            'order_id'      => 'required|exists:orders,id',
            'start_latitude' => 'nullable|numeric',
            'start_longitude' => 'nullable|numeric',
            'end_address'   => 'nullable|string',
            'estimated_time'=> 'nullable|integer',
        ]);
        Shipment::create($validated);
        return redirect()->route('shipments.index')->with('success', 'تمت إضافة الشحنة بنجاح');
    }

    // صفحة تفاصيل الشحنة
    public function show($id)
    {
        $shipment = DB::table('shipments')
            ->leftJoin('trucks', 'shipments.truck_id', '=', 'trucks.id')
            ->leftJoin('drivers', 'drivers.truck_id', '=', 'trucks.id')
            ->select(
                'shipments.*',
                'trucks.truck_name',
                'trucks.plate_number',
                'drivers.driver_name as driver_name'
            )
            ->where('shipments.id', $id)
            ->first();

        return view('pages.Shipment.show', compact('shipment'));
    }
}
