@extends('layouts.master')

@section('title', 'إضافة وجهة جديدة')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card card-statistics h-100">
            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('destinations.store') }}" method="POST" id="destinationForm">
                    @csrf

                    <div class="form-group">
                        <label>موقع الشاحنة الحالي</label>
                        <div id="map" style="height: 350px;"></div>
                        <small class="text-muted">سيتم تحديث الموقع تلقائياً عند اختيار المهمة</small>
                        <input type="hidden" name="start_coordinates" id="start_coordinates" required>
                    </div>

                    <div class="form-group">
                        <label for="start_point">نقطة البداية</label>
                        <input type="text" name="start_point" id="start_point" class="form-control" readonly required>
                    </div>

                    <div class="form-group">
                        <label for="task_id">المهمة</label>
                        <select name="task_id" id="task_id" class="form-control" required onchange="updateTruckLocation()">
                            <option value="">-- اختر مهمة --</option>
                            @foreach($tasks as $task)
                                {{-- @if($task->truck && $task->truck->gpsSensor) --}}
                                    <option value="{{ $task->id }}"
                                        data-truck-id="{{ $task->truck_id }}"
                                        data-sensor-id="{{ $task->truck->gpsSensor->id }}">
                                        {{ $task->name }} - {{ $task->truck->truck_name }} - {{ $task->driver->driver_name ?? 'بدون سائق' }}
                                    </option>
                                {{-- @endif --}}
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="order_id">الطلب</label>
                        <select name="order_id" id="order_id" class="form-control" required onchange="updateDeliveryAddress()">
                            <option value="">-- اختر طلب --</option>
                            @foreach($companyOrders as $companyOrder)
                                <option value="{{ $companyOrder->order->id }}"
                                    data-delivery-address="{{ $companyOrder->order->delivery_address }}"
                                    data-delivery-lat="{{ $companyOrder->order->delivery_latitude }}"
                                    data-delivery-lng="{{ $companyOrder->order->delivery_longitude }}">
                                    الطلب #{{ $companyOrder->order->id }} - {{ $companyOrder->order->customer->customer_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="end_point">نقطة النهاية</label>
                        <input type="text" name="end_point" id="end_point" class="form-control" readonly required>
                        <input type="hidden" name="end_lat" id="end_lat" required>
                        <input type="hidden" name="end_lng" id="end_lng" required>
                    </div>

                    <div class="form-group">
                        <label for="date">تاريخ الرحلة</label>
                        <input type="datetime-local" name="date" class="form-control" required
                               min="{{ now()->format('Y-m-d\TH:i') }}">
                    </div>

                    <button type="submit" class="btn btn-primary">حفظ الوجهة</button>
                    <a href="{{ route('destinations.index') }}" class="btn btn-secondary">إلغاء</a>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    let map, startMarker = null, endMarker = null;

    document.addEventListener("DOMContentLoaded", function () {
        initMap();
    });

    function initMap() {
        map = L.map('map').setView([15.3694, 44.1910], 7);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);
    }

    async function updateTruckLocation() {
        const taskId = document.getElementById('task_id').value;

        if (!taskId) {
            clearStartLocation();
            return;
        }

        try {
            const response = await fetch(`/admin/tasks/${taskId}/location`);
            const data = await response.json();

            if (!response.ok) {
                throw new Error(data.error || 'فشل في جلب موقع الشاحنة');
            }

            if (!data.coordinates) {
                throw new Error('الإحداثيات غير متوفرة');
            }

            // فك الإحداثيات
            const [lat, lng] = data.coordinates.split(',').map(coord => parseFloat(coord.trim()));

            if (isNaN(lat) || isNaN(lng)) {
                throw new Error('الإحداثيات غير صالحة');
            }

            const locationName = data.location || 'نقطة بداية';

            // إزالة العلامة القديمة
            if (startMarker) {
                map.removeLayer(startMarker);
                startMarker = null;
            }

            // إضافة العلامة الجديدة
            startMarker = L.marker([lat, lng], {
                icon: L.icon({
                    iconUrl: 'https://cdn-icons-png.flaticon.com/512/477/477103.png',
                    iconSize: [32, 32],
                    iconAnchor: [16, 32]
                })
            }).addTo(map).bindPopup(locationName).openPopup();

            // تحديث الخانات المخفية والنصية
            document.getElementById('start_coordinates').value = `${lat},${lng}`;
            document.getElementById('start_point').value = locationName;

            // ضبط عرض الخريطة على الموقع
            map.setView([lat, lng], 13);

        } catch (err) {
            alert('خطأ في جلب موقع الشاحنة: ' + err.message);
            clearStartLocation();
        }
    }

    function clearStartLocation() {
        if (startMarker) {
            map.removeLayer(startMarker);
            startMarker = null;
        }
        document.getElementById('start_coordinates').value = '';
        document.getElementById('start_point').value = '';
    }

    function updateDeliveryAddress() {
        const select = document.getElementById('order_id');
        const selected = select.selectedOptions[0];

        if (!selected) {
            clearEndLocation();
            return;
        }

        const address = selected.dataset.deliveryAddress || '';
        const lat = selected.dataset.deliveryLat || '';
        const lng = selected.dataset.deliveryLng || '';

        document.getElementById('end_point').value = address;
        document.getElementById('end_lat').value = lat;
        document.getElementById('end_lng').value = lng;

        if (lat && lng && !isNaN(parseFloat(lat)) && !isNaN(parseFloat(lng))) {
            const endLatLng = [parseFloat(lat), parseFloat(lng)];

            if (endMarker) {
                map.removeLayer(endMarker);
                endMarker = null;
            }

            endMarker = L.marker(endLatLng, {
                icon: L.icon({
                    iconUrl: 'https://cdn-icons-png.flaticon.com/512/1077/1077114.png',
                    iconSize: [32, 32],
                    iconAnchor: [16, 32]
                })
            }).addTo(map).bindPopup(address).openPopup();

            map.setView(endLatLng, 13);
        } else {
            clearEndLocation();
        }
    }

    function clearEndLocation() {
        if (endMarker) {
            map.removeLayer(endMarker);
            endMarker = null;
        }
        document.getElementById('end_point').value = '';
        document.getElementById('end_lat').value = '';
        document.getElementById('end_lng').value = '';
    }
</script>
@endsection
