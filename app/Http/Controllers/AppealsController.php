<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppealsController extends Controller
{
    public function index()
    {
        $my_appeals = Auth::user()->appeals()->get();
        return view('user.appeals.index', ['my_appeals' => $my_appeals]);
    }
}
