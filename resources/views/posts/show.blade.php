@extends('layouts.app')

@section('content')

<div class="row">

            <div class="col-md-12">
                <h2>{{$post->title}}</h2>

                <p>{{$post->description}}</p>

                <p>Post {{$post->created_at->diffForHumans()}}</p>
            </div>
        </div>

        <hr>
    <div class="row">
        <div class="col-md-12">

            @if(Auth::guest())

                Please log in to your account to comment
            @else    
        <form  action="{{ route('create_comment_path', ['post' => $post->id]) }}" method="post">
               
        {!! csrf_field() !!}
               
               
                <div class="form-group">
                    <label for="coment"></label>
                    <textarea name="coment" id="" cols="60" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Post Comment</button>
                </div>    
            </form>
            @endif
        </div>
    </div>
@endsection

