@extends('layouts.layout')

@section('content')
    <div class="container-fluid">
        <div class="row sider">
            <div class="col-2 sidebar">
                <a href="{{ url('searchall/'. $input) }}" class="nonactive-sidebar">All</a>
                <a href="{{  url('searchsong/'. $input)}}" class="nonactive-sidebar">Songs</a>
                <a href="{{  url('searchalbum/'. $input)}}" class="nonactive-sidebar">Albums</a>
                <a href="{{  url('searchsinger/'. $input)}}" class="active-sidebar">Singers</a>
                <a href="{{  url('searchmusician/'. $input)}}" class="nonactive-sidebar">Musician</a>
            </div>
            <div class="col-10 sidebar-content">
                <h1 class="title-a">ALL SINGERS - "{{ $input }}"</h1>
                @if (count($singers))
                    <div class="row">
                        @foreach ($singers as $singer)
                            <div class="col-3 block-content">
                                <a href="{{  url('singer/'. $singer->id)}}"><img src="{{ Voyager::image($singer->image) }}" alt=""></a>
                                <h1><a href="{{  url('singer/'. $singer->id)}}">{{ $singer->name }}</a></h1>
                                {{-- <button><span class="fas fa-heart"></span>Follow</button> --}}
                            </div>
                            
                        @endforeach
                    </div>
                    {{ $singers->links() }}
                @else
                    <i style="padding-left: 20px; font-size: 25px;">No singer matched "{{ $input }}".</i>
                @endif
                
            </div>
        </div>
        
    </div>
@endsection