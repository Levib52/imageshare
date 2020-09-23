@extends('layouts.app')
@section('content')
<div class="container my-lg-3 py-2 p-md-5" style="background-color: white;">
    <div id="imageCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">   
            <?php $postImages = json_decode($post->postImage);
                foreach ($postImages as $key => $postImage) { ?>
                <div class="carousel-item {{$key == 0 ? 'active' : '' }}">
                    <a href="/storage/photos/{{$postImage}}">
                        <img class="d-block w-100" src="/storage/photos/{{$postImage}}" alt="" class="img-fluid">
                    </a>
                </div>
            <?php }?>
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
    <h5><small><span class="text-muted">Posted by <a href="../user/{{$post->user->id}}">{{$post->user->username}}</a>
        <div class="row">
            <div class="col-lg-3">
                <h5>Description:</h5>
            </div>
            <div class="col">
                <p>{{$post->postDescription}}</p>
            </div>
        </div>
    <div class="row d-none">
        <div class="col">{{$post->tags}}</div>
    </div>
</div>
@endsection