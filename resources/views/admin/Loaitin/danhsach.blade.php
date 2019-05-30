
@extends('admin.layouts.index')
@section('content')
  <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">The Loai
                            <small>List</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    @if(session('Thongbao'))
                    <div class="alert alert-success">
                    {{session("Thongbao")}}
                    </div>
                    @endif

                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Ten Loai Tin</th>
                                <th>Ten Khong Dau</th>
                                
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($loaitin as $lt)
                            <tr class="odd gradeX" align="center">
                                <td>{{$lt->id}}</td>
                                <td>{{$lt->Ten}}</td>
                                <td>{{$lt->TenKhongDau}}</td>
                                <td>Hiện</td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/loaitin/xoa/{{$lt->id}}"> Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/loaitin/sua/{{$lt->id}}">Edit</a></td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
@endsection