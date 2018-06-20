@extends('layouts.app')
<title>Thay đổi thông tin lớp</title>
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
                <h1 class="panel-heading">Thay đổi thông tin lớp</h1>
                <div class="panel-body">
                    <hr>
                    <div class="row">
                        <div class="col-sm-4">
                            <form method="POST" action="{{ route('lop.update', $data->id )}}">
                                @csrf
                                <div class="form-group">
                                    <label>Tên lớp:</label>
                                    <input type="text" class="form-control" value="{{ $data->name }}" name="name"
                                           placeholder="Nhap lop" required>
                                </div>
                                <div class="form-group">
                                    <label>Thuộc ngành</label>
                                    <select id="nganh" class="form-control" name="nganh">
                                        <option value="index">---</option>
                                        @foreach ($nganhs as $key => $value)
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Thuộc khoa</label>
                                    <select id="khoa" class="form-control" name="khoa">
                                        <option value="index">---</option>
                                        @foreach ($khoas as $key => $value)
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                                <button type="reset" class="btn btn-info">Làm mới</button>
                                <a class="btn btn-danger" href="{{ route('lop.index') }}">Quay lại</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function () {
            $("#khoa").change(function () {
                $.ajax({
                    url: "{{ route('lop.getlistnganh') }}",
                    data: {
                        id: $('#khoa').val()
                    },
                    success: function (data) {
                        $("#nganh").empty();
                        data.map(function (val) {
                            $("#nganh").append(new Option(val.name, val.id));
                        });
                    }
                });
            });
            $("#nganh").change(function () {
                $.ajax({
                    url: "{{ route('lop.getkhoa') }}",
                    data: {
                        id: $('#nganh').val()
                    },
                    success: function (data) {
                        $("#khoa").val(data);
                    }
                });
            });
        });
    </script>
@endsection