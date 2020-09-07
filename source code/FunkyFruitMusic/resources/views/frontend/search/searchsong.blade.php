@extends('layouts.layout')

@section('content')
    <div class="container-fluid">
        <div class="row sider">
            <div class="col-2 sidebar">
                <a href="{{ url('searchall/'. $input) }}" class="nonactive-sidebar">All</a>
                <a href="{{  url('searchsong/'. $input)}}" class="active-sidebar">Songs</a>
                <a href="{{  url('searchalbum/'. $input)}}" class="nonactive-sidebar">Albums</a>
                <a href="{{  url('searchsinger/'. $input)}}" class="nonactive-sidebar">Singers</a>
                <a href="{{  url('searchmusician/'. $input)}}" class="nonactive-sidebar">Musician</a>
            </div>
            <div class="col-10 sidebar-content">
                <h1 class="title-a">ALL SONGS - "{{ $input }}"</h1>
                @if (count($songs))
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
                @else
                    <i style="padding-left: 20px; font-size: 25px;">No song matched "{{ $input }}"</i>
                @endif
                {{ $songs->links() }}
            </div>
        </div>
        
    </div>
@endsection