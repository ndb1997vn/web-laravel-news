@extends('admin.layouts.index')
@section('content')
      <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Thể Loại
                            <small>{{$loaitin->Ten}}</small>
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

                        <form action="admin/loaitin/sua/{{$loaitin->id}}" method="POST" >
                            <input type="hidden" name="_token" value="{{csrf_token()}}" />
                            <div class="form-group" />

                                <label>Tên Loai Tin</label>
                                <input class="form-control" name="Ten" placeholder="Nhập Tên Loai Tin" value="{{$loaitin->Ten}}" />
                            </div>
                            <button type="submit" class="btn btn-default">Sửa</button>
                            <button type="reset" class="btn btn-default">Làm Mới</button>
                            <button type="button" class="btn btn-default">Quay Lai</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->


@endsection('content')