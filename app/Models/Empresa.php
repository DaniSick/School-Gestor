<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'razon_social',
        'rfc',
        'direccion',
        'telefono',
        'email',
        'representante_legal',
        'fecha_creacion',
        'estatus',
    ];

    // Relación con el modelo Cuenta
    public function cuentas()
    {
        return $this->hasMany(Cuenta::class, 'empresa_id');
    }

    // Relación con el modelo TipoPoliza
    public function tiposPolizas()
    {
        return $this->hasMany(TipoPoliza::class, 'empresa_id');
    }

    // Método para cargar tipos de pólizas predeterminados
    public function cargarTiposPolizasPredeterminados()
    {
        $tiposPolizasBase = [
            ['tipo' => 'Eg', 'descripcion' => 'Egreso'],
            ['tipo' => 'Ig', 'descripcion' => 'Ingreso'],
            ['tipo' => 'Dr', 'descripcion' => 'Diario'],
        ];

        foreach ($tiposPolizasBase as $tipoPoliza) {
            $this->tiposPolizas()->updateOrCreate(
                [
                    'tipo' => $tipoPoliza['tipo'],
                ],
                [
                    'descripcion' => $tipoPoliza['descripcion'],
                ]
            );
        }
    }

    // Método para cargar cuentas predeterminadas
    public function cargarCuentasPredeterminadas()
    {
        $cuentas = [
            ['numero' => '1100', 'nombre' => 'Efectivo y Equivalentes', 'tipo' => 'acumulativa', 'children' => [
                ['numero' => '1101', 'nombre' => 'Caja', 'tipo' => 'detalle'],
                ['numero' => '1102', 'nombre' => 'Bancos', 'tipo' => 'detalle'],
            ]],
            ['numero' => '1200', 'nombre' => 'Cuentas por Cobrar', 'tipo' => 'acumulativa', 'children' => [
                ['numero' => '1201', 'nombre' => 'Clientes', 'tipo' => 'detalle'],
                ['numero' => '1202', 'nombre' => 'Documentos por Cobrar', 'tipo' => 'detalle'],
            ]],
            ['numero' => '1300', 'nombre' => 'Inventarios', 'tipo' => 'acumulativa', 'children' => [
                ['numero' => '1301', 'nombre' => 'Materias Primas', 'tipo' => 'detalle'],
                ['numero' => '1302', 'nombre' => 'Productos Terminados', 'tipo' => 'detalle'],
            ]],
            // ...continúa con el resto de las cuentas
        ];

        foreach ($cuentas as $cuenta) {
            $this->crearCuenta(null, $cuenta);
        }
    }

    private function crearCuenta($parentId, $cuentaData)
    {
        $cuenta = $this->cuentas()->create([
            'parent_id' => $parentId,
            'numero' => $cuentaData['numero'],
            'nombre' => $cuentaData['nombre'],
            'tipo' => $cuentaData['tipo'],
        ]);

        if (isset($cuentaData['children'])) {
            foreach ($cuentaData['children'] as $child) {
                $this->crearCuenta($cuenta->id, $child);
            }
        }
    }

    protected static function booted()
    {
        // Después de crear una empresa, cargar tipos de pólizas predeterminados
        static::created(function ($empresa) {
            $empresa->cargarTiposPolizasPredeterminados();
        });
    }
}
