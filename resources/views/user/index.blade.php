@extends('layouts.app')
@section('content')
<div class="container p-lg-5" style="background-color: white;">
    <div class="row">
        <div class="col-lg-3 p-lg-5 h-25 w-25 my-2">
            <img src="{{ $user->profile->profileImage() }}" alt="" class="rounded-circle img-fluid" style="max-width: 150px;">
        </div>
        <div class="col-lg-9">
            <div class="pt-2 pt-lg-5">
                <h2>{{$user->username}}</h2>
            </div>
            <div class="d-flex pt-lg-2 pb-lg-3">
                <div class="pr-2">
                    <a href="{{$user->profile->instagram}}" target="_blank"><i class="fab fa-lg fa-instagram"></i></a>
                </div>
                <div>
                    <a href="{{$user->profile->twitter}}" target="_blank"><i class="fab fa-lg fa-twitter"></i></i></a>
                </div>
            </div>
            <div>
                <p>{{$user->profile->location}}</p>
            </div>
            <div>
                <p>{{$user->profile->bio}}</p>
            </div>
        </div>
    </div>
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