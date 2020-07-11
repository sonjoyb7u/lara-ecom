<?php

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

function slugGenerate($text)
{
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

// SUCCESS/ERROR SESSION-FLASH MESSAGE SHOW...
function getMessage($type, $message)
{
    session()->flash('type', $type);
    session()->flash('message', $message);
}

// UPLOAD SINGLE IMAGE/THUMBNAIL FILE...
function uploadSingleImage($user_detail, $check_image_file, $image_file, $image_size, $image_path)
{
    if ($check_image_file) {
//        foreach ($image_files as $image_file) {
        $image_file_ext = $image_file->getClientOriginalExtension();
        $new_image_name = $user_detail->user_name . '_' . date('Ymdhis') . '_' . rand(9999, 99999) . '.' . $image_file_ext;
        $image_file_type = $image_file->getMimeType();

        if ($image_file->isValid()) {
            if ($image_file_type === 'image/jpeg' || $image_file_type === 'image/png') {
                Image::make($image_file)
                        ->resize($image_size['w'], $image_size['h'])
                        ->save(public_path($image_path) . $new_image_name);
            }
        }

        return $new_image_name;
    }
}

//    UPLOAD MULTIPLE IMAGE/THUMBNAIL FILE...
function uploadImage($user_detail, $check_image_file, $image_files, $image_size, $image_path)
{
    $image_name = [];
    if ($check_image_file) {
        foreach ($image_files as $image_file) {
            $image_file_ext = $image_file->getClientOriginalExtension();
            $new_image_name = $user_detail->user_name . '_' . date('Ymdhis') . '_' . rand(9999, 99999) . '.' . $image_file_ext;
            $image_file_type = $image_file->getMimeType();

            if ($image_file->isValid()) {
                if ($image_file_type === 'image/jpeg' || $image_file_type === 'image/png') {
                    Image::make($image_file)
                        ->resize($image_size['w'], $image_size['h'])
                        ->save(public_path($image_path) . $new_image_name);
                }
            }
//                $image_name[] = $new_image_name;
            array_push($image_name, $new_image_name);
        }
        return $image_name;
    }
}

//UPLOAD GALLERY IMAGE FILES...
function uploadGalleryImage($user_detail, $check_gallery_files, $gallery_files, $gallery_size, $gallery_path)
{
    $gallery_image_name = [];
    if ($check_gallery_files) {
        foreach ($gallery_files as $gallery_file) {
            $image_file_ext = $gallery_file->getClientOriginalExtension();
            $new_gallery_image_name = $user_detail->user_name . '_' . date('Ymdhis') . '_' . rand(9999, 99999) . '.' . $image_file_ext;
            $image_file_type = $gallery_file->getMimeType();

            if ($gallery_file->isValid()) {
                if ($image_file_type === 'image/jpeg' || $image_file_type === 'image/png') {
                    Image::make($gallery_file)
                            ->resize($gallery_size['w'], $gallery_size['h'])
                            ->save(public_path($gallery_path) . $new_gallery_image_name);
                }
            }
//                $gallery_image_name[] = $new_gallery_image_name;
            array_push($gallery_image_name, $new_gallery_image_name);
        }
        return $gallery_image_name;
    }
}

//EDIT SINGLE IMAGE FILES...
function editSingleImage($user_detail, $image, $check_image_file, $image_file, $image_size, $image_path)
{
    if ($check_image_file) {
        $image_file_ext = $image_file->getClientOriginalExtension();
        $new_image_name = $user_detail->user_name . '_' . date('Ymdhis') . '_' . rand(9999, 99999) . '.' . $image_file_ext;
        $image_file_type = $image_file->getMimeType();

        if ($image_file->isValid()) {
            if ($image_file_type === 'image/jpeg' || $image_file_type === 'image/png') {
//                        unlink(public_path('uploads/images/sub-category/'.$image));
                Storage::disk('public')->delete('/images/sub-category/' . $image);

                Image::make($image_file)
                        ->resize($image_size['w'], $image_size['h'])
                        ->save(public_path($image_path) . $new_image_name);
            }
        }

        return $new_image_name;
    }
}

//EDIT IMAGE FILES...
function editImage($user_detail, $images, $check_image_file, $image_files, $image_size, $image_path)
{
    $image_name = [];
    if ($check_image_file) {
        foreach ($image_files as $image_file) {
            $image_file_ext = $image_file->getClientOriginalExtension();
            $new_image_name = $user_detail->user_name . '_' . date('Ymdhis') . '_' . rand(9999, 99999) . '.' . $image_file_ext;
            $image_file_type = $image_file->getMimeType();

            if ($image_file->isValid()) {
                if ($image_file_type === 'image/jpeg' || $image_file_type === 'image/png') {
                    foreach ($images as $image) {
                        //                        unlink(public_path('uploads/images/product/'.$image));
                        Storage::disk('public')->delete('/images/product/images/' . $image);
                    }
                    Image::make($image_file)
                        ->resize($image_size['w'], $image_size['h'])
                        ->save(public_path($image_path) . $new_image_name);
                }
            }
//                $image_name[] = $new_image_name;
            array_push($image_name, $new_image_name);
        }
        return $image_name;
    }
}

//EDIT GALLERY IMAGE FILES...
function editGalleryImage($user_detail, $gallery_images, $check_gallery_files, $gallery_files, $size, $path)
{
    $gallery_image_name = [];
    if ($check_gallery_files) {
        foreach ($gallery_files as $gallery_file) {
            $image_file_ext = $gallery_file->getClientOriginalExtension();
            $new_gallery_image_name = $user_detail->user_name . '_' . date('Ymdhis') . '_' . rand(9999, 99999) . '.' . $image_file_ext;
            $image_file_type = $gallery_file->getMimeType();

            if ($gallery_file->isValid()) {
                if ($image_file_type === 'image/jpeg' || $image_file_type === 'image/png') {
                    foreach ($gallery_images as $gallery_image) {
//                        unlink(public_path('uploads/images/product/'.$image));
                        Storage::disk('public')->delete('/images/product/gallery-images/' . $gallery_image);
                    }
                    Image::make($gallery_file)
                        ->resize($size['w'], $size['h'])
                        ->save(public_path($path) . $new_gallery_image_name);
                }
            }
//            $gallery_image_name[] = $new_gallery_image_name;
            array_push($gallery_image_name, $new_gallery_image_name);
        }
        return $gallery_image_name;
    }
}


// ORDER STATUS COLOR css...
function randomStatusColor($status) {
    $color = [
        'pending' => 'x-warning',
        'success' => 'x-success',
        'return' => 'x-danger',
        'shipped' => 'x-primary',

    ];

    return $color[$status];
}

// ORDER STATUS function...
function orderStatus() {
    $o_status = [
        'pending',
        'success',
        'return',
        'shipped',
    ];
    return $o_status;
}

// PAYMENT STATUS function...
function paymentStatus() {
    $p_status = [
        'pending',
        'success',
    ];
    return $p_status;
}

function randomRatingColor($rating) {
    $color = [
        0 => 'x-default',
        1 => 'x-danger',
        2 => 'x-warning',
        3 => 'x-info',
        4 => 'x-primary',
        5 => 'x-success',
    ];

    return $color[$rating];
}
