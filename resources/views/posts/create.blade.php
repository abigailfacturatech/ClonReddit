@extends('layouts.app')

@section('content')

  <h2>Create Post</h2>
 
  @include('posts._form', ['post' => $post])
    
@endsection