
@extends('layouts.master')

@section('title', 'Clients List')

@section('content')
<a href="/admin/dashboard" class="btn btn-primary">返回</a>
<div class="panel panel-default">
  <div class="panel-heading">添加客户端</div>
  <div class="panel-body">
<form class="form-inline" method="post" action="/admin/client">
  <div class="form-group">
    <label class="sr-only" for="client_name">应用名称</label>
    <input type="text" class="form-control" id="client_name" name="name" placeholder="应用名称">
  </div>
  <div class="form-group">
    <label class="sr-only" for="client_url">应用URL</label>
    <input type="url" class="form-control" id="client_url" name="url" placeholder="应用URL">
  </div>
  <button type="submit" class="btn btn-default">添加</button>
</form>
  </div>
</div>
<div class="panel panel-default">
  <div class="panel-heading">客户端列表</div>
  <div class="panel-body">
    <ul class="list-group">
        @if (!empty($list))
            @foreach ($list as $row)
            <li class="list-group-item">
                <a href="javascript: void(0);" id="del_<?php echo $row->id; ?>" data-client-id="<?php echo $row->id; ?>">
                    <span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
                </a>
                <span class="label label-default"><?php echo $row->name;?></span><?php echo '['.$row->redirect_uri.']'; ?>
                <ol class="breadcrumb">
                    <li>Client ID: <?php echo $row->id; ?></li>
                    <li>Client Secret: <?php echo $row->secret; ?></li>
                </ol>
            </li>
            @endforeach
        @endif
    </ul>
  </div>
</div>

<script src="/js/client.js"></script>
@endsection
