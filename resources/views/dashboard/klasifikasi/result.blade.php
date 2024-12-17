@extends('dashboard.layouts.main')

@section('content')
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Classsification</h4>

        <!-- Form Simpan Klasifikasi -->
        <div class="card">
            <h5 class="card-header">Simpan Hasil Klasifikasi</h5>
            <div class="card-body">
                <form action="{{ route('save.classification') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="product" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" id="product" name="product" required>
                    </div>
                    <input type="hidden" name="positif_count" value="{{ $positifCount }}">
                    <input type="hidden" name="netral_count" value="{{ $netralCount }}">
                    <input type="hidden" name="negatif_count" value="{{ $negatifCount }}">
                    <button type="submit" class="btn btn-primary">Simpan Klasifikasi</button>
                </form>
            </div>
        </div>
        <!-- Form Simpan Klasifikasi -->

        <!-- Preprocessed Data Table -->
        <div class="card mt-3">
            <h5 class="card-header">Preprocessed Data</h5>
            <div class="table-responsive">
                <table id="preprocessed-table" class="table">
                    <thead class="table-light">
                        <tr>
                            <th>Id</th>
                            <th>Review</th>
                            <th>Rating</th>
                            <th>Klasifikasi Manual</th>
                            <th>Klasifikasi Sistem</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($results as $result)
                        <tr>
                            <td>{{ $result->id }}</td>
                            <td><span class="fw-medium">{{ $result->review }}</span></td>
                            <td>
                                @for ($i = 1; $i <= $result->rating_id; $i++)
                                    <img src="{{ asset('img/star-filled.png') }}" width="10" height="10" alt="Star">
                                @endfor
                            </td>
                            <td><span class="badge bg-label-primary me-1">{{ $result->classification->name }}</span>
                            </td>
                            <td><span class="badge bg-label-success me-1">{{ $result->sysclassification->name }}</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Pagination Links -->
            <div class="d-flex justify-content-center">
                {{ $results->links('dashboard.layouts.pagination') }}
            </div>
        </div>
        <!-- Preprocessed Data Table -->

        <!-- Jumlah Klasifikasi -->
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card">
                    <h5 class="card-header">
                        Jumlah Klasifikasi
                    </h5>
                    <div class="card-body">
                        <ul>
                            <li>Sentimen Positif: {{ $positifCount }}</li>
                            <li>Sentimen Netral: {{ $netralCount }}</li>
                            <li>Sentimen Negatif: {{ $negatifCount }}</li>
                        </ul>
                         <canvas id="classStatisticsPieChart" width="400" height="100"></canvas>
                    </div>
                </div>
            </div>

            <!-- Confusion Matrix, Precision, dan Recall -->
            <div class="col-md-6">
                <div class="card">
                    <h5 class="card-header">
                        Pengujian
                    </h5>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Metric</th>
                                    <th>Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>True Positives (TP)</td>
                                    <td>{{ $confusionMatrix['TP'] }}</td>
                                </tr>
                                <tr>
                                    <td>True Negatives (TN)</td>
                                    <td>{{ $confusionMatrix['TN'] }}</td>
                                </tr>
                                <tr>
                                    <td>False Positives (FP)</td>
                                    <td>{{ $confusionMatrix['FP'] }}</td>
                                </tr>
                                <tr>
                                    <td>False Negatives (FN)</td>
                                    <td>{{ $confusionMatrix['FN'] }}</td>
                                </tr>
                                <tr>
                                    <td>Precision</td>
                                    <td>{{ $precision }}</td>
                                </tr>
                                <tr>
                                    <td>Recall</td>
                                    <td>{{ $recall }}</td>
                                </tr>
                                <tr>
                                    <td>Akurasi</td>
                                    <td>{{ $accuracy }}%</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="card">
                            <div class="card-body d-flex justify-content-end">
                                <form action="{{ route('hilang.data') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">
                                        <i class="tf-icons bx bx-trash"></i> Hapus Data Klasifikasi
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Jumlah Klasifikasi -->
        </div>
    </div>
    @endsection

    @push('scripts')
   <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Mengambil nilai-nilai dari PHP dan menetapkannya ke variabel JavaScript
        var positifCount = <?php echo $positifCount; ?>;
        var netralCount = <?php echo $netralCount; ?>;
        var negatifCount = <?php echo $negatifCount; ?>;

        var ctx = document.getElementById('classStatisticsPieChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Positif', 'Netral', 'Negatif'],
                datasets: [{
                    label: 'Jumlah Klasifikasi',
                    data: [positifCount, netralCount, negatifCount],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 206, 86, 0.5)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endpush
