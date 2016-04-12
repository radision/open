@extends('layouts.master')

@section('title', 'Administrator Dashboard')

@section('content')
<div class="row">
    <div class="col-md-12">
        <a href="/admin/client" class="btn btn-primary">客户端列表</a>
    </div>
    <div class="col-md-12">
        <a href="/admin/user" class="btn btn-primary">用户列表</a>
    </div>
</div>
@endsection
