@extends('layouts.app')
<title>Danh sách lớp</title>
@section('content')
    <div class="container">
        <div class="row justify-content-center"><h1><b>Quản Lý Lớp</b></h1></div>
        <hr>
        @if(session()->has('message'))
            <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ session()->get('message') }}
            </div>
        @endif
        <div class="row justify-content-center">
            <a class="btn btn-danger" href="{{ route('lop.create') }}">Thêm mới</a> &nbsp
            <a class="btn btn-success" href="{{ route('admin') }}">Quay lại</a>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-12">
                <form method="get" action="{{ route('lop.search') }}">
                    @csrf
                    <div class="row">
                        <div class="col-sm-8">
                            <input id="search" type="text" name="search" class="search form-control"
                                   placeholder="search ...">
                        </div>
                        <div class="col-sm-2">
                            <button class="btn btn-sm btn-block pull-left" type="submit">Tìm kiếm</button>
                        </div>
                        <div class="col-sm-2">
                            <button class="btn btn-sm btn-block pull-left">Làm lại</button>
                        </div>
                    </div>
                </form>
                <hr>
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>Tên lớp</th>
                        <th>Thuộc ngành</th>
                        <th>Thuộc khoa</th>
                        <th>Tùy chọn</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($data as $key => $value): ?>
                    <tr>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->nganh }}</td>
                        <td>{{ $value->khoa }}</td>
                        <td>
                            <a href="{{ route('lop.edit', [$value->id]) }}" class="btn btn-success">Sửa</a>
                            <a href="{{ route('lop.destroy', [$value->id]) }}" class="btn btn-danger">Xóa</a>
                        </td>
                        </td>
                    </tr>
                    <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-sm-12">
                {{ $data->links() }}
            </div>
        </div>
    </div>
@endsection
