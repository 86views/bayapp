<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {   
        $posts = Post::orderBy('created_at', 'desc')
                 ->paginate(3);
        return view('posts.index', compact('posts'));

        // return view ('posts.index',  [

        //     'posts' => $posts
        // ]);
    }

    /**
     * Show the form for creating a new resource.   
     * 
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
               'title' => 'required',
               'author' => 'required',
               'body' => 'required',
               'cover_image' => 'required|mimes:png,jpg,jpeg|max:5048',
        ]);
        // File Handle 

        if($request->hasFile('cover_image')) 
        {
            $newImageName = time().'-'.$request->name . '.'.$request->cover_image->extension();

            $request->cover_image->move(public_path('images'), $newImageName);
        } else {
            $newImageName = 'noimage.jpg'; 
        }

         $post = Post::create([
         'title' => $request->input('title'),
         'author' => $request->input('author'),
         'body' => $request->input('body'),
         'user_id' => auth()->user()->id,
         'cover_image' => $newImageName
         
      ]);

       return redirect('/posts')->with('success', 'Post Created Successfully');

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);

        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        if (!isset($post)){
            return redirect('/posts')->with('error', 'No Post Found');
        }

        if(auth()->user()->id  !== $post->user->id) 
        {
            return redirect('/posts')->with('error', 'Unauthorized Page'); 
        }

        return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $this->validate($request, [
            'title' => 'required',
            'author' => 'required',
            'body' => 'required',
            // 'cover_image' => 'required|mimes:png,jpg,jpeg|max:5048',
      ]);

      
    //   if($request->hasFile('cover_image')) 
    //   {
    //       $newImageName = time().'-'.$request->name . '.'.$request->cover_image->extension();

    //       $request->cover_image->move(public_path('images'), $newImageName);
    //   } 

        // $posts = Post::where('id', $id)
        // ->update([
        //   'title' => $request->input('title'),
        //   'author' => $request->input('author'),
        //   'body' => $request->input('body'),
        
        // ]);

       
          $post = Post::find($id);
          $post->title = $request->input('title');
          $post->author = $request->input('author');
          $post->body = $request->input('body');
        //  if($request->hasFile('cover_image')) {
        //        $post->cover_image  = $newImageName;
        //  } 
           $post->save();

         return redirect('/posts')->with('success', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if(auth()->user()->id  !== $post->user->id) 
        {
            return redirect('/posts')->with('error', 'Unauthorized Page'); 
        }
        $post->delete();
        return redirect('/posts')->with('success', 'Post Delete');
    }
}
