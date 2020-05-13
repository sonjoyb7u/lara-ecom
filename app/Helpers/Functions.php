<?php

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

function slugGenerate($text) {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'N-A';
        }

        return $text;
    }


    function getMessage($type, $message) {
        session()->flash('type', $type);
        session()->flash('message', $message);

    }


    function uploadImage($user_detail, $check_file, $image_files, $size, $path) {
        $image_name = [];
        if($check_file) {
            foreach ($image_files as $file) {
                $image_file_ext = $file->getClientOriginalExtension();
                $new_image_name  = $user_detail->user_name . "_" . date("Ymdhis") . "_" . rand(9999, 99999) . "." . $image_file_ext;
                $image_file_type = $file->getMimeType();

                if($file->isValid()) {
                    if ($image_file_type === "image/jpeg" || $image_file_type === "image/png") {
                        Image::make($file)
                            ->resize($size['w'], $size['h'])
                            ->save(public_path($path) . $new_image_name);

                    }
                }
                $image_name[] = $new_image_name;

            }
            return $image_name;
        }

    }

function editImage($user_detail, $images, $check_file, $image_files, $size, $path) {
    $image_name = [];
    if($check_file) {
        foreach ($image_files as $file) {
            $image_file_ext = $file->getClientOriginalExtension();
            $new_image_name  = $user_detail->user_name . "_" . date("Ymdhis") . "_" . rand(9999, 99999) . "." . $image_file_ext;
            $image_file_type = $file->getMimeType();

            if($file->isValid()) {
                if ($image_file_type === "image/jpeg" || $image_file_type === "image/png") {
                    foreach ($images as $image) {
//                        unlink(public_path('uploads/images/product/'.$image));
                        Storage::disk('public')->delete('/images/product/'.$image);

                    }
                    Image::make($file)
                        ->resize($size['w'], $size['h'])
                        ->save(public_path($path) . $new_image_name);


                }
            }
            $image_name[] = $new_image_name;

        }
        return $image_name;
    }

}
