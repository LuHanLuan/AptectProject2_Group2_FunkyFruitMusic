@extends('layouts.layout')

@section('content')
    <div class="container-fluid">
        <div class="row sider">
            <div class="col-2 sidebar">
                <a href="{{ url('searchall/'. $input) }}" class="nonactive-sidebar">All</a>
                <a href="{{  url('searchsong/'. $input)}}" class="nonactive-sidebar">Songs</a>
                <a href="{{  url('searchalbum/'. $input)}}" class="active-sidebar">Albums</a>
                <a href="{{  url('searchsinger/'. $input)}}" class="nonactive-sidebar">Singers</a>
                <a href="{{  url('searchmusician/'. $input)}}" class="nonactive-sidebar">Musician</a>
            </div>
            <div class="col-10 sidebar-content">
                <h1 class="title-a">ALL ALBUMS - "{{ $input }}"</h1>
                @if (count($albums))
                    <div class="row">
                        @foreach ($albums as $album)
                            <div class="col-3 block-content">
                                <a href="{{  url('album/'. $album->id)}}"><img src="{{ Voyager::image($album->image) }}" alt=""></a>
                                <h1><a href="{{  url('album/'. $album->id)}}">{{ $album->name }}</a></h1>
                                {{-- <button><span class="fas fa-heart"></span>Follow</button> --}}
                            </div>
                            
                        @endforeach
                    </div>
                    {{ $albums->links() }}
                @else
                    <i style="padding-left: 20px; font-size: 25px;">No album matched "{{ $input }}".</i>
                @endif
            </div>
        </div>
        
    </div>
@endsection