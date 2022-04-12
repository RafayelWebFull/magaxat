<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CountriesController extends Controller
{
    public function index()
    {
        $countries = Country::all();
        return view('admin.countries.index', ['countries' => $countries]);
    }

    public function create()
    {
        return view('admin.countries.create');
    }

    public function store()
    {
        $attributes = validator(request()->all(), [
            'name' => ['required', 'string', Rule::unique('countries', 'name')],
        ])->validate();

        Country::create(['name' => $attributes['name']]);

        return redirect()->route('admin.countries.index');
    }

    public function edit(Country $country)
    {
        return view('admin.countries.edit', ['country' => $country]);
    }

    public function update(Country $country)
    {
        $attributes = validator(request()->all(), [
            'name' => ['required', 'string', Rule::unique('countries', 'name')->ignore($country->id)],
        ])->validate();

        $country->update(['name' => $attributes['name']]);

        return redirect()->route('admin.countries.index');
    }

    public function destroy(Country $country)
    {
        $country->delete();
        return back();
    }

    public function add_all()
    {
        $countries = request('countries');
        return response()->json(['message' => 'aaaa']);
    }

}
