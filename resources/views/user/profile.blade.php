
@extends('layouts.master')

@section('title', 'Users Profile')

@section('content')
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">欢迎您</a> </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="#">我的卡片</a></li>
                    <li class="active"><a href="/profile">个人信息</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<div class="container">
<form name="form_profile" id="form_profile" method="post" action="/profile">
<table class="table table-bordered">
    <tr><th width="100">手机号</th><td><?php echo $user_info->mobile; ?></td></tr>
    <tr><th>姓名</th><td><input type="text" id="name" name="name" class="form-control" value="<?php echo $user_info->name; ?>"></td></tr>
    <tr><th>邮箱</th><td><input type="email" id="email" name="email" class="form-control" value="<?php echo $user_info->email; ?>"></td></tr>
    <tr><th>性别</th><td>
    <label class="radio-inline"><input type="radio" id="gender_1" name="gender" value="1" <?php if ($user_attribute->gender != 2) { echo 'checked'; } ?>> 男 </label>
    <label class="radio-inline"><input type="radio" id="gender_2" name="gender" value="2" <?php if ($user_attribute->gender == 2) { echo 'checked'; } ?>< > 女 </label>
    </td></tr>
    <tr><th>所在城市</th><td><input type="text" id="city" name="city" class="form-control" value="<?php echo $user_attribute->city; ?>"></td></tr>
    <tr><th>关注<br />(以','分隔)</th><td><textarea id="tags" name="tags" class="form-control"><?php echo $user_tags; ?></textarea></td></tr>
</table>
<button type="submit" class="btn btn-primary">保存</button>
</form>
</div>
@endsection
