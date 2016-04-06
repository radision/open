@extends('layouts.master')

@section('title', 'Administrator Login')

@section('content')
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        @if (!empty($error))
        <div class="alert alert-danger" role="alert"><?php echo $error; ?></div>
        @endif
        <div class="panel panel-default">
          <div class="panel-heading">管理员登录</div>
          <div class="panel-body">
            <form method="post" class="form-inline" action="/login">
              <div class="form-group">
                <label class="sr-only" for="admin_name">用户名</label>
                <input type="text" class="form-control" id="admin_name" name="name" placeholder="用户名">
              </div>
              <div class="form-group">
                <label class="sr-only" for="admin_passwd">密码</label>
                <input type="password" class="form-control" id="admin_passwd" name="passwd" placeholder="密码">
              </div>
              <button type="submit" class="btn btn-default">登录</button>
            </form>
          </div>
        </div>
    </div>
</div>
@endsection
