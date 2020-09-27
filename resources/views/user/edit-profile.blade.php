@extends('layouts.app')

@section('content')
    <div class="container p-4" style="background-color:white;">
        <h1>Edit Information</h1>
        <form action="/user/{{ $user->id }}" enctype="multipart/form-data" method="post">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="location">Bio</label>
                <input type="text" class="form-control @error('location') is-invalid @enderror" id="bio" name="bio" value="{{old('bio', $user->profile->bio)}}">
                @error('location')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" class="form-control @error('location') is-invalid @enderror" id="location" name="location" value="{{old('location', $user->profile->location)}}">
                @error('location')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="instagram">Instagram</label>
                <input type="text" class="form-control @error('instagram') is-invalid @enderror" id="instagram" name="instagram" value="{{old('instagram', $user->profile->instagram)}}">
                @error('instagram')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="twitter">Twitter</label>
                <input type="text" class="form-control @error('twitter') is-invalid @enderror" id="twitter" name="twitter" value="{{old('twitter', $user->profile->twitter)}}">
                @error('instagram')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="profileImage" class="custom-file-upload">Profile Picture</label>
                <input type="file" class="form-control-file @error('profileImage') is-invalid @enderror" id="profileImage" name="profileImage">
                @error('profileImage')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-row justify-content-center">
                <input class="btn btn-outline-dark" type="submit" value="Submit">
            </div>
        </form>
        <div class="row">
            <div class="col text-center pt-4">
                <form action="/user/{{$user->id}}" enctype="multipart/form-data" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-outline-danger" type="submit" value="Delete">Delete Account</button>
                </form>
            </div>
        </div>
    </div>
@endsection