@extends('layouts.app')
@section('content')
<div class="container p-4 border mt-3" style="background-color:white;">
    <h2 class="my-4" style="font-family: 'Roboto', sans-serif;">Upload your images</h2>
    <hr>
    <form action="/image" enctype="multipart/form-data" method="post" class="pt-5">
        @csrf
        <div class="form-group text-lg-center text-md-left py-lg-5 mx-auto">
            <label for="postImage" class="custom-file-upload">
                <i class="fa fa-cloud-upload"></i> Choose Image(s)
            </label>
            <input type="file" multiple class=" mx-auto @error('postImage') is-invalid @enderror" id="postImage" name="postImage[]">
            @error('postImage')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <div class="row image-preview pt-4" id="image-preview" name="image-preview">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="postTitle">Title</label>
                <input type="text" class="form-control @error('postTitle') is-invalid @enderror" id="postTitle" name="postTitle" value="{{old('postTitle')}}">
                @error('postTitle')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group col-md-6">
                <label for="postTags">Tags</label>
                <input type="text" class="form-control @error('postTags') is-invalid @enderror" id="postTags" name="postTags" value="{{old('postTags')}}">
                @error('postTags')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label for="postDescription">Description</label>
            <textarea class="form-control @error('postDescription') is-invalid @enderror" id="postDescription" name="postDescription">{{old('postDescription')}}</textarea>
            @error('postDescription')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-row justify-content-center my-5">
            <input class="btn btn-outline-dark" type="submit" value="Submit">
        </div>
    </form>
</div>
@endsection