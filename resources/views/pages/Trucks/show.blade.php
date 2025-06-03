@extends('layouts.master')
@section('title', 'تفاصيل الشاحنة')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>تفاصيل الشاحنة: {{ $truck->truck_name }}</h4>
    </div>
    <div class="card-body">
        <ul>
            <li><strong>رقم اللوحة:</strong> {{ $truck->plate_number }}</li>
            <li><strong>رقم الشاسيه:</strong> {{ $truck->chassis_number }}</li>
            <li><strong>الحالة:</strong> {{ $truck->vehicle_status }}</li>
        </ul>
        <hr>
        <h5>الموقع الحالي:</h5>
        @if($gpsData && $gpsData->location)
            <div>الإحداثيات: {{ $gpsData->location }}</div>
            <iframe
                width="100%"
                height="300"
                frameborder="0"
                style="border:0"
                src="https://maps.google.com/maps?q={{ $gpsData->location }}&z=15&output=embed"
                allowfullscreen>
            </iframe>
        @else
            <div class="text-muted">لا توجد بيانات GPS حالياً</div>
        @endif

        <hr>
        <h5>حالة الطقس:</h5>
        @if($weatherData)
            <div>
                <strong>درجة الحرارة:</strong> {{ $weatherData->value['temperature'] ?? '-' }}<br>
                <strong>الرطوبة:</strong> {{ $weatherData->value['humidity'] ?? '-' }}
            </div>
        @else
            <div class="text-muted">لا توجد بيانات طقس حالياً</div>
        @endif

        <hr>
        <h5>نبض قلب السائق:</h5>
        @if($heartData)
            <div>
                <strong>نبض القلب:</strong> {{ $heartData->heart_rate ?? ($heartData->value['heart_rate'] ?? '-') }}
            </div>
        @else
            <div class="text-muted">لا توجد بيانات نبض قلب حالياً</div>
        @endif

        @if($obdData->count())
            <div class="card mt-4">
                <div class="card-header">آخر بيانات OBD لكل كود</div>
                <div class="card-body">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>OBD Code</th>
                                <th>القيمة</th>
                                <th>الوقت</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($obdData as $data)
                                <tr>
                                    <td>{{ $data->obd_code }}</td>
                                    <td>{{ $data->value }}</td>
                                    <td>{{ $data->timestamp }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
