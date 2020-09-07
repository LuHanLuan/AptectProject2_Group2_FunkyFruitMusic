@extends('layouts.layout')

@section('content')
<?php
use Carbon\Carbon;
    $songs = DB::select('select * from songs where id = ?', [$songId]);
    $checkNullSong = DB::select('select * from songs where id = ? and lyric is not null', [$songId]);
    $othersongs = DB::select('select * from songs where id <> ? limit 4', [$songId]);
?>

<br>
<div class="container-fluid">
    <div class="data-content">
        @foreach ($songs as $song)
            <?php
                $singers = DB::select('select distinct s.id as id, s.name as name from singers s, detailsongs ds where s.id = ds.singer_id and ds.song_id = ?', [$song->id]);
                $musicians = DB::select('select distinct m.id as id, m.name as name from musicians m, songs s where m.id = s.musician_id and s.id = ?', [$song->id]);
                $file = (json_decode($song->file))[0]->download_link;
                $categories = DB::select('select distinct c.id as id, c.name as name from categories c, songs s where c.id = s.category_id and s.id = ?', [$song->id]);
                $nations = DB::select('select distinct n.id as id, n.name as name from nations n, songs s where n.id = s.nation_id and s.id = ?', [$song->id]);
                $likedsongs = DB::select('select * from likedsongs where song_id = ? and user_id = ?', [$song->id, Auth::id()]);

                if(Auth::check()){
                    $lastViews = DB::select('select * from views where song_id = ? and user_id = ? order by created_at desc limit 1', [$song->id, Auth::id()]);

                    $from = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now());

                    if(count($lastViews)){
                        foreach ($lastViews as $lv) {
                            $to = Carbon::createFromFormat('Y-m-d H:i:s', $lv->created_at);
                        }
                        $diff = $to->floatDiffInMinutes($from);
                        if ($diff > 0.1){
                            DB::insert('insert into views (song_id, user_id, created_at) values (?, ?, ?)', [$songId, Auth::id(), Carbon::now()]);
                        }
                    } else{
                        DB::insert('insert into views (song_id, user_id, created_at) values (?, ?, ?)', [$songId, Auth::id(), Carbon::now()]);
                    } 
                }

                $views = DB::select('select * from views where song_id = ?', [$song->id]);
            ?>

            <h1>{{ $song->name }}</h1>
            <canvas id="canvas"></canvas>
            <h3 id="name"></h3>
            <audio id="audio" controls></audio>
        @endforeach
    </div>

    <div class="data-content">
        @foreach ($songs as $song)
        <div class="row">
            <div class="col-6 lyric">
                <h3>Lyrics: {{ $song->name }}</h3>
                <div class="long-text">           
                @if (count($checkNullSong))
                    {!! $song->lyric !!}               
                @else
                    <i>There is no lyric for current song.</i>   
                @endif       
                </div>
            </div>
            <div class="col-6">
                <div class="icon-detail">
                    @if (count($likedsongs))
                        <a href="{{ url('likedSongs', [$song->id]) }}" class="fas fa-heart" title="Unlike this song">Unlike this song</a>
                    @else
                        <a href="{{ url('likedSongs', [$song->id]) }}" class="far fa-heart" style="font-weight: normal" title="Like this song">Like this song</a>
                    @endif
                    <a href="{{ Voyager::image( $file ) }}" class="fas fa-download" target="_blank" download="{{ $song->name }}.mp3" title="Download">Download</a>
                    {{-- <a href="#" class="fas fa-plus" title="Add to playlist">Add to playlist</a> --}}
                </div>
                <div class="detail-song">
                    <p>
                        <h3>
                            <span class="far fa-eye" style="font-size: 30px"> {{ count($views) }}</span>
                        </h3>
                        @foreach ($musicians as $musician)
                            <h3>
                                <span style="font-weight: bold; font-size: 20px">Songwriter:</span>
                                <a href="{{  url('musician/'. $musician->id)}}">{{ $musician->name }}</a>
                            </h3>      
                        @endforeach
                        @if (count($singers))
                            <h3><span style="font-weight: bold; font-size: 20px">Singer(s):</span>
                            @foreach ($singers as $singer) 
                                <span><a href="{{  url('singer/'. $singer->id)}}">{{ $singer->name }}</a></span>                                   
                            @endforeach
                            </h3>
                        @endif
                        @foreach ($categories as $category)
                            <h3>
                                <span style="font-weight: bold; font-size: 20px">Category:</span>
                                <a href="{{  url('category/'. $category->id)}}">{{ $category->name }}</a>
                            </h3>      
                        @endforeach
                        @foreach ($nations as $nation)
                            <h3>
                                <span style="font-weight: bold; font-size: 20px">Nation:</span>
                                <a href="{{  url('nation/'. $nation->id)}}">{{ $nation->name }}</a>
                            </h3>      
                        @endforeach
                        <h1>Other songs you may like:</h1>
                        @foreach ($othersongs as $othersong)
                        <?php
                        $othersingers = DB::select('select distinct s.id as id, s.name as name from singers s, detailsongs ds where s.id = ds.singer_id and ds.song_id = ?', [$othersong->id]);
                        $otherlikedsongs = DB::select('select * from likedsongs where song_id = ? and user_id = ?', [$othersong->id, Auth::id()]);
                        ?>
                            <p style="text-align: left">
                                <div class="row">
                                    <div class="col-xs-7 col-lg-7">
                                        <span class="song-display">
                                            <a href="{{  url('song/'. $othersong->id)}}" style="color: black">{{ $othersong->name }}</a>
                                            @if (count($othersingers))
                                                @foreach ($othersingers as $othersinger)
                                                <span> - <a href="{{  url('singer/'. $othersinger->id)}}">{{ $othersinger->name }}</a></span>
                                                @endforeach
                                            @endif
                                            
                                        </span>
                                    </div>
                                    <div class="col-xs-5 col-lg-5 small-icon-block">
                                        <a href="{{  url('song/'. $othersong->id)}}" class="fas fa-play" title="Play"></a>
                                        {{-- @if (count($otherlikedsongs))
                                            <a href="{{ url('likedSongs', [$othersong->id]) }}" class="fas fa-heart" title="Unlike this song"></a>
                                        @else
                                            <a href="{{ url('likedSongs', [$othersong->id]) }}" class="far fa-heart" style="font-weight: normal" title="Like this song"></a>
                                        @endif --}}
                                        {{-- <a href="#" class="fas fa-plus" title="Add to playlist"></a> --}}
                                    </div>
                                </div>
                            </p>
                        @endforeach
                        
                    </p>
                </div>
            </div>
            </div>

            <?php
                $comments = DB::select('select * from comments where song_id = ? order by id desc', [$song->id]);
            ?>
            <div class="col-12" style="padding-top: 30px; padding-left: 50px;">
                <form action="{{ url('comment') }}" method="get">
                    <textarea name="comment" cols="170" rows="6" placeholder="write comment here"></textarea><br>
                    <input type="hidden" name="songId" value="{{ $song->id }}">
                    <input type="submit" value="comment" style="background:#3b5998;padding:4px; color:white;">
                </form>

                @foreach ($comments as $comment)
                <div class="row">
                    <div class="col-1">
                        <img src="{{ Voyager::image(setting('site.user-logo')) }}" alt="" style="width: 50px">
                    </div>
                    <div class="col-11">
                        <div style="width: 800px;">
                            <?php 
                                $users = DB::select('select * from users where id = ?', [$comment->user_id])
                            ?>
                            @foreach ($users as $user)
                                @if ($user->role_id == 1)
                                    <h2 style="color: red">{{ $user->name }}</h2>
                                @else
                                    <h2>{{ $user->name }}</h2>
                                @endif           
                            @endforeach
                            <p>{{ $comment->comment }}</p>
                        </div>
                    </div>
                </div>
                
                    
                @endforeach

            </div>
            
        </div>
        
        @endforeach
    </div>
    
