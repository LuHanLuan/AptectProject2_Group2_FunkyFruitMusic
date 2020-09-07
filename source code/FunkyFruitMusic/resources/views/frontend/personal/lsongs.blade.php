@extends('layouts.layout')

@section('content')
<div class="container-fluid">
    <div class="row sider">
        <div class="col-2 sidebar">
            <a href="{{ url('recent') }}" class="nonactive-sidebar">Recent songs</a>
            <a href="{{ url('lsongs') }}" class="active-sidebar">Liked songs</a>
        </div>
        <div class="col-10 sidebar-content">
            <h1>
                <a href="#" class="nonactive-sidebar">LIKED SONGS ></a>
            </h1>

            @if (count($songs))
                @foreach ($songs as $song)
                    <?php
                    $singers = DB::select('select distinct s.id as id, s.name as name from singers s, detailsongs ds where s.id = ds.singer_id and ds.song_id = ?', [$song->id]);
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
                                <span class="far fa-trash-alt" data-toggle="modal" data-target="#exampleModalCenter" style="color: blue; font-size: 25px; padding-right: 50px;"></span>
                                {{-- @if (count($likedsongs))
                                    <a href="{{ url('likedSongs', [$song->id]) }}" class="fas fa-heart" title="Unlike this song"></a>
                                @else
                                    <a href="{{ url('likedSongs', [$song->id]) }}" class="far fa-heart" style="font-weight: normal" title="Like this song"></a>
                                @endif --}}
                                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Remove "{{ $song->name }}" from liked songs</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure to remove this song?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal"><a href="" style="color: white">No</a></button>
                                                <button type="button" class="btn btn-primary"><a href="{{ url('removelsongs/'. $song->id)  }}" title="Remove from liked songs">Yes</a></button>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <a href="{{ Voyager::image( $file ) }}" class="fas fa-download" target="_blank" download="{{ $song->name }}.mp3" title="Download"></a>
                                {{-- <a href="#" class="fas fa-plus" title="Add to playlist"></a> --}}
                            </div>
                        </div>
                    </p>
                @endforeach
                {{ $songs->links() }}
            @else
                <i>You didn't like any song yet</i>
            @endif
        </div>
    </div>
@endsection