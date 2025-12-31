@extends('Admin/Master')

@section('section')

<!-- Start of Edit Discount Section -->
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="card">
                    <form action="{{ route('update.dis', $data['dis']->_id) }}" method="post">
                        @csrf
                        <div class="card-header">
                            <h5 class="card-title mb-0">Edit Discounts</h5>
                        </div>
                        <div class="card-body">
                            <h5 class="mb-2">Enter Discount Name</h5>
                            <input type="text" class="form-control" placeholder="Ex: Offer2006" name="disnam" value="{{ old('disnam', $data['dis']->discount_name) }}">
                            <div class="error">
                                @error('disnam')
                                    <span style="color:red; font-size:13px">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="mb-2">Enter Discount Price</h5>
                            <input type="text" class="form-control" placeholder="Ex: 300" name="dispri" value="{{ old('dispri', $data['dis']->discount_price) }}">
                            <div class="error">
                                @error('dispri')
                                    <span style="color:red; font-size:13px">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="mb-2">Enter Discount Expiry Date</h5>
                            <input type="date" class="form-control" name="disdat" value="{{ \Carbon\Carbon::parse($data['dis']->discount_expire)->format('Y-m-d') }}">
                            <div class="error">
                                @error('disdat')
                                    <span style="color:red; font-size:13px">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="card-body">
                            <button class="btn btn-primary" type="submit">Edit Discount</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- End of Edit Discount Section -->

@endsection