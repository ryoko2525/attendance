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
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors('ログインしてください。');
        }

        $works = Work::where('user_id', Auth::id())->paginate(5);
        return view('index', compact('works'));
    }


    public function show($date = null)
    {
        $date = $date ?? Carbon::today()->format('Y-m-d');

        // 特定の日付に働いている全ユーザーの勤務記録を取得
        $works = Work::with(['breakTimes', 'user']) // ユーザー情報と休憩時間の関係を事前に読み込む(workモデルないで定義したリレーションメソッドの名前)
            ->whereDate('work_date', $date)
            ->paginate(5);

        // 各勤務記録の勤務時間と休憩時間を計算
        $works->getCollection()->each->calculateDurations();

        return view('date', compact('works', 'date'));
    }
    
    
    
}
