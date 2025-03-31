<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class SetupReportSystem extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reports:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Configura el sistema de reportes actualizando los menús y componentes necesarios';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Iniciando configuración del sistema de reportes...');
        
        // Verificar si el paquete DomPDF está instalado
        if (!class_exists('Barryvdh\DomPDF\ServiceProvider')) {
            $this->warn('El paquete DomPDF no está instalado. Se intentará instalar...');
            
            // Intentar instalar el paquete DomPDF
            $this->info('Ejecutando: composer require barryvdh/laravel-dompdf');
            exec('composer require barryvdh/laravel-dompdf');
            
            $this->info('Paquete instalado. Recuerda agregar el service provider y facade al archivo config/app.php');
        } else {
            $this->info('El paquete DomPDF ya está instalado.');
        }
        
        // Actualizar los menús
        $this->info('Ejecutando: php artisan db:seed --class=MenuSeeder');
        Artisan::call('db:seed', ['--class' => 'MenuSeeder']);
        
        $this->info('Sistema de reportes configurado correctamente.');
        
        return Command::SUCCESS;
    }
}
