@extends('layouts.app')


@section('content')
   <h1> POST</h1>
 @if (count($posts) > 0)
     @foreach ($posts as $post)
         <div class="well">
              <div class="row">
                  <div class="col-md-4 col-sm-4">
                    <img style="width:100%" src="{{ asset('images/' . $post->cover_image) }}"
                       alt="">
                  </div>
                  <br> <br> <br>
                  <div class="col-md-8 col-sm-8">
                    <h3><a href="/posts/{{ $post->id }}"> {{ $post->title }} </a> </h3>
                    <h5>  {!! $post->body !!} </h5>
                    <small> Written On: {{ $post->created_at }}  by {{ $post->user->name }} </small>
                </div>
              </div>
         </div>   
     @endforeach
       {{ $posts->links() }}
 @else
       <p> No Post Found  </p>
 @endif


@endsection