<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Order #{{ $order->id_order }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
            line-height: 1.6;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 30px;
            border-radius: 10px;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 32px;
            margin-bottom: 10px;
        }

        .header p {
            font-size: 14px;
            opacity: 0.9;
        }

        .invoice-info {
            display: table;
            width: 100%;
            margin-bottom: 30px;
        }

        .invoice-info-left,
        .invoice-info-right {
            display: table-cell;
            width: 50%;
            vertical-align: top;
        }

        .invoice-info h3 {
            font-size: 16px;
            color: #10b981;
            margin-bottom: 10px;
            border-bottom: 2px solid #10b981;
            padding-bottom: 5px;
        }

        .info-row {
            margin-bottom: 8px;
        }

        .info-label {
            display: inline-block;
            width: 120px;
            font-weight: bold;
            color: #666;
        }

        .info-value {
            color: #333;
        }

        .status-badge {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 15px;
            font-weight: bold;
            font-size: 11px;
        }

        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .status-proses {
            background: #dbeafe;
            color: #1e40af;
        }

        .status-selesai {
            background: #d1fae5;
            color: #065f46;
        }

        .status-batal {
            background: #fee2e2;
            color: #991b1b;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        table thead {
            background: #10b981;
            color: white;
        }

        table thead th {
            padding: 12px;
            text-align: left;
            font-weight: bold;
        }

        table tbody td {
            padding: 10px 12px;
            border-bottom: 1px solid #e5e7eb;
        }

        table tbody tr:hover {
            background: #f9fafb;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .summary {
            background: #f9fafb;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
        }

        .summary-row {
            display: table;
            width: 100%;
            margin-bottom: 10px;
        }

        .summary-label {
            display: table-cell;
            width: 70%;
            font-weight: bold;
            color: #666;
        }

        .summary-value {
            display: table-cell;
            width: 30%;
            text-align: right;
            font-weight: bold;
            color: #333;
        }

        .total-row {
            border-top: 2px solid #10b981;
            padding-top: 10px;
            margin-top: 10px;
        }

        .total-row .summary-label,
        .total-row .summary-value {
            font-size: 16px;
            color: #10b981;
        }

        .footer {
            text-align: center;
            color: #666;
            font-size: 11px;
            border-top: 2px solid #e5e7eb;
            padding-top: 20px;
            margin-top: 30px;
        }

        .footer p {
            margin-bottom: 5px;
        }

        .notes {
            background: #fef3c7;
            border-left: 4px solid #f59e0b;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .notes h4 {
            color: #92400e;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .notes p {
            color: #78350f;
            margin: 0;
        }

        .badge-kategori {
            background: #10b981;
            color: white;
            padding: 3px 10px;
            border-radius: 10px;
            font-size: 10px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>⚡ SIBIMA+</h1>
            <p>Sistem Informasi Bisnis - Platform Pembelian UMKM Bengkalis</p>
        </div>

        <!-- Invoice Info -->
        <div class="invoice-info">
            <div class="invoice-info-left">
                <h3>INVOICE</h3>
                <div class="info-row">
                    <span class="info-label">Nomor Order:</span>
                    <span class="info-value">#{{ $order->id_order }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Tanggal:</span>
                    <span class="info-value">{{ \Carbon\Carbon::parse($order->created_at)->format('d M Y, H:i') }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Status:</span>
                    <span class="status-badge status-{{ $order->status }}">
                        {{ strtoupper($order->status) }}
                    </span>
                </div>
            </div>

            <div class="invoice-info-right" style="text-align: right;">
                <h3>INFORMASI PELANGGAN</h3>
                <div class="info-row">
                    <span class="info-value"><strong>{{ $order->username }}</strong></span>
                </div>
                <div class="info-row">
                    <span class="info-value">{{ $order->email }}</span>
                </div>
                <div class="info-row">
                    <span class="info-value">{{ $order->phone }}</span>
                </div>
            </div>
        </div>

        <!-- Alamat Pengiriman -->
        <div style="margin-bottom: 30px; padding: 15px; background: #f9fafb; border-radius: 8px;">
            <h3 style="color: #10b981; margin-bottom: 10px; font-size: 14px;">📍 ALAMAT PENGIRIMAN</h3>
            <p style="margin: 0;">{{ $order->alamat_pengiriman }}</p>
        </div>

        <!-- Catatan -->
        @if($order->catatan)
        <div class="notes">
            <h4>📝 CATATAN PESANAN</h4>
            <p>{{ $order->catatan }}</p>
        </div>
        @endif

        <!-- Tabel Produk -->
        <h3 style="color: #10b981; margin-bottom: 15px; font-size: 16px;">DETAIL PRODUK</h3>
        <table>
            <thead>
                <tr>
                    <th style="width: 5%;">No</th>
                    <th style="width: 35%;">Nama Produk</th>
                    <th style="width: 20%;">Kategori</th>
                    <th style="width: 10%;" class="text-center">Qty</th>
                    <th style="width: 15%;" class="text-right">Harga</th>
                    <th style="width: 15%;" class="text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orderItems as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td><strong>{{ $item->nama_b }}</strong></td>
                    <td>
                        <span class="badge-kategori">{{ $item->nama_kategori }}</span>
                    </td>
                    <td class="text-center">{{ $item->kuantiti }}</td>
                    <td class="text-right">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                    <td class="text-right"><strong>Rp {{ number_format($item->total, 0, ',', '.') }}</strong></td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Ringkasan Pembayaran -->
        <div class="summary">
            <div class="summary-row">
                <div class="summary-label">Subtotal:</div>
                <div class="summary-value">Rp {{ number_format($order->totalprice, 0, ',', '.') }}</div>
            </div>
            <div class="summary-row">
                <div class="summary-label">Biaya Pengiriman:</div>
                <div class="summary-value" style="color: #10b981;">GRATIS</div>
            </div>
            <div class="summary-row total-row">
                <div class="summary-label">TOTAL PEMBAYARAN:</div>
                <div class="summary-value">Rp {{ number_format($order->totalprice, 0, ',', '.') }}</div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p><strong>Terima kasih telah berbelanja di SIBIMA+</strong></p>
            <p>Platform Pembelian UMKM Bengkalis</p>
            <p>Dokumen ini dicetak pada: {{ \Carbon\Carbon::now()->format('d M Y, H:i') }}</p>
            <p style="margin-top: 10px; font-size: 10px;">Invoice ini sah dan diproses secara elektronik</p>
        </div>
    </div>
</body>

</html>