@extends('admin.admin_dashboard')

@push('styles')
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
@endpush

@section('admin')
    <div class="page-content">

        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Update Smtp Setting</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Update Smtp Setting</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <hr />

        <div class="card">
            <div class="card-body">

                <form action="{{ route('smtp.update') }}" method="POST" id="myForm">
                    @csrf

                    <input type="hidden" name="id" value="{{ $smtp->id }}">

                    <div class="row mb-3">
                        <div class="col-sm-2">
                            <h6 class="mb-0">Mailer</h6>
                        </div>
                        <div class="form-group col-sm-10 text-secondary">
                            <input type="text" class="form-control" name="mailer"
                                value="{{ old('mailer', $smtp->mailer) }}" />

                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-2">
                            <h6 class="mb-0">Host</h6>
                        </div>
                        <div class="form-group col-sm-10 text-secondary">
                            <input type="text" class="form-control" name="host"
                                value="{{ old('host', $smtp->host) }}" />

                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-2">
                            <h6 class="mb-0">Port</h6>
                        </div>
                        <div class="form-group col-sm-10 text-secondary">
                            <input type="text" class="form-control" name="port"
                                value="{{ old('port', $smtp->port) }}" />

                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-2">
                            <h6 class="mb-0">Username</h6>
                        </div>
                        <div class="form-group col-sm-10 text-secondary">
                            <input type="text" class="form-control" name="username"
                                value="{{ old('username', $smtp->username) }}" />

                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-2">
                            <h6 class="mb-0">Password</h6>
                        </div>
                        <div class="form-group col-sm-10 text-secondary">
                            <input type="text" class="form-control" name="password"
                                value="{{ old('password', $smtp->password) }}" />

                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-2">
                            <h6 class="mb-0">Encryption</h6>
                        </div>
                        <div class="form-group col-sm-10 text-secondary">
                            <input type="text" class="form-control" name="encryption"
                                value="{{ old('encryption', $smtp->encryption) }}" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-2">
                            <h6 class="mb-0">From Address</h6>
                        </div>
                        <div class="form-group col-sm-10 text-secondary">
                            <input type="text" class="form-control" name="from_address"
                                value="{{ old('from_address', $smtp->from_address) }}" />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10 text-secondary">
                            <input type="submit" class="btn btn-primary px-4" value="Save Change" />
                        </div>
                    </div>

                </form>

            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    mailer: {
                        required: true,
                    },
                    host: {
                        required: true,
                    },
                    port: {
                        required: true,
                    },
                    username: {
                        required: true,
                    },
                    password: {
                        required: true,
                    },
                    encryption: {
                        required: true,
                    },
                    from_address: {
                        required: true,
                    },

                },
                messages: {
                    mailer: {
                        required: 'Please Enter Mailer',
                    },
                    host: {
                        required: 'Please Enter Host',
                    },
                    port: {
                        required: 'Please Enter Port',
                    },
                    username: {
                        required: 'Please Enter Username',
                    },
                    password: {
                        required: 'Please Enter Password',
                    },
                    encryption: {
                        required: 'Please Enter Encryption',
                    },
                    from_address: {
                        required: 'Please Enter From Address',
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
