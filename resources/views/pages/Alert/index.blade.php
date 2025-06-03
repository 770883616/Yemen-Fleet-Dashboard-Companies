@extends('layouts.master')

@section('title', 'جميع الإشعارات')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">جميع الإشعارات</h2>
    <div class="notifications-container">
        @forelse($alerts as $alert)
            <div class="notification-item d-flex align-items-start mb-3 p-3 border rounded">
                <div class="icon bg-primary text-white rounded-circle mr-3">
                    <i class="ti-bell"></i>
                </div>
                <div>
                    <h6 class="mb-1">{{ $alert->type ?? '-' }}</h6>
                    <p class="mb-0 text-muted">{{ $alert->message ?? '-' }}</p>
                    <small class="text-muted">
                        تاريخ الإرسال:
                        {{ $alert->created_at ? $alert->created_at->format('Y-m-d H:i') : '-' }}
                    </small>
                </div>
            </div>
        @empty
            <div class="text-center">لا توجد إشعارات</div>
        @endforelse
    </div>
</div>
@endsection
