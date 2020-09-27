@extends('layouts.app')
@section('content')
<div class="post-wrapper">
    <div class="container post-container text-center pt-4">
        <?php $postImages = json_decode($post->postImage);?>
        <?php $numImages = count($postImages);?>
        @if($numImages === 1)
            <a href="/storage/photos/{{$postImages[0]}}" class="mx-auto">
                <img class="img-fluid" src="/storage/photos/{{$postImages[0]}}" alt="">
            </a>
        @else
            <div id="imageCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
                <div class="carousel-inner justify-content-center">
                    @foreach($postImages as $key => $postImage)
                    <div class="carousel-item {{$key == 0 ? 'active' : '' }}">
                        <a href="/storage/photos/{{$postImage}}">
                            <img class="img-fluid" src="/storage/photos/{{$postImage}}" alt="">
                        </a>
                    </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#imageCarousel" role="button"  data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true">     </span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#imageCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        @endif
    </div>
    @can('update', $post)
        <div class="row"></div>
            <div class="col text-center pt-4">
                <form action="/image/{{$post->id}}" enctype="multipart/form-data" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-outline-dark" type="submit" value="Delete">Delete Post</button>
                </form>
            </div>
        </div>
    @endcan
    <div class="row"></div>
        <div class="col text-center pt-4">
            <div class="container">
                <a href="" class="nav-link py-3 mt-0" data-toggle="collapse" data-target="#postInfoDropdown" aria-controls="postInfoDropdown" aria-expanded="false">
                    <i class="fas fa-info-circle fa-2x"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="container collapse navbar-collapse" id="postInfoDropdown">
        <div class="row">
            <div class="col text-center pt-3">
                <h3>{{$post->postTitle}}</h3>
            </div>
        </div>
        <div class="row">
            <div class="col text-center pt-3">
                <p>{{$post->postDescription}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col text-center pt-5">
                <a href="../user/{{$post->user->id}}"><img src="{{ $post->user->profile->profileImage() }}" alt="" class="rounded-circle img-fluid" style="max-width: 55px;"></a>
            </div>
        </div>
        <div class="row pb-5">
            <div class="col text-center pt-1">
                <div class="">
                    <a href="../user/{{$post->user->id}}"><h5><strong>{{$post->user->username}}</strong></h5></a>
                </div>
            </div>
        </div>
        <div class="row d-none">
            <div class="col">
                {{$post->postTags}}
            </div>
        </div>
    </div>
</div>
@endsection