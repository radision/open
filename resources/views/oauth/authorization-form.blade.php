@extends('layouts.master')

@section('content')
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">欢迎访问 {{$client->getName()}}</h3>
  </div>
  <div class="panel-body">
    <form class="form-horizontal" method="post" action="{{route('oauth.authorize.post', $params)}}">
      {{ csrf_field() }}
      <input type="hidden" name="client_id" value="{{$params['client_id']}}">
      <input type="hidden" name="redirect_uri" value="{{$params['redirect_uri']}}">
      <input type="hidden" name="response_type" value="{{$params['response_type']}}">
      <input type="hidden" name="state" value="{{$params['state']}}">
      <input type="hidden" name="scope" value="{{$params['scope']}}">

      <div class="form-group">
        <label for="mobile" class="col-sm-2 control-label">手机号</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="mobile" name="mobile" placeholder="手机号">
        </div>
      </div>
      <div class="form-group">
        <label for="passwd" class="col-sm-2 control-label">密码</label>
        <div class="col-sm-10">
          <input type="password" class="form-control" id="passwd" name="passwd" placeholder="密码">
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button class="btn btn-success" type="submit" name="approve" value="1">登录</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
