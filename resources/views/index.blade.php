@extends('layouts.app')
@section('content')
<div class="container" style="background-color: white;">
    <div class="row">
        <div class="col my-3">
            <h3>Explore photos</h3>
        </div>
    </div>
    <div class="row">
        @foreach($recentPosts as $post)
            <a href="/image/{{$post->id}}" class="col-lg-3 col-md-6 py-3">
                <?php $thumbnails = json_decode($post->thumbnail); ?>
                <img class="img-fluid" src="/storage/photos/{{ $thumbnails[0] }}" alt="">
            </a>
        @endforeach
    </div>
</div>
@endsection