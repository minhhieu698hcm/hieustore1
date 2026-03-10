<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Banner;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    public function manager()
{
    $banners = Banner::where('position', 'hero')->orderBy('order')->get();
    $banners_highlight = Banner::where('position', 'highlight')->orderBy('order')->limit(3)->get();
    $banners_middle = Banner::where('position', 'middle')->orderBy('order')->limit(1)->get();
    $logo_main = Banner::where('position', 'logo_main')->orderBy('order')->get();
    $logo_footer = Banner::where('position', 'logo_footer')->orderBy('order')->get();

    return view('admin.banners.manager', compact('banners', 'banners_highlight','banners_middle','logo_main','logo_footer'));
}

public function heroUpdate(Request $request)
{
    $count = count($request->input('title', []));
    $existingIds = [];
    $activeList = $request->input('active', []);

    for ($i = 0; $i < $count; $i++) {
        $id = $request->id[$i] ?? null;
        $banner = $id ? Banner::find($id) : new Banner();

        $banner->position = 'hero';
        $banner->title    = $request->title[$i] ?? null;
        $banner->link     = $request->link[$i] ?? null;
        $banner->order    = $request->order[$i] ?? 0;
        $banner->active   = isset($activeList[$i]) ? 1 : 0;

        if ($request->hasFile("image.$i")) {
            $file = $request->file("image")[$i];
            $filename = 'banner_hero_' . time() . '_' . Str::random(5) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/banner_hero'), $filename);
            $banner->image_url = $filename;
        }

        $banner->save();

        if ($banner->id) {
            $existingIds[] = $banner->id;
        }
    }

    // Xoá banner và hình ảnh không còn dùng
    $toDelete = Banner::where('position', 'hero')
        ->whereNotIn('id', $existingIds)
        ->get();

    foreach ($toDelete as $banner) {
        if ($banner->image_url) {
            $filePath = public_path('upload/banner_hero/' . $banner->image_url);
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
        }
    }

    Banner::whereIn('id', $toDelete->pluck('id'))->delete();

    return response()->json([
        'success' => true,
        'message' => 'Cập nhật banner hero thành công.'
    ]);
}



public function highlightUpdate(Request $request)
{
    $count = count($request->input('title', []));
    $existingIds = [];
    $fileInputs = $request->file('image');
    $activeList = $request->input('active', []);

    for ($i = 0; $i < $count; $i++) {
        $id = $request->id[$i] ?? null;
        $banner = $id ? Banner::find($id) : new Banner();

        $banner->position = 'highlight';
        $banner->title    = $request->title[$i] ?? null;
        $banner->link     = $request->link[$i] ?? null;
        $banner->order    = $request->order[$i] ?? 0;
        $banner->active   = isset($activeList[$i]) ? 1 : 0;

        // ✅ Xử lý ảnh nếu tồn tại file input đúng index
        if (!empty($fileInputs) && array_key_exists($i, $fileInputs)) {
            $file = $fileInputs[$i];

            if ($file->getClientOriginalExtension() === 'webp') {
                if ($banner->image_url && file_exists(public_path('upload/3_banner_highlight/' . $banner->image_url))) {
                    unlink(public_path('upload/3_banner_highlight/' . $banner->image_url));
                }

                $filename = 'banner_highlight_' . time() . '_' . Str::random(5) . '.webp';
                $file->move(public_path('upload/3_banner_highlight'), $filename);
                $banner->image_url = $filename;
            }
        }

        $banner->save();

        if ($banner->id) {
            $existingIds[] = $banner->id;
        }
    }

    // ✅ Xoá các banner không còn được gửi lên
    Banner::where('position', 'highlight')
        ->whereNotIn('id', $existingIds)
        ->each(function ($banner) {
            $path = public_path('upload/3_banner_highlight/' . $banner->image_url);
            if (file_exists($path)) {
                unlink($path);
            }
            $banner->delete();
        });

    return response()->json([
        'success' => true,
        'message' => 'Cập nhật 3 banner highlight thành công!'
    ]);
}


