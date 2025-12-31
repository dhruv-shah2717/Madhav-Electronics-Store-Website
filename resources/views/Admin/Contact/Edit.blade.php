@extends('Admin/Master')

@section('section')

<!-- Start of Edit Contact Section -->
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="card">
                    <form action="{{ route('update.con', $data['con']->_id) }}" method="post">
                        @csrf
                        <div class="card-header">
                            <h5 class="card-title mb-0">Edit Contacts</h5>
                        </div>
                        <div class="card-body">
                            <h5 class="mb-2">Enter Contact Message</h5>
                            <textarea class="form-control" name="conmess">{{ old('conmess') }}</textarea>
                            <div class="error">
                                @error('conmess')
                                    <span style="color:red; font-size:13px">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="card-body">
                            <button class="btn btn-primary" type="submit">Edit Contact</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- End of Edit Contact Section -->

@endsection