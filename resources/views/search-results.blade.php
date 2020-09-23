@extends('layouts.app')

@section('content')
<div class="container" style="background-color: white;">
        <div class="row">
            <div class="col my-3">
                <h3>"{{$query}}" images</h3>
            </div>
        </div>
        <div class="row">
                @foreach($results as $result)
                    <a href="/post/{{$result->id}}" class="col-lg-3 col-md-6 py-3">
                        <h5>{{ \Illuminate\Support\Str::limit($result->postTitle, 55) }}</h5>
                        <?php $thumbnails = json_decode($result->thumbnail); ?>
                        <img class="img-fluid" src="/storage/photos/{{ $thumbnails[0] }}" alt="">
                    </a>
                @endforeach
        </div>
@endsection