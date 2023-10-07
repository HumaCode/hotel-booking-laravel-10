@extends('admin.admin_dashboard')

@push('styles')
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
@endpush

@section('admin')
    <div class="page-content">

        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Add Team</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add Team</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <hr />

        <div class="card">
            <div class="card-body p-4">

                <form class="row g-3">
                    <div class="col-md-4">
                        <label for="room_type" class="form-label">Room Type</label>
                        <select id="room_type" name="room_type" class="form-select">
                            <option selected disabled>Select Room Type</option>

                            @foreach ($roomType as $item)
                                <option value="{{ $item->room->id }}">{{ $item->name }}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="check_in" class="form-label">Check In</label>
                        <input type="date" class="form-control" id="check_in" name="check_in" placeholder="Check In">
                    </div>

                    <div class="col-md-4">
                        <label for="check_out" class="form-label">Check Out</label>
                        <input type="date" class="form-control" id="check_out" name="check_out" placeholder="Check Out">
                    </div>

                    <div class="col-md-6">
                        <label for="number_of_rooms" class="form-label">Room</label>
                        <input type="number" min="0" class="form-control" id="number_of_rooms"
                            name="number_of_rooms" placeholder="Room">

                        <input type="hidden" name="available_room">
                        <label for="" class="mt-2">Availability <span
                                class="text-success availability"></span></label>
                    </div>

                    <div class="col-md-6">
                        <label for="number_of_person" class="form-label">Guest</label>
                        <input type="number" class="form-control" id="number_of_person" name="number_of_person"
                            placeholder="Guest">
                    </div>

                    <hr>
                    <h3 class="mt-3 mb-5 text-center">Customer Information</h3>

                    <div class="col-md-4">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ old('name') }}">
                    </div>

                    <div class="col-md-4">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ old('email') }}">
                    </div>

                    <div class="col-md-4">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="number" min="0" class="form-control" id="phone" name="phone"
                            value="{{ old('phone') }}">
                    </div>

                    <div class="col-md-4">
                        <label for="country" class="form-label">Country</label>
                        <input type="text" class="form-control" id="country" name="name"
                            value="{{ old('country') }}">
                    </div>

                    <div class="col-md-4">
                        <label for="zip_code" class="form-label">Zip Code</label>
                        <input type="text" class="form-control" id="zip_code" name="zip_code"
                            value="{{ old('zip_code') }}">
                    </div>

                    <div class="col-md-4">
                        <label for="state" class="form-label">State</label>
                        <input type="text"class="form-control" id="state" name="state"
                            value="{{ old('state') }}">
                    </div>

                    <div class="col-md-12">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control" id="address" name="address" placeholder="Address ..." rows="3">{{ old('address') }}</textarea>
                    </div>

                    <div class="col-md-12">
                        <div class="d-grid gap-2">
                            <button type="button" class="btn btn-primary">SUBMIT</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(e.target.files['0'])
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    position: {
                        required: true,
                    },
                    image: {
                        required: true,
                    }

                },
                messages: {
                    name: {
                        required: 'Please Enter Team Name',
                    },
                    position: {
                        required: 'Please Enter Position',
                    },
                    image: {
                        required: 'Please Input Image',
                    },

                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
            });
        });
    </script>
@endpush
