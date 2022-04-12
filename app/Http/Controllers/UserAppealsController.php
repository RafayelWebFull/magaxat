<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddAppealsRequest;
use App\Http\Requests\StoreImageRequest;
use App\Http\Requests\UpdateAppealRequest;
use App\Models\Appeal;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class UserAppealsController extends Controller
{
    public function my_appeals()
    {
        $my_appeals = Auth::user()->appeals()->get();
        return view('layouts.front.my-appeals', ['my_appeals' => $my_appeals]);
    }

    public function create()
    {
        return view('user.appeals.create');
    }

    public function store(AddAppealsRequest $request)
    {
        
        $user = Auth::user();

        if (request()->file('appeal_image')) {
            $image_path = $request->file('appeal_image')[0]->store('images', 's3');
        }


        if (request()->file('appeal_pdf')) {
            $pdf_path = $request->file('appeal_pdf')->store('files', 's3');
        }


        $last_uniqueid = Appeal::latest()->pluck('uniqueid')->first();
        if ($last_uniqueid !== null) {
            $uniqueid = $last_uniqueid + 1;
        } else {
            $uniqueid = 100000;
        }

        $appeal = $user->appeals()->create([
            'title' => $request->appeal_title,
            'description' => $request->appeal_description,
            'image_name' => request()->file('appeal_image') ? basename($image_path) : null,
            'image_path' => request()->file('appeal_image') ? Storage::disk('s3')->url($image_path) : null,
            'pdf_name' => request()->file('appeal_pdf') ? basename($pdf_path) : null,
            'pdf_path' => request()->file('appeal_pdf') ? Storage::disk('s3')->url($pdf_path) : null,
            'uniqueid' => $uniqueid 
        ]);


        if (request()->file('appeal_video')) {
            $video_path = $request->file('appeal_video')->store('videos', 's3');

            $appeal->video()->create([
                'user_id' => Auth::id(),
                'video_name' => request()->file('appeal_video') ? basename($video_path) : null,
                'video_path' => request()->file('appeal_video') ? Storage::disk('s3')->url($video_path) : null,
            ]);
        }


        if (request('appeal_image')) {
            $other_images = array_except($request->appeal_image, 0);
            foreach($other_images as $image) {
                $file = $image;
                $image_path = $image->store('images', 's3');
                
                $appeal->images()->create([
                    'title' => $request->title ?? null,
                    'image_name' => basename($image_path),
                    'image_path' => Storage::disk('s3')->url($image_path)
                ]);
            }
        }
        

        return redirect()->route('all-appeals');
    }

    public function edit(Appeal $appeal)
    {
        $appeal_video = $appeal->video()->first();
        return view('layouts.front.edit-appeal', [
            'appeal' => $appeal,
            'appeal_video' => $appeal_video
        ]);
    }

    public function update(UpdateAppealRequest $request, Appeal $appeal)
    {
        
        if (request()->file('appeal_image')) {
            Storage::disk('s3')->delete("images/{$appeal->image_name}");
            $file = $request->appeal_image[0];
            $image_path = $file->store('images', 's3');
        }

        if (request()->file('appeal_video')) {
            Storage::disk('s3')->delete("videos/{$appeal->video_name}");
            $video_path = $request->file('appeal_video')->store('videos', 's3');
    
            $appeal->video()->create([
                'user_id' => Auth::id(),
                'video_name' => request()->file('appeal_video') ? basename($video_path) : null,
                'video_path' => request()->file('appeal_video') ? Storage::disk('s3')->url($video_path) : null,
            ]);
        }

        if (request()->file('appeal_pdf')) {
            $pdf_path = $request->file('appeal_pdf')->store('files', 's3');
        }


        $appeal->update([
            'title' => $request->appeal_title,
            'description' => $request->appeal_description,
            'image_name' => request()->file('appeal_image') ? basename($image_path) : null,
            'image_path' => request()->file('appeal_image') ? Storage::disk('s3')->url($image_path) : $appeal->image_path,
            'pdf_name' => request()->file('appeal_pdf') ? basename($pdf_path) : null,
            'pdf_path' => request()->file('appeal_pdf') ? Storage::disk('s3')->url($pdf_path) : $appeal->pdf,
        ]);

        if (request('appeal_image')) {
            $other_images = array_except($request->appeal_image, 0);
            foreach($other_images as $image) {
                $file = $image;
                $extension = $file->getClientOriginalExtension();
                $image_path = $image->store('images', 's3');
                
                $appeal->images()->create([
                    'title' => $request->title ?? null,
                    'image_name' => basename($image_path),
                    'image_path' => Storage::disk('s3')->url($image_path)
                ]);
            }
        }

        return redirect()->route('all-appeals');
    }

    public function delete(Appeal $appeal)
    {
        Storage::disk('s3')->delete("images/{$appeal->image_name}");
        Storage::disk('s3')->delete("videos/{$appeal->video_name}");

        $appeal->video()->delete();

        $appeal->delete();
        return back();
    }

    public function appeal_images(Appeal $appeal)
    {
        $appeal_images = $appeal->images()->get();
        return view('user.appeals.images.index', [
            'appeal_images' => $appeal_images,
            'appeal' => $appeal,
        ]);
    }

    public function add_appeal_image(Appeal $appeal)
    {
        return view('user.appeals.images.create', [
            'appeal' => $appeal,
        ]);
    }

    public function store_appeal_image(StoreImageRequest $request, Appeal $appeal)
    {
        if (request()->file('image')) {
            $file = $request->image;
            $extension = $file->getClientOriginalExtension();
            $image_name = uniqid(). '.' .$extension;
            $image_path = $file->store('images', 's3');          
        }

        $appeal->images()->create([
            'title' => $request->title ?? null,
            'image_name' => basename($image_path),
            'image_path' => Storage::disk('s3')->url($image_path)
        ]);

        return redirect()->route('user.appeal.images', $appeal->id);
    }

    public function edit_appeal_image(Appeal $appeal, Image $image)
    {
        return view('user.appeals.images.edit', [
            'appeal' => $appeal,
            'image' => $image,
        ]);
    }

    public function update_appeal_image(StoreImageRequest $request, Appeal $appeal, Image $image)
    {
        if (request()->file('image')) {
            Storage::disk('s3')->delete("images/{$image->image_name}");
            $file = $request->image;
            $extension = $file->getClientOriginalExtension();
            $image_name = uniqid(). '.' .$extension;
            $image_path = $file->store('images', 's3');
         
        }

        $image->update([
            'title' => $request->title,
            'image_name' => basename($image_path),
            'image_path' => Storage::disk('s3')->url($image_path)
        ]);

        return redirect()->route('user.appeal.images', $appeal->id);
    }

    public function delete_appeal_image(Appeal $appeal, Image $image)
    {
        Storage::disk('s3')->delete("images/{$image->image_name}");
        $image->delete();
        return back();
    }
}
