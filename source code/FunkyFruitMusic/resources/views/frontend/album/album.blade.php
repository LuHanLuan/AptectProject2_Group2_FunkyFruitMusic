<style>
    .copy{
        margin:20px;
        padding:20px;
        border-style:solid;
        border-width:1px;
        border-color: #ddd;
        -webkit-border-radius:3px;
        border-radius:3px;
        font-size:18px;
    }
    .panel{ margin: 20px; padding:0px; height:34px;}
    .audio-panel{border:none !important;}
    #playlist,audio{width:100%;}
    .active a{color:#333;text-decoration:none;}
    #playlist ul{list-style:none; margin:0px; padding:20px;}
    #playlist li{margin:0px; padding:0px;}
    #playlist li, a{transition:all 0.5s;}
    .list-group-item.active a{ text-decoration:none; color:#333;}
    #playlist .col-7 a{display:block; position:relative; width:100%;}
    #playlist li .col-7 a{display:block; text-decoration:none;}
    #playlist li:hover{background-color:#333; color: #fff;}
    #playlist li:hover>a{color: #fff;}
    #playlist li a:hover{text-decoration:none; color: #fff;}
    #playlist a{color:#333; text-decoration:none;}
    .last{display:none;}
</style>
<script src="https://cdn.jsdelivr.net/npm/cplayer/dist/cplayer.min.js"></script>

@extends('layouts.layout')
<br>
<?php
    $albums = DB::select('select * from albums where id = ?', [$albumId]);
    $songs = DB::select('select s.id as id, s.file as file, s.name as name from songs s, detailalbums d where s.id = d.song_id and d.album_id = ?', [$albumId]);
    $firstsongs = DB::select('select s.id as id, s.file as file, s.name as name from songs s, detailalbums d where s.id = d.song_id and d.album_id = ? limit 1', [$albumId]);
    $otheralbums = DB::select('select * from albums where id <> ? limit 4', [$albumId]);
?>
@section('content')
    <div class="container-fluid">
        <div class="data-content">
            @foreach ($albums as $album)
                <h1 style="text-align: center">Album "{{ $album->name }}"
                    <img src="{{ Voyager::image($album->image) }}" style="max-height: 200px" alt="">
                </h1>
            @endforeach
            @foreach ($firstsongs as $firstsong)
                <?php
                    $firstfile = (json_decode($firstsong->file))[0]->download_link;
                ?>

                <div class="panel panel-default audio-panel">
                    <audio id="audio" autoplay preload="auto" tabindex="0" controls>
                        <source src="{{ Voyager::image($firstfile) }}">
                    </audio>
                </div>
            @endforeach
            
            <ul id="playlist">
                @foreach ($songs as $song)
                    <?php
                        $file = (json_decode($song->file))[0]->download_link;
                        $likedsongs = DB::select('select * from likedsongs where song_id = ? and user_id = ?', [$song->id, Auth::id()]);
                    ?>
                    @foreach ($albums as $album)
                        <li class="active list-group-item">
                            <a href="{{ Voyager::image($file) }}" style="font-size:25px; padding-left: 10px;">
                            {{ $song->name }}
                            </a>         
                        </li>
                    @endforeach
                @endforeach

                <li class="last">
                    <a href="">
                    </a>
                </li>
            </ul>

            <h1 style="color: dodgerblue;">Other albums: </h1>
            <div class="row">
                @foreach ($otheralbums as $otheralbum)
                    <div class="col-3 block-content">
                        <a href="{{  url('album/'. $otheralbum->id)}}"><img src="{{ Voyager::image($otheralbum->image) }}" alt=""></a>
                        <h1><a href="{{  url('album/'. $otheralbum->id)}}">{{ $otheralbum->name }}</a></h1>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    

    <script>
        var audio;
        var playlist;
        var tracks;
        var current;

        init();
        function init(){
            current = 0;
            audio = $('#audio');
            playlist = $('#playlist');
            tracks = playlist.find('li a');
            len = tracks.length - 1;
            audio[0].volume = 0.5;
            audio[0].play();
            playlist.find('a').click(function(e){
                e.preventDefault();
                link = $(this);
                current = link.parent().index();
                run(link, audio[0]);
            });
            audio[0].addEventListener('ended',function(e){
                current++;
                if(current == len){
                    current = 0;
                    link = playlist.find('a')[0];
                }else{
                    link = playlist.find('a')[current];    
                }
                run($(link),audio[0]);
            });
        }
        function run(link, player){
                player.src = link.attr('href');
                par = link.parent();
                par.addClass('active').siblings().removeClass('active');
                audio[0].load();
                audio[0].play();
        }
    </script>


@endsection