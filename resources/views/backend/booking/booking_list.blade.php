@extends('admin.admin_dashboard')


@section('admin')
    <div class="page-content">

        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Booking List</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Booking List</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="btn-group">
                    <a href="{{ route('add.team') }}" class="btn btn-outline-primary px-5 radius-30">Add Team</a>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->

        <hr />
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>S1</th>
                                <th>B No</th>
                                <th>B Date</th>
                                <th>Customer</th>
                                <th>Room</th>
                                <th>Check In/Out</th>
                                <th>Total Room</th>
                                <th>Guest</th>
                                <th>Payment</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($allData as $item)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}.</td>

                                    <td class="text-center">
                                        <a href="{{ route('edit.team', $item->id) }}"
                                            class="btn btn-outline-warning px-3 radius-30">Edit</a> &nbsp;
                                        <a href="{{ route('delete.team', $item->id) }}"
                                            class="btn btn-outline-danger px-3 radius-30" id="delete">Delete</a>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
