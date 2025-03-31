<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Libro Diario</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }
        .header h1 {
            margin: 0;
            font-size: 18px;
        }
        .info {
            margin-bottom: 20px;
        }
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
        }
        .poliza-header {
            background-color: #f2f2f2;
            padding: 5px;
            margin-top: 15px;
            border: 1px solid #ddd;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 4px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            font-size: 9px;
        }
        .text-right {
            text-align: right;
        }
        .font-bold {
            font-weight: bold;
        }
        .subtotal {
            background-color: #f9f9f9;
            font-weight: bold;
        }
        .totals {
            background-color: #e6f0ff;
            font-weight: bold;
            padding: 8px;
            margin-top: 20px;
            border: 1px solid #ddd;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 9px;
            color: #666;
        }
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LIBRO DIARIO</h1>
        <h2>{{ $empresa->nombre }}</h2>
        <p>RFC: {{ $empresa->rfc }}</p>
    </div>
    
    <div class="info">
        <div class="info-row">
            <div>
                <strong>Periodo:</strong> {{ $fecha_inicio }} - {{ $fecha_fin }}
            </div>
            <div>
                <strong>Fecha de generación:</strong> {{ $fecha_generacion }}
            </div>
        </div>
    </div>
    
    @php
        $totalCargos = 0;
        $totalAbonos = 0;
        $count = 0;
    @endphp
    
    @foreach ($contenedores as $contenedor)
        @php
            $totalCargos += $contenedor->total_cargos;
            $totalAbonos += $contenedor->total_abonos;
            $count++;
        @endphp
        
        <div class="poliza-header">
            <div style="display: flex; justify-content: space-between;">
                <div>
                    <strong>{{ $contenedor->tipoPoliza->tipo }} - {{ $contenedor->descripcion }}</strong><br>
                    Fecha: {{ \Carbon\Carbon::parse($contenedor->fecha)->format('d/m/Y') }}
                </div>
                <div>
                    #{{ $contenedor->id }}
                </div>
            </div>
        </div>
        
        <table>
            <thead>
                <tr>
                    <th>Cuenta</th>
                    <th>Descripción</th>
                    <th class="text-right">Cargo</th>
                    <th class="text-right">Abono</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contenedor->lineasPolizas as $linea)
                    <tr>
                        <td>{{ $linea->cuenta->numero }} - {{ $linea->cuenta->nombre }}</td>
                        <td>{{ $linea->descripcion }}</td>
                        <td class="text-right">
                            @if($linea->cargo > 0)
                                ${{ number_format($linea->cargo, 2) }}
                            @endif
                        </td>
                        <td class="text-right">
                            @if($linea->abono > 0)
                                ${{ number_format($linea->abono, 2) }}
                            @endif
                        </td>
                    </tr>
                @endforeach
                
                <tr class="subtotal">
                    <td colspan="2" class="text-right">Subtotales:</td>
                    <td class="text-right">${{ number_format($contenedor->total_cargos, 2) }}</td>
                    <td class="text-right">${{ number_format($contenedor->total_abonos, 2) }}</td>
                </tr>
            </tbody>
        </table>
        
        @if($count % 3 == 0 && $count < count($contenedores))
            <div class="page-break"></div>
        @endif
    @endforeach
    
    <div class="totals">
        <div style="display: flex; justify-content: space-between;">
            <div>
                <strong>TOTALES GENERALES</strong>
            </div>
            <div>
                <strong>Cargos:</strong> ${{ number_format($totalCargos, 2) }}
                &nbsp;&nbsp;&nbsp;
                <strong>Abonos:</strong> ${{ number_format($totalAbonos, 2) }}
            </div>
        </div>
    </div>
    
    <div class="footer">
        <p>Este documento es informativo y no tiene validez fiscal.</p>
    </div>
</body>
</html>
