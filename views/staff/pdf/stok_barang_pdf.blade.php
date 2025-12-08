<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Stok Barang</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            line-height: 1.4;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 3px solid #e74c3c;
        }

        .header h1 {
            font-size: 20px;
            color: #e74c3c;
            margin-bottom: 5px;
        }

        .header h2 {
            font-size: 16px;
            color: #555;
            font-weight: normal;
            margin-bottom: 10px;
        }

        .info-box {
            background: #f8f9fa;
            padding: 10px 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            border-left: 4px solid #e74c3c;
        }

        .info-row {
            margin-bottom: 5px;
        }

        .info-label {
            font-weight: bold;
            display: inline-block;
            width: 150px;
        }

        .statistics {
            display: table;
            width: 100%;
            margin-bottom: 20px;
        }

        .stat-item {
            display: table-cell;
            width: 25%;
            text-align: center;
            padding: 10px;
            background: #f8f9fa;
            border-right: 1px solid #ddd;
        }

        .stat-item:last-child {
            border-right: none;
        }

        .stat-number {
            font-size: 20px;
            font-weight: bold;
            color: #e74c3c;
        }

        .stat-label {
            font-size: 9px;
            color: #666;
            margin-top: 3px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        thead {
            background: #e74c3c;
            color: white;
        }

        th {
            padding: 10px 8px;
            text-align: left;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }

        td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tbody tr:hover {
            background-color: #f0f0f0;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 9px;
            font-weight: bold;
        }

        .badge-danger {
            background: #dc3545;
            color: white;
        }

        .badge-warning {
            background: #ffc107;
            color: #333;
        }

        .badge-success {
            background: #28a745;
            color: white;
        }

        .badge-info {
            background: #17a2b8;
            color: white;
        }

        .badge-secondary {
            background: #6c757d;
            color: white;
        }

        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 2px solid #ddd;
            text-align: center;
            font-size: 9px;
            color: #666;
        }

        .no-data {
            text-align: center;
            padding: 30px;
            color: #999;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>SIBIMA+</h1>
        <h2>LAPORAN STOK BARANG</h2>
        <div style="font-size: 10px; color: #666;">
            Dicetak pada: {{ $tanggal }}
        </div>
    </div>

    <div class="info-box">
        @if($search)
        <div class="info-row">
            <span class="info-label">Filter Pencarian:</span>
            <span>"{{ $search }}"</span>
        </div>
        @endif
        <div class="info-row">
            <span class="info-label">Total Item Barang:</span>
            <span>{{ $totalBarang }} item</span>
        </div>
        <div class="info-row">
            <span class="info-label">Total Stok:</span>
            <span>{{ number_format($totalStok, 0, ',', '.') }} unit</span>
        </div>
    </div>

    <div class="statistics">
        <div class="stat-item">
            <div class="stat-number">{{ $totalBarang }}</div>
            <div class="stat-label">Total Barang</div>
        </div>
        <div class="stat-item">
            <div class="stat-number" style="color: #dc3545;">{{ $stokRendah }}</div>
            <div class="stat-label">Stok Rendah (≤10)</div>
        </div>
        <div class="stat-item">
            <div class="stat-number" style="color: #ffc107;">{{ $stokSedang }}</div>
            <div class="stat-label">Stok Sedang (11-50)</div>
        </div>
        <div class="stat-item">
            <div class="stat-number" style="color: #28a745;">{{ $stokAman }}</div>
            <div class="stat-label">Stok Aman (>50)</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="30%">Nama Barang</th>
                <th width="18%">Kategori</th>
                <th width="12%" class="text-center">Stok</th>
                <th width="20%" class="text-right">Harga</th>
                <th width="15%" class="text-center">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($barang as $index => $item)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>
                    <strong>{{ $item->nama_b }}</strong>
                    @if($item->desc_b)
                    <br>
                    <span style="font-size: 9px; color: #666;">
                        {{ Str::limit($item->desc_b, 40) }}
                    </span>
                    @endif
                </td>
                <td>
                    @if($item->nama_kategori)
                    <span class="badge badge-info">{{ $item->nama_kategori }}</span>
                    @else
                    <span class="badge badge-secondary">-</span>
                    @endif
                </td>
                <td class="text-center">
                    @if($item->stok_b <= 10)
                    <span class="badge badge-danger">{{ $item->stok_b }}</span>
                    @elseif($item->stok_b <= 50)
                    <span class="badge badge-warning">{{ $item->stok_b }}</span>
                    @else
                    <span class="badge badge-success">{{ $item->stok_b }}</span>
                    @endif
                </td>
                <td class="text-right">
                    <strong>Rp {{ number_format($item->price, 0, ',', '.') }}</strong>
                </td>
                <td class="text-center">
                    @if($item->status == 'active')
                    <span class="badge badge-success">Aktif</span>
                    @else
                    <span class="badge badge-secondary">Tidak Aktif</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="no-data">
                    Tidak ada data barang yang tersedia
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Dokumen ini digenerate otomatis oleh sistem SIBIMA+</p>
        <p>© {{ date('Y') }} SIBIMA+ - Sistem Informasi Barang Manajemen</p>
    </div>
</body>
</html>
