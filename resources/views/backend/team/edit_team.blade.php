@extends('admin.admin_dashboard')

@push('styles')
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
@endpush

@section('admin')
    <div class="page-content">

        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Edit Team</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Team</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <hr />

        <div class="card">
            <div class="card-body">

                <form action="{{ route('team.update') }}" method="POST" enctype="multipart/form-data" id="myForm">
                    @csrf

                    <input type="hidden" name="id" value="{{ $team->id }}">

                    <div class="row mb-3">
                        <div class="col-sm-2">
                            <h6 class="mb-0">Name</h6>
                        </div>
                        <div class="form-group col-sm-10 text-secondary">
                            <input type="text" class="form-control" name="name"
                                value="{{ old('name', $team->name) }}" />

                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-2">
                            <h6 class="mb-0">Position</h6>
                        </div>
                        <div class="form-group col-sm-10 text-secondary">
                            <input type="text" class="form-control" name="position"
                                value="{{ old('position', $team->position) }}" />

                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-2">
                            <h6 class="mb-0">Facebook</h6>
                        </div>
                        <div class="form-group col-sm-10 text-secondary">
                            <input type="text" class="form-control" name="facebook"
                                value="{{ old('facebook', $team->facebook) }}" />

                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-2">
                            <h6 class="mb-0">Instagram</h6>
                        </div>
                        <div class="form-group col-sm-10 text-secondary">
                            <input type="text" class="form-control " name="instagram"
                                value="{{ old('instagram', $team->instagram) }}" />

                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-2">
                            <h6 class="mb-0">Twitter</h6>
                        </div>
                        <div class="form-group col-sm-10 text-secondary">
                            <input type="text" class="form-control" name="twitter"
                                value="{{ old('twitter', $team->twitter) }}" />

                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-2">
                            <h6 class="mb-0">Image</h6>
                        </div>
                        <div class="col-sm-10 text-secondary">
                            <input class="form-control @error('image') is-invalid @enderror" type="file" name="image"
                                id="image">
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-2">
                            <h6 class="mb-0">Preview</h6>
                        </div>
                        <div class="col-sm-10 text-secondary">
                            {{-- <img src="{{ asset('uploads/noimage.jpg') }}" alt="Admin"
                                class="rounded-circle p-1 bg-primary" width="110" id="showImage"> --}}
                            <img src="{{ !empty($team->image) ? url($team->image) : asset('uploads/noimage.jpg') }}"
                                alt="Team image" class="rounded-circle p-1 bg-primary" width="110" id="showImage">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10 text-secondary">
                            <input type="submit" class="btn btn-primary px-4" value="Update Team" />
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

                },
                messages: {
                    name: {
                        required: 'Please Enter Team Name',
                    },
                    position: {
                        required: 'Please Enter Position',
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
