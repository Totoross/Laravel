<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    //用户列表
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    //注册页面
    public function create()
    {
        return view('users.create');
    }

    //注册请求
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50|min:2',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        session()->flash('success', '欢迎开启新的 Laravel 旅程');
        return redirect()->route('users.show', [$user]);
    }

}