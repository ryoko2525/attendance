<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BreakTime;
use App\Models\Work;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class BreakController extends Controller
{
    public function start(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->back()->with('error', '認証されていません。');
        }

        $user = Auth::user();
        $latestWork = Work::where('user_id', $user->id)->latest('start_time')->first();

        if (!$latestWork || $latestWork->end_time) {
            return redirect()->back()->with('error', '現在勤務中ではありません。');
        }

        // すでに休憩中か確認
        $ongoingBreak = BreakTime::where('work_id', $latestWork->id)
            ->whereNull('end_time')
            ->first();

        if ($ongoingBreak) {
            return redirect()->back()->with('error', 'すでに休憩中です。');
        }

        BreakTime::create([
            'work_id' => $latestWork->id,
            'start_time' => Carbon::now(),
        ]);

        return redirect()->back()->with('success', '休憩を開始しました。');
    }


    public function end(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->back()->with('error', '認証されていません。');
        }

        $user = Auth::user();
        $latestWork = Work::where('user_id', $user->id)->latest('start_time')->first();

        if (!$latestWork || $latestWork->end_time) {
            return redirect()->back()->with('error', '現在勤務中ではありません。');
        }

        // 最新の休憩を取得
        $latestBreak = BreakTime::where('work_id', $latestWork->id)
            ->latest('start_time')
            ->first();

        if (!$latestBreak || $latestBreak->end_time) {
            return redirect()->back()->with('error', '休憩中ではありません。');
        }

        $latestBreak->update(['end_time' => Carbon::now()]);

        return redirect()->back()->with('success', '休憩を終了しました。');
    }

}
