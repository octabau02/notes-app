<?php

namespace App\Services;

use App\Adapters\CloudNoteFactory;
use App\Factory\ExportBuilderFactory;
use App\Factory\NoteFactory;
use App\RepoAction\NotaRepoAction;
use App\RepoData\NotaRepoData;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class NoteService
{
    protected $cloudNoteFactory;

    public static function listar($filtros = [], $columnas = '', $orden = [], $limit = null, $offset = null){

        $notes = NotaRepoData::listar($filtros, $columnas, $orden, $limit, $offset);

        $notes = $notes->map(function ($note) {
            if(!empty($note->created_at)){
                $note->created_at = Carbon::parse($note->created_at);
            }
            if(!empty($note->updated_at)){
                $note->updated_at = Carbon::parse($note->updated_at);
            }
            if(!empty($note->reminder_date)){
                $note->reminder_date = Carbon::parse($note->reminder_date);
            }
            return $note;
        });

        return $notes;
    }

    public static function obtenerMetricas(){
        $user = Auth::user();
        $totalNotes = count(self::listar(['user_id' => $user->id], 'id'));
        $todayNotes = count(self::listar(['created_at'=> today()], 'id'));
        $editedNotes = count(self::listar(['user_id' => $user->id, 'was_updated' => 'true'], 'id'));

        return compact('totalNotes', 'todayNotes', 'editedNotes');
    }

    public static function crear($notaData, $configNube){
        $notaTipo = !empty($notaData['important']) ? 'important' : (!empty($notaData['reminder_date']) ? 'reminder' : 'normal');
        $tipoNota = NoteFactory::create($notaTipo);
        $servicioNube = CloudNoteFactory::create($configNube);

        $insertNote = $tipoNota->create($notaData);
        $note_id = NotaRepoAction::crear($insertNote);

        $servicioNube->sync($note_id);
    }

    public static function actualizar($notaData){
        $nota = NotaRepoData::obtener(['id' => $notaData['id']], 'id,type,saved_in');
        if(count($nota) != 1){
            throw new \Exception('Se espera una unica nota');
        }
        $notaTipo = !empty($notaData['important']) ? 'important' : (!empty($notaData['reminder_date']) ? 'reminder' : 'normal');
        $tipoNota = NoteFactory::create($notaTipo);
        $servicioNube = CloudNoteFactory::create($nota[0]->saved_in);

        $updateNote = $tipoNota->update($notaData);
        if(NotaRepoAction::actualizar($notaData['id'], $updateNote) == 1){
            $servicioNube->sync($notaData['id']);
        }
    }

    public static function eliminar($id){
        if(NotaRepoAction::eliminar($id) != 0){
            return redirect()->back()->with(['success', 'Nota eliminada correctamente']);
        }
        return redirect()->back()->withErrors(['Ocurrio un error']);
    }

    public static function exportar($id, $exportFormat){
        $nota = NotaRepoData::obtener($id, '');
        if(count($nota) != 1){
            throw new \Exception('Se espera una unica nota');
        }
        $exportBuilder = ExportBuilderFactory::create($exportFormat, $nota[0]);
        return $exportBuilder->build();
    }
}
