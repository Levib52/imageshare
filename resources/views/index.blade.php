@extends('layouts.app')
@section('content')
<div class="container" style="background-color: white;">
    <div class="row">
        <div class="col my-3 pt-2">
            <h3>Explore photos</h3>
        </div>
    </div>
    <div class="row">
        @foreach($recentPosts as $post)
        <?php $thumbnails = json_decode($post->thumbnail);?>
            <a href="/image/{{$post->id}}" class="col-lg-3 col-md-6 py-3">
                <!-- check number of images. if there is more than one image, display in a carosel -->
                <?php $num = count($thumbnails);?>
                @if($num === 1)
                    <img class="img-fluid" src="/storage/photos/{{$thumbnails[0]}}" alt="">
                @else
                    <div id="thumbnailCarousel" class="carousel slide px-0" data-ride="carousel">
                        <div class="carousel-inner px-0">
                            @foreach($thumbnails as $key => $thumbnail)
                            <div class="carousel-item {{$key == 0 ? 'active' : '' }}">
                                <img class="img-fluid" src="/storage/photos/{{ $thumbnail }}" alt="">
                            </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </a>
        @endforeach
    </div>
    <div class="row">
        <div class="col-12 d-flex justify-content-center">
            {{$recentPosts->links()}}
        </div>
    </div>
</div>
@endsection