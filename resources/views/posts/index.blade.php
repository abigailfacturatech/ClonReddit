
@extends('layouts.app')


@section('content')



    @foreach($posts as $post)

        <div class="row">
            <div class="col-md-1">
                <post-vote
                :is-authenticated="{!! json_encode(Auth::user() !== null) !!}"
                :post-id="{{ $post->id }}"
                :current-votes=" {{ $post->totalVotes() }}"
                :user-vote="{{ $post->userVote(Auth::user()) }}"
               >
                </post-vote>
            </div>
            <div class="col-md-11" >


                <h2>
                    <a href="{{ route('post_show_path', ['id' => $post->id])}}">{{ $post ['title'] }}</a>


                    @if($post->wasCreatedBy(Auth::user()))

                    <small class="pull-right"  style="text-align: center">



                            <form action="{{ route('delete_post_path', ['post' => $post->id])}}" method="POST" >
                            <div ><a href="{{ route('edit_post_path', ['post' => $post->id]) }}" class="btn btn-info">Edit</a></div>
                            {{ csrf_field() }}

                            {{method_field('DELETE')}}


                               <div  >  <button type="submit" class='btn btn-danger'>Delete</button></div>


                            </form>
                        </small>
                    @endif




                    <p> Posted {{ $post->created_at->diffForHumans() }} by <b>{{$post->user->name}}</b></p>

            </div>

        </div>

        <hr>

    @endforeach


        {{$posts->render() }}

@endsection()
