@extends('Admin/Master')

@section('section')

<!-- Start of Create Product Section -->
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="card">
                    <form action="{{ route('store.pro') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-header">
                            <h5 class="card-title mb-0">Create Products</h5>
                        </div>
                        
                        <div class="row">
                            <div class="col-12 col-md-3">
                                <div class="card-body">
                                    <h5 class="mb-2">Enter Product Name</h5>
                                    <input type="text" class="form-control" placeholder="Ex: Lenovo Ideapad gaming 3" name="pronam" value="{{ old('pronam') }}">
                                    <div class="error">
                                        @error('pronam')
                                            <span style="color:red; font-size:13px">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="card-body">
                                    <h5 class="mb-2">Enter Product Brand</h5>
                                    <input type="text" class="form-control" placeholder="Ex: Lenovo" name="probra" value="{{ old('probra') }}">
                                    <div class="error">
                                        @error('probra')
                                            <span style="color:red; font-size:13px">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="card-body">
                                    <h5 class="mb-2">Enter Product Price</h5>
                                    <input type="text" class="form-control" placeholder="Ex: 50000" name="propri" value="{{ old('propri') }}">
                                    <div class="error">
                                        @error('propri')
                                            <span style="color:red; font-size:13px">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="card-body">
                                    <h5 class="mb-2">Enter Product Expiry Price</h5>
                                    <input type="text" class="form-control" placeholder="Ex: 60000" name="proxpri" value="{{ old('proxpri') }}">
                                    <div class="error">
                                        @error('proxpri')
                                            <span style="color:red; font-size:13px">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 col-md-3">
                                <div class="card-body">
                                    <h5 class="mb-2">Select Product Category</h5>
                                    <select class="form-select mb-3" name="catnam">
                                        @foreach($data['cat'] as $tem)
                                            <option value="{{ $tem->_id }}">{{ $tem->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="card-body">
                                    <h5 class="mb-2">Select Product Subcategory</h5>
                                    <select class="form-select mb-3" name="subcatnam">
                                        @foreach($data['subcat'] as $tem)
                                            <option value="{{ $tem->_id }}">{{ $tem->subcategory_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="card-body">
                                    <h5 class="mb-2">Select Product Quantity</h5>
                                    <select class="form-select mb-3" name="proqty">
                                        @foreach(range(1, 15) as $i)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="card-body">
                                    <h5 class="mb-2">Select Product Images</h5>
                                    <input class="form-control" type="file" id="formFileMultiple" multiple name="proimg[]">
                                    <div class="error">
                                        @error('proimg')
                                            <span style="color:red; font-size:13px">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="card-body">
                                    <h5 class="mb-2">Enter Product Description</h5>
                                    <textarea style="width: 100%; height: 140px;" class="form-control" name="prodis">{{ old('prodis') }}</textarea>
                                    <div class="error">
                                        @error('prodis')
                                            <span style="color:red; font-size:13px">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <button class="btn btn-primary" type="submit">Add Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- End of Create Product Section -->

@endsection