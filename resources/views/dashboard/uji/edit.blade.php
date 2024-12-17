@extends('dashboard.layouts.main')

@section('content')
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">Edit Data Uji</h4>

        <!-- Basic Layout -->
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                    </div>
                    <div class="card-body">
                        <form method="POST" action="/dashboard/uji/update/{{ $testing->id }}" class="mb-5"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label" for="review">Review</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-message2" class="input-group-text"><i
                                            class="bx bx-comment"></i></span>
                                    <textarea class="form-control @error('review') is-invalid @enderror" id="review"
                                        name="review" required>{{ old('review', $testing->review) }}</textarea>
                                    @error('review')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="classification" class="form-label">Sentiment</label>
                                <select class="form-select" id="exampleFormControlSelect1" name="classification_id"
                                    aria-label="Default select example">
                                    @foreach ($classifications as $classification)
                                    <option value="{{ $classification->id }}"
                                        {{ old('classification_id', $testing->classification_id) == $classification->id ? 'selected' : '' }}>
                                        {{ $classification->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="sysclassification" class="form-label">System Classification</label>
                                <select class="form-select" id="exampleFormControlSelect1" name="sysclassification_id"
                                    aria-label="Default select example">
                                    @foreach ($sysclassifications as $sysclassification)
                                    <option value="{{ $sysclassification->id }}"
                                        {{ old('sysclassification_id', $testing->sysclassification_id) == $sysclassification->id ? 'selected' : '' }}>
                                        {{ $sysclassification->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="/dashboard/uji" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content-backdrop fade"></div>
</div>
@endsection

