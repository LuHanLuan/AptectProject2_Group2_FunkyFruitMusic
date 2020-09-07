@extends('layouts.layout')

@section('content')
    <?php
        $singers = DB::select('select * from singers where id = ?', [$singerId]);
        $songs = DB::select('select s.id as id, s.name as name, s.file as file from detailsongs ds, songs s where s.id = ds.song_id and ds.singer_id = ? limit 5', [$singerId]);
        $othersingers = DB::select('select * from singers where id <> ? limit 4', [$singerId]);
    ?>
    <div class="container-fluid">
        <div class="data-content">
            <div class="row block-a">
                @foreach ($singers as $singer)
                    <div class="col-3">
                        
                            <img src="{{ Voyager::image($singer->image) }}" alt="">
                        
                    </div>
                    <div class="col-9">
                        <h1>
                            {{ $singer->name }}
                            {{-- <span><a href="#" class="far fa-heart" style="font-size:25px; padding-left: 10px; text-decoration:none;"></a></span> --}}
                        </h1>
                        
                        <div class="block-b">{!! $singer->description !!}</div>
                    </div>
                @endforeach  
            </div>

            <h1 style="color: dodgerblue;">Signature songs: </h1>
            @if (count($songs))
                @foreach ($singers as $singer)
                    @foreach ($songs as $song)
                        <?php
                            $file = (json_decode($song->file))[0]->download_link;
                            $likedsongs = DB::select('select * from likedsongs where song_id = ? and user_id = ?', [$song->id, Auth::id()]);
                        ?>
                        <p style="text-align: left">
                            <div class="row">
                                <div class="col-xs-8 col-lg-8">
                                    <span class="data-display">
                                        <a href="{{  url('song/'. $song->id)}}" style="color: black"> {{ $song->name }}</a>                            
                                    </span>
                                </div>
                                <div class="col-xs-4 col-lg-4 small-icon-block">
                                    <a href="{{  url('song/'. $song->id)}}" class="fas fa-play" title="Play"></a>
                                    @if (count($likedsongs))
                                        <a href="{{ url('likedSongs', [$song->id]) }}" class="fas fa-heart" title="Unlike this song"></a>
                                    @else
                                        <a href="{{ url('likedSongs', [$song->id]) }}" class="far fa-heart" style="font-weight: normal" title="Like this song"></a>
                                    @endif
                                    <a href="{{ Voyager::image( $file ) }}" class="fas fa-download" target="_blank" download="{{ $song->name }}.mp3" title="Download"></a>
                                    {{-- <a href="#" class="fas fa-plus" title="Add to playlist"></a> --}}
                                </div>
                            </div>
                        </p>
                    @endforeach
                @endforeach
            @else
                <i style="padding-left: 20px;">There is no song for this singer</i>
            @endif
            

            <h1 style="color: dodgerblue;">Other singers: </h1>
            <div class="row">
                @foreach ($othersingers as $othersinger)
                    <div class="col-3 block-content">
                        <a href="{{  url('singer/'. $othersinger->id)}}"><img src="{{ Voyager::image($othersinger->image) }}" alt=""></a>
                        <h1><a href="{{  url('singer/'. $othersinger->id)}}">{{ $othersinger->name }}</a></h1>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection