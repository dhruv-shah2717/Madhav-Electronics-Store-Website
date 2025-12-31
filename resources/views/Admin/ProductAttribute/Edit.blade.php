@extends('Admin/Master')

@section('section')

<!-- Start of Edit Product Attribute Section -->
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="card">
                    <form action="{{ route('update.proatu', $data['proatu']->_id) }}" method="post">
                        @csrf
                        <div class="card-header">
                            <h5 class="card-title mb-0">Edit Product Attribute</h5>
                        </div>
                        <div class="card-body">
                            <h5 class="mb-2">Enter Attribute Name</h5>
                            <input type="text" class="form-control" placeholder="Ex: 8GB RAM" name="proatunam" value="{{ $data['proatu']->attribute_name }}">
                            <div class="error">
                                @error('proatunam')
                                    <span style="color:red; font-size:13px">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="mb-2">Enter Attribute Price</h5>
                            <input type="text" class="form-control" placeholder="Ex: 300" name="proatupri" value="{{ $data['proatu']->attribute_price }}">
                            <div class="error">
                                @error('proatupri')
                                    <span style="color:red; font-size:13px">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="mb-2">Select Product</h5>
                            <select name="proid" class="form-select">
                                @foreach($data['pro'] as $tem)
                                    <option 
                                        @if($data['proatu']->product_id == $tem->_id) 
                                            selected 
                                        @endif 
                                        value="{{ $tem->_id }}">
                                        {{ $tem->product_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="card-body">
                            <button class="btn btn-primary" type="submit">Edit Attribute</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- End of Edit Product Attribute Section -->

@endsection