</div>

@endsection

<script>
    window.onload = function() {

        const canvas = document.getElementById("canvas");
        const h3 = document.getElementById('name')
        const audio = document.getElementById("audio");

        audio.src = "{{ Voyager::image( $file ) }}"; 

        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
        const ctx = canvas.getContext("2d");


        const context = new AudioContext(); // (Interface) Audio-processing graph
        let src = context.createMediaElementSource(audio); // Give the audio context an audio source,
        // to which can then be played and manipulated
        const analyser = context.createAnalyser(); // Create an analyser for the audio context

        src.connect(analyser); // Connects the audio context source to the analyser
        analyser.connect(context.destination); // End destination of an audio graph in a given context

        analyser.fftSize = 16384;

        const bufferLength = analyser.frequencyBinCount; // (read-only property)

        const dataArray = new Uint8Array(bufferLength); // Converts to 8-bit unsigned integer array
        // At this point dataArray is an array with length of bufferLength but no values
        console.log('DATA-ARRAY: ', dataArray) // Check out this array of frequency values!

        const WIDTH = canvas.width;
        const HEIGHT = canvas.height;
        console.log('WIDTH: ', WIDTH, 'HEIGHT: ', HEIGHT)

        const barWidth = (WIDTH / bufferLength) * 13;
        console.log('BARWIDTH: ', barWidth)

        console.log('TOTAL WIDTH: ', (117*10)+(118*barWidth)) // (total space between bars)+(total width of all bars)

        let barHeight;
        let x = 0;

        function renderFrame() {
            requestAnimationFrame(renderFrame); // Takes callback function to invoke before rendering

            x = 0;

            analyser.getByteFrequencyData(dataArray); // Copies the frequency data into dataArray

            ctx.fillStyle = "rgba(0,0,0,0.2)"; 
            ctx.fillRect(0, 0, WIDTH, HEIGHT); 

            let r, g, b;
            let bars = 118 // Set total number of bars you want per frame

            for (let i = 0; i < bars; i++) {
            barHeight = (dataArray[i] * 2.5);

            if (dataArray[i] > 210){ // pink
                r = 250
                g = 0
                b = 255
            } else if (dataArray[i] > 200){ // yellow
                r = 250
                g = 255
                b = 0
            } else if (dataArray[i] > 190){ // yellow/green
                r = 204
                g = 255
                b = 0
            } else if (dataArray[i] > 180){ // blue/green
                r = 0
                g = 219
                b = 131
            } else { // light blue
                r = 0
                g = 199
                b = 255
            }
            ctx.fillStyle = `rgb(${r},${g},${b})`;
            ctx.fillRect(x, (HEIGHT - barHeight), barWidth, barHeight);

            x += barWidth + 10 
            }
        }

        audio.play();
        renderFrame();
    };
</script>

