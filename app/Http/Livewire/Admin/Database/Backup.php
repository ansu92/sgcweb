<?php

namespace App\Http\Livewire\Admin\Database;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use ZipArchive;

class Backup extends Component
{
    public $zippedBackup = '0';
    public $holo;

    public $openRestaurar = false;

    protected $rules = [
        'backup' => 'required|not_in:0',
    ];

    protected $messages = [
        'backup.required' => 'Debe seleccionar un archivo.',
        'backup.not_in' => 'Debe seleccionar un archivo.',
    ];

    public function render()
    {
        $files = [];

        foreach (Storage::allFiles('backups') as $item) {
            $files[] = Str::substr($item, 16);
        }

        return view('livewire.admin.database.backup', compact('files'));
    }

    public function updatedBackup($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function respaldar()
    {
        Artisan::call('backup:run --only-db');

        $this->emit('alert', 'Se ha creado el respaldo de la base de datos satisfactoriamente');
    }

    public function restaurar()
    {
        $zip = new ZipArchive;
        $zip->open(storage_path('app/backups/SGC-Web/' . $this->zippedBackup));
        $zip->extractTo(storage_path('app/backups/SGC-Web'));
        $zip->close();

        Artisan::call('db:restore --path=C:/laragon/www/sgcweb/storage/app/backups/SGC-Web/db-dumps/postgresql-sgcweb.backup');

        Storage::deleteDirectory('backups/SGC-Web/db-dumps');

        $this->reset('open');
        $this->emit('alert', 'Se ha restaurado la base de datos satisfactoriamente');
    }
}
