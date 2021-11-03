@extends('layouts.app')

@section('content')

    <!-- this method es para decir si el $post ya fue almacenado en la bd
        si ya existe lo vamosa editar,
    sino entonces creamos uno nuevo -->  
  @if( $post->exists )
   <!-- method update-->  
 
    <form action="{{ route('update_post_path', ['post' => $post->id]) }}" method="POST">

          {{ method_field('PUT') }}

    @else      
        <!-- method edit-->  
    <form action="{{ route('store_post_path') }}" method="POST">

    @endif   
        
        {{ csrf_field()}}
        
        
          <!-- title field-->    
    <div class="form-group">
      <label for="title">Title:</label>
      <input type="text" name="title" class="form-control" value="{{ $post->title or old('title') }}" />
    </div>

        <!-- Descriotion Input-->   

   <div class="form-group">
     <label for="" class="form-label">Description:</label>
     <textarea rows="5" name="description" class="form-control"/>{{ $post->description or old('description') }}</textarea>
   </div>

        <!-- url field--> 
    
   <div class="form-group">
     <label for="" >Url:</label>
     <input type="text" class="form-control" name="url" value="{{ $post->url or old('url') }}"/>
   </div>


   <div class="form-group">
        <button type="submit" class="btn btn-primary">Save post</button>
    </div> 

    </form>   

@endsection