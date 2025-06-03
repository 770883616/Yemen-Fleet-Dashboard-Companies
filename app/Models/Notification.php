<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
        'is_read',
        'is_group_message',
        'notifiable_id',
        'notifiable_type',
        'sender_type',
        'sender_id',
        // 'extra_data', // إذا أضفت هذا العمود
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'is_group_message' => 'boolean'
    ];

    // Polymorphic Relations
    public function notifiable()
    {
        return $this->morphTo();
    }

    public function sender()
    {
        return $this->morphTo();
    }

    // الوظائف
    public function send()
    {
        // إرسال الإشعار عبر القنوات المختلفة
        return $this->save();
    }

    public function markAsRead()
    {
        $this->update(['is_read' => true]);
        return $this;
    }

    public static function filterByReceiver($type, $id)
    {
        return self::where('notifiable_type', $type)
                 ->where('notifiable_id', $id)
                 ->get();
    }
}
