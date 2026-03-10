<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Support\Facades\Session;

class AttributeValueController extends Controller
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
        public function manage_attr_value(){
            $this->checkLogin();
            $perPage = 10;
            $list_attr_value = AttributeValue::join('attribute','attribute.idAttribute','=','attribute_value.idAttribute')->paginate($perPage);
            $count_attr_value = AttributeValue::count();

            return view("admin.attribute_value.all_attribute_value")->with(compact('list_attr_value', 'count_attr_value'));
        }

        // Chuyển đến trang thêm phân loại
        public function add_attr_value(){
            $list_attribute = Attribute::get();
            $this->checkLogin();
            
            return view("admin.attribute_value.add_attribute_value")->with(compact('list_attribute'));
        }

        // Chuyển đến trang sửa phân loại
        public function edit_attr_value($idAttrValue){
            $this->checkLogin();
            
            $list_attribute = Attribute::get();
            $select_attr_value = AttributeValue::join('attribute','attribute.idAttribute','=','attribute_value.idAttribute')
                ->where('idAttrValue', $idAttrValue)->first();
            return view("admin.attribute_value.edit_attribute_value")->with(compact('select_attr_value','list_attribute'));
        }

        // Thêm phân loại
        public function submit_add_attr_value(Request $request){
            $data = $request->all();
            $attr_value = new AttributeValue();
            
            $select_attr_value = AttributeValue::where('idAttribute', $data['idAttribute'])
                ->where('AttrValName', $data['AttrValName'])->first();

            if($select_attr_value){
                return redirect()->back()->with('error', 'Tên phân loại này đã tồn tại');
            }else{
                $attr_value->AttrValName = $data['AttrValName'];
                $attr_value->idAttribute = $data['idAttribute'];
                $attr_value->save();
                session()->flash('success', 'Thêm phân loại thành công!');
                return redirect()->back();
            }
        }

        // Sửa phân loại
      public function submit_edit_attr_value(Request $request, $idAttrValue){
    $data = $request->all();
    $attr_value = AttributeValue::find($idAttrValue);

    // Kiểm tra xem có tên phân loại nào khác trùng với tên mới trong cùng nhóm phân loại không
    $select_attr_value = AttributeValue::where('idAttribute', $data['idAttribute'])
        ->where('AttrValName', $data['AttrValName'])
        ->where('idAttrValue', '!=', $idAttrValue) // Sử dụng cột khóa chính đúng
        ->first();

    if ($select_attr_value) {
        return redirect()->back()->with('error', 'Tên phân loại này đã tồn tại');
    } else {
        // Cập nhật tên phân loại và idAttribute
        $attr_value->AttrValName = $data['AttrValName'];
        $attr_value->idAttribute = $data['idAttribute'];
        $attr_value->save();
        session()->flash('success', 'Sửa phân loại thành công!');
        return redirect()->back();
    }
}

        // Xóa phân loại
        public function delete_attr_value($idAttrValue){
            AttributeValue::where('idAttrValue', $idAttrValue)->delete();
            session()->flash('success', 'Xoá phân loại thành công!');
            return redirect()->back();
        }
}
