@extends('layouts.layout')

@section('content')
    <div class="container-fluid">
        <div class="data-content">
            <h1 class="title-a">ALL SINGERS</h1>
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
        </div>
    </div>
@endsection