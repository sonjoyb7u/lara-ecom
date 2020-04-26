<?php

namespace App\Http\Controllers\Admin\Slider;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Exception;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::with('user')->orderBy('id', 'desc')->get();

//         return $sliders;

        return view('admin.slider.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.slider.create');
    }

    public function store(SliderRequest $request, $id)
    {
//        return $request->all();
        $user_id = base64_decode($id);
        $user_detail = User::find($user_id);

        $image_file = $request->file('image');
        $image_file_ext = $image_file->getClientOriginalExtension();
        $new_image_file  = $user_detail->user_name ."_".date("Ymdhis")."_".rand(9999, 99999).".".$image_file_ext;
//        return $new_image_file;

        $image_file_type = $image_file->getMimeType();

        try {
            $slider_data = [
                'user_id' => $user_detail->id,
                'message' => $request->message,
                'title' => $request->title,
                'sub-title' => $request->sub_title,
                'image' => $new_image_file,
                'start' => $request->start,
                'end' => $request->end,
                'url' => $request->url,
            ];

//             return $slider_data;

            if($image_file->isValid()) {
                if ($image_file_type == "image/jpeg" || $image_file_type == "image/png") {

                    $slider_create = Slider::create($slider_data);

                    if ($slider_create) {
//                    $image_file->storeAs('/images/category/', $new_image_file);
                        $image_file->move('uploads/images/slider/', $new_image_file);
                        getMessage('success', 'SUCCESS, Slider Has Been Added Successfully Done.');

                        if ($user_detail->is_admin === 1) {
                            return redirect()->route('super-admin.slider.index');
                        } else {
                            return redirect()->route('admin.slider.index');
                        }
                    }

                }

            }

        } catch (Exception $e) {
            // return 'Error : ' . $e->getMessage();
            getMessage('danger', 'ERROR, ' . $e->getMessage());
            return redirect()->back();
        }

    }

    public function edit($slider_id)
    {
        $slider_id = base64_decode($slider_id);
//        return 'Slider Id :' . $slider_id;

        $slider_detail = Slider::with('user')->find($slider_id);
//        return $slider_detail;

        return view('admin.slider.edit', compact('slider_detail'));
    }

    public function update(SliderRequest $request, $slider_id, $user_id)
    {
        $slider_id = base64_decode($slider_id);
        $user_id = base64_decode($user_id);
//        return 'Slider Id :' . $slider_id . ' User Id :' . $user_id;

        $slider_detail = Slider::find($slider_id);
//         return $category_detail->image;
        $user_detail = User::find($user_id);

        if($request->file('image')) {
            $image_file = $request->file('image');
            $image_file_ext = $image_file->getClientOriginalExtension();
            $new_image_file  = $user_detail->user_name ."_".date("Ymdhis")."_".rand(9999, 99999).".".$image_file_ext;
//            return $new_image_file;
            $image_file_type = $image_file->getMimeType();

            if($image_file->isValid()) {
                if($image_file_type == "image/jpeg" || $image_file_type == "image/png") {

//                    unlink(public_path('uploads/images/category/'.$category_detail->image));
                    Storage::disk('public')->delete('/images/slider/'.$slider_detail->image);

                    $slider_detail->user_id = $user_detail->id;
                    $slider_detail->message = $request->message;
                    $slider_detail->title = $request->title;
                    $slider_detail->sub_title = $request->sub_title;
                    $slider_detail->image = $new_image_file;
                    $slider_detail->start = $request->start;
                    $slider_detail->end = $request->end;
                    $slider_detail->url = $request->url;

                    $slider_update_data = $slider_detail->update();

                    if ($slider_update_data) {
//                        $image_file->storeAs('/images/category/', $new_image_file);
                        $image_file->move('uploads/images/slider/', $new_image_file);

                        getMessage('success', 'SUCCESS, Slider Has Been Updated Successfully Done With Image.');

                        if ($user_detail->is_admin === 1) {
                            return redirect()->route('super-admin.slider.index');
                        } else {
                            return redirect()->route('admin.slider.index');
                        }
                    } else {
                        getMessage('danger','ERROR, Slider has not been Updated With Image!');
                        return redirect()->back();
                    }


                }

            }

        } else {
            $slider_detail->user_id = $user_detail->id;
            $slider_detail->message = $request->message;
            $slider_detail->title = $request->title;
            $slider_detail->sub_title = $request->sub_title;
            $slider_detail->start = $request->start;
            $slider_detail->end = $request->end;
            $slider_detail->url = $request->url;

            $slider_update_data = $slider_detail->update();

            if ($slider_update_data) {
                getMessage('success', 'SUCCESS, Slider Has Been Updated Successfully Done Without Image.');

                if ($user_detail->is_admin === 1) {
                    return redirect()->route('super-admin.slider.index');
                } else {
                    return redirect()->route('admin.slider.index');
                }
            } else {
                getMessage('danger','ERROR, Slider has not been Updated Without Image!');
                return redirect()->back();
            }

        }


    }

    public function destroy($slider_id)
    {
        $slider_id = base64_decode($slider_id);

        $slider_detail = Slider::find($slider_id);

        Storage::disk('public')->delete('/images/slider/'.$slider_detail->image);

        $slider_delete = $slider_detail->delete();

        if ($slider_delete) {
            getMessage('success', 'SUCCESS, Slider Has Been Deleted Successfully Done.');

            return redirect()->back();

        }

    }

    public function updateStatus($slider_id, $slider_status)
    {
        // return $slider_id . ' ' . $slider_status;

        $slider_detail = Slider::find($slider_id);

        $slider_detail->status = $slider_status;

        return $slider_update_status = $slider_detail->save();

    }
}
