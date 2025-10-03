<?php

namespace App\Http\Controllers;

use App\Builders\ExportJsonBuilder;
use App\Facades\SyncNotes;
use App\Factory\ExportDirectorFactory;
use App\Services\ExportJsonDirector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Notes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $note)
    {
        $note->validate([
            'title' => 'string|required|max:255',
            'content' => 'string|required|max:255',
            'important' => 'nullable',
            'reminder_date' => 'date|nullable'
        ]);

        SyncNotes::send($note);

        return redirect('dashboard')->with('success', 'Nota creada satisfactoriamente.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {


    }

    public function export(string $id)
    {
        $note = DB::table('notes')->where('id', '=', $id)->first();
        $exportFormat = DB::table('metadata')->where('key', 'export_format')->value('value');

        $director = new ExportDirectorFactory();
        $exporter = $director->create($exportFormat ,$note);
        $exportedNote = $exporter->export();
        return response($exportedNote);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $note)
    {
        $note->validate([
            'id' => 'integer|required|exists:notes,id',
            'title' => 'string|required|max:255',
            'content' => 'string|required|max:255',
            'important' => 'nullable',
            'reminder_date' => 'date|nullable'
        ]);

        SyncNotes::send($note);

        return redirect('dashboard')->with('success', 'Nota actualizada satisfactoriamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $note = DB::table('notes')->where('id', '=', $id)->first();
        $user = Auth::user();

        if($note->user_id != $user->id){
            return redirect()->back()->withErrors(['No tienes permitido eliminar esta nota']);
        }
        if(empty($note)){
            return redirect()->back()->withErrors(['No se encontro la nota a eliminar']);
        }

        if(DB::table('notes')->where('id', $note->id)->delete() != 0){
            return redirect()->back()->with(['success', 'Nota eliminada correctamente']);
        }
        return redirect()->back()->withErrors(['Ocurrio un error']);
    }
}
