@extends('layouts.app')
<title>Danh sách Sinh viên</title>

@section('content')
    <div class="container">
        <div class="row justify-content-center"><h1><b>Quản Lý Sinh Viên</b></h1></div>
        <hr>
        <div class="row justify-content-center">
            <div class="row justify-content-center">
                <a type="button" href="{{ route('sinhvien.create') }}" class="btn btn-outline-secondary"><b>Thêm mới</b>
                </a>&nbsp
                <a class="btn btn-success" href="{{ route('admin') }}">Quay lại</a>
            </div>
        </div>
        <hr>
        <div>
            <div class="row">
                <form method="get" action="{{route('sinhvien.search')}}">
                    <div class="row col-sm-12">
                        <div class="col-sm-6">
                            <input id="search" type="text" name="search" class="search form-control"
                                   placeholder="search ...">
                        </div>
                        <div class="col-sm-3">
                            <button class="btn btn-sm btn-block pull-left" type="submit">Tìm kiếm</button>
                        </div>
                        <div class="col-sm-3">
                            <a href="{{route('sinhvien.index')}}" class="btn btn-sm btn-block pull-left btn-default">Làm
                                lại</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Chọn Khoa</label>
                                <select id="khoa" class="form-control" name="khoa">
                                    <option value="">---</option>
                                    @foreach ($khoas as $key => $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Chọn Ngành</label>
                                <select id="nganh" class="form-control" name="nganh">
                                    <option value="">---</option>
                                    @foreach ($nganhs as $key => $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Chọn Lớp</label>
                                <select id="lop" class="form-control" name="lop">
                                    <option value="">---</option>
                                    @foreach ($lops as $key => $value)
                                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <hr>
        <div class="row">
            <table class="table table-striped table-hover table-bordered">
                <thead>
                <tr>
                    <th>MSSV</th>
                    <th>Họ & tên</th>
                    <th>Giới tính</th>
                    <th>Khoa</th>
                    <th>Ngành</th>
                    <th>Lớp</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th>Ảnh đại diện</th>
                    <th>Tùy chọn</th>
                </tr>
                </thead>
                <tbody id="table">
                <?php foreach ($data as $key => $value): ?>
                <tr>
                    <td>{{ $value->mssv }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->gioitinh }}</td>
                    <td>{{ $value->khoa }}</td>
                    <td>{{ $value->nganh }}</td>
                    <td>{{ $value->lop }}</td>
                    <td>{{ $value->email }}</td>
                    <td>{{ $value->sdt }}</td>
                    @if (empty($value->anh))
                        <td><img src="{{url('upload')}}/avatar.png" width="50px" height="50px"></td>
                    @else
                        <td><img src="{{url('upload', $value->anh)}}" width="50px" height="50px"></td>
                    @endif
                    <td>
                        <a href="{{ route('sinhvien.edit', [$value->id]) }}" class="btn btn-success">Sửa</a>
                        <a href="{{ route('sinhvien.destroy', [$value->id]) }}" class="btn btn-danger">Xóa</a>
                    </td>
                </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        </div>
        {{ $data->links() }}
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
                        $("#nganh").append(new Option('---', ''))
                        data.map(function (val) {
                            $("#nganh").append(new Option(val.name, val.id));
                        });
                        $.ajax({
                            url: "{{ route('lop.getlistlop') }}",
                            data: {
                                id: $('#nganh').val()
                            },
                            success: function (data) {
                                $("#lop").empty();
                                $("#lop").append(new Option('---', ''))
                                data.map(function (val) {
                                    $("#lop").append(new Option(val.name, val.id));
                                });
                            }
                        });
                    }
                });
            });
            $("#nganh").change(function () {
                $.ajax({
                    url: "{{ route('lop.getlistlop') }}",
                    data: {
                        id: $('#nganh').val()
                    },
                    success: function (data) {
                        $("#lop").empty();
                        $("#lop").append(new Option('---', ''))
                        data.map(function (val) {
                            $("#lop").append(new Option(val.name, val.id));
                        });
                    }
                });
            });
        });
    </script>
@endsection