@extends('adminlte::page')

@section('title', 'JOB CiNEMA | 採用報酬設定')

@section('content_header')
<h1><i class="fas fa-home mr-2"></i>採用報酬設定</h1>
@stop

@section('content_bread')
<li class="breadcrumb-item active">採用報酬設定</li>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header with-border">
                <div class="btn-group float-right">
                    <a href="{{ route('recruit_reward.create') }}" class="btn btn-sm btn-success">
                        <i class="fa fa-plus"></i><span class="hidden-xs">&nbsp;&nbsp;新規</span>
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if(!$non_attach_categories->isEmpty())
                <div class="alert alert-warning">
                    <strong><i class="fas fa-exclamation-circle mb-2"></i>以下のカテゴリに採用報酬が設定されていません</strong><br>
                    <ul>
                        @foreach($non_attach_categories as $c)
                        <li>{{ $c->name }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <table id="tableReward" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>金額</th>
                            <th>カテゴリ</th>
                            <th>ラベル</th>
                            <th>操作</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(!$rewards->isEmpty())
                        @foreach($rewards as $reward)
                        <tr>
                            <td>{{ $reward->id }}</td>
                            <td>{{ $reward->custom_amount }}</td>
                            <td>{{ $reward->category->name }}</td>
                            <td>{{ $reward->label }}</td>
                            <td class="project-actions text-right">
                                <a class="btn btn-primary btn-sm" href="{{ route('recruit_reward.show', $reward->id) }}">
                                    <i class="fas fa-eye">
                                    </i>
                                </a>
                                <a class="btn btn-info btn-sm" href="{{ route('recruit_reward.edit', $reward->id) }}">
                                    <i class="fas fa-pencil-alt">
                                    </i>
                                </a>
                                <a href="javascript:void(0);" class="btn btn-danger btn-sm grid-row-delete" data-id="{{ $reward->id }}" data-toggle="tooltip" title="" data-original-title="削除">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <p>データがありません</p>
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<script>
    $(function() {
        $('#tableReward').DataTable({
            "paging": true,
            "searching": true,
            "scrollX": true,
            "ordering": false,
            "lengthMenu": [10, 20, 30, 40, 50, 100],
            "displayLength": 50,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "columnDefs": [{
                "targets": 'nosort',
                "orderable": false
            }]
        });

        $('.grid-row-delete').unbind('click').click(function() {
            let id = $(this).data('id');
            deleteItem('/admin/setting/recruit_reward/', id, '/admin/setting/recruit_reward');
        });

    });
</script>
@stop
