<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function stats()
    {
        $user = Auth::user();

        return view('profile.charts', ['user' => $user]);
    }

    public function clients()
    {
        $user = Auth::user();
    }
}
