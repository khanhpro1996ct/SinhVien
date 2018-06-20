@extends('layouts.app')
<title>Thay đổi thông tin ngành</title>
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
                <h1 class="panel-heading">Thay đổi thông tin ngành</h1>
                <div class="panel-body">
                    <hr>
                    <div class="row">
                        <div class="col-sm-4">
                            <form method="POST" action="{{ route('nganh.update', $data->id) }}">
                                @csrf
                                <div class="form-group">
                                    <label>Thuộc Khoa</label>
                                    <select id="khoas" class="form-control" name="khoa">
                                        <option value="index">---</option>
                                        @foreach ($khoas as $key => $value)
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Tên ngành:</label>
                                    <input type="text" class="form-control" value="{{ $data->name }}" name="name"
                                           placeholder="Nhập nganh" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Lưu lại</button>
                                <button type="reset" class="btn btn-info">Làm mới</button>
                                <a class="btn btn-danger" href="{{ route('nganh.index') }}">Quay Lại</a>
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
            $("#khoas").change(function () {
                $.ajax({
                    url: "{{ route('nganh.store') }}",
                    data: {
                        parents: $('#khoas').val()
                    },
                    success: function (data) {
                        $("#nganhs").empty();
                        data.map(function (val) {
                            $("#nganhs").append(new Option(val.name, val.id));
                        });
                    }
                });
            });
            $("#nganhs").change(function () {
                $.ajax({
                    url: "{{ route('nganh.getKhoabyId') }}",
                    data: {
                        id: $('#nganhs').val()
                    },
                    success: function (data) {
                        $("#khoas").val(data);
                    }
                });
            });
        });
    </script>
@endsection