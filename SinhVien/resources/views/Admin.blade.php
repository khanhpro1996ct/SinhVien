@extends('layouts.app')
<title>Quan Ly</title>
@section('content')
    <div class="container">
        @if(session()->has('message'))
            <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ session()->get('message') }}
            </div>
        @endif
        <div class="row">
            <a>Admin</a>
        </div>
        <div class="row justify-content-sm-end">
            <a href="{{ route('login.getlogin') }}">Thoát</a>
        </div>
        <hr>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row justify-content-center">
                    <div class="col-sm-4" style="text-align: center">
                        <a style="width: 200px; height: 100px;" class="btn btn-lg btn-primary"
                           href="{{ route('khoa.giaodien') }}">Khoa</a>
                    </div>
                    <div class="col-sm-4">
                        <a style="width: 200px; height: 100px" class="btn btn-lg btn-info"
                           href="{{ route('nganh.index') }}">Ngành</a>
                    </div>
                </div>
                <hr>
                <div class="row justify-content-center">
                    <div class="col-sm-4">
                        <a style="width: 200px; height: 100px" class="btn btn-lg btn-warning"
                           href="{{ route('lop.index') }}">Lớp</a>
                    </div>
                    <div class="col-sm-4">
                        <a style="width: 200px; height: 100px" class="btn btn-lg btn-danger"
                           href="{{ route('sinhvien.index') }}">Sinh Viên</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection