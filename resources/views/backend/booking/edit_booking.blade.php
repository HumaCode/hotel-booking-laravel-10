@extends('admin.admin_dashboard')

@push('styles')
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
@endpush

@section('admin')
    <div class="page-content">
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-5">

            <div class="col">
                <div class="card radius-10 border-start border-0 border-4 border-info">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Booking No</p>
                                <h6 class="my-1 text-info">{{ $editData->code }}</h6>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto"><i
                                    class='bx bxs-cart'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card radius-10 border-start border-0 border-4 border-danger">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Booking Date</p>
                                <h6 class="my-1 text-danger">
                                    {{ \Carbon\Carbon::parse($editData->created_at)->format('d/m/Y') }}</h6>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-burning text-white ms-auto">
                                <i class='bx bxs-wallet'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card radius-10 border-start border-0 border-4 border-success">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Payment </p>
                                <h6 class="my-1 text-success">{{ $editData->payment_method }}</h6>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto">
                                <i class='bx bxs-bar-chart-alt-2'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card radius-10 border-start border-0 border-4 border-warning">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Pay Status </p>
                                <h6 class="my-1 text-warning">
                                    @if ($editData->payment_status == '1')
                                        <span class="text-success">Complete</span>
                                    @else
                                        <span class="text-danger">Pending</span>
                                    @endif
                                </h6>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto">
                                <i class='bx bxs-group'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card radius-10 border-start border-0 border-4 border-warning">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Pay Booking </p>
                                <h6 class="my-1 text-warning">
                                    @if ($editData->status == '1')
                                        <span class="text-success">Active</span>
                                    @else
                                        <span class="text-danger">Pending</span>
                                    @endif
                                </h6>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto">
                                <i class='bx bxs-group'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div><!--end row-->

        <div class="row">
            <div class="col-12 col-lg-8 d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Room Type</th>
                                        <th>Total Room</th>
                                        <th>Price</th>
                                        <th>Check In/ Check Out</th>
                                        <th>Total Days</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $editData->room->type->name }}</td>
                                        <td>{{ $editData->number_of_rooms }}</td>
                                        <td>${{ $editData->actual_price }}</td>
                                        <td>
                                            <span class="badge bg-primary">{{ $editData->check_in }}</span> / <br> <span
                                                class="badge bg-warning text-dark">{{ $editData->check_out }}</span>
                                        </td>
                                        <td>{{ $editData->total_night }}</td>
                                        <td>${{ $editData->actual_price * $editData->number_of_rooms }}</td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="col-md-6" style="float: right;">
                                <style>
                                    .test_table td {
                                        text-align: right;
                                        font-weight: bold;
                                    }

                                    .test_table .title-td {
                                        text-align: start;
                                        font-weight: bold;
                                    }
                                </style>
                                <table class="table test_table" style="float: right;" border="none">
                                    <tr>
                                        <td class="title-td">Subtotal</td>
                                        <td>${{ $editData->subtotal }}</td>
                                    </tr>
                                    <tr>
                                        <td class="title-td">Discount</td>
                                        <td>${{ $editData->discount }}</td>
                                    </tr>
                                    <tr>
                                        <td class="title-td">Grand Total</td>
                                        <td>${{ $editData->total_price }}</td>
                                    </tr>
                                </table>
                            </div>

                            <div style="clear: both;"></div>
                            <div style="margin-top: 40px; margin-bottom: 20px"></div>
                            <a href="javascript::void(0)" class="btn btn-primary assign_room">Assign Room</a>

                            @php
                                $assign_rooms = App\Models\BookingRoomList::with('room_number')
                                    ->where('booking_id', $editData->id)
                                    ->get();
                            @endphp


                            @if (count($assign_rooms) > 0)
                                <table class="table table-bordered mt-3">
                                    <tr>
                                        <td>Room Number</td>
                                        <td>Action</td>
                                    </tr>

                                    @foreach ($assign_rooms as $item)
                                        <tr>
                                            <td>{{ $item->room_number->room_no }}</td>
                                            <td>
                                                <a href="{{ route('assign_room_delete', $item->id) }}"
                                                    id="delete">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            @else
                                <div class="alert alert-danger text-center mt-3">
                                    Not Found Assign Room
                                </div>
                            @endif

                        </div>

                        <form action="{{ route('update.booking.status', $editData->id) }}" method="POST">
                            @csrf

                            <div class="row" style="margin-top: 40px">
                                <div class="col-md-6">
                                    <label for="" class="mb-2">Payment Status</label>
                                    <select id="payment_status" name="payment_status" class="form-select">
                                        <option disabled selected>Choose...</option>
                                        <option value="0" {{ $editData->payment_status == '0' ? 'selected' : '' }}>
                                            Pending
                                        </option>
                                        <option value="1" {{ $editData->payment_status == '1' ? 'selected' : '' }}>
                                            Complete
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="" class="mb-2">Booking Status</label>
                                    <select id="status" name="status" class="form-select">
                                        <option disabled selected>Choose...</option>
                                        <option value="0" {{ $editData->status == '0' ? 'selected' : '' }}>
                                            Pending
                                        </option>
                                        <option value="1" {{ $editData->status == '1' ? 'selected' : '' }}>
                                            Complete
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <div class="d-grid gap-2">
                                        <button class="btn btn-primary" type="submit">Update</button>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <div class="d-grid gap-2">
                                        <a href="{{ route('download.invoice', $editData->id) }}" class="btn btn-warning"><i
                                                class="lni lni-download"></i>Download
                                            Invoice</a>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-4 d-flex">
                <div class="card radius-10 w-100">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <div>
                                <h6 class="mb-0">Manage Room and Date</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('update.booking', $editData->id) }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="" class="mb-2">Check In</label>
                                    <input type="date" required name="check_in" id="check_in" class="form-control"
                                        value="{{ $editData->check_in }}">
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="" class="mb-2">Check Out</label>
                                    <input type="date" required name="check_out" id="check_out" class="form-control"
                                        value="{{ $editData->check_out }}">
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="" class="mb-2">Room</label>
                                    <input type="number" min="0" required id="number_of_rooms"
                                        name="number_of_rooms" class="form-control"
                                        value="{{ $editData->number_of_rooms }}">
                                </div>

                                <input type="hidden" name="available_room" id="available_room">

                                <div class="col-md-12 mb-3">
                                    <label for="" class="mb-2">Availablity : <span
                                            class="text-success availablity"></span></label>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <div class="d-grid gap-2">
                                        <button class="btn btn-primary" type="submit">SUBMIT</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>


                    <div class="card-footer">
                        <div class="card radius-10 w-100">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <h6 class="mb-0">Customer Information</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">

                                <ul class="list-group list-group-flush">
                                    <li
                                        class="list-group-item d-flex bg-transparent justify-content-between align-items-center border-top">
                                        Name <span
                                            class="badge bg-warning text-dark rounded-pill">{{ $editData->user->name }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                                        Email <span
                                            class="badge bg-warning text-dark rounded-pill">{{ $editData->user->email }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                                        Phone <span
                                            class="badge bg-warning text-dark rounded-pill">{{ $editData->user->phone }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                                        Country <span
                                            class="badge bg-warning text-dark rounded-pill">{{ $editData->country }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                                        State <span
                                            class="badge bg-warning text-dark rounded-pill">{{ $editData->state }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                                        Zip Code <span
                                            class="badge bg-warning text-dark rounded-pill">{{ $editData->zip_code }}</span>
                                    </li>
                                    <li
                                        class="list-group-item d-flex bg-transparent justify-content-between align-items-center">
                                        Address <span
                                            class="badge bg-warning text-dark rounded-pill">{{ $editData->address }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div><!--end row-->

    </div>


    <div class="modal fade myModal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Rooms</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
                {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div> --}}
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        $(document).ready(function() {
            getAvaility();

            $('.assign_room').on('click', function() {
                $.ajax({
                    url: "{{ route('assign_room', $editData->id) }}",
                    success: function(data) {
                        $('.myModal .modal-body').html(data);
                        $('.myModal').modal('show');

                    }
                });
                return false;
            });
        });


        function getAvaility() {
            var check_in = $('#check_in').val();
            var check_out = $('#check_out').val();
            var room_id = "{{ $editData->rooms_id }}";

            $.ajax({
                url: "{{ route('check_room_availability') }}",
                data: {
                    room_id: room_id,
                    check_in: check_in,
                    check_out: check_out
                },
                success: function(data) {
                    $('.availablity').text(data['available_room']);
                    $('#available_room').val(data['available_room']);
                }
            });
        }
    </script>
@endpush
