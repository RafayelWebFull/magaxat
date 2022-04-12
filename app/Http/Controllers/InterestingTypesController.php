<?php

namespace App\Http\Controllers;

use App\Models\InterestingType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class InterestingTypesController extends Controller
{
    public function index()
    {
        $interesting_types = InterestingType::all();
        return view('admin.interesting_types.index', ['interesting_types' => $interesting_types]);
    }

    public function create()
    {
        return view('admin.interesting_types.create');
    }

    public function store()
    {
        $attributes = validator(request()->all(), [
            'name' => ['required', 'string', Rule::unique('interesting_types', 'name')],
        ])->validate();

        InterestingType::create(['name' => $attributes['name']]);

        return redirect()->route('admin.interesting-types.index');
    }

    public function edit(InterestingType $interesting_type)
    {
        return view('admin.interesting_types.edit', ['type' => $interesting_type]);
    }

    public function update(InterestingType $interesting_type)
    {
        $attributes = validator(request()->all(), [
            'name' => ['required', 'string', Rule::unique('interesting_types', 'name')->ignore($interesting_type->id)],
        ])->validate();

        $interesting_type->update(['name' => $attributes['name']]);

        return redirect()->route('admin.interesting-types.index');
    }

    public function destroy(InterestingType $interesting_type)
    {
        $interesting_type->delete();
        return back();
    }

    public function all_types()
    {
        $types = InterestingType::all();
        return $types;
    }
}
