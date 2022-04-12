<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class AdminController extends Controller
{

    public function home()
    {
        $user = Auth::user();
        $user_counts = count(User::where('type', '!=', 'admin')->get());
        $countries_counts = count(Country::all());

        return view('admin.home',[ 
                'user' => $user,
                'user_counts' => $user_counts,
                'countries_counts' => $countries_counts
            ]);
    }


    public function users()
    {
        $users = User::all();
        return view('admin.users.index', ['users' => $users]);
    }

    public function delete_user(User $user)
    {
        $user->delete();
        return back();
    }

    public function block_user(User $user)
    {
        $user->update(['status' => 0]);
        return back();
    }

    public function unblock_user(User $user)
    {
        $user->update(['status' => 1]);
        return back();
    }

    public function create_user()
    {
        return view('admin.users.create');
    }

    public function store_user()
    {
        $attributes = validator(request()->all(), [
            'name' => ['required', 'string'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'string', 'min:8'],
            'type' => ['string']
        ])->validate();

        User::create([
            'name' => $attributes['name'],
            'email' => $attributes['email'],
            'password' => Hash::make($attributes['password']),
            'type' => request('type') ? 'benefactor' : 'user',
            'image' => 'images/avatar.png'
        ]);

        return redirect()->route('admin.users');
    }
}
