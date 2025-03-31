<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Empresa;

class AddPredefinedTiposPolizas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'polizas:add-predefined';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Agrega tipos de pólizas predefinidas a todas las empresas existentes';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $empresas = Empresa::all();
        
        if ($empresas->isEmpty()) {
            $this->info('No hay empresas registradas.');
            return Command::SUCCESS;
        }
        
        $count = 0;
        
        foreach ($empresas as $empresa) {
            $empresa->cargarTiposPolizasPredeterminados();
            $count++;
        }
        
        $this->info("Se han agregado tipos de pólizas predefinidas a {$count} empresas.");
        
        return Command::SUCCESS;
    }
}
