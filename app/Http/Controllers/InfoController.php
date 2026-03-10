<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Info;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class InfoController extends Controller
{
    public function manager()
{
    $banners = Info::where('position', 'bannertext')
        ->orderBy('order')
        ->get();

    return view('admin.info.manager', compact('banners'));
}

public function saveBannerText(Request $request)
{
    // Nhận và giải mã JSON từ form
    $titles = json_decode($request->input('title', '[]'), true);
    $orders = json_decode($request->input('order', '[]'), true);
    $ids = json_decode($request->input('id', '[]'), true);
    $actives = json_decode($request->input('active', '[]'), true);

    foreach ($titles as $index => $title) {
        $id = $ids[$index] ?? null;

        $data = [
            'title' => $title,
            'position' => 'bannertext',
            'order' => $orders[$index] ?? 0,
            'active' => $actives[$index] ?? 0,
        ];

        if ($id) {
            Info::where('id', $id)->update($data);
        } else {
            Info::create($data);
        }
    }

    return response()->json([
        'status' => 'success',
        'message' => 'Cập nhật banner chữ thành công!'
    ]);
}



public function deleteBannerText(Request $request)
{
    $id = $request->input('id');

    if (!$id) {
        return response()->json(['status' => 'error', 'message' => 'Thiếu ID']);
    }

    try {
        $banner = Info::findOrFail($id);

        if ($banner->position !== 'bannertext') {
            return response()->json(['status' => 'error', 'message' => 'Không đúng loại banner.']);
        }

        $banner->delete();

        return response()->json(['status' => 'success', 'message' => 'Xóa banner chữ thành công.']);
    } catch (\Exception $e) {
        return response()->json(['status' => 'error', 'message' => 'Đã có lỗi khi xóa.']);
    }
}

}
