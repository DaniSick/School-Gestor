<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Balanza General</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
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
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 5px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .text-right {
            text-align: right;
        }
        .font-bold {
            font-weight: bold;
        }
        .totals {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>BALANZA GENERAL</h1>
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
    
    <table>
        <thead>
            <tr>
                <th>Número</th>
                <th>Cuenta</th>
                <th>Cargo</th>
                <th>Abono</th>
                <th>Saldo</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalCargo = 0;
                $totalAbono = 0;
            @endphp
            
            @foreach ($cuentas as $cuenta)
                @php
                    $totalCargo += $cuenta['total_cargo_periodo'];
                    $totalAbono += $cuenta['total_abono_periodo'];
                @endphp
                <tr>
                    <td>{{ $cuenta['numero'] }}</td>
                    <td>{{ $cuenta['nombre'] }}</td>
                    <td class="text-right">${{ number_format($cuenta['total_cargo_periodo'], 2) }}</td>
                    <td class="text-right">${{ number_format($cuenta['total_abono_periodo'], 2) }}</td>
                    <td class="text-right">${{ number_format($cuenta['saldo_actual'], 2) }}</td>
                </tr>
            @endforeach
            
            <!-- Totales -->
            <tr class="totals">
                <td colspan="2" class="text-right">TOTALES:</td>
                <td class="text-right">${{ number_format($totalCargo, 2) }}</td>
                <td class="text-right">${{ number_format($totalAbono, 2) }}</td>
                <td class="text-right">${{ number_format($totalCargo - $totalAbono, 2) }}</td>
            </tr>
        </tbody>
    </table>
    
    <div class="footer">
        <p>Este documento es informativo y no tiene validez fiscal.</p>
    </div>
</body>
</html>
