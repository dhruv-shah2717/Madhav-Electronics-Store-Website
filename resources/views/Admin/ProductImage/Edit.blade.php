@extends('Admin/Master')

@section('section')

<!-- Start of Edit Product Image Section -->
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="card">
                    <form action="{{ route('update.proimg', $data['id']) }}" method="post" enctype="multipart/form-data"> 
                        @csrf
                        <div class="card-header">
                            <h5 class="card-title mb-0">Edit Product Image</h5>
                        </div>
                        <div class="card-body">
                            <h5 class="mb-2">Select Product Image</h5>
                            <input type="file" class="form-control" name="proimg">
                            <div class="error">
                                @error('proimg')
                                    <span style="color:red; font-size:13px">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="card-body">
                            <button class="btn btn-primary" type="submit">Edit Product Image</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- End of Edit Product Image Section -->

@endsection