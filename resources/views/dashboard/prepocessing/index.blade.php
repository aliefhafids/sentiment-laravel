@extends('dashboard.layouts.main')

@section('content')
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Tables /</span> Preprocessed Data</h4>

        <!-- Preprocessed Data Table -->
        <div class="card">
            <h5 class="card-header">Preprocessed Data</h5>
            <div class="table-responsive">
                <table id="preprocessed-table" class="table">
                    <thead class="table-light">
                        <tr>
                            <th>Review</th>
                            <th>Text</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($preprocessedData["preprocessed_data"]["preprocessed_data"] as $data)
                        <tr>
                            <td>{{ $data["Review"] }}</td>
                            <td>{{ $data["Text"] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Preprocessed Data Table -->
    </div>
</div>
@endsection
