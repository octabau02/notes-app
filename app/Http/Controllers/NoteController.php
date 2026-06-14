<?php

namespace App\Http\Controllers;

use App\Coordidators\NoteCoordinator;
use App\Services\NoteService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Throwable;

class NoteController extends Controller
{
    /**
     * Muestra todas las notas del usuario
     */
    public function gestor()
    {
        try {
            $notas = NoteService::listar(['user_id' => Auth::id()]);
            $metricas = NoteService::obtenerMetricas();
            return view('gestor', ['notas' => $notas, 'metricas' => $metricas]);
        } catch (Throwable $error) {
            Log::error('Ocurrio un error al mostrar el gestor' . $error);
            return redirect()->back()->withErrors(['Ocurrio un error al mostrar el gestor']);
        }
    }

    /**
     * Guarda una nueva nota
     */
    public function agregar(Request $request)
    {
        try {
            $notaData = $request->validate([
                'title' => 'string|required|max:255',
                'content' => 'string|required|max:255',
                'important' => 'nullable',
                'reminder_date' => 'date|nullable'
            ]);

            NoteCoordinator::crear($notaData);
            return redirect()->route('notas.gestor')->with('success', 'Nota creada satisfactoriamente.');

        } catch (Throwable $error) {
            Log::error('Ocurrio un error al registrar la nota' . $error);
            return redirect()->back()->withErrors(['Ocurrio un error al registrar la nota'])->withInput();
        }
    }

    public function exportar(string $id)
    {
        try {
            $exportedNote = NoteCoordinator::exportar($id);
            return response($exportedNote);
        } catch (\Throwable $error) {
            Log::error('Ocurrio un error al exportar la nota' . $error);
            return redirect()->back()->withErrors(['Ocurrio un error al exportar la nota']);
        }
    }

    /**
     * Actualiza una nota
     */
    public function editar(Request $request)
    {
        try {
            $notaData = $request->validate([
                'id' => 'integer|required|exists:notes,id',
                'title' => 'string|required|max:255',
                'content' => 'string|required|max:255',
                'important' => 'nullable',
                'reminder_date' => 'date|nullable'
            ]);

            NoteService::actualizar($notaData);

            return redirect()->route('notas.gestor')->with('success', 'Nota actualizada satisfactoriamente.');

        } catch (\Throwable $error) {
            Log::error('Ocurrio un error al actualizar la nota' . $error);
            return redirect()->back()->withErrors(['Ocurrio un error al actualizar la nota'])->withInput();
        }
    }

    /**
     * Elimina una nota
     */
    public function eliminar(string $id)
    {
        try {
            NoteService::eliminar($id);

            return redirect()->route('notas.gestor')->with('success', 'Nota eliminada satisfactoriamente.');
        } catch (Throwable $error) {
            Log::error('Ocurrio un error al eliminar la nota' . $error);
            return redirect()->back()->withErrors(['Ocurrio un error al eliminar la nota']);
        }
        return redirect()->back()->withErrors(['Ocurrio un error']);
    }
}
