@extends('Admin/Master')

@section('section')

<!-- Start of Create Slider Section -->
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="card">
                    <form action="{{ route('store.sli') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-header">
                            <h5 class="card-title mb-0">Create Sliders</h5>
                        </div>
                        <div class="card-body">
                            <h5 class="mb-2">Select Category Image</h5>
                            <input type="file" class="form-control" name="sliimg">
                            <div class="error">
                                @error('sliimg')
                                    <span style="color:red; font-size:13px">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="card-body">
                            <button class="btn btn-primary" type="submit">Add Slider</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- End of Create Slider Section -->

@endsection