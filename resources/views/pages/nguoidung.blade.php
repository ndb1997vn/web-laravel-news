@extends('layout.index')
@section('content')

    <!-- Page Content -->
    <div class="container">

    	<!-- slider -->
    	<div class="row carousel-holder">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <div class="panel panel-default">
				  	<div class="panel-heading">Thông tin tài khoản</div>
				  	<div class="panel-body">
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
                        <form action="nguoidung" method="post">
                            <input type="hidden"    name="_token" value="{{csrf_token()}}"\>
                            <div class="form-group">
                                <label>Họ Và Tên</label>
                                <input class="form-control" name="hoten" placeholder="Nhập Họ Tên Người Dùng" value="{{$user->name}}"/>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" value="{{$user->email}}" placeholder="Nhập Địa Chỉ Email" readonly="" />
                            </div>
                            <div class="form-group">
                              
                                <input type="checkbox" id="changepass" name="changepass"  >
                                  <label>Đổi Mật Khẩu</label>
                                <input type="password" class="form-control password" name="pass" placeholder="Nhập Mật Khẩu " disabled="" />
                            </div>
                            <div class="form-group">
                                <label>Nhập Lại Mật Khẩu</label>
                                <input type="password" class="form-control password" name="pass1" placeholder="Nhập Lại Mật Khẩu " disabled="" />
                            </div>
                        
                   
                            <button type="submit" class="btn btn-default">Sửa</button>
                            <button type="reset" class="btn btn-default">Làm Mới</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
  @endsection('content')
@section('script') 
    <script >
        $(document).ready(function(){
            $("#changepass").change(function(){
                if($(this).is(":checked") )
                {
                    $(".password").removeAttr('disabled');
                }
                else
                {
                     $(".password").attr('disabled','');
                }

            });
        });



    </script>

@endsection