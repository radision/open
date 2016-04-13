@extends('layouts.master')

@section('title', 'User Login')

@section('content')
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        @if (!empty($error))
        <div class="alert alert-danger" role="alert"><?php echo $error; ?></div>
        @endif
        <div class="panel panel-default">
          <div class="panel-heading">登录</div>
          <div class="panel-body">
            <form method="post" class="form-inline" action="/login">
              <div class="form-group">
                <label class="sr-only" for="user_mobile">手机号</label>
                <input type="text" class="form-control" id="user_mobile" name="mobile" placeholder="手机号">
              </div>
              <div class="form-group">
                <label class="sr-only" for="user_password">密码</label>
                <input type="password" class="form-control" id="user_password" name="password" placeholder="密码">
              </div>
              <button type="submit" class="btn btn-default">登录</button>
            </form>
          </div>
        </div>
    </div>
</div>
@endsection