public function updateMiddle(Request $request)
{
    $count = count($request->input('title', []));
    $existingIds = [];
    $fileInputs = $request->file('image');
    $activeList = $request->input('active', []);

    for ($i = 0; $i < $count; $i++) {
        $id = $request->id[$i] ?? null;
        $banner = $id ? Banner::find($id) : new Banner();

        $banner->position = 'middle';
        $banner->title    = $request->title[$i] ?? null;
        $banner->link     = $request->link[$i] ?? null;
        $banner->order    = $request->order[$i] ?? 0;
        $banner->active   = isset($activeList[$i]) ? 1 : 0;

        if (!empty($fileInputs) && array_key_exists($i, $fileInputs)) {
            $file = $fileInputs[$i];

            if ($file->getClientOriginalExtension() === 'webp') {
                if ($banner->image_url && file_exists(public_path('upload/banner_middle/' . $banner->image_url))) {
                    unlink(public_path('upload/banner_middle/' . $banner->image_url));
                }

                $filename = 'banner_middle_' . time() . '_' . Str::random(5) . '.webp';
                $file->move(public_path('upload/banner_middle'), $filename);
                $banner->image_url = $filename;
            }
        }

        $banner->save();

        if ($banner->id) {
            $existingIds[] = $banner->id;
        }
    }

    // ✅ Xoá banner cũ (nếu cần)
    Banner::where('position', 'middle')
        ->whereNotIn('id', $existingIds)
        ->each(function ($banner) {
            $path = public_path('upload/banner_middle/' . $banner->image_url);
            if (file_exists($path)) {
                unlink($path);
            }
            $banner->delete();
        });

    return response()->json([
        'success' => true,
        'message' => 'Cập nhật banner middle thành công!'
    ]);
}

public function updateLogo(Request $request)
{
    $positions = ['logo_main', 'logo_footer']; // Hai loại logo cần xử lý
    $successMessages = [];

    foreach ($positions as $pos) {
        $titles = $request->input("title_$pos", []);
        $count = count($titles);
        $existingIds = [];
        $fileInputs = $request->file("image_$pos");
        $activeList = $request->input("active_$pos", []);

        for ($i = 0; $i < $count; $i++) {
            $id = $request->input("id_$pos.$i") ?? null;
            $banner = $id ? Banner::find($id) : new Banner();

            $banner->position = $pos;
            $banner->title    = $titles[$i] ?? null;
            $banner->link     = $request->input("link_$pos.$i") ?? null;
            $banner->order    = $request->input("order_$pos.$i") ?? 0;
            $banner->active   = isset($activeList[$i]) ? 1 : 0;

            if (!empty($fileInputs) && array_key_exists($i, $fileInputs)) {
                $file = $fileInputs[$i];

                if ($file->getClientOriginalExtension() === 'webp') {
                    // Xóa ảnh cũ nếu có
                    if ($banner->image_url && file_exists(public_path('public/frontend/images/logo/' . $banner->image_url))) {
                        unlink(public_path('public/frontend/images/logo/' . $banner->image_url));
                    }

                    // Tạo tên file mới
                    $filename = "{$pos}_" . time() . '_' . Str::random(5) . '.webp';
                    $file->move(public_path('public/frontend/images/logo/'), $filename);
                    $banner->image_url = $filename;
                }
            }

            $banner->save();

            if ($banner->id) {
                $existingIds[] = $banner->id;
            }
        }

        // Xóa logo cũ không còn trong danh sách
        Banner::where('position', $pos)
            ->whereNotIn('id', $existingIds)
            ->each(function ($banner) {
                $path = public_path('public/frontend/images/logo/' . $banner->image_url);
                if (file_exists($path)) {
                    unlink($path);
                }
                $banner->delete();
            });

        $successMessages[] = "Cập nhật " . ucfirst(str_replace('_', ' ', $pos)) . " thành công!";
    }

    return response()->json([
        'success' => true,
        'message' => implode(' - ', $successMessages)
    ]);
}


}
