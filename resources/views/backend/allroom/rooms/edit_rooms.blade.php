@extends('admin.admin_dashboard')

@push('styles')
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
@endpush

@section('admin')
    <div class="page-content">

        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Edit Room</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Room</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <hr />

        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs nav-primary" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" data-bs-toggle="tab" href="#primaryhome" role="tab"
                            aria-selected="true">
                            <div class="d-flex align-items-center">
                                <div class="tab-icon"><i class="bx bx-home font-18 me-1"></i>
                                </div>
                                <div class="tab-title">Manage Room</div>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#primaryprofile" role="tab" aria-selected="false"
                            tabindex="-1">
                            <div class="d-flex align-items-center">
                                <div class="tab-icon"><i class="bx bx-user-pin font-18 me-1"></i>
                                </div>
                                <div class="tab-title">Room Number</div>
                            </div>
                        </a>
                    </li>
                </ul>
                <div class="tab-content py-3">
                    <div class="tab-pane fade active show" id="primaryhome" role="tabpanel">
                        <div class="col-xl-12 mx-auto">

                            <div class="card">
                                <div class="card-body p-4">
                                    <h5 class="mb-4">Update Room</h5>

                                    <form class="row g-3" action="{{ route('update.room', $editData->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="col-md-4">
                                            <label for="roomtype_id" class="form-label">Room Type Name</label>
                                            <input type="text" class="form-control" id="roomtype_id" name="roomtype_id"
                                                value="{{ $editData->type->name }}" disabled>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="total_adult" class="form-label">Total Adult</label>
                                            <input type="text" name="total_adult" class="form-control" id="total_adult"
                                                value="{{ old('total_adult', $editData->total_adult) }}">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="total_child" class="form-label">Total Child</label>
                                            <input type="text" class="form-control" name="total_child" id="total_child"
                                                value="{{ old('total_child', $editData->total_child) }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="image" class="form-label">Main Image</label>
                                            <input type="file" class="form-control" name="image" id="image"
                                                accept=".png,.jpg,.jpeg,.gif">

                                            <img src="{{ !empty($editData->image) ? url($editData->image) : asset('uploads/noimage.jpg') }}"
                                                alt="Main Image" class="p-1 bg-primary mt-2" width="110" height="120"
                                                id="showImage">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="multiImg" class="form-label">Galery Image</label>
                                            <input type="file" name="multi_img[]" multiple class="form-control"
                                                id="multiImg" accept=".png,.jpg,.jpeg,.gif">

                                            @foreach ($multiImgs as $item)
                                                <img src="{{ !empty($item->multi_img) ? url($item->multi_img) : asset('uploads/noimage.jpg') }}"
                                                    alt="Main Image" class="p-1 bg-primary mt-2" width="110"
                                                    id="showImage">

                                                <a href="{{ route('multi.image.delete', $item->id) }}"><i
                                                        class="lni lni-close"></i></a>
                                            @endforeach
                                            <hr>

                                            <div class="row mt-2" id="preview_img"></div>
                                        </div>

                                        <div class="col-md-3">
                                            <label for="price" class="form-label">Room Price</label>
                                            <input type="text" class="form-control" id="price" name="price"
                                                value="{{ old('price', $editData->price) }}">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="size" class="form-label">Size</label>
                                            <input type="number" min="0" name="size" class="form-control"
                                                id="size" value="{{ old('size', $editData->size) }}">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="discount" class="form-label">Discount (%)</label>
                                            <input type="number" min="0" name="discount" class="form-control"
                                                id="discount" value="{{ old('discount', $editData->discount) }}">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="room_capacity" class="form-label">Room Capacity</label>
                                            <input type="number" min="0" class="form-control"
                                                name="room_capacity" id="room_capacity"
                                                value="{{ old('room_capacity', $editData->room_capacity) }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="view" class="form-label">Room View</label>
                                            <select id="view" name="view" class="form-select">
                                                <option disabled selected>Choose...</option>
                                                <option value="Sea View"
                                                    {{ $editData->view == 'Sea View' ? 'selected' : '' }}>Sea View
                                                </option>
                                                <option value="Hill View"
                                                    {{ $editData->view == 'Hill View' ? 'selected' : '' }}>Hill View
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="bed_style" class="form-label">Bed Style</label>
                                            <select id="bed_style" name="bed_style" class="form-select">
                                                <option disabled selected>Choose...</option>
                                                <option value="Queen Bed"
                                                    {{ $editData->bed_style == 'Queen Bed' ? 'selected' : '' }}>Queen Bed
                                                </option>
                                                <option value="Twin Bed"
                                                    {{ $editData->bed_style == 'Twin Bed' ? 'selected' : '' }}>Twin Bed
                                                </option>
                                                <option value="King Bed"
                                                    {{ $editData->bed_style == 'King Bed' ? 'selected' : '' }}>King Bed
                                                </option>
                                            </select>
                                        </div>

                                        <div class="col-md-12">
                                            <label for="short_desc" class="form-label">Short Description</label>
                                            <textarea class="form-control" name="short_desc" id="short_desc" rows="3">{{ old('short_desc', $editData->short_desc) }}</textarea>
                                        </div>

                                        <div class="col-md-12">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control" name="description" id="myeditorinstance">{!! old('description', $editData->description) !!}</textarea>
                                        </div>

                                        <div class="row mt-2">
                                            <div class="col-md-12 mb-3">
                                                @forelse ($basic_facility as $item)
                                                    <div class="basic_facility_section_remove"
                                                        id="basic_facility_section_remove">
                                                        <div class="row add_item">
                                                            <div class="col-md-10">
                                                                <label for="facility_name" class="form-label"> Room
                                                                    Facilities </label>
                                                                <select name="facility_name[]" id="facility_name"
                                                                    class="form-control">
                                                                    <option value="">Select Facility</option>
                                                                    <option value="Complimentary Breakfast"
                                                                        {{ $item->facility_name == 'Complimentary Breakfast' ? 'selected' : '' }}>
                                                                        Complimentary Breakfast</option>
                                                                    <option value="32/42 inch LED TV"
                                                                        {{ $item->facility_name == '32/42 inch LED TV' ? 'selected' : '' }}>
                                                                        32/42 inch LED TV</option>

                                                                    <option value="Smoke alarms"
                                                                        {{ $item->facility_name == 'Smoke alarms' ? 'selected' : '' }}>
                                                                        Smoke alarms</option>

                                                                    <option value="Minibar"
                                                                        {{ $item->facility_name == 'Minibar' ? 'selected' : '' }}>
                                                                        Minibar</option>

                                                                    <option value="Work Desk"
                                                                        {{ $item->facility_name == 'Work Desk' ? 'selected' : '' }}>
                                                                        Work Desk</option>

                                                                    <option value="Free Wi-Fi"
                                                                        {{ $item->facility_name == 'Free Wi-Fi' ? 'selected' : '' }}>
                                                                        Free Wi-Fi</option>

                                                                    <option value="Safety box"
                                                                        {{ $item->facility_name == 'Safety box' ? 'selected' : '' }}>
                                                                        Safety box</option>

                                                                    <option value="Rain Shower"
                                                                        {{ $item->facility_name == 'Rain Shower' ? 'selected' : '' }}>
                                                                        Rain Shower</option>

                                                                    <option value="Slippers"
                                                                        {{ $item->facility_name == 'Slippers' ? 'selected' : '' }}>
                                                                        Slippers</option>

                                                                    <option value="Hair dryer"
                                                                        {{ $item->facility_name == 'Hair dryer' ? 'selected' : '' }}>
                                                                        Hair dryer</option>

                                                                    <option value="Wake-up service"
                                                                        {{ $item->facility_name == 'Wake-up service' ? 'selected' : '' }}>
                                                                        Wake-up service</option>

                                                                    <option value="Laundry & Dry Cleaning"
                                                                        {{ $item->facility_name == 'Laundry & Dry Cleaning' ? 'selected' : '' }}>
                                                                        Laundry & Dry Cleaning</option>

                                                                    <option value="Electronic door lock"
                                                                        {{ $item->facility_name == 'Electronic door lock' ? 'selected' : '' }}>
                                                                        Electronic door lock</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group" style="padding-top: 30px;">
                                                                    <a class="btn btn-success addeventmore"><i
                                                                            class="lni lni-circle-plus"></i></a>
                                                                    <span class="btn btn-danger removeeventmore"><i
                                                                            class="lni lni-circle-minus"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                @empty

                                                    <div class="basic_facility_section_remove"
                                                        id="basic_facility_section_remove">
                                                        <div class="row add_item">
                                                            <div class="col-md-10">
                                                                <label for="basic_facility_name" class="form-label">Room
                                                                    Facilities </label>
                                                                <select name="facility_name[]" id="basic_facility_name"
                                                                    class="form-control">
                                                                    <option value="">Select Facility</option>
                                                                    <option value="Complimentary Breakfast">Complimentary
                                                                        Breakfast</option>
                                                                    <option value="32/42 inch LED TV"> 32/42 inch LED TV
                                                                    </option>
                                                                    <option value="Smoke alarms">Smoke alarms</option>
                                                                    <option value="Minibar"> Minibar</option>
                                                                    <option value="Work Desk">Work Desk</option>
                                                                    <option value="Free Wi-Fi">Free Wi-Fi</option>
                                                                    <option value="Safety box">Safety box</option>
                                                                    <option value="Rain Shower">Rain Shower</option>
                                                                    <option value="Slippers">Slippers</option>
                                                                    <option value="Hair dryer">Hair dryer</option>
                                                                    <option value="Wake-up service">Wake-up service
                                                                    </option>
                                                                    <option value="Laundry & Dry Cleaning">Laundry & Dry
                                                                        Cleaning</option>
                                                                    <option value="Electronic door lock">Electronic door
                                                                        lock</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <div class="form-group" style="padding-top: 30px;">
                                                                    <a class="btn btn-success addeventmore"><i
                                                                            class="lni lni-circle-plus"></i></a>

                                                                    <span class="btn btn-danger removeeventmore"><i
                                                                            class="lni lni-circle-minus"></i></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforelse
                                            </div>
                                        </div>
                                        <br>

                                        <div class="col-md-12">
                                            <div class="d-md-flex d-grid align-items-center gap-3">
                                                <button type="submit" class="btn btn-primary px-4">Save Change</button>
                                                <button type="button" class="btn btn-light px-4">Reset</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>


                        </div>
                    </div>


                    <div class="tab-pane fade" id="primaryprofile" role="tabpanel">
                        <div class="card">
                            <div class="card-body">

                                <button type="button" class="btn btn-outline-primary px-5" onclick="addRoomNo()"
                                    id="addRoomNo">Add
                                    New</button>

                                <div class="roomnoHide" id="roomnoHide">
                                    <form action="{{ route('store.room.no', $editData->id) }}" method="POST">
                                        @csrf

                                        <input type="hidden" name="room_type_id" value="{{ $editData->roomtype_id }}">

                                        <div class="row">
                                            <div class="col-md-4 mb-2">
                                                <label for="room_no" class="form-label">Room No</label>
                                                <input type="number" min="0"
                                                    class="form-control @error('room_no') is-invalid @enderror"
                                                    name="room_no" id="room_no" value="{{ old('room_no') }}">
                                                @error('room_no')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col-md-4 mb-2">
                                                <label for="status" class="form-label">Status</label>
                                                <select id="status" name="status"
                                                    class="form-select @error('status') is-invalid @enderror">
                                                    <option disabled selected>Choose...</option>
                                                    <option value="Active">Active
                                                    </option>
                                                    <option value="Inactive">Inactive
                                                    </option>
                                                </select>
                                                @error('status')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col-md-4 mb-2">
                                                <label for="status" class="form-label "></label>
                                                <button type="submit"
                                                    class="btn btn-outline-success px-5 form-control mt-2">Save</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>

                                <table class="table mb-0 mt-2" id="roomview">
                                    <thead class="table-dark text-center">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Room Number</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($allRoomNo as $item)
                                            <tr>
                                                <th class="text-center">{{ $loop->iteration }}.</th>
                                                <td>{{ $item->room_no }}</td>
                                                <td class="text-center">
                                                    @if ($item->status == 'Active')
                                                        <span class="badge bg-success">{{ $item->status }}</span>
                                                    @else
                                                        <span class="badge bg-danger">{{ $item->status }}</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('edit.roomno', $item->id) }}"
                                                        class="btn btn-outline-warning btn-sm"><i
                                                            class="lni lni-pencil me-0"></i>
                                                    </a> &nbsp;
                                                    <a href="{{ route('delete.roomno', $item->id) }}"
                                                        class="btn btn-outline-danger btn-sm" id="delete"><i
                                                            class="lni lni-trash me-0"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>

                            </div>
                        </div>

                    </div>
                </div>
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

    <!--------===Show MultiImage ========------->
    <script>
        $(document).ready(function() {
            $('#multiImg').on('change', function() { //on file input change
                if (window.File && window.FileReader && window.FileList && window
                    .Blob) //check File API supported browser
                {
                    var data = $(this)[0].files; //this file data

                    $.each(data, function(index, file) { //loop though each file
                        if (/(\.|\/)(gif|jpe?g|png)$/i.test(file
                                .type)) { //check supported file type
                            var fRead = new FileReader(); //new filereader
                            fRead.onload = (function(file) { //trigger function on successful read
                                return function(e) {
                                    var img = $('<img/>').addClass('thumb').attr('src',
                                            e.target.result).width(100)
                                        .height(80); //create image element 
                                    $('#preview_img').append(
                                        img); //append image to output element
                                };
                            })(file);
                            fRead.readAsDataURL(file); //URL representing the file's data.
                        }
                    });

                } else {
                    alert("Your browser doesn't support File API!"); //if File API is absent
                }
            });
        });
    </script>

    <!--========== Start of add Basic Plan Facilities ==============-->
    <div style="visibility: hidden">
        <div class="whole_extra_item_add" id="whole_extra_item_add">
            <div class="basic_facility_section_remove" id="basic_facility_section_remove">
                <div class="container mt-2">
                    <div class="row">
                        <div class="form-group col-md-10">
                            <label for="basic_facility_name">Room Facilities</label>
                            <select name="facility_name[]" id="basic_facility_name" class="form-control">
                                <option value="">Select Facility</option>
                                <option value="Complimentary Breakfast">Complimentary Breakfast</option>
                                <option value="32/42 inch LED TV"> 32/42 inch LED TV</option>
                                <option value="Smoke alarms">Smoke alarms</option>
                                <option value="Minibar"> Minibar</option>
                                <option value="Work Desk">Work Desk</option>
                                <option value="Free Wi-Fi">Free Wi-Fi</option>
                                <option value="Safety box">Safety box</option>
                                <option value="Rain Shower">Rain Shower</option>
                                <option value="Slippers">Slippers</option>
                                <option value="Hair dryer">Hair dryer</option>
                                <option value="Wake-up service">Wake-up service</option>
                                <option value="Laundry & Dry Cleaning">Laundry & Dry Cleaning</option>
                                <option value="Electronic door lock">Electronic door lock</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2" style="padding-top: 20px">
                            <span class="btn btn-success addeventmore"><i class="lni lni-circle-plus"></i></span>
                            <span class="btn btn-danger removeeventmore"><i class="lni lni-circle-minus"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            var counter = 0;
            $(document).on("click", ".addeventmore", function() {
                var whole_extra_item_add = $("#whole_extra_item_add").html();
                $(this).closest(".add_item").append(whole_extra_item_add);
                counter++;
            });
            $(document).on("click", ".removeeventmore", function(event) {
                $(this).closest("#basic_facility_section_remove").remove();
                counter -= 1
            });
        });
    </script>
    <!--========== End of Basic Plan Facilities ==============-->


    {{-- room view --}}
    <script>
        $('#roomnoHide').hide();
        $('#roomview').show();

        function addRoomNo() {
            $('#roomnoHide').show();
            $('#roomview').hide();
            $('#addRoomNo').hide();
        }
    </script>
@endpush
