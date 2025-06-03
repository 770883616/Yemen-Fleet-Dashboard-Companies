<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    // عرض كل الإشعارات للمستخدم الحالي
    public function index()
    {
        $alerts = \App\Models\Notification::latest()->get();
        return view('pages.Alert.index', compact('alerts'));
    }

    // تعليم إشعار كمقروء
    public function markAsRead($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->markAsRead();
        return back()->with('success', 'تم تعليم الإشعار كمقروء.');
    }

    // حذف إشعار
    public function destroy($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->delete();
        return back()->with('success', 'تم حذف الإشعار.');
    }

    // تعليم كل الإشعارات كمقروءة
    public function markAllAsRead()
    {
        $user = Auth::user();
        Notification::where('notifiable_id', $user->id)
            ->where('notifiable_type', get_class($user))
            ->update(['is_read' => true]);
        return back()->with('success', 'تم تعليم جميع الإشعارات كمقروءة.');
    }

    public function showAlerts()
    {
        $alerts = Notification::latest()->get();
        return view('pages.Alert.index', compact('alerts'));
    }

    public static function create($type, $message, $notifiable_id, $notifiable_type, $extra = [])
    {
        $company = auth('company')->user();

        \App\Models\Notification::create([
            'message' => $message,
            'is_read' => false,
            'is_group_message' => false,
            'notifiable_id' => $notifiable_id,
            'notifiable_type' => $notifiable_type,
            'sender_type' => get_class($company),
            'sender_id' => $company->id,
            // إذا أضفت عمود extra_data:
            // 'extra_data' => json_encode($extra),
        ]);
    }
}
