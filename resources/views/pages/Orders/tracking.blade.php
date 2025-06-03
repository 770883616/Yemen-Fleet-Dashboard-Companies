{{-- filepath: resources/views/pages/Orders/tracking.blade.php --}}
@extends('layouts.master')
@section('title', 'تتبع الشحنة')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>تتبع الشحنة للطلب رقم: {{ $order->id }}</h4>
    </div>
    <div class="card-body">
        <div id="map" style="height: 400px;"></div>
        <hr>
        <div>
            <strong>موقع السائق الحالي:</strong>
            @if($lastLocation)
                {{ $lastLocation }}
            @else
                غير متوفر حالياً
            @endif
        </div>
        <div>
            <strong>موقع العميل:</strong>
            {{ $order->destination->end_point ?? '-' }}
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY"></script>
<script>
    // مثال بسيط لرسم الموقعين على الخريطة
    document.addEventListener('DOMContentLoaded', function () {
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 10,
            center: {lat: 15.369874, lng: 44.191237} // يمكنك ضبطها ديناميكياً
        });

        @if($lastLocation)
            var loc = "{{ $lastLocation }}".split(',');
            var driverLatLng = {lat: parseFloat(loc[0]), lng: parseFloat(loc[1])};
            new google.maps.Marker({position: driverLatLng, map: map, label: '🚚'});
            map.setCenter(driverLatLng);
        @endif

        @if($order->destination)
            // مثال: إذا كان لديك إحداثيات النهاية
            // var clientLatLng = {lat: ..., lng: ...};
            // new google.maps.Marker({position: clientLatLng, map: map, label: '🏁'});
        @endif
    });

    // يمكنك إضافة AJAX لتحديث الموقع كل 30 ثانية
</script>
@endsection
