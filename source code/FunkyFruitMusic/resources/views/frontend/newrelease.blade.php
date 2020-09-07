@extends('layouts.layout')

@section('content')
    


    <div class="container-fluid">
        <div>
            <img src="img/banner/new-release.jpg" alt=""  class="banner-img" width="100%" height="250px">
        </div>
        
        <div class="data-content">

        
            <?php
                $songs = DB::select('select * from songs order by created_at desc limit 10');
            ?>
            <?php $count = 1; ?>
            @foreach ($songs as $song)

                <?php
                    $singers = DB::select('select distinct s.name as name from singers s, detailsongs ds where s.id = ds.singer_id and ds.song_id = ?', [$song->id]);
                    $file = (json_decode($song->file))[0]->download_link;
                    $likedsongs = DB::select('select * from likedsongs where song_id = ? and user_id = ?', [$song->id, Auth::id()]);
                ?>

                <div class="song-detail">
                    
                    <p style="text-align: left">
                        <div class="row">
                            <div class="col-xs-1 col-lg-1 counter">
                                <span>
                                    <?php echo $count; $count+=1; ?>
                                </span>
                            </div>
                            <div class="col-xs-8 col-lg-8">
                                <span class="song-display">
                                    <a href="song/{{ $song->id }}">{{ $song->name }}</a>
                                    @if (count($singers))
                                        <br>
                                        @foreach ($singers as $singer)
                                        <span><a href="" style="font-weight: normal">{{ $singer->name }}</a></span>
                                        @endforeach
                                    @endif
                                    
                                </span>
                            </div>
                            <div class="col-xs-3 col-lg-3 icon-block">
                                <a href="song/{{ $song->id }}" class="fas fa-play" title="Play"></a>
                                @if (count($likedsongs))
                                    <a href="{{ url('likedSongs', [$song->id]) }}" class="fas fa-heart"  title="Unlike this song"></a>
                                @else
                                    <a href="{{ url('likedSongs', [$song->id]) }}" class="far fa-heart" style="font-weight: normal" title="Like this song"></a>
                                @endif
                                <a href="{{ Voyager::image( $file ) }}" class="fas fa-download" target="_blank" download="{{ $song->name }}.mp3" title="Download"></a>
                                {{-- <a href="#" class="fas fa-plus" title="Add to playlist"></a> --}}
                            </div>
                        </div>
                    </p>
                </div>
            @endforeach
        </div>
    </div>
@endsection