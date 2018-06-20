@extends('layouts.app')
<title>Thay đổi thông tin sinh viên</title>
@section('style')
    <style>
        img {
            max-width: 180px;
        }

        input[type=file] {
            padding: 10px;
            max-width: 180px;
            background: #2d2d2d;
        }
    </style>
@section('content')
    <div class="container">
        @if(session()->has('message'))
            <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ session()->get('message') }}
            </div>
        @endif
        <div class="panel-group">
            <div class="panel panel-success">
                <h1 class="panel-heading">Thay đổi thông tin sinh viên</h1>
                <div class="panel-body">
                    <hr>
                    <div class="row justify-content-center">
                        <div class="col-sm-4">
                            <form method="POST" enctype="multipart/form-data"
                                  action="{{ route('sinhvien.update', $data->id) }}">
                                @csrf
                                <div class="form-group">
                                    <label>MSSV:</label>
                                    <input type="text" class="form-control" value="{{ $data->mssv }}" name="mssv"
                                           placeholder="Nhập MSSV" required>
                                </div>
                                <div class="form-group">
                                    <label>Họ & tên</label>
                                    <input type="text" class="form-control" value="{{ $data->name }}" name="name"
                                           placeholder="Nhập họ & tên" required>
                                </div>
                                <div class="form-group">
                                    <div class="form-check">
                                        <label>Giới tính:</label> &nbsp &nbsp &nbsp &nbsp
                                        @if($data->gioitinh == 'nam')
                                            <input class="form-check-input" checked name="gioitinh" value="nam" type="radio" id="nam">
                                            <label class="form-check-label" for="nam">Nam</label> &nbsp &nbsp &nbsp &nbsp
                                            <input class="form-check-input" name="gioitinh" value="nu" type="radio" id="nu">
                                            <label class="form-check-label" for="nu">Nữ</label>
                                        @else
                                            <input class="form-check-input" checked name="gioitinh" value="nam" type="radio" id="nam">
                                            <label class="form-check-label" for="nam">Nam</label> &nbsp &nbsp &nbsp &nbsp
                                            <input class="form-check-input" checked name="gioitinh" value="nu" type="radio" id="nu">
                                            <label class="form-check-label" for="nu">Nữ</label>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Thuộc Khoa</label>
                                    <select id="khoa" class="form-control" name="khoa">
                                        @foreach ($khoas as $key => $value)
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Thuộc Nganh</label>
                                    <select id="nganh" class="form-control" name="nganh">
                                        @foreach ($nganhs as $key => $value)
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Lớp</label>
                                    <select id="lop" class="form-control" name="lop">
                                        @foreach ($lops as $key => $value)
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control" value="{{ $data->email }}" name="email"
                                           placeholder="Nhập email" required>
                                </div>
                                <div class="form-group">
                                    <label>Số điện thoại</label>
                                    <input type="text" class="form-control" value="{{ $data->sdt }}" name="sdt"
                                           placeholder="Nhập số điện thoại" required>
                                </div>
                                <div class="form-group">
                                    <label>Ảnh đại diện</label>
                                    <br>
                                    <img id="avatar" src="{{ url('upload', $data->anh) }}" alt="your image"/>
                                    <input type='file' name="file" onchange="readURL(this)"/>
                                </div>

                                <button id="submit" type="submit" value="upload" class="btn btn-primary">Lưu lại
                                </button>
                                <button type="reset" class="btn btn-info">Làm mới</button>
                                <a class="btn btn-danger" href="{{ route('sinhvien.index') }}">Quay lại</a>
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
                    url: "{{ route('lop.getlistlop') }}",
                    data: {
                        id: $('#nganh').val()
                    },
                    success: function (data) {
                        $("#lop").empty();
                        data.map(function (val) {
                            $("#lop").append(new Option(val.name, val.id));
                        });
                    }
                });
            });
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $("#avatar").attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
                console.log(document.getElementById('fileAvatar').value);
            }
        }
    </script>
@endsection