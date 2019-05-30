@extends('admin.layouts.index')
@section('content')
      <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Thể Loại
                            <small>{{$theloai->Ten}}</small>
                        </h1>
                    </div>
            
                    <div class="col-lg-7" style="padding-bottom:120px">
                        @if(count($errors)>0)
                        <div class=" alert alert-danger">
                            @foreach($errors->all() as $err)
                            {{$err}}
                            @endforeach
                        </div>
                        @endif
                        @if(session('Thongbao'))
                        <div class="alert alert-success">
                            {{session('Thongbao')}}
                        </div>
                        @endif

                        <form action="admin/theloai/sua/{{$theloai->id}}" method="POST" >
                            <input type="hidden" name="_token" value="{{csrf_token()}}" />
                            <div class="form-group" />

                                <label>Tên Thể Loại</label>
                                <input class="form-control" name="Ten" placeholder="Nhập Tên Thể Loại" value="{{$theloai->Ten}}" />
                            </div>
                            <button type="submit" class="btn btn-default">Sửa</button>
                            <button type="reset" class="btn btn-default">Làm Mới</button>
                            <button type="button" class="btn btn-default" onClick="function1()">Just Click!<button>


                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
        


@endsection('content')