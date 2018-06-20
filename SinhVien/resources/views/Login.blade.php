@extends('layouts.app')
@section('content')
    <div class="container" style="margin-top: 10%">
        <div class="row justify-content-center">
            <div class="col-sm-6 col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-header">
                        <div class="row justify-content-center">
                            <div class="center-block">
                                <img class="profile-img" src="{{url('upload')}}/login.png" width="100px" height="100px">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="panel-body">
                        <form action="{{route('login.postLogin')}}" method="POST">
                            {!! csrf_field() !!}
                            <div class="row justify-content-center">
                                <div class="col-sm-12 col-md-10  col-md-offset-1 ">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input id="mssv" class="form-control" placeholder="mssv" name="mssv"
                                                   type="text" autofocus required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input id="password" class="form-control" placeholder="Mật khẩu"
                                                   name="password" type="password" value="" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-lg btn-primary btn-block" value="Đăng nhập">
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