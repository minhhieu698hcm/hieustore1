<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Support\Facades\Session;


class AttributeController extends Controller
{
    public function checkLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('/dashboard');
            }else
            {
                return Redirect::to('/admin')->send();
            }
        }
        public function manage_attribute(){
            $this->checkLogin();
            $perPage = 10;
            $list_attribute = Attribute::paginate($perPage);
            $count_attribute = Attribute::count();
            
            return view("admin.attribute.all_attribute")->with(compact('list_attribute', 'count_attribute'));
        }

        // Chuyển đến trang thêm nhóm phân loại
        public function add_attribute(){
            $this->checkLogin();
          
            return view("admin.attribute.add_attribute");
        }

        // Chuyển đến trang sửa nhóm phân loại
        public function edit_attribute($idAttribute){
            $this->checkLogin();
            
            $select_attribute = Attribute::where('idAttribute', $idAttribute)->first();
            return view("admin.attribute.edit_attribute")->with(compact('select_attribute'));
        }

        // Thêm nhóm phân loại
        public function submit_add_attribute(Request $request){
            $data = $request->all();
            $attribute = new Attribute();
            
            $select_attribute = Attribute::where('AttributeName', $data['AttributeName'])->first();

            if($select_attribute){
                return Redirect::to('add-attribute')->with('error', 'Tên nhóm phân loại này đã tồn tại');
            }else{
                $attribute->AttributeName = $data['AttributeName'];
                $attribute->save();
                session()->flash('success', 'Thêm nhóm phân loại thành công!');
                return Redirect::to('add-attribute');
            }
        }

        // Sửa nhóm phân loại
        public function submit_edit_attribute(Request $request, $idAttribute){
        $data = $request->all();
        $attribute = Attribute::find($idAttribute);

        // Kiểm tra xem có tồn tại AttributeName khác mà trùng với tên mới không
        $select_attribute = Attribute::where('AttributeName', $data['AttributeName'])
                                    ->where('idAttribute', '!=', $idAttribute) // Sử dụng cột khóa chính đúng
                                    ->first();

        if ($select_attribute) {
            return redirect()->back()->with('error', 'Tên nhóm phân loại này đã tồn tại');
        } else {
            // Cập nhật tên nhóm phân loại
            $attribute->AttributeName = $data['AttributeName'];
            $attribute->save();
            session()->flash('success', 'Sửa nhóm phân loại thành công!');
            return redirect()->back();
        }
    }

        // Xóa nhóm phân loại
        public function delete_attribute($idAttribute){
            Attribute::where('idAttribute', $idAttribute)->delete();
            return redirect()->back();
        }
        
        // Hiện checkbox chọn phân loại sản phẩm
        public function select_attribute(Request $request){
            $data = $request->all();

            if($data['action']){
                $output = '';
                if($data['action'] == "attribute"){
                    $list_attribute_val = AttributeValue::where('idAttribute', $data['idAttribute'])
                    ->orderByRaw("CAST(REGEXP_REPLACE(AttrValName, '[^0-9.]', '') AS FLOAT) ASC")->get();
                    foreach($list_attribute_val as $key => $attribute_val){
                        $output .= '<label for="chk-attr-'.$attribute_val->idAttrValue.'" class="d-block col-lg-3 p-0 m-0 "><div id="attr-name-'.$attribute_val->idAttrValue.'" class="select-attr text-center mr-2 mt-2 btn btn-outline-danger" style="width: 80%;">'.$attribute_val->AttrValName.'</div></label>
                        <input type="checkbox" class="checkstatus d-none chk_attr" id="chk-attr-'.$attribute_val->idAttrValue.'" data-id = "'.$attribute_val->idAttrValue.'" data-name = "'.$attribute_val->AttrValName.'" name="chk_attr[]" value="'.$attribute_val->idAttrValue.'">';
                    }
                }
            }
            echo $output;
        }
}
