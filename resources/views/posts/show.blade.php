@extends('layouts.app')


@section('content')
   <a href="/posts" class="btn btn-primary"> Go Back </a>
   <div>
    <img src="{{ asset('images/' . $post->cover_image) }}"
    alt="" width="400" height="400" class="img-fluid">
   </div>
   <h1> {{ $post->title }} </h1>
    <div>
       <h2> <strong>  {{ $post->author }}  </strong>  </h2>
    </div>  
    
    <div>
        {!! $post->body  !!}
   </div> 

    <hr> 
   <small>Written On: {{ $post->created_at }}  by {{$post->user->name}} </small>
   <hr>

   @if(!Auth::guest())
     @if(Auth::user()->id == $post->user->id)
   <a href="/posts/{{ $post->id }}/edit" class="btn btn-default"> Edit </a>
      

    <form action="/posts/{{ $post->id }}" method="POST">
        @csrf
        @method('delete')
    <input type="submit" class="pull-right btn btn-danger" 
    value="Delete">
             
  </form>
 @endif
 @endif
 
@endsection