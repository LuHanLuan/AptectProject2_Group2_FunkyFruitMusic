@extends('layouts.layout')

@section('content')
    <div class="container-fluid">
        <div class="row sider">
            <div class="col-2 sidebar">
                <a href="{{ url('searchall/'. $input) }}" class="active-sidebar">All</a>
                <a href="{{  url('searchsong/'. $input)}}" class="nonactive-sidebar">Songs</a>
                <a href="{{  url('searchalbum/'. $input)}}" class="nonactive-sidebar">Albums</a>
                <a href="{{  url('searchsinger/'. $input)}}" class="nonactive-sidebar">Singers</a>
                <a href="{{  url('searchmusician/'. $input)}}" class="nonactive-sidebar">Musician</a>
            </div>
            <div class="col-10 sidebar-content">
                @if (count($songs) || count($ss) || count($musicians))
                    
                    @if (count($songs))
                        <h1 class="title-a">SONGS - "{{ $input }}"</h1>
                        @foreach ($songs as $song)
                            <?php
                            $singers = DB::select('select distinct s.id, s.name as name from singers s, detailsongs ds where s.id = ds.singer_id and ds.song_id = ?', [$song->id]);
                            $file = (json_decode($song->file))[0]->download_link;
                            $likedsongs = DB::select('select * from likedsongs where song_id = ? and user_id = ?', [$song->id, Auth::id()]);
                            ?>
                            <p style="text-align: left">
                                <div class="row">
                                    <div class="col-xs-7 col-lg-7">
                                        <span class="song-display">
                                            <a href="{{  url('song/'. $song->id)}}" style="color: black"> {{ $song->name }}</a>
                                            @if (count($singers))
                                                @foreach ($singers as $singer)
                                                <span> - <a href="{{  url('singer/'. $singer->id)}}">{{ $singer->name }}</a></span>
                                                @endforeach
                                            @endif
                                            
                                        </span>
                                    </div>
                                    <div class="col-xs-5 col-lg-5 small-icon-block">
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
                        <a href="{{ url('searchsong/'.$input) }}" class="view-m">View more</a>
                    @endif

                    @if (count($albums))
                        <h1 class="title-a">ALL ALBUMS - "{{ $input }}"</h1>
                        <div class="row">
                            @foreach ($albums as $album)
                                <div class="col-3 block-content">
                                    <a href="{{  url('album/'. $album->id)}}"><img src="{{ Voyager::image($album->image) }}" alt=""></a>
                                    <h1><a href="{{  url('album/'. $album->id)}}">{{ $album->name }}</a></h1>
                                    {{-- <button><span class="fas fa-heart"></span>Follow</button> --}}
                                </div>
                                
                            @endforeach
                        </div>
                        <a href="{{ url('searchmusician/'.$input) }}" class="view-m">View more</a>
                    @endif
                    
                    @if (count($ss))
                        <h1 class="title-a">ALL SINGERS - "{{ $input }}"</h1>
                        <div class="row">
                            @foreach ($ss as $singer)
                                <div class="col-3 block-content">
                                    <a href="{{  url('singer/'. $singer->id)}}"><img src="{{ Voyager::image($singer->image) }}" alt=""></a>
                                    <h1><a href="{{  url('singer/'. $singer->id)}}">{{ $singer->name }}</a></h1>
                                    {{-- <button><span class="fas fa-heart"></span>Follow</button> --}}
                                </div>
                                
                            @endforeach
                        </div>
                        <a href="{{ url('searchsinger/'.$input) }}" class="view-m">View more</a>
                    @endif

                    
                    
                    @if (count($musicians))
                        <h1 class="title-a">ALL MUSICIANS - "{{ $input }}"</h1>
                        <div class="row">
                            @foreach ($musicians as $musician)
                                <div class="col-3 block-content">
                                    <a href="{{  url('musician/'. $musician->id)}}"><img src="{{ Voyager::image($musician->image) }}" alt=""></a>
                                    <h1><a href="{{  url('musician/'. $musician->id)}}">{{ $musician->name }}</a></h1>
                                    {{-- <button><span class="fas fa-heart"></span>Follow</button> --}}
                                </div>
                                
                            @endforeach
                        </div>
                        <a href="{{ url('searchmusician/'.$input) }}" class="view-m">View more</a>
                    @endif
                @else
                    <i style="padding-left: 20px; font-size: 30px;";">No data matched "{{ $input }}".</i>
                @endif
                
            </div>
        </div>
        
    </div>
@endsection