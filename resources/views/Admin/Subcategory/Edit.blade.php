@extends('Admin/Master')

@section('section')

<!-- Start of Edit Subcategory Section -->
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="card">
                    <form action="{{ route('update.subcat', $data['subcat']->_id) }}" method="post">
                        @csrf
                        <div class="card-header">
                            <h5 class="card-title mb-0">Edit Subcategories</h5>
                        </div>
                        <div class="card-body">
                            <h5 class="mb-2">Enter Subcategory Name</h5>
                            <input type="text" class="form-control" placeholder="Ex: Laptop" name="subcatnam" value="{{ $data['subcat']->subcategory_name }}">
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
                                    <option 
                                        @if($data['subcat']->category_id == $tem->_id) 
                                            selected 
                                        @endif 
                                        value="{{ $tem->_id }}">
                                        {{ $tem->category_name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="error">
                                @error('catnam')
                                    <span style="color:red; font-size:13px">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="card-body">
                            <button class="btn btn-primary" type="submit">Update Subcategory</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- End of Edit Subcategory Section -->

@endsection