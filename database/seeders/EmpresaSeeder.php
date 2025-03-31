<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Empresa;

class EmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $empresas = [
            [
                'nombre' => 'Empresa Ejemplo S.A. de C.V.',
                'razon_social' => 'Empresa Ejemplo Sociedad Anónima de Capital Variable',
                'rfc' => 'EJE123456789',
                'direccion' => 'Calle Falsa 123, Colonia Centro, Ciudad de México, CDMX',
                'telefono' => '5551234567',
                'email' => 'contacto@empresa-ejemplo.com',
                'representante_legal' => 'Juan Pérez',
                'fecha_creacion' => '2020-01-01',
                'estatus' => true,
            ],
            [
                'nombre' => 'Tech Solutions S.A.',
                'razon_social' => 'Tech Solutions Sociedad Anónima',
                'rfc' => 'TEC987654321',
                'direccion' => 'Av. Tecnológica 456, Parque Industrial, Monterrey, NL',
                'telefono' => '8187654321',
                'email' => 'info@techsolutions.com',
                'representante_legal' => 'María López',
                'fecha_creacion' => '2018-05-15',
                'estatus' => true,
            ],
        ];

        foreach ($empresas as $empresaData) {
            $empresa = Empresa::create($empresaData);
            $empresa->cargarCuentasPredeterminadas();
        }
    }
}
