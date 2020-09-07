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
            $songsdata = DB::select('select * from songs order by created_at desc limit 3')
        ?>

        <div class="page-content">
            <h1 style="text-align: center; color: greenyellow; font-size: 35px; font-weight:bold;">
                <img src="img/logo/logo.png" style="width: 50px;" alt="">
                <span>Funky Fruit Music</span>
            </h1>
            <h1 style="text-align: center; color: greenyellow; font-size: 35px; font-weight:bold;">
                Overview Report
            </h1>
            <br style="clear:both;">
            <h2 style="font-size: 25px">Report date:  <?php echo date("Y/m/d") ?></h2>
            <hr style="clear:both;">
            <h1 style="padding-left: 30px; clear: both; font-size: 25px;">Website Statistics</h1>
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <th scope="row">Total users</th>
                        <td>{{ count($users) }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Total songs</th>
                        <td>{{ count($songs) }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Total albums</th>
                        <td>{{ count($albums) }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Total singers</th>
                        <td>{{ count($singers) }}</td>
                    </tr>
                    <tr>
                        <th scope="row">Total musicians</th>
                        <td>{{ count($musicians) }}</td>
                    </tr>
                </tbody>
        </div>

        
    </body>
</html>


    
