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
                                    <form class="row g-3">
                                        <div class="col-md-4">
                                            <label for="roomtype_id" class="form-label">Room Type Name</label>
                                            <input type="text" class="form-control" id="roomtype_id" name="roomtype_id"
                                                value="{{ $editData->type->name }}">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="total_adult" class="form-label">Total Adult</label>
                                            <input type="text" name="total_adult" class="form-control" id="total_adult"
                                                value="{{ $editData->total_adult }}">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="total_child" class="form-label">Total Child</label>
                                            <input type="text" class="form-control" name="total_child" id="total_child"
                                                value="{{ $editData->total_child }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="input4" class="form-label">Main Image</label>
                                            <input type="file" class="form-control" id="input4" placeholder="Email">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="input4" class="form-label">Galery Image</label>
                                            <input type="file" class="form-control" id="input4" placeholder="Email">
                                        </div>

                                        <div class="col-md-4">
                                            <label for="price" class="form-label">Room Price</label>
                                            <input type="text" class="form-control" id="price" name="price"
                                                value="{{ $editData->price }}">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="discount" class="form-label">Discount (%)</label>
                                            <input type="number" min="0" name="discount" class="form-control"
                                                id="discount" value="{{ $editData->discount }}">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="room_capacity" class="form-label">Room Capacity</label>
                                            <input type="number" min="0" class="form-control"
                                                name="room_capacity" id="room_capacity"
                                                value="{{ $editData->room_capacity }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="view" class="form-label">Room View</label>
                                            <select id="view" name="view" class="form-select">
                                                <option selected="">Choose...</option>
                                                <option value="Sea View">Sea View</option>
                                                <option value="Hill View">Hill View</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="bed_style" class="form-label">Bed Style</label>
                                            <select id="bed_style" name="bed_style" class="form-select">
                                                <option selected="">Choose...</option>
                                                <option value="Queen Bed">Queen Bed</option>
                                                <option value="Twin Bed">Twin Bed</option>
                                                <option value="King Bed">King Bed</option>
                                            </select>
                                        </div>

                                        <div class="col-md-12">
                                            <label for="short_desc" class="form-label">Short Description</label>
                                            <textarea class="form-control" name="short_desc" id="short_desc" rows="3">{{ $editData->short_desc }}</textarea>
                                        </div>

                                        <div class="col-md-12">
                                            <label for="description" class="form-label">Description</label>
                                            <textarea class="form-control" name="description" id="myeditorinstance">{!! $editData->description !!}</textarea>
                                        </div>


                                        <div class="col-md-12">
                                            <div class="d-md-flex d-grid align-items-center gap-3">
                                                <button type="button" class="btn btn-primary px-4">Submit</button>
                                                <button type="button" class="btn btn-light px-4">Reset</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>


                        </div>
                    </div>


                    <div class="tab-pane fade" id="primaryprofile" role="tabpanel">
                        <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid.
                            Exercitation
                            +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko
                            farm-to-table
                            craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts
                            ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus
                            mollit.
                            Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack
                            odio
                            cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson
                            biodiesel. Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus
                            tattooed
                            echo park.</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
