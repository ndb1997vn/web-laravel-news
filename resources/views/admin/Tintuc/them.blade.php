@extends('admin.layouts.index')
@csrf
@section('content')
  <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Tin Tức
                            <small>Thêm</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        @if(count($errors)>0)
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $err)
                                {{$err}}<br>
                                @endforeach
                              </div>
                            @endif
                            
                            @if(session('ThongBao'))
                            <div class="alert alert-success">
                                {{session('ThongBao')}}
                            </div>
                            @endif
                        <form action="admin/tintuc/them" method="POST" enctype="multipart/form-data" >
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                            <div class="form-group" name="1" >
                                <label>Thể Loại</label>
                                <select class="form-control" id="TheLoai">
                                    <option value="0">Chọn Thể loại</option>
                                    @foreach($theloai as $tl)
                                    <option value="{{$tl->id}}">{{$tl->Ten}}</option>
                                    @endforeach
                                </select>
                            </div>
                             <div class="form-group">
                                <label>Loại Tin</label>
                                <select class="form-control" id="LoaiTin" name="LoaiTin"> 
                                    <option value="0" >Chọn Loại Tin</option>
                                    @foreach($loaitin as $lt)
                                    <option value="{{$lt->id}}">{{$lt->Ten}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tiêu Đề</label>
                                <input class="form-control" name="TieuDe" placeholder="Nhập Tiêu Đề" />
                            </div>
                            
                            <div class="form-group">
                                <label>Tóm Tắt</label>
                                <textarea id="demo" class="form-control" name="TomTat" rows="3"></textarea>                            </div>

                             <div class="form-group">
                                <label>Nội Dung</label>
                                <textarea id="demo" class="form-control ckeditor" name="NoiDung" rows="5"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Hình Ảnh</label>
                                <input type="file" name="Hinh" class="form-control">
                            </div>
                            
                            
                            <div class="form-group">
                                <label>Nổi bật</label>
                                <label class="radio-inline">
                                    <input name="rdoStatus" value="0" checked="" type="radio">không
                                </label>
                                <label class="radio-inline">
                                    <input name="rdoStatus" value="1" type="radio">Có
                                </label>
                            </div>
                            <button type="submit" class="btn btn-default">Thêm</button>
                            <button type="reset" class="btn btn-default">Làm Mới</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
  @endsection

@section('script')
<script>
    $(document).ready(function(){
       $("#TheLoai").change(function(){
            var idTheloai=$(this).val();
            $.get("admin/ajax/loaitin/"+idTheloai,function(data){
                $("#LoaiTin").html(data);
            });
         });
    });
</script>
@endsection