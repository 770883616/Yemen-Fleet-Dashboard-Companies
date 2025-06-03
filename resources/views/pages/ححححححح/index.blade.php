@extends('layouts.master')

@section('title', 'قائمة الحوادث')

@section('content')
<div class="row">
    <div class="col-12 mb-3">
        <a href="{{ route('accidents.create') }}" class="btn btn-success">➕ تسجيل حادث جديد</a>
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
                                <th>نوع الحادث</th>
                                <th>الموقع</th>
                                <th>التاريخ</th>
                                <th>العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($accidents as $index => $accident)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $accident->truck->truck_name }}</td>
                                    <td>{{ $accident->type }}</td>
                                    <td>{{ $accident->location }}</td>
                                    <td>{{ $accident->date->format('Y-m-d H:i') }}</td>
                                    <td>
                                        <a href="{{ route('accidents.edit', $accident->id) }}" class="btn btn-primary btn-sm">تعديل</a>
                                        <form action="{{ route('accidents.destroy', $accident->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد من الحذف؟')">حذف</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="6">لا توجد حوادث مسجلة</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
