@extends('layouts.master')

@section('title', 'ダッシュボード | JOB CiNEMA')
@section('description', '釧路の職場を上映する求人サイト')

@section('header')
@component('components.header')
@endcomponent
@endsection

@section('contents')
<!-- パンくず -->
<div id="breadcrumb" class="bread only-pc">
    <ol>
        </li>
        <li>
            マイページ
        </li>
    </ol>
</div>

<section class="main-section s-mypage-section">
    <div class="inner">
        <div class="pad">
            <h2 class="txt-h2 d-inline-block mr-3">マイページ</h2>
            @if(Auth::user())
            @if(!empty($user->last_name) && !empty($user->first_name))
            <p class="mypage-hello-text">ようこそ<i class="fas fa-user mx-1"></i>{{$user->full_name}}さん <span class="caret"></span></p>
            @else
            <p class="mypage-hello-text">ようこそ<i class="fas fa-user mx-1"></i>ゲストさん<span class="caret"></span></p>
            @endif
            @endif
            <div class="container">
                <div class="row">
                    <div class="mypage-btn-list-wrap">
                        <ul class="mypage-btn-list-inner">
                            <li>
                                <a class="btn-gray" href="{{ route('index.seeker.job') }}">応募管理</a>
                            </li>
                            <li>
                                <a class="btn-gray" href="{{ route('edit.seeker.profile') }}">会員情報編集</a>
                            </li>
                        </ul>
                        <ul class="mypage-btn-list-inner">
                            <li>
                                <a class="btn-gray" href="{{ route('edit.seeker.career') }}">現在の状況・希望編集</a>
                            </li>
                            <li>
                                <a class="btn-gray" href="{{ route('mypage.changepassword.get') }}">パスワード変更</a>
                            </li>
                        </ul>
                        <ul class="mypage-btn-list-inner">
                            <li>
                                <a class="btn-gray" href="{{ route('mypage.changeemail.get') }}">メールアドレス変更</a>
                            </li>
                            @if (Auth::guard()->check())
                            <li>
                                <a class="btn-gray" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('ログアウト') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                @endif
                            </li>
                        </ul>
                    </div>
                </div>
                <p class="mypage-pagetop-btn"><a class="txt-blue-link" href="/">トップページに戻る</a></p>
                <p class="text-right">
                    <a href="{{ route('delete.seeker') }}" id="deleteSeeker" onclick="deleteUser(event)">
                        {{ __('退会する') }}
                    </a>
                </p>
                <form id="deleteSeekerForm" action="{{ route('delete.seeker') }}" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
            </div>

        </div>
    </div>
</section>
</div>
@endsection

@section('footer')
@component('components.footer')
@endcomponent
@endsection

@section('js')
<script>
    function deleteUser(e) {
        e.preventDefault();
        if (window.confirm('お祝い金申請中の場合、受け取りができなくなります。よろしいですか？')) {
            document.getElementById('deleteSeekerForm').submit();
        }
        return;
    };
</script>
@endsection
