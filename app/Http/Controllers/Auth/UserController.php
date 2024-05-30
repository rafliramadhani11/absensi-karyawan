<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Absen;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $absens = Absen::where('user_id', $user->id)->latest()->paginate(10);

        return view('auth.user.index', compact('user', 'absens'));
    }
}
