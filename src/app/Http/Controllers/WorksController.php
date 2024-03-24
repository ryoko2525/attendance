<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Work;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class WorksController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->withErrors('You must be logged in.');
        }

        $works = Work::where('user_id', $user->id)->paginate(5);
        return view('index', compact('works'));
    }

    public function show($date)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->withErrors('You must be logged in.');
        }

        $works = Work::with(['breakTimes']) // 休憩時間のリレーションを事前に読み込む
        ->where('user_id', $user->id)
        ->whereDate('work_date', $date)
        ->paginate(5);
        // 各勤務記録に対して勤務時間と休憩時間を計算
        foreach ($works as $work) {
            $totalBreakDuration = $work->breakTimes->sum(function ($break) {
                return Carbon::parse($break->end_time)->diffInSeconds(Carbon::parse($break->start_time));
            });
            $workDuration = 0;
            if (!empty($work->end_time)) {
                $workDuration = Carbon::parse($work->end_time)->diffInSeconds(Carbon::parse($work->start_time)) - $totalBreakDuration;
            }
            $work->total_break_duration = $totalBreakDuration;
            $work->work_duration = $workDuration;
        
        }


        return view('date', compact('works', 'date'));
    }
}
