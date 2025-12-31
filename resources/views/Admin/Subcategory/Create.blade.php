@extends('Admin/Master')

@section('section')

<!-- Start of Create Subcategory Section -->
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="card">
                    <form action="{{ route('store.subcat') }}" method="post">
                        @csrf
                        <div class="card-header">
                            <h5 class="card-title mb-0">Create Subcategories</h5>
                        </div>
                        <div class="card-body">
                            <h5 class="mb-2">Enter Subcategory Name</h5>
                            <input type="text" class="form-control" placeholder="Ex: Laptop" name="subcatnam" value="{{ old('subcatnam') }}">
                            <div class="error">
                                @error('subcatnam')
                                    <span style="color:red; font-size:13px">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="mb-2">Select Category</h5>
                            <select class="form-select mb-3" name="catnam">
                                @foreach($data['cat'] as $tem)
                                    <option value="{{ $tem->_id }}">{{ $tem->category_name }}</option>
                                @endforeach
                            </select>
                            <div class="error">
                                @error('catnam')
                                    <span style="color:red; font-size:13px">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="card-body">
                            <button class="btn btn-primary" type="submit">Add Sub Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- End of Create Subcategory Section -->

@endsection