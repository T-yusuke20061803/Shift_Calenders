<?php
//ユーザー識別について
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class UserController extends Controller
{
    /*public function show($id)
    {
        $user = User::findOrFail($id);
        
        //認可ポリシーの確認
        $this->authorize('view',$user);
        
        return view('user.show', compact('user'));
        
    }*/
    public function show($id)
    {
        $user = Auth::user();
        dump($user);
        $userid=$user->id;
        $userrole=$user->is_reader;
        dd($userid,$userrole);
        if ($user->id  != $id){//管理者が一般の画面一覧を見る
            return redirect()->route('login');
        }

        // ユーザー情報の表示処理
        return view('user.profile', ['user' => $user]);
    }
    
}