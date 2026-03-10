@extends('admin_layout')
@section('admin_content')
<div class="panel panel-default">
    <div class="panel-heading">
        Tất cả hiệu 
    </div>
    <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Bulk action</option>
          <option value="1">Delete selected</option>
          <option value="2">Bulk edit</option>
          <option value="3">Export</option>
        </select>
        <button class="btn btn-sm btn-default">Apply</button>                
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Go!</button>
          </span>
        </div>
      </div>
    </div>
    <div class="table-responsive">
      <?php
      $message = Session::get('message');
      if($message){
          echo $message;
          Session::put('message',null);
      }
      ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
             <th>Tên thương hiệu</th>
            <th>Hiển thị</th>
            <th>Ngày tạo</th>
            <th>Chỉnh sửa</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($all_brand_product as $key => $brand_pro )
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{ $brand_pro->brand_name }}</td>
            <td><span class="text-ellipsis">
              <?php
              if($brand_pro->brand_status ==1){
              ?>
               <a href="{{URL::to('/unactive-brand-product/'.$brand_pro->brand_id)}}"><span style="font-size: 45px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="45px" height="45px" viewBox="0 0 24 24" fill="none">
                <path d="M15.0007 12C15.0007 13.6569 13.6576 15 12.0007 15C10.3439 15 9.00073 13.6569 9.00073 12C9.00073 10.3431 10.3439 9 12.0007 9C13.6576 9 15.0007 10.3431 15.0007 12Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <path d="M12.0012 5C7.52354 5 3.73326 7.94288 2.45898 12C3.73324 16.0571 7.52354 19 12.0012 19C16.4788 19 20.2691 16.0571 21.5434 12C20.2691 7.94291 16.4788 5 12.0012 5Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
              </span></a>
              <?php
                }else{
              ?>
              <a href="{{URL::to('/active-brand-product/'.$brand_pro->brand_id)}}"><span style="font-size: 45px;"><svg width="45px" height="45px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M2.99902 3L20.999 21M9.8433 9.91364C9.32066 10.4536 8.99902 11.1892 8.99902 12C8.99902 13.6569 10.3422 15 11.999 15C12.8215 15 13.5667 14.669 14.1086 14.133M6.49902 6.64715C4.59972 7.90034 3.15305 9.78394 2.45703 12C3.73128 16.0571 7.52159 19 11.9992 19C13.9881 19 15.8414 18.4194 17.3988 17.4184M10.999 5.04939C11.328 5.01673 11.6617 5 11.9992 5C16.4769 5 20.2672 7.94291 21.5414 12C21.2607 12.894 20.8577 13.7338 20.3522 14.5" stroke="#fe0606" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
              </span></a>
              <?php
              }
            ?>
            </span></td>
            <td><span class="text-ellipsis">{{ \Carbon\Carbon::parse($brand_pro->created_at)->format('d/m/Y') }}</span></td>
            <td>
              <a href="{{URL::to('/edit-brand-product/'.$brand_pro->brand_id)}}" class="active styling-edit" ui-toggle-class="" style="padding: 0px 40px 0px 10px;">
                <svg width="45px" height="45px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M21.2799 6.40005L11.7399 15.94C10.7899 16.89 7.96987 17.33 7.33987 16.7C6.70987 16.07 7.13987 13.25 8.08987 12.3L17.6399 2.75002C17.8754 2.49308 18.1605 2.28654 18.4781 2.14284C18.7956 1.99914 19.139 1.92124 19.4875 1.9139C19.8359 1.90657 20.1823 1.96991 20.5056 2.10012C20.8289 2.23033 21.1225 2.42473 21.3686 2.67153C21.6147 2.91833 21.8083 3.21243 21.9376 3.53609C22.0669 3.85976 22.1294 4.20626 22.1211 4.55471C22.1128 4.90316 22.0339 5.24635 21.8894 5.5635C21.7448 5.88065 21.5375 6.16524 21.2799 6.40005V6.40005Z" stroke="#00c756" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M11 4H6C4.93913 4 3.92178 4.42142 3.17163 5.17157C2.42149 5.92172 2 6.93913 2 8V18C2 19.0609 2.42149 20.0783 3.17163 20.8284C3.92178 21.5786 4.93913 22 6 22H17C19.21 22 20 20.2 20 18V13" stroke="#00c756" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
              </a>
              <a  onclick="return confirm('Bạn muốn xóa danh mục?')" href="{{URL::to('/delete-brand-product/'.$brand_pro->brand_id)}}" class="active styling-edit" ui-toggle-class="">
                <svg fill="#ff0000" height="45px" width="45px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" stroke="#ff0000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <path d="M403.038,116.16c-7.236-27.172-31.674-46.276-60.424-46.276h-2.809v-8.758C339.805,27.421,312.384,0,278.678,0h-45.357 c-33.705,0-61.126,27.421-61.126,61.126v8.758h-2.809c-28.75,0-53.188,19.104-60.424,46.276 c-21.548,2.947-38.206,21.463-38.206,43.807v25.299c0.002,4.516,3.664,8.178,8.18,8.178h17.941l16.938,185.423 c0.387,4.246,3.953,7.434,8.134,7.434c0.25,0,0.5-0.012,0.753-0.034c4.498-0.411,7.811-4.39,7.4-8.888l-16.801-183.936h213.767 c4.516,0,8.178-3.661,8.178-8.178s-3.661-8.178-8.178-8.178H87.114v-17.121c0-15.369,12.503-27.872,27.872-27.872h0.674h47.961 c4.516,0,8.178-3.661,8.178-8.178s-3.661-8.178-8.178-8.178h-37.362c6.724-17.549,23.581-29.5,43.131-29.5h173.228 c19.549,0,36.407,11.95,43.131,29.5H196.331c-4.516,0-8.178,3.661-8.178,8.178s3.661,8.178,8.178,8.178h200.015h0.674 c15.369,0,27.872,12.503,27.872,27.872v17.121h-65.112c-4.516,0-8.178,3.661-8.178,8.178s3.661,8.178,8.178,8.178h38.925 L373.765,466.46c-1.52,16.638-15.265,29.184-31.972,29.184H170.21c-16.707,0-30.452-12.547-31.972-29.184l-5.15-56.37 c-0.411-4.498-4.391-7.807-8.888-7.4c-4.498,0.411-7.811,4.39-7.4,8.888l5.15,56.371C124.245,493.061,144.991,512,170.209,512 h171.582c25.218,0,45.964-18.939,48.259-44.052l25.075-274.505h17.941c4.516,0,8.178-3.661,8.178-8.178v-25.299 C441.244,137.623,424.585,119.107,403.038,116.16z M285.289,69.884h-58.573v-8.758c0-3.644,2.965-6.608,6.608-6.608h45.357 c3.644,0,6.609,2.964,6.609,6.608V69.884z M323.452,69.884h-21.807v-8.758c0-12.661-10.302-22.963-22.964-22.963h-45.357 c-12.662,0-22.963,10.302-22.963,22.963v8.758h-21.807v-8.758c0-24.687,20.083-44.77,44.77-44.77h45.357 c24.687,0,44.772,20.083,44.772,44.77V69.884z"></path> </g> </g> </g></svg>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
        <div class="row">
          
          <div class="col-sm-5 text-center">
            <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
          </div>
          <div class="col-sm-7 text-right text-center-xs">                
            <ul class="pagination pagination-sm m-t-none m-b-none">
              <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
              <li><a href="">1</a></li>
              <li><a href="">2</a></li>
              <li><a href="">3</a></li>
              <li><a href="">4</a></li>
              <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
            </ul>
          </div>
        </div>
      </footer>
@endsection