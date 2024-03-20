<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Work;
    

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
        // 役割: 勤務開始処理
        // 処理の流れ:
        // ユーザー認証を確認。
        // 現在の時刻を取得し、Workレコードのstart_timeとして保存。
        // user_idを使用して、認証済みのユーザーに対応するレコードを作成。
        // 処理が成功したら、成功メッセージと共に勤務状態をフロントエンドに返す。
        // エラーが発生した場合は、エラーメッセージを返す。
        return view('stamp');
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