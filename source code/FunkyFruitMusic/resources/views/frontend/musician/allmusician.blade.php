@extends('layouts.layout')

@section('content')
    <div class="container-fluid">
        <div class="data-content">
            <h1 class="title-a">ALL MUSICIANS</h1>
            <div class="row">
                @foreach ($musicians as $musician)
                    <div class="col-3 block-content">
                        <a href="{{  url('musician/'. $musician->id)}}"><img src="{{ Voyager::image($musician->image) }}" alt=""></a>
                        <h1><a href="{{  url('musician/'. $musician->id)}}">{{ $musician->name }}</a></h1>
                        {{-- <button><span class="fas fa-heart"></span>Follow</button> --}}
                    </div>
                    
                @endforeach
            </div>
            {{ $musicians->links() }}
        </div>
    </div>
@endsection