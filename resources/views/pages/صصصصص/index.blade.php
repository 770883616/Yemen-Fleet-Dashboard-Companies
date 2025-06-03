@extends('layouts.master')

@section('title', 'قائمة عمليات الصيانة')

@section('content')
<div class="row">
    <div class="col-12 mb-3">
        <a href="{{ route('maintenances.create') }}" class="btn btn-success">➕ إضافة صيانة جديدة</a>
    </div>

    <div class="col-12">
        <div class="card card-statistics h-100">
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="table-responsive">
                    <table class="table table-bordered text-center">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>الشاحنة</th>
                                <th>نوع الصيانة</th>
                                <th>التكلفة</th>
                                <th>التاريخ</th>
                                <th>الحالة</th>
                                <th>العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($maintenances as $index => $maintenance)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $maintenance->truck->truck_name }}</td>
                                    <td>{{ $maintenance->type }}</td>
                                    <td>{{ number_format($maintenance->cost, 2) }} ر.س</td>
                                    <td>{{ $maintenance->date->format('Y-m-d H:i') }}</td>
                                    <td>
                                        @if($maintenance->date > now())
                                            <span class="badge badge-warning">مستقبلية</span>
                                        @else
                                            <span class="badge badge-success">مكتملة</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('maintenances.show', $maintenance->id) }}" class="btn btn-info btn-sm">عرض</a>
                                        <a href="{{ route('maintenances.edit', $maintenance->id) }}" class="btn btn-primary btn-sm">تعديل</a>
                                        <form action="{{ route('maintenances.destroy', $maintenance->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد من الحذف؟')">حذف</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="7">لا توجد عمليات صيانة مسجلة</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{ $maintenances->links() }}
            </div>
        </div>
    </div>
</div>
@endsection