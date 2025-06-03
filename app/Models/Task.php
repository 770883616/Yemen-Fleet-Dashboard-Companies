<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'deadline',
        'status',
        'driver_id',
        'truck_id',
        'destination_id'
    ];

    protected $casts = [
        'deadline' => 'datetime'
    ];

    // العلاقات
    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id');
    }

    public function truck()
    {
        return $this->belongsTo(Truck::class, 'truck_id');
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class, 'destination_id');
    }

    // الوظائف
    public function assignDriver(Driver $driver)
    {
        $this->driver()->associate($driver);
        return $this->save();
    }

    public function assignTruck(Truck $truck)
    {
        $this->truck()->associate($truck);
        return $this->save();
    }

    public function updateStatus($status)
    {
        $this->update(['status' => $status]);

        if ($status === 'completed') {
            $this->driver->notifications()->create([
                'message' => "تم إكمال المهمة: {$this->name}",
                'is_read' => false
            ]);
        }

        return $this;
    }

    public function viewDetails()
    {
        return [
            'task' => $this,
            'driver' => $this->driver,
            'truck' => $this->truck,
            'destination' => $this->destination
        ];
    }
}
