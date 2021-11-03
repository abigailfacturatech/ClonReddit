@extends('layouts/app')

@section('content')
    @if(count($errors) > 0)

          <div class="alert alert-danger">

              <ul>
                  @foreach ($errors->all() as $error )
                      
                  <li>{{$error}}</li>
                  @endforeach
              </ul>

          </div>

    @endif

      <form action="{{ route('update_post_path', ['post' => $post->id]) }}" method="POST">

          {{ csrf_field() }}

          {{ method_field('PUT') }}

          <!-- title field-->    

          <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" class="form-control" value="{{ $post->title }}" />
          </div>

              <!-- Descriotion Input-->   

          <div class="form-group">
            <label for="" class="form-label">Description:</label>
            <textarea rows="5" name="description" class="form-control"/>{{ $post->description }}</textarea>
          </div>

          <!-- url field--> 
          
          <div class="form-group">
            <label for="" >Url:</label>
            <input type="text" class="form-control" name="url" value="{{ $post->url }}"/>
          </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Edit post</button>
            </div>
      </form>  

@endsection