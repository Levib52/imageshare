@extends('layouts.app')

@section('content')
<div class="container" style="background-color: white;">
        <div class="row">
            <div class="col my-3">
                <h3>{{$query}} images</h3>
            </div>
        </div>
        <div class="row">
            @if(count($results) < 1)
            <div class="container">
                <div>
                    <h3>No results found</h3>
                </div>
            </div>
            @else
                @foreach($results as $result)
                    <a href="/image/{{$result->id}}" class="col-lg-3 col-md-6 py-3">
                        <div id="thumbnailCarousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                            <?php $thumbnails = json_decode($result->thumbnail);
                                foreach($thumbnails as $key => $thumbnail){ ?>
                                <div class="carousel-item {{$key == 0 ? 'active' : '' }}">
                                    <img class="img-fluid" src="/storage/photos/{{ $thumbnail }}" alt="">
                                </div>
                            <?php }?>
                            </div>
                        </div>
                    </a>
                @endforeach
            @endif
        </div>
@endsection