<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Work;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class WorkController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $isWorking = false;
        $canPunch = true; // その日の勤務が完全に終了していればfalse、そうでなければtrue

        if ($user) {
            $lastWork = Work::where('user_id', $user->id)->latest()->first();

            if ($lastWork) {
                $lastWorkDate = Carbon::parse($lastWork->start_time)->startOfDay();
                $today = Carbon::today();

                if ($lastWork && empty($lastWork->end_time)) {
                    $isWorking = true; // 最後の勤務記録が終了していない場合、勤務中と判断
                }

                if ($lastWorkDate->equalTo($today) && !empty($lastWork->end_time)) {
                    $canPunch = false; // 本日の勤務記録が完了している場合、再度打刻できないようにする
                }
            }
        }

        return view('stamp', compact('isWorking', 'canPunch'));
    }


    public function show()

    {

        return view('date');
    }

    public function start(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['message' => '認証されていません。'], 401);
        }
        $user = Auth::user();

        // 最後の勤務記録を取得
        $lastWork = Work::where('user_id', $user->id)->latest()->first();

        // 最後の勤務記録が存在し、その勤務記録の日付が今日である場合はエラー
        if ($lastWork) {
            $lastWorkDate = Carbon::parse($lastWork->start_time)->startOfDay();
            $today = Carbon::today();
            // 終了時刻が記録されているかどうかにかかわらず、最後の勤務記録の日付が今日であればエラー
            if ($lastWorkDate->equalTo($today)) {
                return redirect()->back()->with('error', '本日はすでに打刻がされています');
            }
        }



        // 勤務記録を作成
        $work = Work::create([
            'user_id' => $user->id,
            'start_time' => Carbon::now(),
            'work_date' => Carbon::today()->toDateString(),
        ]);

        return redirect()->back()->with('success', '出勤打刻が完了しました');
    }





    public function end(Request $request)

    {
        $user = Auth::user();
        $work = Work::where('user_id', $user->id)->latest()->first();

        // $workがnull、つまり勤務記録が存在しない場合の処理を追加
        if ($work === null) {
            return redirect()->back()->with('error', '出勤打刻がまだされていません。');
        }
        if (!empty($work->end_time)) {
            return redirect()->back()->with('error', '既に退勤の打刻がされているか、出勤打刻されていません');
        }
        // 勤務記録に終了時刻を記録
        $work->update([
            'end_time' => Carbon::now()
        ]);


        return redirect()->back()->with('success', '退勤打刻が完了しました');
    }
}
