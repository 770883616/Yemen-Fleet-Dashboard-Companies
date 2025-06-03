<?php
// filepath: app/Services/NotificationService.php
namespace App\Services;

use App\Models\Notification;
use App\Models\Truck;
use App\Models\Driver;
use App\Models\Shipment;
use App\Models\Company;

class NotificationService
{
    public static function create($type, $message, $notifiable_id, $notifiable_type, $extra = [])
    {
        Notification::create([
            'message' => $message,
            'is_read' => false,
            'is_group_message' => false,
            'notifiable_id' => $notifiable_id,
            'notifiable_type' => $notifiable_type,
            // يمكنك إضافة حقول إضافية هنا حسب الحاجة
        ]);
        // يمكنك هنا أيضاً إرسال FCM أو SMS أو Email إذا أردت
    }

    // مثال: تنبيهات أعطال الشاحنات
    public static function vehicleFault($truck, $code = null, $temp = null, $fuel = null)
    {
        if ($temp && $temp > 110) {
            self::create('vehicle_fault', "🔴 تحذير: درجة حرارة المحرك مرتفعة في الشاحنة [{$truck->plate_number}]", $truck->id, Truck::class);
        }
        if ($code) {
            self::create('vehicle_fault', "🔴 عطل تم رصده في شاحنة [{$truck->plate_number}]: [$code]", $truck->id, Truck::class);
        }
        if ($fuel && $fuel < 10) {
            self::create('vehicle_fault', "⚠️ تنبيه: الشاحنة [{$truck->plate_number}] توشك على نفاد الوقود", $truck->id, Truck::class);
        }
    }

    // مثال: تنبيهات صحة السائق
    public static function driverHealth($driver, $heart = null, $bp = null)
    {
        if ($heart && ($heart > 120 || $heart < 50)) {
            self::create('driver_health', "⚠️ تنبيه: حالة غير طبيعية في نبض السائق [{$driver->driver_name}]", $driver->id, Driver::class);
        }
        if ($bp) {
            self::create('driver_health', "🔴 تحذير صحي: ضغط الدم غير مستقر للسائق [{$driver->driver_name}]", $driver->id, Driver::class);
        }
    }

    // ... أضف باقي الفئات بنفس الطريقة
}
