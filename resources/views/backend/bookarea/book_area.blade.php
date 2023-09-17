@extends('admin.admin_dashboard')

@push('styles')
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
@endpush

@section('admin')
    <div class="page-content">

        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Update Book Area</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Update Book Area</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <hr />

        <div class="card">
            <div class="card-body">

                <form action="{{ route('book.area.update') }}" method="POST" enctype="multipart/form-data" id="myForm">
                    @csrf

                    <input type="hidden" name="id" value="{{ $book->id }}">

                    <div class="row mb-3">
                        <div class="col-sm-2">
                            <h6 class="mb-0">Short Title</h6>
                        </div>
                        <div class="form-group col-sm-10 text-secondary">
                            <input type="text" class="form-control" name="short_title"
                                value="{{ old('short_title', $book->short_title) }}" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-2">
                            <h6 class="mb-0">Main Title</h6>
                        </div>
                        <div class="form-group col-sm-10 text-secondary">
                            <input type="text" class="form-control" name="main_title"
                                value="{{ old('position', $book->main_title) }}" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-2">
                            <h6 class="mb-0">Short Description</h6>
                        </div>
                        <div class="form-group col-sm-10 text-secondary">

                            <textarea name="short_desc" id="short_desc" rows="3" class="form-control">{{ old('short_desc', $book->short_desc) }}</textarea>

                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-2">
                            <h6 class="mb-0">Link Url</h6>
                        </div>
                        <div class="form-group col-sm-10 text-secondary">
                            <input type="text" class="form-control" name="link_url"
                                value="{{ old('link_url', $book->link_url) }}" />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-2">
                            <h6 class="mb-0">Image</h6>
                        </div>
                        <div class="form-group col-sm-10 text-secondary">
                            <input class="form-control" type="file" name="image" id="image"
                                accept=".jpg,.jpeg,.png">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-2">
                            <h6 class="mb-0">Preview</h6>
                        </div>
                        <div class="col-sm-10 text-secondary">
                            {{-- <img src="{{ asset('uploads/noimage.jpg') }}" alt="Book Area"
                                class="rounded-circle p-1 bg-primary" width="110" id="showImage"> --}}
                            <img src="{{ !empty($book->image) ? url($book->image) : asset('uploads/noimage.jpg') }}"
                                alt="Admin" class="p-1 bg-primary" width="110" id="showImage">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10 text-secondary">
                            <input type="submit" class="btn btn-primary px-4" value="Update Book Area" />
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
                    short_title: {
                        required: true,
                    },
                    main_title: {
                        required: true,
                    },
                    short_desc: {
                        required: true,
                    },
                    link_url: {
                        required: true,
                    },

                },
                messages: {
                    short_title: {
                        required: 'Please Enter Short Title',
                    },
                    main_title: {
                        required: 'Please Enter Main Title',
                    },
                    short_desc: {
                        required: 'Please Enter Short Description',
                    },
                    link_url: {
                        required: 'Please Enter Link Url',
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
