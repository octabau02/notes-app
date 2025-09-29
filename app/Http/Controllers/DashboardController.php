<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if(empty($user)){
            return redirect('login');
        }
        $notes = DB::table('notes')->where('user_id', '=', $user->id)->get();
        $notes = $notes->map(function ($note) {

            if(!empty($note->created_at)){
                $note->created_at = Carbon::parse($note->created_at);
            }
            if(!empty($note->updated_at)){
                $note->updated_at = Carbon::parse($note->updated_at);
            }
            return $note;
        });
        $totalNotes = DB::table('notes')->where('user_id', '=', $user->id)->count();
        $todayNotes = DB::table('notes')->where('user_id', '=', $user->id)
                                        ->whereNotNull('created_at')->count();

        $editedNotes = DB::table('notes')->where('user_id', '=', $user->id)
        ->where('updated_at', '!=', null)->count();


        return view('dashboard', compact('user','totalNotes', 'todayNotes', 'editedNotes', 'notes'));
    }
}
