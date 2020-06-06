<?php

namespace App\Http\Controllers\Admin\Brand;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use App\Models\User;
use Exception;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::with('user')->get();

        // return $brands;

        return view('admin.brand.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brand.create');
    }

    public function store(BrandRequest $request, $id)
    {
        $user_id = base64_decode($id);
        $user_detail = User::find($user_id);
//        return $user_detail;

        try {
            $brand_name = $request->brand_name;
            $brand_data = [
                'user_id' => $user_detail->id,
                'brand_name' => $brand_name,
                'brand_slug' => Str::slug($brand_name),
            ];

            // return $brand_data;

            $brand_create = Brand::create($brand_data);

            if ($brand_create) {
                getMessage('success', 'Success, Brand Has Been Added Successfully Done.');

                if ($user_detail->is_admin === 1) {
                    return redirect()->route('super-admin.brand.index');
                } else {
                    return redirect()->route('admin.brand.index');
                }
            }
        } catch (Exception $e) {
            // return 'Error : ' . $e->getMessage();
            getMessage('danger', $e->getMessage());
            return redirect()->back();
        }
    }

    public function edit($brand_id)
    {
        $brand_id = base64_decode($brand_id);

        $brand_detail = Brand::find($brand_id);

        return view('admin.brand.edit', compact('brand_detail'));
    }

    public function update(BrandRequest $request, $brand_id)
    {
        $brand_id = base64_decode($brand_id);

        $brand_detail = Brand::find($brand_id);
        $user_detail = User::find($brand_detail->user_id);

        // return $user_detail;

        try {
            $brand_name = $request->brand_name;

            $brand_detail->brand_name = $request->brand_name;
            $brand_detail->brand_slug = Str::slug($brand_name);

            // return $brand_update_data;

            $brand_update_data = $brand_detail->update();

            if ($brand_update_data) {
                getMessage('success', 'Brand Has Been Updated Successfully Done.');

                if ($user_detail->is_admin === 1) {
                    return redirect()->route('super-admin.brand.index');
                } else {
                    return redirect()->route('admin.brand.index');
                }
            }
        } catch (Exception $e) {
            // return 'Error : ' . $e->getMessage();
            getMessage('danger', $e->getMessage());
            return redirect()->back();
        }
    }

    public function destroy($brand_id)
    {
        $brand_id = base64_decode($brand_id);

        $brand_detail = Brand::find($brand_id);
        $user_detail = User::find($brand_detail->user_id);

        $brand_delete = $brand_detail->delete();

        if ($brand_delete) {
            getMessage('success', 'Brand Has Been Deleted Successfully Done.');

            if ($user_detail->is_admin === 1) {
                return redirect()->back();
            } else {
                return redirect()->back();
            }
        }
    }

    public function updateStatus($brand_id, $brand_status)
    {
        // return $brand_id . ' ' . $brand_status;
        $brand_detail = Brand::find($brand_id);
        $user_detail = User::find($brand_detail->user_id);

        $brand_detail->status = $brand_status;

        return $brand_update_status = $brand_detail->save();

        // if ($brand_update_status) {
        //     // getMessage('success', 'Brand Status Has Been Updated Successfully Done.');

        //     // return redirect()->back();

        //     // if ($user_detail->is_admin === 1) {
        //     //     return redirect()->route('super-admin.brand.index');
        //     // } else {
        //     //     return redirect()->route('admin.brand.index');
        //     // }
        // }
    }
}
