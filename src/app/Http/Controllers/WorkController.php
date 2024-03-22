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

        return view('stamp');
    }


    public function show()

    {

        return view('date');
    }

    public function start(Request $request)

    {
        // 勤務開始処理
        // ユーザー認証を確認。
    if (!Auth::check()) {
        return response()->json(['message' => '認証されていません。'], 401);
    }
    try {
    $work = new Work();//新しいインスタンスを作成
    $work->user_id = Auth::id();//認証済みのユーザーを取得してuser_idと
    $work->work_date = Carbon::today()->toDateString();//yymmddで現在時刻を取得
    $work->start_time = Carbon::now();
    $work->save();
        return response()->json(['message' => '勤務開始しました。', 'status' => 'started'], 200);
    } catch (\Exception $e) {
        return response()->json(['message' => '勤務開始処理に失敗しました。'], 500);
    }
   }





    public function end(Request $request)

    {
        // 役割: 勤務終了処理
        // 処理の流れ:
        // ユーザー認証を確認。
        // 現在の時刻を取得し、Workレコードのend_timeとして保存。
        // 認証済みユーザーの最新の勤務レコードを検索し、終了時間を更新。
        // 処理が成功したら、成功メッセージと共にフロントエンドに返す。
        // エラーが発生した場合は、エラーメッセージを返す。
        return view('date');
    }
}
