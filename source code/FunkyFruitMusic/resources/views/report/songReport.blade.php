<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <style>
            body{
                font-family: DejaVu Sans, sans-serif;
            }
        </style>
    </head>
    <body>

        <?php
            $users = DB::select('select * from users');
            $songs = DB::select('select * from songs');
            $albums = DB::select('select * from albums');
            $singers = DB::select('select * from singers');
            $musicians = DB::select('select * from musicians');
            $songsdata = DB::select('select * from songs order by created_at desc limit 10')
        ?>

        <div class="page-content">
            <h1 style="text-align: center; color: greenyellow; font-size: 35px; font-weight:bold;">
                <img src="img/logo/logo.png" style="width: 50px;" alt="">
                <span>Funky Fruit Music</span>
            </h1>
            <h1 style="text-align: center; color: greenyellow; font-size: 35px; font-weight:bold;">
                Newest Song Report
            </h1>
            <br style="clear:both;">
            <h2 style="font-size: 25px">Report date:  <?php echo date("Y/m/d") ?></h2>
            <hr style="clear:both;">
            <h1 style="padding-left: 30px; font-size: 25px;">Top 10 newest songs</h1>
    
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Song</th>
                        <th scope="col">Category</th>
                        <th scope="col">Nation</th>
                        <th scope="col">Singer</th>
                    </tr>
                </thead>
                <tbody>
            @foreach ($songsdata as $song)
                <?php
                    $singers = DB::select('select distinct s.id as id, s.name as name from singers s, detailsongs ds where s.id = ds.singer_id and ds.song_id = ?', [$song->id]);
                    $categories = DB::select('select * from categories where id = ?', [$song->category_id]);
                    $nations = DB::select('select * from nations where id = ?', [$song->nation_id]);
                ?>
                    <tr>
                        <th scope="row">{{ $song->name }}</th>
                        @foreach ($categories as $category)
                            <td>{{ $category->name }}</td>
                        @endforeach
                        @foreach ($nations as $nation)
                            <td>{{ $nation->name }}</td>
                        @endforeach
                        <td>
                            @foreach ($singers as $singer) 
                                <span>{{ $singer->name }}</span> 
                            @endforeach
                        </td>       
                    </tr>
            @endforeach
                </tbody>
            </table>
        </div>

        
    </body>
</html>


    
