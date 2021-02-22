@extends('adminlte::page')

@section('title', 'JOB CiNEMA | お知らせ管理')

@section('content_header')
    <h1><i class="fas fa-edit mr-2"></i>お知らせ管理</h1>
@stop

@section('content_bread')
    <li class="breadcrumb-item"><a href="{{ route('notice.index') }}">お知らせ管理</a></li>
    <li class="breadcrumb-item active">詳細</li>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">詳細</h3>
                    <div class="card-tools">
                        <div class="btn-group" style="margin-right: 5px">
                            <a href="{{ route('notice.index') }}" class="btn btn-sm btn-default" title="一覧">
                                <i class="fa fa-list"></i><span class="hidden-xs"> 一覧</span>
                            </a>
                        </div>
                        <div class="btn-group" style="margin-right: 5px">
                            <a href="{{ route('notice.edit', $notice->id) }}" class="btn btn-sm btn-primary" title="編集">
                                <i class="fa fa-edit"></i><span class="hidden-xs"> 編集</span>
                            </a>
                        </div>
                        <div class="btn-group pull-right" style="margin-right: 5px">
                            <a href="javascript:void(0);" class="btn btn-sm btn-danger {{ $notice->id }}-delete" title="削除">
                                <i class="fa fa-trash"></i><span class="hidden-xs"> 削除</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <div class="system-values">
                            <div class="system-values-flows">
                            </div>
                            <ul class="system-values-list">
                                <li>
                                    <p class="system-values-label">ID</p>
                                    <p class="system-values-item">{{ $notice->id }}</p>
                                </li>
                                <li>
                                    <p class="system-values-label">作成日時</p>
                                    <p class="system-values-item">{{ $notice->created_at }}</p>
                                </li>
                                <li>
                                    <p class="system-values-label">更新日時</p>
                                    <p class="system-values-item">{{ $notice->created_at }}</p>
                                </li>
                            </ul>
                        </div>
                        <hr>
                    </div>
                    <div class="body-box">
                        <div class="form-group">
                            <div class="row">
                                <label class="col-sm-2 text-sm-right">件名</label>
                                <div class="col-sm-8">
                                    <p>{{ $notice->subject }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 text-sm-right">本文</label>
                                <div class="col-sm-8">
                                    <p style="white-space: pre-wrap;">{{ $notice->content }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 text-sm-right">対象</label>
                                <div class="col-sm-8">
                                    <p>{{ $notice->target }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-sm-2 text-sm-right">掲載</label>
                                <div class="col-sm-8">
                                    <p>@if($notice->is_delivered)配信中@else未配信@endif</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @stop

        @section('js')
            <script>
                $(function() {
                    $('.{{$notice->id}}-delete').click(function(event) {
                        deleteItem('/admin/data/notice/', '{{$notice->id}}', '/admin/data/notice');
                    });
                });
            </script>
@stop
