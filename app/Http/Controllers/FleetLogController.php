<?php
namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\Accident;
use App\Models\Truck;
use Illuminate\Http\Request;

class FleetLogController extends Controller
{
    public function index(Request $request)
    {
        $truckId = $request->input('truck_id');
        $dateFrom = $request->input('date_from');
        $dateTo = $request->input('date_to');

        $maintenancesQuery = Maintenance::with('truck');
        if ($truckId) $maintenancesQuery->where('truck_id', $truckId);
        if ($dateFrom) $maintenancesQuery->whereDate('date', '>=', $dateFrom);
        if ($dateTo) $maintenancesQuery->whereDate('date', '<=', $dateTo);
        $maintenances = $maintenancesQuery->orderByDesc('date')->paginate(10);

        $accidentsQuery = Accident::with('truck');
        if ($truckId) $accidentsQuery->where('truck_id', $truckId);
        if ($dateFrom) $accidentsQuery->whereDate('date', '>=', $dateFrom);
        if ($dateTo) $accidentsQuery->whereDate('date', '<=', $dateTo);
        $accidents = $accidentsQuery->orderByDesc('date')->paginate(10);

        $trucks = Truck::all();

        return view('pages.Fleet.maintenance_accidents', compact('maintenances', 'accidents', 'trucks'));
    }
}
