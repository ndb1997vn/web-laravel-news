 @extends('admin.layouts.index')
 @section('content')
 <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">User
                            <small>Thêm</small>
                        </h1>
                    </div>
                
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                              @if(count($errors)>0)
                                <div class='alert alert-danger'>
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
                        <form action="admin/user/them" method="POST">
                            <input type="hidden"    name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label>Họ Và Tên</label>
                                <input class="form-control" name="hoten" placeholder="Nhập Họ Tên Người Dùng" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Nhập Địa Chỉ Email" />
                            </div>
                            <div class="form-group">
                                <label>Mật Khẩu</label>
                                <input type="password" class="form-control" name="pass" placeholder="Nhập Mật Khẩu " />
                            </div>
                            <div class="form-group">
                                <label>Nhập Lại Mật Khẩu</label>
                                <input type="password" class="form-control" name="pass1" placeholder="Nhập Lại Mật Khẩu " />
                            </div>
                        
                            <div class="form-group">
                                <label>Quyền</label>
                                <label class="radio-inline">
                                    <input name="permission" value="1" checked="" type="radio">Admin
                                </label>
                                <label class="radio-inline">
                                    <input name="permission" value="2" type="radio">Thường
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
  @endsection('content')
