<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\InterestingType;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function profile()
    {
        $user = Auth::user();
        $user_interesting_types_ids = $user->interesting_type_id !== "null" ? json_decode($user->interesting_type_id) : [];
        $my_interesting_types = $user_interesting_types_ids !== null ? InterestingType::whereIn('id', $user_interesting_types_ids)->get() : null;
        $user = $user->load('country');
        $areas_of_interesting = InterestingType::all();
        $countries = Country::all();
        $my_posts = $user->posts()->with('video')->get();
        $my_appeals = $user->appeals()->with('video')->get();
        $my_posts_images = $user->posts()->whereNull('video_path')->whereNotNull('image_path')->get();
        $my_videos = $user->videos()->get();
        $my_subscribtions = $user->subscribtions()->pluck('user_id');
        $my_subscribtions_users = User::whereIn('unique_id', $my_subscribtions)->get();
        $my_subscribers = $user->subscribers()->pluck('subscriber_id');
        $my_subscribers_users = User::whereIn('unique_id', $my_subscribers)->get();
        $user_subscribers_count = $user->subscribers()->count();
        $user_subscribtions_count = $user->subscribtions()->count();

        return view('profile', [
            'user' => $user,
            'my_interesting_types' => $my_interesting_types,
            'countries' => $countries,
            'areas_of_interesting' => $areas_of_interesting,
            'my_posts' => $my_posts,
            'my_appeals' => $my_appeals,
            'my_posts_images' => $my_posts_images,
            'my_videos' => $my_videos,
            'my_subscribtions_users' => $my_subscribtions_users,
            'my_subscribers_users' => $my_subscribers_users,
            'my_subscribers' => $my_subscribers_users,
            'user_subscribers_count' => $user_subscribers_count,
            'user_subscribtions_count' => $user_subscribtions_count,
            'user_interesting_types_ids' => $user_interesting_types_ids
        ]);
    }


    public function update_profile()
    {
        $user = Auth::user();

        $attributes = validator(request()->all(), [
            'name' => ['string'],
            'last_name' => ['string', 'sometimes', 'nullable'],
            'email' => ['email', Rule::unique('users', 'email')->ignore($user->id)],
            'image' => ['sometimes','nullable','max:2048', 'mimes:png,jpg,jpeg'],
            'date_of_birth' => ['sometimes','nullable','date'],
            'phone_number' => ['sometimes','nullable','numeric'],
            'additional_type' => ['sometimes','nullable','in:individual,organisation'],
            'interesting_type' => ['sometimes', 'nullable', 'array'],
            'interesting_type.*' => ['numeric', Rule::exists('interesting_types', 'id')],
            'country_id' => ['sometimes','nullable','integer', Rule::exists('countries', 'id')],
            'gender' => ['sometimes','nullable','string', Rule::in('male', 'female')],
            'organisation_description' => ['sometimes', 'nullable', 'in:individual,organisation']
        ])->validate();

        if (request()->file('cover-image')) {
            Storage::disk('s3')->delete("images/{$user->cover_image_name}");
            $file = request()->file('cover-image');
            $image_path = $file->store('images', 's3');
        }

        $user->update([
            'name' => request('name') ? ucfirst($attributes['name']) : $user->name,
            'last_name' => request('last_name') ? ucfirst($attributes['last_name']) : $user->last_name,
            'email' => request('email') ? $attributes['email'] : $user->email,
            'date_of_birth' => request('date_of_birth') ? $attributes['date_of_birth'] : null,
            'phone_number' => request('phone_number') ? $attributes['phone_number'] : null,
            'gender' => $attributes['gender'] ?? null,
            'country_id' => $attributes['country_id'] ?? null,
            'cover_image_name' => request()->file('cover-image') ? basename($image_path) : null,
            'cover_image_path' => request()->file('cover-image') ? Storage::disk('s3')->url($image_path) : null,
            'interesting_type_id' => json_encode(request('interesting_type'))?? null,
            'additional_type' => request('additional_type') ? $attributes['additional_type'] : null,
            'organisation_description' => request('organisation_description') ? $attributes['organisation_description'] : null
        ]);


        return redirect()->route('user.profile');
    }

    public function update_profile_image()
    {
        Storage::disk('s3')->delete("images/".auth()->user()->image);
        $cropped_image = request('croppedImage');
        $image_array = explode(";", $cropped_image);
        $image_array_2 = explode(",", $image_array[1]);
        $imageInfo = explode(";base64,", $cropped_image);
        $imgExt = str_replace('data:image/', '', $imageInfo[0]);
        $image = str_replace(' ', '+', $imageInfo[1]);
        $imageName = time().".".$imgExt;

        Storage::disk('s3')->put("/images/{$imageName}",base64_decode($image));
        $url = Storage::disk('s3')->url("images/{$imageName}");

        auth()->user()->update(['image' => $url]);
    }

    public function my_notifications()
    {
        $user = Auth::user();
        $my_notifications = $user->notifications()->where('type', 'App\Notifications\NewSubscribtion')
                            ->where('read_at', null)->get();
        return $my_notifications;
    }

    public function check_notification()
    {
        try {
            $notification_id = request('nid');
            $status = request('status');
            $user_notification = auth()->user()->notifications()->where('id', $notification_id)->firstOrFail();
            if ($status === 'accept') {
                $user = User::where('email', $user_notification->data['user_email'])->first();
                auth()->user()->subscribtions()->create(['user_id' => $user->unique_id]);
            }
            $user_notification->update(['read_at' => now()]);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }


    public function get_notification_user()
    {
        $notification_id = request('nid');
        $notification_data = DB::table('notifications')->where('id', $notification_id)->pluck('data')->first();
        $notification_data = json_decode($notification_data);
        $notification_user = User::where('email', $notification_data->user_email)->first();
        return $notification_user;
    }

}
