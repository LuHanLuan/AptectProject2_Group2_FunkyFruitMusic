<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class DeleteController extends Controller
{
    public function delete(Request $request, $id)
    {
        try {
            return parent::destroy($request, $id);
        } catch (QueryException $exception) {
            $message = $exception->getMessage();
            if (strpos($message, 'foreign key constraint') !== false) {
                $message = "This row can't be deleted";
            }

            return back()->with(['message' => $message]);
        }
    }
}
