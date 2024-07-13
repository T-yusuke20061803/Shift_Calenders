<?php
//ユーザー識別について
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function show($id)
    {
        $user = User::findOrFail($id);
        
        //認可ポリシーの確認
        $this->authorize('view',$user);
        
        return view('user.show', compact('user'));
        
    }
}