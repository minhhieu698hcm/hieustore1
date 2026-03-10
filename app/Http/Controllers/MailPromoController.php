<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MailPromo;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use App\Mail\PromoMail;
use DB;
use Session;


class MailPromoController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('/dashboard');
            }else
            {
                return Redirect::to('/admin')->send();
            }
        }
  public function showSendForm($id) {
    $promo = MailPromo::findOrFail($id);
    return view('admin.mailpromo.send', compact('promo'));
}

public function sendMailPromo(Request $request, $id) {
    $promo = MailPromo::findOrFail($id);
    $emails = explode("\n", $request->emails ?? '');

    // Xử lý file nếu có
    if ($request->hasFile('email_file')) {
        $fileEmails = file($request->file('email_file')->getRealPath(), FILE_IGNORE_NEW_LINES);
        $emails = array_merge($emails, $fileEmails);
    }

    $emails = array_unique(array_filter(array_map('trim', $emails)));

    foreach ($emails as $email) {
        Mail::to($email)->send(new PromoMail($promo));
    }

    return back()->with('success', 'Đã gửi email thành công!');
}

public function getEmailsFromOrders() {
    $emails = DB::table('orders')->pluck('customer_email')->unique()->toArray();
    return response()->json($emails);
}
public function all_mailpromo(){
        $this->AuthLogin();
        $perPage = 10;
        $all_mailpromo = DB::table('mailpromo')->paginate($perPage);
        $manager_mailpromo = view('admin.mailpromo.all_mailpromo')->with('all_mailpromo',$all_mailpromo);
        return view('admin_layout')->with('admin.mailpromo.all_mailpromo',$manager_mailpromo);
    }
public function add_mailpromo(){
        $this->AuthLogin();

        return view('admin.mailpromo.add_mailpromo');
    }
public function save_mailpromo(Request $request)
{
    $this->AuthLogin();

    $validator = Validator::make($request->all(), [
		'form_name' => 'required|max:255',
        'mailpromo_title' => 'required|max:255',
        'mailpromo_content' => 'required',
        'mailpromo_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Bước 1: Insert trước để lấy ID
    $mailpromo_id = DB::table('mailpromo')->insertGetId([
		'form_name' => $request->form_name,
        'mailpromo_title' => $request->mailpromo_title,
        'mailpromo_content' => '', // để tạm, lát update lại
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    $folderPath = public_path("upload/mailpromo/{$mailpromo_id}");
    if (!File::exists($folderPath)) {
        File::makeDirectory($folderPath, 0755, true);
    }

    // Bước 2: Xử lý ảnh trong nội dung (base64)
    $content = $this->saveBase64Images($request->mailpromo_content, $mailpromo_id);

    // ============================
    // ✅ Bước 2.5: Dùng DOMDocument để convert layout grid sang table cho email
    libxml_use_internal_errors(true);
    $doc = new \DOMDocument();
    $doc->loadHTML('<?xml encoding="utf-8" ?>' . $content);

    $xpath = new \DOMXPath($doc);
    $grids = $xpath->query('//div[contains(@class, "grid")]');

    foreach ($grids as $grid) {
        $products = $xpath->query('.//div[contains(@class, "product")]', $grid);

        $table = $doc->createElement('table');
        $table->setAttribute('style', 'width:100%;table-layout:fixed;border-spacing:0;border-collapse:collapse;');

        $tr = $doc->createElement('tr');

        foreach ($products as $product) {
            $td = $doc->createElement('td');
            $td->setAttribute('style', 'width:33.33%;padding:10px;vertical-align:top;word-break:break-word;');
            $td->appendChild($product->cloneNode(true));
            $tr->appendChild($td);
        }

        $table->appendChild($tr);
        $grid->parentNode->replaceChild($table, $grid);
    }

    $content = $doc->saveHTML($doc->getElementsByTagName('body')->item(0));
    $content = preg_replace('/^<body>|<\/body>$/', '', $content); // Xóa thẻ <body> bao ngoài
    // ============================

    // Format thêm style HTML
    $content = str_replace('<img', '<img style="max-width:100%;height:auto;"', $content);
    $content = str_replace('<table', '<table style="width:100%;"', $content);
    $content = str_replace('<td', '<td style="word-break:break-word;"', $content);

    // Fix đường dẫn ảnh tương đối -> đầy đủ asset (có /public/)
    $content = preg_replace_callback('/src="\/?(upload\/mailpromo\/[^"]+)"/i', function ($matches) {
        return 'src="' . asset('public/' . $matches[1]) . '"';
    }, $content);

    // Bước 3: Nếu có ảnh đại diện
    $imageFileName = null;
    if ($request->hasFile('mailpromo_image')) {
        $get_image = $request->file('mailpromo_image'); 
        $image_name = pathinfo($get_image->getClientOriginalName(), PATHINFO_FILENAME);
        $new_image = $image_name . '_' . uniqid() . '.' . $get_image->getClientOriginalExtension();
        $get_image->move($folderPath, $new_image);
        $imageFileName = $new_image;
    }

    // Bước 4: Cập nhật lại nội dung và ảnh đại diện
    DB::table('mailpromo')
        ->where('mailpromo_id', $mailpromo_id)
        ->update([
            'mailpromo_content' => $content,
            'mailpromo_image' => $imageFileName,
            'updated_at' => now(),
        ]);

    session()->flash('success', 'Thêm Mail Promo thành công!');
    return Redirect::to('all-mailpromo');
}

/**
 * ✅ Lưu ảnh base64 vào thư mục promo_id
 */
protected function saveBase64Images($content, $promoId)
{
    $pattern = '/<img[^>]+src=["\']data:image\/([^"\';]+);base64,([^"\']+)["\'][^>]*>/i';

    return preg_replace_callback($pattern, function ($matches) use ($promoId) {
        $ext = $matches[1];
        $base64data = $matches[2];
        $imgData = base64_decode($base64data);
        if ($imgData === false) return $matches[0];

        $fileName = uniqid('img_') . '.' . $ext;
        $savePath = public_path("upload/mailpromo/{$promoId}/{$fileName}");
        file_put_contents($savePath, $imgData);

        $url = asset("public/upload/mailpromo/{$promoId}/{$fileName}");
        return '<img src="' . $url . '" style="max-width:100%;height:auto;" />';
    }, $content);
}


public function edit_mailpromo($mailpromo_id)
{
    $this->AuthLogin();

    $mailpromo = DB::table('mailpromo')->where('mailpromo_id', $mailpromo_id)->first();
    if (!$mailpromo) {
        return redirect('all-mailpromo')->with('error', 'Mail Promo không tồn tại.');
    }

    return view('admin.mailpromo.edit_mailpromo')->with('mailpromo', $mailpromo);
}



public function submit_edit_mailpromo(Request $request)
{
    $this->AuthLogin();

    $mailpromo_id = $request->mailpromo_id;
    $folderPath = public_path("upload/mailpromo/{$mailpromo_id}");

    if (!File::exists($folderPath)) {
        File::makeDirectory($folderPath, 0755, true);
    }

    // Decode nội dung từ HTML entities
    $decodedContent = html_entity_decode($request->mailpromo_content);

    // Lưu ảnh base64 trong content và thay src
    $content = $this->saveBase64Images($decodedContent, $mailpromo_id);

    // Loại bỏ script nếu có (bảo mật)
    $content = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $content);

    // ============================
    // Tự động convert grid -> table với DOMDocument (như save_mailpromo)
    libxml_use_internal_errors(true);
    $doc = new \DOMDocument();
    $doc->loadHTML('<?xml encoding="utf-8" ?>' . $content);

    $xpath = new \DOMXPath($doc);
    $grids = $xpath->query('//div[contains(@class, "grid")]');

    foreach ($grids as $grid) {
        $products = $xpath->query('.//div[contains(@class, "product")]', $grid);

        $table = $doc->createElement('table');
        $table->setAttribute('style', 'width:100%;table-layout:fixed;border-spacing:0;border-collapse:collapse;');

        $tr = $doc->createElement('tr');

        foreach ($products as $product) {
            $td = $doc->createElement('td');
            $td->setAttribute('style', 'width:33.33%;padding:10px;vertical-align:top;word-break:break-word;');
            $td->appendChild($product->cloneNode(true));
            $tr->appendChild($td);
        }

        $table->appendChild($tr);
        $grid->parentNode->replaceChild($table, $grid);
    }

    $content = $doc->saveHTML($doc->getElementsByTagName('body')->item(0));
    $content = preg_replace('/^<body>|<\/body>$/', '', $content); // Xóa thẻ <body> bao ngoài
    // ============================

    // Thêm style cho img, table, td
    $content = str_replace('<img', '<img style="max-width:100%;height:auto;"', $content);
    $content = str_replace('<table', '<table style="width:100%;"', $content);
    $content = str_replace('<td', '<td style="word-break:break-word;"', $content);

    // Cập nhật src ảnh base64 sang đường dẫn đầy đủ
    $content = preg_replace_callback('/src="\/?(upload\/mailpromo\/[^"]+)"/i', function ($matches) {
        return 'src="' . asset('public/' . $matches[1]) . '"';
    }, $content);

    $data = [
		'form_name' => $request->form_name,
        'mailpromo_title' => $request->mailpromo_title,
        'mailpromo_content' => $content,
        'updated_at' => now(),
    ];

    // Xử lý ảnh đại diện nếu có upload mới
    if ($request->hasFile('mailpromo_image')) {
        $old = DB::table('mailpromo')->where('mailpromo_id', $mailpromo_id)->first();

        if ($old && $old->mailpromo_image) {
            $oldPath = $folderPath . '/' . $old->mailpromo_image;
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
        }

        $file = $request->file('mailpromo_image');
        $imageName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $uniqueName = $imageName . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        $file->move($folderPath, $uniqueName);
        $data['mailpromo_image'] = $uniqueName;
    }

    DB::table('mailpromo')->where('mailpromo_id', $mailpromo_id)->update($data);

    session()->flash('success', 'Cập nhật Mail Promo thành công!');
    return redirect('all-mailpromo');
}

 public function previewPromoMail($id)
    {
        $promo = DB::table('mailpromo')->where('mailpromo_id', $id)->first();

        if (!$promo) {
            abort(404, 'Không tìm thấy nội dung mail promo');
        }

        $mailable = new MailPromoPreview($promo); // <-- sử dụng Mailable mới
        return $mailable->render();
    }
    public function delete_mailpromo($mailpromo_id)
{
    $this->AuthLogin();

    // Xoá thư mục ảnh liên quan
    $folder = public_path("upload/mailpromo/{$mailpromo_id}");
    if (File::exists($folder)) {
        File::deleteDirectory($folder);
    }

    DB::table('mailpromo')->where('mailpromo_id', $mailpromo_id)->delete();

    session()->flash('success','Xóa Mail Promo thành công');
    return Redirect::to('all-mailpromo');
}

}
