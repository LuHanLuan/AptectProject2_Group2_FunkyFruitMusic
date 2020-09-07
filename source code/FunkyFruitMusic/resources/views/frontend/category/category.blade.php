@extends('layouts.layout')

@section('content')
<?php
    $categories = DB::select('select * from categories');
    $sameCates = DB::select('select * from categories where id = ?', [$categoryId]);
    //$songs = DB::select('select s.id as id, s.name as name, s.file as file from categories c, songs s where c.id = s.category_id and c.id = ?', [$categoryId]);
    //$songsPage = DB::table('categories')->join('songs', 'categories.id', '=' , 'songs.category_id')->select('songs.id as id, songs.name as name, songs.file as file')->where('categories.id','=',$categoryId)->paginate(10);
?>
    <div class="container-fluid">
        <div class="row sider">
            <div class="col-2 sidebar">
                <a href="{{ url('category') }}" class="nonactive-sidebar">All Categories</a>
                @foreach ($categories as $category)
                    @if ($categoryId == $category->id)
                        <a href="{{  url('category/'. $category->id)}}" class="active-sidebar">{{ $category->name }}</a>
                    @else
                        <a href="{{  url('category/'. $category->id)}}" class="nonactive-sidebar">{{ $category->name }}</a>
                    @endif
                @endforeach
            </div>
            <div class="col-10 sidebar-content">
                @foreach ($sameCates as $sameCate)
                    <h1><a href="" class="nonactive-sidebar">{{ $sameCate->name }} ></a></h1>
                @endforeach
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
                    <i>There is no song for this category</i>
                @endif
                {{ $songs->links() }}
            </div>
        </div>
        
    </div>
@endsection