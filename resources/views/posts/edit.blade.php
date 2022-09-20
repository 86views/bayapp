@extends('layouts.app')


@section('content')
<div class="form-body">
    <h3> Update Post </h3>
    <form action="/posts/{{ $post->id }}"  method="POST"> 
        @csrf
        @method('PUT')


{{-- <div class="card-body">
    <div class="form-group">
        <label for="post"> Post Image </label>
        <div class="input-group">
            <div class="custom-file">
            <input type="file" name="cover_image" 
            class="form-control" id="image">
            
            </div>
        </div>
        </div>  --}}

    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" class="form-control" 
        id="title" placeholder="Enter Title" value="{{ $post->title }}">
    </div>

    <div class="form-group">
        <label for="title">Author</label>
        <input type="text" name="author" class="form-control" 
        id="title" placeholder="Enter Author" value="{{ $post->author }}">
    </div>


    <div class="form-group">
    <label for="body">Post Body</label>
    <textarea name="body" id="task_textarea" class="form-control"
    placeholder="Enter ..."> {{ $post->body }}</textarea>
    </div>

    

    
                                     
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>

  </form>
               
</div>
@endsection



@section('scripts')
{{-- <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
CKEDITOR.replace( 'task_textarea' );
</script> --}}

<script src="//cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
CKEDITOR.replace( 'task_textarea' );
</script>
@endsection
