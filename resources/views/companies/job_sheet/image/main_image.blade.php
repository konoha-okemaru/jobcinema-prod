@extends('layouts.employer_mypage_master')

@section('title', 'メイン写真の登録| JOB CiNEMA')
@section('description', '釧路の職場を上映する求人サイト')

@section('header')
@component('components.employer.mypage_header')
@endcomponent
@endsection

@section('contents')
<div class="main-wrap">
    <section class="main-section job-create-section">
        <div class="inner">
            <div class="pad">

                <div class="col-md-10 mr-auto ml-auto">
                    @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong><i class="fas fa-exclamation-circle"></i>エラー</strong><br>
                        <ul class="list-unstyled">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if(Session::has('message_success'))
                    <div class="alert alert-success">
                        {{ Session::get('message_success') }}
                    </div>
                    @endif
                    @if(Session::has('message_danger'))
                    <div class="alert alert-danger">
                        {{ Session::get('message_danger') }}
                    </div>
                    @endif

                    <form id="JobSheetCompanyRegisterMainimageForm" action="{{ route('enterprise.update.jobsheet.mainimage', [$jobitem])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="data[JobSheet][id]" value="{{$jobitem->id}}" id="JobSheetId" />
                        <input type="hidden" name="data[File][suffix]" value="1" id="FileSuffix" />
                        <input type="hidden" name="data[File][currentPath]" value="{{ $images[0] }}" id="FileCurrentPath">
                        <div class="card">
                            <div class="card-header">メイン写真の登録</div>
                            <div class="card-body">
                                <p>ファイルを選択から登録したい画像を選んでください</p>
                                <div class="my-5">
                                    <input name="data[File][image]" type="file" id="FileImage" accept=".jpg,.gif,.png,image/gif,image/jpeg,image/png">
                                </div>
                                <p>現在登録されている画像</p>
                                @if($jobitem->job_img_1)
                                <p class="pre-main-image"><img src="{{ $images[0] }}" alt="メイン写真を登録してください"></p>
                                @endif
                                <ul class="list-unstyled">
                                    <li>画像はjpg/gif/png形式に対応しています。</li>
                                    <li>画像のサイズは280×210ピクセルです。
                                        サイズの違う画像は自動的にサイズ調整されます。</li>
                                    <li>登録できるファイルサイズは20MBまでです。</li>
                                </ul>
                            </div>
                        </div> <!-- card -->
                        <div class="form-group text-center">
                            <button type="submit" name="submit" value="submit" class="btn btn-primary">登録する</button>
                            <a href="javascript:void(0);" class="btn btn-secondary" id="deleteImage">登録された画像を削除</a>
                            <a class="create-image-back-btn" href="javascript:void(0);" class="btn btn-outline-secondary" id="close_button">戻る</a>
                        </div>
                    </form>
                </div>

            </div> <!-- pad -->
        </div> <!-- inner -->
    </section>
</div> <!-- main-wrap -->
@endsection

@section('footer')
@component('components.employer.mypage_footer')
@endcomponent
@endsection

@section('js')
<script>
    $(function() {
        var job = @json($jobitem);
        var imagePath = $('#FileCurrentPath').attr('value');

        if (imagePath != '') {
            window.opener.$('#photo1').attr('src', imagePath);
            if (imagePath == '/img/common/no-image.gif') {
                window.opener.$('#FileIsExist1').val(0);
            } else {
                window.opener.$('#FileIsExist1').val(1);
            }
        }

        $('#deleteImage').click(function() {
            if (window.confirm('登録されているメイン写真を削除します。よろしいですか？')) {
                window.location.href = '/enterprise/jobs/create/delete_image/' + job.id + '?flag=1';
                return false;
            }
        });
    });
</script>

@endsection
