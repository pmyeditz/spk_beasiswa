<x-main>
    @section('main')
    <x-sidebar></x-sidebar>

    <div class="main">
        <div class="row g-4">
            <!-- Total Siswa -->
            <div class="col-md-6 col-lg-3">
                <div class="card-custom">
                    <div class="card-title">
                        <i class="fa-solid fa-users-line me-2"></i>Total Siswa
                    </div>
                    <h2 class="text-success">{{ \App\Models\Siswa::count() }}</h2>
                    <small><i class="fa-solid fa-arrow-up text-success"></i> 10% dari bulan lalu</small>
                </div>
            </div>

            <!-- Total Kriteria -->
            <div class="col-md-6 col-lg-3">
                <div class="card-custom">
                    <div class="card-title">
                        <i class="fa-solid fa-layer-group me-2"></i>Total Kriteria
                    </div>
                    <h2 class="text-primary">{{ \App\Models\Kriteria::count() }}</h2>
                    <small><i class="fa-solid fa-arrow-right text-muted"></i> Tetap</small>
                </div>
            </div>

            <!-- Siswa Terpilih -->
            <div class="col-md-6 col-lg-3">
                <div class="card-custom">
                    <div class="card-title">
                        <i class="fa-solid fa-award me-2"></i>Penerima Beasiswa
                    </div>
                    <h2 class="text-success">{{ \App\Models\Keputusan::where('status', 'diterima')->count() }}</h2>
                    <small><i class="fa-solid fa-arrow-up text-success"></i> 5% dari sebelumnya</small>
                </div>
            </div>

            <!-- Perhitungan SAW -->
            <div class="col-md-6 col-lg-3">
                <div class="card-custom">
                    <div class="card-title">
                        <i class="fa-solid fa-calculator me-2"></i>Perhitungan SAW
                    </div>
                    <h2 class="text-warning">Selesai</h2>
                    <small><i class="fa-solid fa-check-circle text-success"></i> Diperbarui</small>
                </div>
            </div>
        </div>

        <!-- Analytics Section -->
        <div class="mt-4">
            <div class="card-custom p-3">
                <form method="GET" class="d-flex justify-content-between align-items-center mb-3">
                    <div class="fs-5">
                        <i class="fa-solid fa-chart-simple me-2"></i>Analisis Seleksi Beasiswa
                    </div>
                    <select name="bulan" class="form-select w-auto" onchange="this.form.submit()">
                        @foreach(range(1, 12) as $i)
                            @php $monthVal = str_pad($i, 2, '0', STR_PAD_LEFT); @endphp
                            <option value="{{ $monthVal }}" {{ $bulan == $monthVal ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                            </option>
                        @endforeach
                    </select>
                </form>

                <!-- Chart -->
                <canvas id="statusChart" height="100"></canvas>

            </div>
        </div>
    </div>

    @push('scripts')
<script>
    const ctx = document.getElementById('statusChart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Diterima', 'Diproses', 'Ditolak'],
            datasets: [{
                label: 'Jumlah Siswa',
                data: [
                    {{ $statusCounts['diterima'] }},
                    {{ $statusCounts['diproses'] }},
                    {{ $statusCounts['ditolak'] }}
                ],
                backgroundColor: [
                    'rgba(25, 135, 84, 0.8)',
                    'rgba(108, 117, 125, 0.8)',
                    'rgba(220, 53, 69, 0.8)'
                ],
                borderColor: [
                    'rgba(25, 135, 84, 1)',
                    'rgba(108, 117, 125, 1)',
                    'rgba(220, 53, 69, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: (context) => `Jumlah: ${context.parsed.y}`
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });
</script>
@endpush

    @endsection
</x-main>
