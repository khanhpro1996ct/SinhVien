@extends('layouts.app')
@section('content')
    <div class="container" style="margin-top: 10%">
        <div class="row justify-content-center">
            <div class="col-sm-6 col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form action="{{route('user.resetpasswd',[$data->id])}}" method="POST">
                            @csrf
                            <div class="row justify-content-center">
                                @if(session()->has('error'))
                                    <div class="alert alert-danger">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        {{ session()->get('error') }}
                                    </div>
                                @endif
                                @if(session()->has('error2'))
                                    <div class="alert alert-danger">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                        {{ session()->get('error2') }}
                                    </div>
                                @endif
                                <div class="col-sm-12 col-md-10  col-md-offset-1 ">
                                    <div class="form-group">
                                        <input id="oldpass" class="form-control" placeholder="Mật khẩu cũ"
                                               name="oldpass" type="password" value="">
                                    </div>
                                    <div class="form-group">
                                        <input id="newpass1" class="form-control" placeholder="Mật khẩu mới"
                                               name="newpass" type="password" value="">
                                    </div>
                                    <div class="form-group">
                                        <input id="newpass2" class="form-control" placeholder="Nhập lại mật khẩu mới"
                                               name="repass" type="password" value="">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-lg btn-danger btn-block"
                                               value="Đổi mật khẩu">
                                        <input type="reset" class="btn btn-lg btn-primary btn-block" value="Làm mới">
                                        <a href="{{route('user.show',[$data->id])}}"
                                           class="btn btn-lg btn-info btn-block">Quay lại</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection