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
        
       
       @if( $post->exists )
          <!-- title field-->    
    <div class="form-group">
      <label for="title">Title:</label>
      <input type="text" name="title" class="form-control" value="{{ $post->title  }}" />
    </div>
        @else  
       <div class="form-group">
        <label for="title">Title:</label>
        <input type="text" name="title" class="form-control" value="{{ old('description')  }}" />
      </div>
        @endif 
      @if( $post->exists )
         <!-- Descriotion Input-->   
      <div class="form-group">
        <label for="" class="form-label">Description:</label>
        <textarea rows="5" name="description" class="form-control"/>{{ $post->description  }}</textarea>
      </div>
      @else  

      <div class="form-group">
        <label for="" class="form-label">Description:</label>
        <textarea rows="5" name="description" class="form-control"/>{{old('description') }}</textarea>
      </div>
      @endif
        <!-- url field--> 
     @if( $post->exists )
      <div class="form-group">
        <label for="" >Url:</label>
        <input type="text" class="form-control" name="url" value="{{ $post->url  }}"/>
      </div>
   @else  
      <div class="form-group">
        <label for="" >Url:</label>
        <input type="text" class="form-control" name="url" value="{{  old('url') }}"/>
      </div>
   @endif

   <div class="form-group">
        <button type="submit" class="btn btn-primary">Save post</button>
    </div> 

    </form>    
@endsection