@extends('layouts.layout')

@section('content')
    <div class="container-fluid">
        <div class="data-content">
            <h1 class="title-a">ALL ALBUMS</h1>
            <div class="row">
                @foreach ($albums as $album)
                    <div class="col-3 block-content-a">
                        <a href="{{  url('album/'. $album->id)}}"><img src="{{ Voyager::image($album->image) }}" alt=""></a>
                        <h1 style="text-align: center"><a href="{{  url('album/'. $album->id)}}">{{ $album->name }}</a></h1>
                        {{-- <button><span class="fas fa-heart"></span>Follow</button> --}}
                    </div>
                    
                @endforeach
            </div>
            {{ $albums->links() }}
        </div>
    </div>
@endsection