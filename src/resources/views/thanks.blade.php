@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
@endsection

@section('content')
<div class="thanks-content">
    <div class="thanks-background">
        <span>Thank You</span>
        <span>So Much</span>
    </div>

    <div class="thanks-message">
        <p>お問い合わせありがとうございました</p>
        <div class="home-btn">
            <a href="/" class="btn-home">HOME</a>
        </div>
    </div>
</div>
@endsection

@if(app()->environment('local'))
@section('js')
<script>
    window.open('http://localhost:8025', '_blank');
</script>
@endsection
@endif
