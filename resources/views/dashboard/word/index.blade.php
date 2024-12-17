@extends('dashboard.layouts.main')

@section('content')
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Word Cloud /</span> Generate</h4>

        <div class="card">
            <h5 class="card-header">Generate Word Cloud</h5>
            <div class="card-body">
                <p>Click the button below to generate the word cloud:</p>
                <form action="{{ route('generate.wordcloud') }}" method="GET">
                    @csrf
                    <button type="submit" class="btn btn-primary">Generate Word Cloud</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
