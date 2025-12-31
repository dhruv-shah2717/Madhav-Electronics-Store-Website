@extends('Admin/Master')

@section('section')

<!-- Start of Edit Product Section -->
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="card">
                    <form action="{{ route('update.pro', $data['pro']->_id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-header">
                            <h5 class="card-title mb-0">Edit Products</h5>
                        </div>
                        
                        <div class="row">
                            <div class="col-12 col-md-3">
                                <div class="card-body">
                                    <h5 class="mb-2">Enter Product Name</h5>
                                    <input type="text" class="form-control" placeholder="Ex: Lenovo Ideapad gaming 3" name="pronam" value="{{ $data['pro']->product_name }}">
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
                                    <input type="text" class="form-control" placeholder="Ex: Lenovo" name="probra" value="{{ $data['pro']->product_brand }}">
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
                                    <input type="text" class="form-control" placeholder="Ex: 50000" name="propri" value="{{ $data['pro']->product_price }}">
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
                                    <input type="text" class="form-control" placeholder="Ex: 60000" name="proxpri" value="{{ $data['pro']->product_xprice }}">
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
                                            <option value="{{ $tem->_id }}" 
                                                @if($data['pro']->category_id == $tem->_id) 
                                                    selected 
                                                @endif 
                                            >{{ $tem->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="card-body">
                                    <h5 class="mb-2">Select Product Subcategory</h5>
                                    <select class="form-select mb-3" name="subcatnam">
                                        @foreach($data['subcat'] as $tem)
                                            <option value="{{ $tem->_id }}"
                                                @if($data['pro']->subcategory_id == $tem->_id) 
                                                    selected 
                                                @endif
                                            >{{ $tem->subcategory_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="card-body">
                                    <h5 class="mb-2">Select Product Quantity</h5>
                                    <select class="form-select mb-3" name="proqty">
                                        @foreach(range(1, 15) as $i)
                                            <option value="{{ $i }}" 
                                                @if($data['pro']->product_qty == $i) 
                                                    selected 
                                                @endif
                                            >{{ $i }}</option>
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
                                    <textarea style="width: 100%; height: 140px;" class="form-control" name="prodis">{{ $data['pro']->product_description }}</textarea>
                                    <div class="error">
                                        @error('prodis')
                                            <span style="color:red; font-size:13px">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <button class="btn btn-primary" type="submit">Edit Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- End of Edit Product Section -->

@endsection