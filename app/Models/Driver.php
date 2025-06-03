<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Driver extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'driver_name',
        'email',
        'phone',
        'address',
        'password',
        'company_id',
        'truck_id', // يجب أن يكون موجوداً هنا
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // العلاقات الأساسية
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'driver_id');
    }

    // علاقة Polymorphic مع الإشعارات
    public function notifications()
    {
        return $this->morphMany(Notification::class, 'notifiable');
    }

    // الوظائف المذكورة في الكلاس دايجرام
    public function login($email, $password)
    {
        return auth()->guard('driver')->attempt([
            'email' => $email,
            'password' => $password
        ]);
    }

    public function viewAssignedTasks()
    {
        return $this->tasks()->with('destination')->get();
    }

    public function updateStatus($status)
    {
        $this->update(['status' => $status]);
        return $this;
    }

    public function receiveNotification(Notification $notification)
    {
        return $this->notifications()->create([
            'message' => $notification->message,
            'is_read' => false,
            'is_group_message' => $notification->is_group_message,
            'sender_id' => $notification->sender_id,
            'sender_type' => $notification->sender_type,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
    public function firstTruck()
    {
        return $this->trucks->first();
    }
    public function scopeWithTruck($query, $truckId)
    {
        return $query->whereHas('trucks', function ($q) use ($truckId) {
            $q->where('truck_id', $truckId);
        });
    }
    public function truck()
    {
        return $this->belongsTo(Truck::class, 'truck_id');
    }
    public function heartSensor()
    {
        return $this->hasOne(\App\Models\Sensor::class, 'driver_id')->where('name', 'heart_rate');
    }

    public static function getDriversWithTasksAndLatestHeartRate()
    {
        return self::with(['tasks', 'heartSensor.sensorData' => function($q) {
            $q->latest('timestamp');
        }])->get();
    }
}
