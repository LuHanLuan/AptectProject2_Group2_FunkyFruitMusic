<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Facade;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use PDF;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class FrontEndController extends Controller
{

    public function paginateArray($data, $perPage = 10)
    {
        $page = Paginator::resolveCurrentPage();
        $total = count($data);
        $results = array_slice($data, ($page - 1) * $perPage, $perPage);

        return new LengthAwarePaginator($results, $total, $perPage, $page, [
            'path' => Paginator::resolveCurrentPath(),
        ]);
    }


    public function newrelease()
    {
        return view('frontend.newrelease');
    }

    public function songWithId(Request $request)
    {
        $songId = $request->id;
        return view('frontend.songWithId', ['songId' => $songId]);
    }

    public function allCategory()
    {
        return view('frontend.category.allcategory');
    }

    public function Category(Request $request)
    {
        $categoryId = $request->categoryId;
        $songs = $this->paginateArray(
            DB::select('select s.id as id, s.name as name, s.file as file from categories c, songs s where c.id = s.category_id and c.id = ?', [$categoryId])
        );
        return view('frontend.category.category', ['categoryId' => $categoryId, 'songs' => $songs]);
    }

    public function allNation()
    {
        return view('frontend.nation.allnation');
    }

    public function Nation(Request $request)
    {
        $nationId = $request->nationId;
        $songs = $this->paginateArray(
            DB::select('select s.id as id, s.name as name, s.file as file from nations n, songs s where n.id = s.nation_id and n.id = ?', [$nationId])
        );
        return view('frontend.nation.nation', ['nationId' => $nationId, 'songs' => $songs]);
    }
    public function allSinger()
    {
        $singers = $this->paginateArray(
            DB::select('select * from singers'),
            16
        );
        return view('frontend.singer.allsinger', ['singers' => $singers]);
    }

    public function Singer(Request $request)
    {
        $singerId = $request->singerId;
        return view('frontend.singer.singer', ['singerId' => $singerId]);
    }
    public function allMusician()
    {
        $musicians = $this->paginateArray(
            DB::select('select * from musicians'),
            16
        );
        return view('frontend.musician.allmusician', ['musicians' => $musicians]);
    }

    public function Musician(Request $request)
    {
        $musicianId = $request->musicianId;
        return view('frontend.musician.musician', ['musicianId' => $musicianId]);
    }

    public function Artist()
    {
        return view('frontend.artist.artist');
    }

    public function searchAll(Request $request)
    {
        $input = $_GET['search'];
        if ($input == null) {
            return back();
        }
        return redirect()->action('FrontEndController@searchAllProcess', ['input' => $input]);
        //return view('frontend.search.searchall', ['input' => $input]);
    }

    public function searchAllProcess(Request $request)
    {
        $input = $request->input;
        $songs = DB::select("select * from songs where name like '%$input%' limit 5");
        $musicians = DB::select("select * from musicians where name like '%$input%' limit 4");
        $ss = DB::select("select * from singers where name like '%$input%' limit 4");
        $albums = DB::select("select * from albums where name like '%$input%' limit 4");
        return view('frontend.search.searchall', ['input' => $input, 'songs' => $songs, 'ss' => $ss, 'musicians' => $musicians, 'albums' => $albums]);
    }

    public function searchSong(Request $request)
    {
        $input = $request->input;
        $songs = $this->paginateArray(
            DB::select("select * from songs where name like '%$input%' "),
            10
        );
        return view('frontend.search.searchsong', ['input' => $input, 'songs' => $songs]);
    }

    public function searchAlbum(Request $request)
    {
        $input = $request->input;
        $albums = $this->paginateArray(
            DB::select("select * from albums where name like '%$input%' "),
            16
        );
        return view('frontend.search.searchalbum', ['input' => $input, 'albums' => $albums]);
    }

    public function searchSinger(Request $request)
    {
        $input = $request->input;
        $singers = $this->paginateArray(
            DB::select("select * from singers where name like '%$input%' "),
            16
        );
        return view('frontend.search.searchsinger', ['input' => $input, 'singers' => $singers]);
    }

    public function searchMusician(Request $request)
    {
        $input = $request->input;
        $musicians = $this->paginateArray(
            DB::select("select * from musicians where name like '%$input%' "),
            16
        );
        return view('frontend.search.searchmusician', ['input' => $input, 'musicians' => $musicians]);
    }

    public function dashboardReport()
    {
        $pdf = PDF::loadView('report.dashboardReport');
        return $pdf->download('report.pdf');
    }

    public function likedSongs(Request $request)
    {
        $songId = $request->songId;
        $likedsongs = DB::select('select * from likedsongs where song_id = ? and user_id = ?', [$songId, Auth::id()]);


        if (Auth::check()) {

            if (count($likedsongs)) {
                DB::delete('delete from likedsongs where song_id = ? and user_id = ?', [$songId, Auth::id()]);

                echo "warning";
                $notification = array(
                    'message' => 'Remove from liked songs!',
                    'alert-type' => 'warning'
                );
            } else {
                DB::insert('insert into likedsongs (song_id, user_id) values (?, ?)', [$songId, Auth::id()]);

                echo "success";

                $notification = array(
                    'message' => 'Added to liked songs!',
                    'alert-type' => 'success'
                );
            }
        } else {
            echo "error";
            $notification = array(
                'message' => 'You need to login first',
                'alert-type' => 'error'
            );
        }
        return back()->with($notification);
    }

    public function allAlbum()
    {
        $albums = $this->paginateArray(
            DB::select('select * from albums'),
            16
        );
        return view('frontend.album.allalbum', ['albums' => $albums]);
    }

    public function Album(Request $request)
    {
        $albumId = $request->albumId;
        return view('frontend.album.album', ['albumId' => $albumId]);
    }

    public function recent()
    {
        if (Auth::check()) {
            return view('frontend.personal.recent');
        }
        return redirect('/');
    }

    public function lsongs()
    {
        if (Auth::check()) {
            $songs = $this->paginateArray(
                DB::select('SELECT s.id as id, s.name as name, s.file as file from songs s, likedsongs lk WHERE lk.user_id = ? and lk.song_id = s.id', [Auth::id()]),
                10
            );
            return view('frontend.personal.lsongs', ['songs' => $songs]);
        }
        return redirect('/');
    }

    public function aboutus()
    {
        return view('frontend.aboutus');
    }

    public function songReport()
    {
        $pdf = PDF::loadView('report.songReport');
        return $pdf->download('songReport.pdf');
    }

    public function removelsongs(Request $request)
    {
        $songId = $request->songId;

        DB::delete('delete from likedsongs where song_id = ? and user_id = ?', [$songId, Auth::id()]);

        echo "warning";
        $notification = array(
            'message' => 'Remove from liked songs!',
            'alert-type' => 'warning'
        );

        return back()->with($notification);
    }

    public function comment(Request $request)
    {
        $comment = $request->comment;
        $songId = $request->songId;

        if (Auth::check()) {
            if ($comment == null) {
                echo "error";
                $notification = array(
                    'message' => 'Please write your comment',
                    'alert-type' => 'error'
                );
                return back()->with($notification);
            }

            DB::insert('insert into comments (song_id, user_id, comment) values (?, ?, ?)', [$songId, Auth::id(), $comment]);

            echo "success";

            $notification = array(
                'message' => 'Comment successfully!',
                'alert-type' => 'success'
            );
        } else {
            echo "error";
            $notification = array(
                'message' => 'You need to login first',
                'alert-type' => 'error'
            );
        }
        return back()->with($notification);
    }
}
