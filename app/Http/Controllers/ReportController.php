<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    // عرض قائمة التقارير
    public function index()
    {
        // جلب بيانات التقارير مع العلاقات المرتبطة
        $reports = Report::with(['maintenance', 'company'])->latest()->paginate(10);

        // عرض صفحة التقارير
        return view('pages.Report.index', compact('reports'));
    }
}
