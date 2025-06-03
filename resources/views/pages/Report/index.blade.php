@extends('layouts.master')

@section('title', 'قائمة التقارير')

@section('content')
<div class="row">
    <!-- محتوى التقارير -->
    <div class="col-md-9 order-md-2">
        <h2>قائمة التقارير</h2>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>عنوان التقرير</th>
                    <th>نوع التقرير</th>
                    <th>التفاصيل</th>
                    <th>التاريخ</th>
                    <th>الحالة</th>
                    <th>الشركة</th>
                    <th>الصيانة</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reports as $report)
                    <tr>
                        <td>{{ $report->title }}</td>
                        <td>{{ $report->report_type }}</td>
                        <td>{{ $report->details }}</td>
                        <td>{{ $report->report_date }}</td>
                        <td>{{ $report->status }}</td>
                        <td>{{ $report->company->name ?? 'غير معروف' }}</td>
                        <td>{{ $report->maintenance->maintenance_type ?? 'غير معروف' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">لا توجد تقارير</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{ $reports->links() }}
    </div>
</div>
@endsection
