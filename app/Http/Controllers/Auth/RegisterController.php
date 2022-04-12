<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\InterestingType;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/profile';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    public function showRegistrationForm()
    {
        $interesting_types = InterestingType::all();
        return view('auth.register', ['types' => $interesting_types]);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'type' => ['required', 'string', 'in:benefactor,user'],
            'phone_number' => ['sometimes', 'nullable', 'numeric'],
            // 'interesting_type' => ['required_if:type,user', 'array'],
            // 'interesting_type.*' => ['numeric', Rule::exists('interesting_types', 'id')],
            'additional_type' => ['sometimes', 'nullable', 'string', 'in:individual,organisation'],
            'organisation_description' => ['sometimes', 'nullable', 'string'],
        ],
            [
                'name.required' => __('translations.required.error'),
                'name.max' => __('translations.max.error'),
                'email.required' => __('translations.required.error'),
                'email.email' => __('translations.email.error'),
                'email.max' => __('translations.max.error'),
                'password.required' => __('translations.required.error'),
                'password.min' => __('translations.min.error'),
                'type.required' => __('translations.required.error'),
                'phone_number.numeric' => __('translations.numeric.error'),
                'interesting_type.required_if' => __('translations.required.error'),
                'interesting_type.*.numeric' => __('translations.numeric.error'),
            ]
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\Models\User
     */

    function rand_color() {
        return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
    }


    protected function create(array $data)
    {
     
        $full_name = request('name') . ' ' . request('last_name');
        $img = \A6digital\Image\Facades\DefaultProfileImage::create($full_name, 256, $this->rand_color(), '#FFF');
        $default_image = Storage::disk('s3')->put("defaultProfileImages/{$full_name}.png", $img->encode());
        $image_path = Storage::disk('s3')->url("defaultProfileImages/{$full_name}.png");

        $user = User::create([
            'name' => ucfirst($data['name']),
            'last_name' => ucfirst($data['last_name']),
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'type' => $data['type'],
            'image' => $image_path,
            'interesting_type_id' => request('interesting_type') ? json_encode($data['interesting_type']) : null,
            'additional_type' => $data['additional_type'] ?? null,
            'organisation_description' => $data['organisation_description'] ?? null,
            'api_token' => str_random(60),
            'unique_id' => str_random(60)
        ]);

        return $user;
    }
}
