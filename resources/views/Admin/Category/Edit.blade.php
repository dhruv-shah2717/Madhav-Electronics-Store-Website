@extends('Admin/Master')

@section('section')

<!-- Start of Edit Category Section -->
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="card">
                    <form action="{{ route('update.cat', $data['cat']->_id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-header">
                            <h5 class="card-title mb-0">Edit Categories</h5>
                        </div>
                        <div class="card-body">
                            <h5 class="mb-2">Enter Category Name</h5>
                            <input type="text" class="form-control" placeholder="Ex: Electronics" name="catnam" value="{{ $data['cat']->category_name }}">
                            <div class="error">
                                @error('catnam')
                                    <span style="color:red; font-size:13px">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="mb-2">Select Category Image</h5>
                            <input type="file" class="form-control" name="catimg">
                            <div class="error">
                                @error('catimg')
                                    <span style="color:red; font-size:13px">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="card-body">
                            <button class="btn btn-primary" type="submit">Edit Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- End of Edit Category Section -->

@endsection