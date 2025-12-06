@extends('staff.layouts')

@section('page-title', 'Beranda')

@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Cards Statistik -->
    <div class="row g-3 mb-4">
        <!-- Total Jenis Barang -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100" style="background-color: #E57373;">
                <div class="card-body text-white">
                    <h6 class="card-title mb-3 fw-semibold">Total Jenis Barang</h6>
                    <h2 class="mb-0 fw-bold">{{ $totalJenisBarang }} Jenis</h2>
                </div>
            </div>
        </div>

        <!-- Total Stok Barang -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100" style="background-color: #E57373;">
                <div class="card-body text-white">
                    <h6 class="card-title mb-3 fw-semibold">Total Stok Barang</h6>
                    <h2 class="mb-0 fw-bold">{{ $totalStokBarang }} Barang</h2>
                </div>
            </div>
        </div>

        <!-- Total Transaksi Minggu Ini -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm h-100" style="background-color: #E57373;">
                <div class="card-body text-white">
                    <h6 class="card-title mb-3 fw-semibold">Total Transaksi</h6>
                    <h2 class="mb-0 fw-bold">{{ $totalTransaksiMingguIni }} Transaksi</h2>
                    <small class="opacity-75">Minggu ini</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <h5 class="card-title mb-4 fw-semibold">Pemasukan dan Pengeluaran Stok per Bulan</h5>
                    <canvas id="chartStok" height="80"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('chartStok').getContext('2d');
    
    const dataGrafik = @json($dataGrafik);
    
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: dataGrafik.labels,
            datasets: [
                {
                    label: 'Pemasukan',
                    data: dataGrafik.pemasukan,
                    backgroundColor: '#4DB6AC',
                    borderColor: '#4DB6AC',
                    borderWidth: 1
                },
                {
                    label: 'Pengeluaran',
                    data: dataGrafik.pengeluaran,
                    backgroundColor: '#E57373',
                    borderColor: '#E57373',
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 50
                    }
                }
            },
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': ' + context.parsed.y + ' barang';
                        }
                    }
                }
            }
        }
    });
});
</script>
@endsection