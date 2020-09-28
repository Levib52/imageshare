<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Post;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostsController extends Controller
{

    /*##
    including the auth middleware ensures only logged in users may see the "upload" view
    ##*/    
    public function __construct()
    {
        //the except show allows the users who are not logged in to view posts
        $this->middleware('auth', ['except' => 'show']);
    }

    /*##
    return the "upload" view with variables used on the page
    ##*/

    public function upload()
    {
        return view('upload');
    }

    /*##
    Store function will gather the data from the "upload" view and store it to the database
    ##*/

    public function store(Request $request)
    {
        // assure necessary data is input correctly
       $data = request()->validate([
            'postTitle' => 'required',
            'postDescription' => 'required',
            'postTags' => 'required',
            'postImage.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg,',
            'thumbnail.*' => '',
        ]);

        //grabbing the image(s) from the request
        if($request->file('postImage')){
            //foreach through each image in the request
            foreach($request->file('postImage') as $postImage) {
                //generate a random name for each image to avoid duplicate names in the database
                $basename = Str::random();
                //set the random name for each image in the original variable. this will be the full size image
                $original = $basename . '.' . $postImage->getClientOriginalExtension();
                //set the random name for each thumbnail. it will be the same as the corrisponding original image but with "_thumb" in the name
                $thumbnail = $basename . '_thumb.' . $postImage->getClientOriginalExtension();
                //save all images to the originalImageArray array
                $originalImageArray[] = $original;
                //save all the thumbnails to the thumbnailArray
                $thumbnailArray[] = $thumbnail;

                //create the thumbnails with intervention image and store them in the "photos" folder
                Image::make($postImage)
                    ->fit(250,200)
                    ->save(public_path('/storage/photos/' . $thumbnail));
                //save the original images in the "photos" folder
                $postImage->move(public_path("/storage/photos/"), $original);
            }
        }
        
        //create the post with all the data
        auth()->user()->post()->create(array_merge([
            'postTitle' => ucfirst($data['postTitle']),
            'postDescription' => $data['postDescription'],
            'postTags' => strtolower($data['postTags']),
            'postImage' => json_encode($originalImageArray),
            'thumbnail' => json_encode($thumbnailArray),
        ]));

        return redirect('/user/'. auth()->user()->id)->with('success', 'Post Created');
    }

    /*##
    return the "post.show" view showing each post individually
    ##*/
    public function show(Post $post)
    {
        return view('image.show', compact('post'));
    }

    /*##
    return the "edit" view
    ##*/
    public function edit(Post $post)
    {
        //authorize ensures that users can only view the "edit" view for posts they created
        $this->authorize('update', $post);

        return view('image.edit', compact('post'));
    }

    public function update(Post $post, Request $request)
    {
        //authorize ensures that users may only edit their own posts
        $this->authorize('update', $post);

        //get new data to update the post
        $data = request()->validate([
            'postTitle' => 'required',
            'postDescription' => 'required',
            'postTags' => 'required',
            'postImage.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'thumbnail.*' => '',
        ]);
        
        //check if any new images are being uploaded
        if($request->file('postImage')){
            $postImages = $request->file('postImage');
            foreach($postImages as $postImage) {
                $basename = Str::random();
                $original = $basename . '.' . $postImage->getClientOriginalExtension();
                $thumbnail = $basename . '_thumb.' . $postImage->getClientOriginalExtension();
                $originalImageArray[] = $original;
                $thumbnailArray[] = $thumbnail;

                Image::make($postImage)
                    ->fit(250,250)
                    ->save(public_path('/storage/photos/' . $thumbnail));

                $postImage->move(public_path("/storage/photos/"), $original);
            }
        }
        if($request->file('postImage') == ""){
            $post->update(array_merge([
                'postTitle' => ucfirst($data['postTitle']),
                'postDescription' => $data['postDescription'],
                'postTags' => strtolower($data['postTags']),
            ]));
        } else {
            $post->update(array_merge([
                'postTitle' => ucfirst($data['postTitle']),
                'postDescription' => $data['postDescription'],
                'postTags' => strtolower($data['postTags']),
                'postImage' => json_encode($originalImageArray),
                'thumbnail' => json_encode($thumbnailArray),
            ]));
        }
        return redirect('image/' .  $post->id)->with('success', 'Post Updated');
    }

    /*##
    delete the post
    ##*/
    public function destroy(Post $post)
    {
        //authorize ensures users can only delete their own posts
        $this->authorize('update', $post);
        $post->delete();

        return redirect('/user/'. auth()->user()->id)->with('success', 'Post Deleted');
    }
}
