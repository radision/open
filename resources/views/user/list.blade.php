
@extends('layouts.master')

@section('title', 'Users List')

@section('content')
<a href="/admin/dashboard" class="btn btn-primary">返回</a>
<div class="panel panel-default">
  <div class="panel-heading">添加用户</div>
  <div class="panel-body">
<form class="form-inline" method="post" action="/admin/user">
  <div class="form-group">
    <label class="sr-only" for="user_mobile">手机号</label>
    <input type="text" class="form-control" id="user_mobile" name="mobile" placeholder="手机号">
  </div>
  <div class="form-group">
    <label class="sr-only" for="client_password">密码</label>
    <input type="password" class="form-control" id="client_password" name="password" placeholder="密码">
  </div>
  <button type="submit" class="btn btn-default">添加</button>
</form>
  </div>
</div>
<div class="panel panel-default">
  <div class="panel-heading">用户列表</div>
  <div class="panel-body">
    <ul class="list-group">
        @if (!empty($list))
            @foreach ($list as $row)
            <li class="list-group-item">
                <span class="label label-default"><?php echo $row->mobile;?></span><?php echo $row->created_at; ?>
            </li>
            @endforeach
        @endif
    </ul>
  </div>
</div>

<script src="/js/user.js"></script>
@endsection
