Action: file_editor create /app/laporan_penjualan_improved.blade.php --file-text "
<!DOCTYPE html>
<html lang=\"id\">

<head>
    <meta charset=\"UTF-8\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <title>Laporan Penjualan - SIBIMA+</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            font-size: 11px;
            line-height: 1.6;
            color: #2C3E50;
            padding: 30px;
            background: #FFFFFF;
        }

        /* Header Section */
        .header {
            text-align: center;
            margin-bottom: 40px;
            padding-bottom: 20px;
            border-bottom: 2px solid #2C3E50;
        }

        .header h1 {
            color: #2C3E50;
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 8px;
            letter-spacing: 0.5px;
        }

        .header h2 {
            color: #34495E;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .header p {
            color: #7F8C8D;
            font-size: 10px;
        }

        /* Info Section */
        .info-section {
            margin-bottom: 30px;
            padding: 20px;
            background: #F8F9FA;
            border: 1px solid #E8E8E8;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 6px 0;
            border-bottom: 1px solid #E8E8E8;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            font-weight: 600;
            color: #2C3E50;
        }

        .info-value {
            color: #34495E;
        }

        /* Summary Section */
        .summary-section {
            margin-bottom: 30px;
            padding: 25px;
            background: #2C3E50;
            color: #FFFFFF;
            text-align: center;
            border: 1px solid #2C3E50;
        }

        .summary-section h3 {
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 10px;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .summary-section .amount {
            font-size: 26px;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        /* Statistics Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: #FFFFFF;
            padding: 20px;
            border: 1px solid #E8E8E8;
            text-align: center;
        }

        .stat-card .stat-value {
            font-size: 24px;
            font-weight: 700;
            color: #2C3E50;
            margin-bottom: 8px;
        }

        .stat-card .stat-label {
            font-size: 10px;
            color: #7F8C8D;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
        }

        .stat-card.pending {
            border-left: 3px solid #F39C12;
        }

        .stat-card.proses {
            border-left: 3px solid #3498DB;
        }

        .stat-card.selesai {
            border-left: 3px solid #27AE60;
        }

        .stat-card.batal {
            border-left: 3px solid #E74C3C;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            border: 1px solid #E8E8E8;
        }

        thead {
            background: #2C3E50;
            color: #FFFFFF;
        }

        thead th {
            padding: 12px 10px;
            text-align: left;
            font-weight: 600;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        tbody td {
            padding: 12px 10px;
            border-bottom: 1px solid #E8E8E8;
            font-size: 11px;
        }

        tbody tr:nth-child(even) {
            background: #F8F9FA;
        }

        tbody tr:hover {
            background: #ECF0F1;
        }

        tfoot {
            background: #F8F9FA;
            font-weight: 700;
        }

        tfoot td {
            padding: 15px 10px;
            border-top: 2px solid #2C3E50;
            font-size: 11px;
        }

        /* Status Badges */
        .status-badge {
            padding: 4px 12px;
            border-radius: 3px;
            font-size: 9px;
            font-weight: 600;
            display: inline-block;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .status-pending {
            background: #FEF5E7;
            color: #D68910;
            border: 1px solid #F9E79F;
        }

        .status-proses {
            background: #EBF5FB;
            color: #2874A6;
            border: 1px solid #AED6F1;
        }

        .status-selesai {
            background: #E8F8F5;
            color: #1E8449;
            border: 1px solid #A9DFBF;
        }

        .status-batal {
            background: #FADBD8;
            color: #C0392B;
            border: 1px solid #F5B7B1;
        }

        /* Breakdown Section */
        .breakdown-section {
            margin-top: 30px;
            padding: 20px;
            background: #F8F9FA;
            border: 1px solid #E8E8E8;
        }

        .breakdown-section h3 {
            font-size: 12px;
            margin-bottom: 15px;
            color: #2C3E50;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .breakdown-table {
            width: 100%;
            margin-bottom: 0;
            border: none;
        }

        .breakdown-table td {
            padding: 8px 0;
            border: none;
            font-size: 11px;
        }

        .breakdown-table strong {
            color: #2C3E50;
            font-weight: 700;
        }

        /* Footer */
        .footer {
            margin-top: 50px;
            padding-top: 20px;
            border-top: 2px solid #2C3E50;
            text-align: center;
            color: #7F8C8D;
            font-size: 9px;
            line-height: 1.8;
        }

        /* Utility Classes */
        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .page-break {
            page-break-after: always;
        }

        /* Print Optimization */
        @media print {
            body {
                padding: 20px;
            }

            .stat-card,
            .info-section,
            .breakdown-section {
                page-break-inside: avoid;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <div class=\"header\">
        <h1>SIBIMA+ UMKM BENGKALIS</h1>
        <h2>LAPORAN PENJUALAN</h2>
        <p>Sistem Informasi Bisnis dan Manajemen</p>
    </div>

    <!-- Info Section -->
    <div class=\"info-section\">
        <div class=\"info-row\">
            <span class=\"info-label\">Tanggal Cetak:</span>
            <span class=\"info-value\">{{ date('d F Y, H:i') }} WIB</span>
        </div>
        <div class=\"info-row\">
            <span class=\"info-label\">Total Transaksi:</span>
            <span class=\"info-value\">{{ count($laporan) }} transaksi</span>
        </div>
        <div class=\"info-row\">
            <span class=\"info-label\">Status:</span>
            <span class=\"info-value\">Semua Status</span>
        </div>
    </div>

    <!-- Summary Section -->
    <div class=\"summary-section\">
        <h3>Total Pendapatan (Selesai)</h3>
        <div class=\"amount\">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</div>
    </div>

    <!-- Statistics Grid -->
    <div class=\"stats-grid\">
        <div class=\"stat-card pending\">
            <div class=\"stat-value\">{{ $laporan->where('status', 'pending')->count() }}</div>
            <div class=\"stat-label\">Pending</div>
        </div>
        <div class=\"stat-card proses\">
            <div class=\"stat-value\">{{ $laporan->where('status', 'proses')->count() }}</div>
            <div class=\"stat-label\">Proses</div>
        </div>
        <div class=\"stat-card selesai\">
            <div class=\"stat-value\">{{ $laporan->where('status', 'selesai')->count() }}</div>
            <div class=\"stat-label\">Selesai</div>
        </div>
        <div class=\"stat-card batal\">
            <div class=\"stat-value\">{{ $laporan->where('status', 'batal')->count() }}</div>
            <div class=\"stat-label\">Batal</div>
        </div>
    </div>

    <!-- Transaction Table -->
    <table>
        <thead>
            <tr>
                <th width=\"5%\">No</th>
                <th width=\"10%\">ID Order</th>
                <th width=\"15%\">Tanggal</th>
                <th width=\"25%\">Kostumer</th>
                <th width=\"20%\">Total</th>
                <th width=\"15%\">Status</th>
            </tr>
        </thead>
        <tbody>
            @php
            $totalPending = 0;
            $totalProses = 0;
            $totalSelesai = 0;
            $totalBatal = 0;
            @endphp
            @forelse($laporan as $index => $item)
            @php
            if($item->status == 'pending') $totalPending += $item->totalprice;
            if($item->status == 'proses') $totalProses += $item->totalprice;
            if($item->status == 'selesai') $totalSelesai += $item->totalprice;
            if($item->status == 'batal') $totalBatal += $item->totalprice;
            @endphp
            <tr>
                <td class=\"text-center\">{{ $index + 1 }}</td>
                <td>#{{ $item->id_order }}</td>
                <td>{{ date('d/m/Y H:i', strtotime($item->created_at)) }}</td>
                <td>{{ $item->username }}</td>
                <td>Rp {{ number_format($item->totalprice, 0, ',', '.') }}</td>
                <td>
                    @if($item->status == 'pending')
                    <span class=\"status-badge status-pending\">Pending</span>
                    @elseif($item->status == 'proses')
                    <span class=\"status-badge status-proses\">Proses</span>
                    @elseif($item->status == 'selesai')
                    <span class=\"status-badge status-selesai\">Selesai</span>
                    @else
                    <span class=\"status-badge status-batal\">Batal</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan=\"6\" class=\"text-center\">Tidak ada data</td>
            </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td colspan=\"4\" class=\"text-right\">TOTAL PENDAPATAN (SELESAI):</td>
                <td colspan=\"2\">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

    <!-- Breakdown by Status -->
    @if(count($laporan) > 0)
    <div class=\"breakdown-section\">
        <h3>Breakdown Berdasarkan Status</h3>
        <table class=\"breakdown-table\">
            <tr>
                <td width=\"50%\">
                    <strong>Pending:</strong> Rp {{ number_format($totalPending, 0, ',', '.') }}
                </td>
                <td width=\"50%\">
                    <strong>Proses:</strong> Rp {{ number_format($totalProses, 0, ',', '.') }}
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Selesai:</strong> Rp {{ number_format($totalSelesai, 0, ',', '.') }}
                </td>
                <td>
                    <strong>Batal:</strong> Rp {{ number_format($totalBatal, 0, ',', '.') }}
                </td>
            </tr>
        </table>
    </div>
    @endif

    <!-- Footer -->
    <div class=\"footer\">
        <p>Dokumen ini digenerate otomatis oleh SIBIMA+ UMKM Bengkalis</p>
        <p>Jl. Sultan Syarif Kasim, Bengkalis, Riau - Indonesia</p>
        <p>&copy; {{ date('Y') }} SIBIMA+. All rights reserved.</p>
    </div>
</body>

</html>