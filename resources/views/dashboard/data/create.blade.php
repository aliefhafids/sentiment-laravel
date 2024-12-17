@extends('dashboard.layouts.main')

@section('content')
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">Input Data Latih</h4>

        <!-- Basic Layout -->
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                         <form method="post" action="/dashboard/latih" class="mb-1" enctype="multipart/form-data">
                    </div>
                    <div class="card-body">
                        <form>
                            @csrf
                            <div class="mb-3">
                                <label class="form-label" for="review">Review</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-message2" class="input-group-text"><i
                                            class="bx bx-comment"></i></span>
                                    <textarea type="text" class="form-control @error('review') is-invalid @enderror"
                                        id="review" name="review" required value="{{ old('review') }}">
                                    @error('review')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    </textarea>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="classification" class="form-label">Sentiment</label>
                                <select class="form-select" id="exampleFormControlSelect1" name="classification_id"
                                    aria-label="Default select example">
                                    @foreach ($cls as $classification)
                                     @if(old('classification_id') == $classification->id)
                                        <option value="{{ $classification->id }}" selected>{{ $classification->name }}</option>
                                        @else
                                        <option value="{{ $classification->id }}">{{ $classification->name }}</option>
                                        @endif
                                     @endforeach
                                </select>
                            </div>
                             <div class="mb-3">
                                <span class="text-muted fw-light">*nb: cantumkan username, tanggal, dan kategori review</span>
                            </div>
                            <button type="submit" class="btn btn-primary">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content-backdrop fade"></div>
</div>
@endsection
