<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    // 新規ユーザー登録フォームの表示
     public function index()

    {
        return view('auth.register');
    }



//     新規ユーザー登録処理
//     public function store(Request$request)
//     {

//         フォームリクエストを検証。

// ユーザーデータをデータベースに保存。

// 登録成功後、ユーザーをログイン状態にし、勤怠管理のメインページにリダイレクト。
//         return view();
//     }
}