<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users=User::all();
        return view('dashboard.pages.home',['users' => $users]);
    }
}
