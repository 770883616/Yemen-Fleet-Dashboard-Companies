<?php

namespace App\Http\Controllers;

use App\Models\Accident;
use App\Models\Truck;
use Illuminate\Http\Request;

class AccidentController extends Controller
{
    public function index()
    {
        $accidents = Accident::with('truck')->latest()->get();
        return view('pages.Accident.index', compact('accidents'));
    }

    public function create()
    {
        $trucks = Truck::all();
        return view('pages.Accident.create', compact('trucks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'location' => 'required|string|max:255',
            'accident_type' => 'required|in:الاصطدام,الانهيار,اخرى',
            'accident_date' => 'required|date',
            'description' => 'required|string',
            'truck_id' => 'required|exists:trucks,id',
        ]);

        Accident::create($request->all());

        return redirect()->route('accidents.index')->with('success', 'تمت إضافة الحادث بنجاح ✅');
    }

    public function edit($id)
    {
        $accident = Accident::findOrFail($id);
        $trucks = Truck::all();
        return view('pages.Accident.edit', compact('accident', 'trucks'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'location' => 'required|string|max:255',
            'accident_type' => 'required|in:الاصطدام,الانهيار,اخرى',
            'accident_date' => 'required|date',
            'description' => 'required|string',
            'truck_id' => 'required|exists:trucks,id',
        ]);

        $accident = Accident::findOrFail($id);
        $accident->update($request->all());

        return redirect()->route('accidents.index')->with('success', 'تم تحديث الحادث بنجاح 🔄');
    }

    public function destroy($id)
    {
        $accident = Accident::findOrFail($id);
        $accident->delete();

        return redirect()->route('accidents.index')->with('success', 'تم حذف الحادث بنجاح 🗑️');
    }
}
