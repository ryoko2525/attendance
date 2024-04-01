<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Work;


class UserController extends Controller
{
     public function show()

    {
        return view('auth.register');
    }
    
    public function index()
    {
        // ユーザーをページネーションで取得（1ページあたり5件）
        $users = User::paginate(5);

        // index.blade.php ビューにデータを渡して表示
        return view('users.index', compact('users'));
    }

    public function showAttendance($userId)
    {
        $user = User::findOrFail($userId);
        $attendances = $user->works()->with('breakTimes')->paginate(5);

        foreach ($attendances as $attendance) {
            // 休憩時間の合計を秒から分に変換してセット
            $attendance->total_break_time = $attendance->calculateTotalBreakDurationInSeconds() / 60;

            // 勤務時間を秒から時間に変換してセット
            $attendance->total_work_time = $attendance->getWorkDurationAttribute() / 3600;
        }

        return view('users.attendance', compact('user', 'attendances'));
    }
}