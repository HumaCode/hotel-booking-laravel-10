@extends('admin.admin_dashboard')


@section('admin')
    <div class="page-content">

        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Edit Room Number</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Room Number</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <hr />

        <div class="card">
            <div class="card-body">

                <form action="{{ route('update.roomno', $editroomno->id) }}" method="POST">
                    @csrf


                    <div class="row mb-3">
                        <div class="col-sm-2">
                            <h6 class="mb-0">Room Number</h6>
                        </div>
                        <div class="form-group col-sm-10 text-secondary">
                            <input type="number" min="0" class="form-control @error('room_no') is-invalid @enderror"
                                name="room_no" value="{{ old('room_no', $editroomno->room_no) }}" autofocus />
                            @error('room_no')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-2">
                            <h6 class="mb-0">Status</h6>
                        </div>
                        <div class="form-group col-sm-10 text-secondary">
                            <select id="status" name="status" class="form-select @error('status') is-invalid @enderror">
                                <option disabled selected>Choose...</option>
                                <option value="Active" {{ $editroomno->status == 'Active' ? 'selected' : '' }}>Active
                                </option>
                                <option value="Inactive" {{ $editroomno->status == 'Inactive' ? 'selected' : '' }}>Inactive
                                </option>
                            </select>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-10 text-secondary">
                            <input type="submit" class="btn btn-primary px-4" value="Update Room Number" />
                        </div>
                    </div>

                </form>

            </div>
        </div>

    </div>
@endsection
