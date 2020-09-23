@extends('layouts.app')
@section('content')
<div class="container p-lg-5" style="background-color: white;">
    <div class="row">
        <div class="col text-center h-25 w-25 my-3">
            <img src="{{ $user->profile->profileImage() }}" alt="" class="rounded-circle img-fluid" style="max-width: 150px;">
        </div>
    </div>
    <div class="row text-center">
        <div class="col">
            <h2 style="font-family: 'Roboto', sans-serif;">{{$user->username}}</h2>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-12 py-4">
            <h3>{{$user->username}}'s photos</h3>
        </div>
    </div>
    <div class="row">
        @foreach($user->post as $post)
            <a href="/image/{{$post->id}}" class="col-lg-3 pb-5 mb-3 text-left">
                <h4>{{$post->postTitle}}</h4>
                <?php
                $thumbnails = json_decode($post->thumbnail); ?>
                <img class="img-fluid" src="/storage/photos/{{$thumbnails[0]}}" alt="">
            </a>
        @endforeach
    </div>
</div>
@endsection