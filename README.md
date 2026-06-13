# Notes App

Gestor de notas personales construido con Laravel 12. Permite crear, editar, eliminar y exportar notas con clasificación por tipo (normal, importante, recordatorio), sincronización simulada con servicios cloud y exportación JSON en múltiples niveles de detalle.

## Características

- **CRUD de notas** con interfaz modal
- **Clasificación por tipo** — Normal, Importante (destacada en rojo) y Recordatorio (con fecha)
- **Métricas del dashboard** — total de notas, notas del día y notas editadas
- **Cloud sync simulado** — adaptadores para Google Keep y Evernote configurables en runtime
- **Exportación JSON multinivel** — Simple, Intermedio y Avanzado
- **Configuración en tiempo de ejecución** mediante tabla `metadata`
- Autenticación por sesión (Laravel Sessions)

## Stack

- PHP 8.2
- Laravel 12
- Tailwind CSS 4 (via Vite)
- MySQL / MariaDB
- Docker (opcional)

## Arquitectura

El proyecto usa una arquitectura en capas con varios patrones de diseño:

```
Controller → Coordinator → Service → BO / Factory → RepoData / RepoAction → DB
                                                   ↕
                                           Adapters / Builders
```

- **Factory** — crea notas según su tipo (`NormalNote`, `ImportantNote`, `ReminderNote`) y adaptadores cloud
- **Adapter** — `KeepAdapter` y `EvernoteAdapter` que simulan sincronización externa
- **Builder** — `SimpleExport`, `IntermediateExport`, `AdvancedExport` para exportación JSON progresiva
- **Repository** — capa de datos dividida en `RepoData` (lecturas) y `RepoAction` (escrituras)

## Instalación

```bash
git clone https://github.com/octabau02/notes-app.git
cd notes-app

# Instalar dependencias
composer install
npm install && npm run build

# Configurar entorno
cp .env.example .env
php artisan key:generate

# Configurar base de datos en .env y migrar
php artisan migrate

# Iniciar servidor
composer run dev
```

## Rutas

| Método | Ruta | Descripción |
|--------|------|-------------|
| GET | `/` | Login |
| GET/POST | `/login` | Iniciar sesión |
| GET/POST | `/register` | Registro |
| POST | `/logout` | Cerrar sesión |
| GET | `/notas` | Dashboard |
| POST | `/notas` | Crear nota |
| PATCH | `/notas` | Editar nota |
| DELETE | `/notas/{id}` | Eliminar nota |
| GET | `/notas/exportar/{id}` | Exportar nota (JSON) |
