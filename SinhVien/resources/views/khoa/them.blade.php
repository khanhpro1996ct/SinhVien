@extends('layouts.app')
<title>Thêm mới khoa</title>
@section('content')
    <div class="container">
        <div class="panel-group">
            <div class="panel panel-success">
                @if(session()->has('message'))
                    <div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{ session()->get('message') }}
                    </div>
                @endif
                <h1 class="panel-heading">Thêm mới khoa</h1>
                <div class="panel-body">
                    <hr>
                    <div class="row justify-content-center">
                        <div class="col-sm-4">
                            <form method="POST" action="{{ route('khoa.luu') }}">
                                @csrf
                                <div class="form-group">
                                    <label>Tên khoa:</label>
                                    <input type="text" class="form-control" name="name" placeholder="Nhập khoa"
                                           required>
                                </div>
                                <button type="submit" class="btn btn-primary">Lưu lại</button>
                                <button type="reset" class="btn btn-info">Làm mới</button>
                                <a class="btn btn-danger" href="{{ route('khoa.giaodien') }}">Quay lại</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection