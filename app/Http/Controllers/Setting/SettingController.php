<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function index()
    {
        $auth = Auth::user();
        $users = User::where('id', $auth->id)->first();
        return view('setting.index', [
            'users' => $users,
        ]);
    }
}
