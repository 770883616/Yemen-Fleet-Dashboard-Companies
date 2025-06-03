@extends('layouts.master')

@section('title')
    قائمة الشاحنات
@stop

@section('css')
<!-- يمكنك إضافة CSS إضافي هنا -->
@endsection

@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    قائمة الشاحنات
@stop
<!-- breadcrumb -->
@endsection

@section('content')
<!-- row -->
<div class="row">
    <div class="col-12 mb-3">
        <a href="{{ route('trucks.create') }}" class="btn btn-success">➕ إضافة شاحنة جديدة</a>
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
                                <th>اسم الشاحنة</th>
                                <th>رقم اللوحة</th>
                                <th>رقم الشاسيه</th>
                                <th>الحالة</th>
                                <th>الموقع</th>
                                <th>الحساسات وآخر قراءة</th>
                                <th>العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($trucks as $index => $truck)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $truck->truck_name }}</td>
                                    <td>{{ $truck->plate_number }}</td>
                                    <td>{{ $truck->chassis_number }}</td>
                                    <td>{{ $truck->vehicle_status ?? 'غير معروف' }}</td>
                                    <td>

                                        @php
                                            // جلب حساس GPS المرتبط بهذه الشاحنة
                                            $gpsSensor = $truck->sensors->where('name', 'gps')->first();
                                            // جلب آخر قراءة GPS من جدول sensor_data
                                            $gpsData = $gpsSensor ? $gpsSensor->sensorData()->orderByDesc('timestamp')->first() : null;
                                            $location = $gpsData->location ?? null;
                                        @endphp
                                        @if($location)
                                            <a href="https://maps.google.com/?q={{ $location }}" target="_blank">{{ $location }}</a>
                                        @else
                                            غير متوفر
                                        @endif
                                    </td>
                                    <td>
                                        {{-- الحساسات وآخر قراءة --}}
                                        @if($truck->sensors && $truck->sensors->count())
                                            @foreach($truck->sensors as $sensor)
                                                @php
                                                    $lastData = $sensor->sensorData()->latest('timestamp')->first();
                                                @endphp
                                                <div>
                                                    <span class="badge badge-primary">{{ $sensor->type }}</span>
                                                    @if($lastData)
                                                        <span class="badge badge-light">{{ json_encode($lastData->value) }}</span>
                                                        <small class="text-muted d-block">{{ $lastData->timestamp }}</small>
                                                    @else
                                                        <span class="text-muted">لا توجد بيانات</span>
                                                    @endif
                                                </div>
                                            @endforeach
                                        @else
                                            <span class="text-muted">لا يوجد حساس</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('trucks.show', $truck->id) }}" class="btn btn-primary btn-sm">تفاصيل</a>
                                        <a href="{{ route('trucks.edit', $truck->id) }}" class="btn btn-info btn-sm">تعديل</a>
                                        <form action="{{ route('trucks.destroy', $truck->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('هل أنت متأكد من الحذف؟')">حذف</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">لا توجد شاحنات مسجلة حالياً</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    {{-- <div class="col-12">
        @forelse($trucks as $truck)
            <div class="card mt-4">
                <div class="card-header">بيانات الحساسات للمركبة: {{ $truck->plate_number ?? $truck->id }}</div>
                <div class="card-body">
                    @forelse($truck->sensors as $sensor)
                        <h5 class="mt-3 mb-2">الحساس: {{ $sensor->name ?? $sensor->id }}</h5>
                        <table class="table table-bordered text-center mb-4">
                            <thead>
                                <tr>
                                    <th>OBD Code</th>
                                    <th>القيمة</th>
                                    <th>الوقت</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($sensor->sensorData as $data)
                                    <tr>
                                        <td>{{ $data->obd_code }}</td>
                                        <td>{{ is_array($data->value) ? json_encode($data->value) : $data->value }}</td>
                                        <td>{{ $data->timestamp }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">لا توجد بيانات لهذا الحساس</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    @empty
                        <div class="text-muted">لا توجد حساسات لهذه المركبة</div>
                    @endforelse
                </div>
            </div>
        @empty
            <div class="text-muted">لا توجد شاحنات لعرض بيانات الحساسات</div>
        @endforelse
    </div> --}}
</div>
<!-- row closed -->
@endsection

@section('js')
<!-- يمكنك إضافة JS إضافي هنا -->
@endsection
