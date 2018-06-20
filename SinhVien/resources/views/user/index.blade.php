@extends('layouts.app')
<title>thong tin</title>
@section('content')
    <div class="container">
        <a>Thông Tin Sinh Viên</a>
        <hr>
        <div class="row justify-content-center">
            <div class="col-sm-4">
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ session()->get('message') }}
                    </div>
                @endif
                <img class="img-thumbnail" width="180" height="180" src="{{ url("upload", $data->anh) }}">
                <br>
                <div class="row">
                    <a href="{{route('user.doimatkhau',[$data->id])}}" id="passwd" style="margin-left: 15px" class="btn btn-danger" name="passwd">Đổi Mật khẩu</a>
                    <a style="margin-left: 5px" class="btn btn-info" href="{{ route('login.getlogin') }}">Thoát</a>
                </div>
            </div>
            <div class="col-sm-8">
                <table class="table table-striped">
                    <tbody>
                    <tr>
                        <td>MSSV</td>
                        <td>{{ $data->mssv }}</td>
                    </tr>
                    <tr>
                        <td>Họ Tên</td>
                        <td>{{ $data->name }}</td>
                    </tr>
                    <tr>
                        <td>Giới Tính</td>
                        <td>{{ $data->gioitinh }}</td>
                    </tr>
                    <tr>
                        <td>Khoa</td>
                        <td>{{ $data->khoa }}</td>
                    </tr>
                    <tr>
                        <td>Ngành</td>
                        <td>{{ $data->nganh }}</td>
                    </tr>
                    <tr>
                        <td>Lớp</td>
                        <td>{{ $data->lop }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{ $data->email }}</td>
                    </tr>
                    <tr>
                        <td>SĐT</td>
                        <td>{{ $data->sdt }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection