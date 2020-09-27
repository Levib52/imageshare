@extends('layouts.app')
@section('content')
<div class="container p-lg-5" style="background-color: white;">
    <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-2 p-lg-5 my-2">
            <img src="{{ $user->profile->profileImage() }}" alt="" class="rounded-circle img-fluid" style="max-width: 150px;">
        </div>
        <div class="col-lg-6 pl-lg-5">
            <div class="pt-2 pt-lg-5">
                <h3>{{$user->username}}</h3>
            </div>
            <div class="d-flex pb-lg-3 pt-2">
                <div class="pr-2">
                    @if($user->profile->instagram == "")
                        <i class="fab fa-lg fa-instagram"></i>
                    @else
                        <a href="http://{{$user->profile->instagram}}" target="_blank"><i class="fab fa-lg fa-instagram"></i></a>
                    @endif
                </div>
                <div>
                    @if($user->profile->twitter == "")
                        <i class="fab fa-lg fa-twitter"></i>
                    @else
                        <a href="http://{{$user->profile->twitter}}" target="_blank"><i class="fab fa-lg fa-twitter"></i></a>
                    @endif
                </div>
            </div>
            <div class="">
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
        <?php $thumbnails = json_decode($post->thumbnail);?>
            <a href="/image/{{$post->id}}" class="col-md-3 py-3">
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
</div>
@endsection