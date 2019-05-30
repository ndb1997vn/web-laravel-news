@extends('admin.layouts.index')
@csrf
@section('content')
  <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Tin Tức
                            <small>{{$tintuc->TieuDe}}</small>
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
                        <form action="admin/tintuc/sua/{{$tintuc->id}}" method="POST" enctype="multipart/form-data" >
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                            <div class="form-group" name="1" >
                                <label>Thể Loại</label>
                                <select class="form-control" id="TheLoai">
                               
                                    @foreach($theloai as $tl)
                                    @if($tintuc->loaitin->theloai->id == $tl->id);
                                    {{"selected"}}
                                    @endif
                                    <option value="{{$tl->id}}">{{$tl->Ten}}</option>
                                    @endforeach
                                </select>
                            </div>
                             <div class="form-group">
                                <label>Loại Tin</label>
                                <select class="form-control" id="LoaiTin" name="LoaiTin">
                                    @foreach($loaitin as $lt)
                                    @if($tintuc->loaitin->id == $lt->id);
                                    {{"selected"}}
                                    @endif
                                    <option value="{{$lt->id}}">{{$lt->Ten}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tiêu Đề</label>
                                <input class="form-control" name="TieuDe" value="{{$tintuc->TieuDe}}" placeholder="Nhập Tiêu Đề" />
                            </div>
                            
                            <div class="form-group">
                                <label>Tóm Tắt</label>
                                <textarea id="demo" class="form-control" name="TomTat"  rows="3">{{$tintuc->TomTat}}</textarea>                            </div>

                             <div class="form-group">
                                <label>Nội Dung</label>
                                <textarea id="demo" class="form-control ckeditor" name="NoiDung" rows="5">{{$tintuc->NoiDung}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Hình Ảnh</label>
                                <img width="400px" src="upload/tintuc/{{$tintuc->Hin}}">
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
                            <button type="submit" class="btn btn-default">Sửa</button>
                            <button type="reset" class="btn btn-default">Làm Mới</button>
                        <form>
                    </div>
                </div>

                          @if(count($errors)>0)
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $err)
                                {{$err}}<br>
                                @endforeach
                              </div>
                            @endif
                            
                            @if(session('ThongBao1'))
                            <div class="alert alert-success">
                                {{session('ThongBao1')}}
                            </div>
                            @endif

                 <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Bình Luận
                            <small>Danh Sách</small>
                        </h1>
                    </div>
                    
                        
                    
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Người Dùng</th>
                                <th>Nội Dung</th>
                                <th>Ngày Đăng</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tintuc->comment as $cm)
                            <tr class="odd gradeX" align="center">
                                <td>{{$cm->id}}</td>
                                <td>{{$cm->user->name}}</td>
                                <td>{{$cm->NoiDung}}</td>
                                <td>{{$cm->creat_at}}</td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/comment/xoa/{{$cm->id }}/{{$tintuc->id}}"> Delete</a></td>
                          
                            </tr>
                            @endforeach
                            
                            
                        </tbody>
                    </table>
                </div>
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