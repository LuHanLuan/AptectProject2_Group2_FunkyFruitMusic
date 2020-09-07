@extends('layouts.layout')

@section('content')
    <?php 
        $singers = DB::select('select * from singers limit 8');
        $musicians = DB::select('select * from musicians order by id desc limit 8');
    ?>
    <div class="container-fluid">
        <div class="data-content">
            <h1 class="title-a">SINGERS</h1>
            <div class="row">
                @foreach ($singers as $singer)
                    <div class="col-3 block-content">
                        <a href="{{  url('singer/'. $singer->id)}}"><img src="{{ Voyager::image($singer->image) }}" alt=""></a>
                        <h1><a href="{{  url('singer/'. $singer->id)}}">{{ $singer->name }}</a></h1>
                        {{-- <button><span class="fas fa-heart"></span>Follow</button> --}}
                    </div>    
                @endforeach
            </div>
            <a href="{{ url('singer') }}" class="view-m">View more</a>
            <h1 class="title-a">MUSICIANS</h1>
            <div class="row">
                @foreach ($musicians as $musician)
                    <div class="col-3 block-content">
                        <a href="{{  url('musician/'. $musician->id)}}"><img src="{{ Voyager::image($musician->image) }}" alt=""></a>
                        <h1><a href="{{  url('musician/'. $musician->id)}}">{{ $musician->name }}</a></h1>
                        <button><span class="fas fa-heart"></span>Follow</button>
                    </div>
                    
                @endforeach
            </div>
            <a href="{{ url('musician') }}" class="view-m">View more</a>
        </div>
    </div>
@endsection