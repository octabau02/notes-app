@extends('layouts.auth')

@section('title', 'Panel principal')

@section('content')
    <div class="card">
        <h3><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" class="icon"><!--!Font Awesome Free v7.0.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M320 312C386.3 312 440 258.3 440 192C440 125.7 386.3 72 320 72C253.7 72 200 125.7 200 192C200 258.3 253.7 312 320 312zM290.3 368C191.8 368 112 447.8 112 546.3C112 562.7 125.3 576 141.7 576L498.3 576C514.7 576 528 562.7 528 546.3C528 447.8 448.2 368 349.7 368L290.3 368z"/></svg>
            Panel de usuario</h1>
        <p>Bienvenido al espacio personal de tus notas</p>
        <section class="panel">
            <div class="items-panel">
                <p class="number">{{$totalNotes}}</p>
                <p>Notas totales</p>
            </div>
            <div class="items-panel">
                <p class="number">{{$todayNotes}}</p>
                <p>Notas de hoy</p>
            </div>
            <div class="items-panel">
                <p class="number">{{$editedNotes}}</p>
                <p>Notas editadas</p>
            </div>
        </section>
    </div>

    <div class="justify-beetween">
        <h4>Mis notas</h3>
        <button id="open-modal-btn-create" class="create-button button-icon">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" class="icon"><!--!Font Awesome Free v7.0.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path fill="#ffffff" d="M352 128C352 110.3 337.7 96 320 96C302.3 96 288 110.3 288 128L288 288L128 288C110.3 288 96 302.3 96 320C96 337.7 110.3 352 128 352L288 352L288 512C288 529.7 302.3 544 320 544C337.7 544 352 529.7 352 512L352 352L512 352C529.7 352 544 337.7 544 320C544 302.3 529.7 288 512 288L352 288L352 128z"/></svg>            <span>Crear nota</span>
        </button>
    </div>
    <div class="notes">
        @foreach($notes as $note)
            <div @class(['card', 'important' => $note->type == 'important'])>
                <div class="card-header">
                    <h3>{{$note->title}}</h3>
                    <div class="actions">
                    <button type="button" class="action-button" title="Editar nota" onclick="edit({{$note->id}})"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" class="icon"><!--!Font Awesome Free v7.0.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M505 122.9L517.1 135C526.5 144.4 526.5 159.6 517.1 168.9L488 198.1L441.9 152L471 122.9C480.4 113.5 495.6 113.5 504.9 122.9zM273.8 320.2L408 185.9L454.1 232L319.8 366.2C316.9 369.1 313.3 371.2 309.4 372.3L250.9 389L267.6 330.5C268.7 326.6 270.8 323 273.7 320.1zM437.1 89L239.8 286.2C231.1 294.9 224.8 305.6 221.5 317.3L192.9 417.3C190.5 425.7 192.8 434.7 199 440.9C205.2 447.1 214.2 449.4 222.6 447L322.6 418.4C334.4 415 345.1 408.7 353.7 400.1L551 202.9C579.1 174.8 579.1 129.2 551 101.1L538.9 89C510.8 60.9 465.2 60.9 437.1 89zM152 128C103.4 128 64 167.4 64 216L64 488C64 536.6 103.4 576 152 576L424 576C472.6 576 512 536.6 512 488L512 376C512 362.7 501.3 352 488 352C474.7 352 464 362.7 464 376L464 488C464 510.1 446.1 528 424 528L152 528C129.9 528 112 510.1 112 488L112 216C112 193.9 129.9 176 152 176L264 176C277.3 176 288 165.3 288 152C288 138.7 277.3 128 264 128L152 128z"/></svg></button>
                        <form action="{{route('notes.destroy', $note->id)}}" method="POST" style="display: inline;" onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta nota?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-button" title="Eliminar nota"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" class="icon"><!--!Font Awesome Free v7.0.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path fill="#e01b24" d="M232.7 69.9L224 96L128 96C110.3 96 96 110.3 96 128C96 145.7 110.3 160 128 160L512 160C529.7 160 544 145.7 544 128C544 110.3 529.7 96 512 96L416 96L407.3 69.9C402.9 56.8 390.7 48 376.9 48L263.1 48C249.3 48 237.1 56.8 232.7 69.9zM512 208L128 208L149.1 531.1C150.7 556.4 171.7 576 197 576L443 576C468.3 576 489.3 556.4 490.9 531.1L512 208z"/></svg></button>
                        </form>
                        <a href="{{route('notes.export', $note->id)}}" class="action-button" style="padding: 0 4px;" title="Exportar nota" target="__blank"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" class="icon"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M128.5 64C93.2 64 64.5 92.7 64.5 128L64.5 512C64.5 547.3 93.2 576 128.5 576L384.5 576C419.8 576 448.5 547.3 448.5 512L448.5 416L526.6 416L495.6 447C486.2 456.4 486.2 471.6 495.6 480.9C505 490.2 520.2 490.3 529.5 480.9L601.5 408.9C610.9 399.5 610.9 384.3 601.5 375L529.5 303C520.1 293.6 504.9 293.6 495.6 303C486.3 312.4 486.2 327.6 495.6 336.9L526.6 367.9L448.5 367.9L448.5 234.4C448.5 217.4 441.8 201.1 429.8 189.1L323.2 82.7C311.2 70.7 295 64 278 64L128.5 64zM390 240L296.5 240C283.2 240 272.5 229.3 272.5 216L272.5 122.5L390 240zM256.5 392C256.5 378.7 267.2 368 280.5 368L384.5 368L384.5 416L280.5 416C267.2 416 256.5 405.3 256.5 392z"/></svg></a>
                    </div>
                </div>
                <p>{{$note->content}}</p>
                @if($note->reminder_date)
                    <p class="time">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" class="icon"><!--!Font Awesome Free v7.1.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M320 64C461.4 64 576 178.6 576 320C576 461.4 461.4 576 320 576C178.6 576 64 461.4 64 320C64 178.6 178.6 64 320 64zM296 184L296 320C296 328 300 335.5 306.7 340L402.7 404C413.7 411.4 428.6 408.4 436 397.3C443.4 386.2 440.4 371.4 429.3 364L344 307.2L344 184C344 170.7 333.3 160 320 160C306.7 160 296 170.7 296 184z"/></svg>
                         {{$note->reminder_date->translatedFormat('j \d\e F \d\e Y')}}
                    </p>
                @endif
                @if($note->updated_at)
                    <p class="time">Editado: {{$note->updated_at->translatedFormat('j \d\e F \d\e Y, H:i')}}</p>
                @endif
                    <p class="time">Creado: {{$note->created_at->translatedFormat('j \d\e F \d\e Y, H:i')}}</p>
                <p class="time">Guardado en: {{$note->saved_in}}</p>
            </div>
        @endforeach
    </div>

        <dialog id="createModal" class="modal">
            <h2>Nueva nota</h2>
            <p>Crea una nota personal</p>
            <form method="POST" action="/notes/store">
                @csrf
                <div class="form-input">
                    <label for="title">Título</label>
                    <input type="text" id="title" name="title" required placeholder="Título de tu nota">
                </div>
                <div class="form-input">
                    <label for="content">Contenido</label>
                    <textarea id="content" name="content" rows="7" required placeholder="Escribe el contenido de tu nota aquí..."></textarea>
                </div>
                <div class="form-input checkbox">
                    <input type="checkbox" id="important" name="important" value="true">
                    <label for="important">Prioridad alta</label>
                </div>
                <div class="form-input date">
                    <label for="reminder_date">Fecha de recordatorio</label>
                    <input type="date" id="reminder_date" name="reminder_date">
                </div>
                <div class="modal-footer">
                    <button id="close-modal-btn-create" type="button" class="secondary-button">Cancelar</button>
                    <button type="submit" class="create-button">Crear nota</button>
                </div>
            </form>
        </dialog>

        <dialog id="editModal" class="modal">
            <h2>Editar nota</h2>
            <p>Modifica tu nota existente</p>
            <form method="POST" action="{{route('notes.update')}}">
                @csrf
                @method('PUT')
                <input type="id" id="edit-id" name="id" hidden>
                <div class="form-input">
                    <label for="title">Título</label>
                    <input type="text" id="edit-title" name="title" required>
                </div>
                <div class="form-input">
                    <label for="content">Contenido</label>
                    <textarea id="edit-content" name="content" rows="7" required></textarea>
                </div>
                <div class="form-input checkbox">
                    <input type="checkbox" id="edit-important" name="important" value="true">
                    <label for="edit-important">Prioridad alta</label>
                </div>
                <div class="form-input date">
                    <label for="edit-reminder_date">Fecha de recordatorio</label>
                    <input type="date" id="edit-reminder_date" name="reminder_date">
                </div>
                <div class="modal-footer">
                    <button id="close-modal-btn-edit" type="button" class="secondary-button">Cancelar</button>
                    <button type="submit" class="create-button">Actualizar</button>
                </div>
            </form>
        </dialog>

        <script>
                const openBtn = document.getElementById('open-modal-btn-create');
                const closeBtn = document.getElementById('close-modal-btn-create');
                const modalCreate = document.getElementById('createModal');

                const openBtnEdit = document.getElementById('open-modal-btn-edit');
                const closeBtnEdit = document.getElementById('close-modal-btn-edit');
                const modalEdit = document.getElementById('editModal');


                var editNote;

                openBtn.addEventListener('click', () => {
                    modalCreate.showModal();
                });

                closeBtn.addEventListener('click', () => {
                    modalCreate.close();
                });

                function openEdit(){
                    modalEdit.showModal();
                };

                closeBtnEdit.addEventListener('click', () => {
                    modalEdit.close();
                });

                const importantCheckbox = document.getElementById('important');
                const reminderDateInput = document.getElementById('reminder_date');

                const editImportantCheckbox = document.getElementById('edit-important');
                const editReminderDateInput = document.getElementById('edit-reminder_date');
                function edit(id){
                    openEdit();
                    notes = @json($notes);
                    editNote = notes.find(note => note.id == id);

                    document.getElementById('edit-id').value = editNote.id;
                    document.getElementById('edit-title').value = editNote.title;
                    document.getElementById('edit-content').value = editNote.content;
                    document.getElementById('edit-important').checked = editNote.type == 'important';

                    if (editImportantCheckbox.checked) {
                        editReminderDateInput.disabled = true;
                        editReminderDateInput.value = '';
                    } else {
                        editReminderDateInput.disabled = false;
                    }

                    if (editNote.reminder_date) {
                        const date = new Date(editNote.reminder_date);
                        const formattedDate = date.toISOString().split('T')[0];
                        document.getElementById('edit-reminder_date').value = formattedDate;
                    } else {
                        document.getElementById('edit-reminder_date').value = '';
                    }
                }


                importantCheckbox.addEventListener('change', () => {
                    if (importantCheckbox.checked) {
                        reminderDateInput.disabled = true;
                        reminderDateInput.value = '';
                    } else {
                        reminderDateInput.disabled = false;
                    }
                });

                editImportantCheckbox.addEventListener('change', () => {
                    if (editImportantCheckbox.checked) {
                        editReminderDateInput.disabled = true;
                        editReminderDateInput.value = '';
                    } else {
                        editReminderDateInput.disabled = false;
                    }
                });
        </script>
@endsection
