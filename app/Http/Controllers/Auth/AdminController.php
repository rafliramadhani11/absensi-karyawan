<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('auth.admin.index', compact('user'));
    }
}
