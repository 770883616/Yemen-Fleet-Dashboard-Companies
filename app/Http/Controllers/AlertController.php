<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use Illuminate\Http\Request;

class AlertController extends Controller
{
    // عرض قائمة الإشعارات
    public function index()
    {
        $alerts = \App\Models\Notification::latest()->get();
        return view('pages.Alert.index', compact('alerts'));
    }
}
