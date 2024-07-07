@extends('qfd.layouts.master')
@section('content')
    <div class="page-inner">
        <div class="page-header">
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Meeting ke 1</h4>
                    </div>
                </div>
            </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex align-items-center">
                    <div class="card">
                        {{-- <h4 class="card-title2">{{ $detailMeeting[0]->projectName }}</h4> --}}
                    </div>
                </div>
            </div>

            @if (\Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <p>{{ \Session::get('success') }}</p>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                </div>
            @endif

            @if (\Session::has('info'))
                <div class="alert alert-info alert-dismissible fade show">
                    <p>{{ \Session::get('info') }}</p>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                </div>
            @endif

            @if (\Session::has('delete'))
                <div class="alert alert-danger alert-dismissible fade show">
                    <p>{{ \Session::get('delete') }}</p>
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                </div>
            @endif
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="pointerco">PO Interco</label>
                                <input type="text" class="form-control" name="pointerco" id="pointerco"
                                    value="{{ $createNotulensi->po_interco ?? '' }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="pronum">Project Name</label>
                                <input type="text" class="form-control" name="pronum" id="pronum"
                                    value="{{ $createNotulensi->projectName ?? '' }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="costumer">Customer</label>
                                <input type="text" class="form-control" name="costumer" id="costumer"
                                    value="{{ $createNotulensi->customer ?? '' }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="customerpo">Customer P/O</label>
                                <input type="text" class="form-control" name="customerpo" id="customerpo"
                                    value="{{ $createNotulensi->customerpo ?? '' }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="qtyorder">Qty Order</label>
                                <input type="text" class="form-control" name="qtyorder" id="qtyorder"
                                    value="{{ $createNotulensi->qty ?? '' }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="reqdelivery">Request Delivery</label>
                                <input type="text" class="form-control" name="reqdelivery" id="reqdelivery"
                                    value="{{ $createNotulensi->reqDelivery ?? '' }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="meetingorg">Meeting Organizer</label>
                                <input type="text" class="form-control" name="meetingorg" id="meetingorg"
                                    value="{{ $createNotulensi->MeetingOrganizer ?? '' }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="location">Location</label>
                                <input type="text" class="form-control" name="location" id="location"
                                    value="{{ $createNotulensi->Location ?? '' }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="reportedby">Reported By</label>
                                <input type="text" class="form-control" name="reportedby" id="reportedby"
                                    value="{{ $createNotulensi->ReportedBy ?? '' }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="meetingdate">Meeting Date</label>
                                <input type="text" class="form-control" name="meetingdate" id="meetingdate"
                                    value="{{ $createNotulensi->MeetingDate ?? '' }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="speaker">Speaker<span class="text-danger">*</span></label>
                                <select class="form-control select2-multiple" name="speakers[]" id="speakers"
                                    multiple="multiple">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->email }}" selected>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="attendance">Attendance<span class="text-danger">*</span></label>
                                <select class="form-control select2-multiple" name="attendance[]" id="attendance"
                                multiple="multiple">
                                @foreach ($attendences as $attendence)
                                    <option value="{{ $attendence->email }}" selected>{{ $attendence->name }}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                    </div>
                </div>
            <div class="page-inner">
                <div class="page-header"></div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="d-flex align-items-center">
                                <div class="card">
                                    {{-- <h4 class="card-title2">{{ $detailMeeting[0]->projectName }}</h4> --}}
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="dt-layout-row"></div>
                            <div class="card-body">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="warnadasar">Painting Style/Warna Dasar</label>
                                                <input type="text" class="form-control" name="warnadasar"
                                                    id="warnadasar">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="no">Nomor Preliminary Drawing</label>
                                                <input type="text" class="form-control" name="pronum"
                                                    id="pronum">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="truck">Truck<span
                                                        class="text-danger">*</span></label>
                                                <select class="form-control select2" name="truck" id="truck"
                                                    required>
                                                    <option value="">select an option</option>
                                                    @foreach ($truck as $trucks)
                                                        <option value="{{ $trucks->truck }}">
                                                            {{ $trucks->truck }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="assy">Assy ke Unit</label>
                                                <input type="text" class="form-control" name="assy"
                                                    id="assy">
                                            </div>
                                        </div>
                                    </div>
                                </div>
        <!-- create notulensi tab-->
        <div class="card-header">
            <h4 class="card-title">Notulensi Meeting</h4>
        </div>
            <form action="{{ url('qfd-store') }}" method="post">
                @csrf
                <input type="hidden" name="id" id="id">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="notes-tab" data-toggle="tab"
                            href="#notes" role="tab" aria-controls="notes"
                            aria-selected="true">Notes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="specification-tab" data-toggle="tab"
                            href="#specification" role="tab"
                            aria-controls="specification"
                            aria-selected="false">Specification</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="scheduleIn-tab" data-toggle="tab"
                            href="#scheduleIn" role="tab" aria-controls="scheduleIn"
                            aria-selected="false">Schedule Incoming</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="scheduleLine-tab" data-toggle="tab"
                            href="#scheduleLine" role="tab"
                            aria-controls="scheduleLine" aria-selected="false">Schedule
                            Line Production</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="schedulePB-tab" data-toggle="tab"
                            href="#schedulePB" role="tab" aria-controls="schedulePB"
                            aria-selected="false">Schedule PB Finish</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="notes" role="tabpanel"
                        aria-labelledby="notes-tab">
                        <div class="form-group mt-3">
                            <label for="notesMeeting">Notes Meeting</label>
                            <textarea class="form-control" id="notesMeeting" rows="10" placeholder="Notes Meeting"></textarea>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="specification" role="tabpanel" aria-labelledby="specification-tab">
                        <div class="form-group mt-4">
                            <div class="form-row justify-content-center">
                                {{-- <div class="container mt-5">
                                    <div class="row">
                                        <div class="col-md-4 d-flex justify-content-center">
                                            <button type="button" class="btn btn-secondary btn-custom" data-toggle="modal" data-target="#uploadModal">Drawing</button>
                                        </div>
                                    </div>
                        <!-- Modal untuk upload image -->
                        <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="uploadModalLabel">Upload Files</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="upload-form" action="/upload-image" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <div class="drop-zone" id="drop-zone">
                                                <span class="drop-zone__prompt">Drag & Drop your files here or click to upload</span>
                                                <input type="file" name="files[]" class="drop-zone__input" multiple >
                                            </div>
                                            <ul class="file-list" id="file-list"></ul>
                                            <button type="submit" class="btn btn-primary mt-3">Upload</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="container">
                <div class="row">
                <div class="col-md-5 mt-5">
                    <div class="form-group">
                        <select class="form-control select2" name="MaterialNumber" id="MaterialNumber" required multiple>
                            {{-- <option value="">Material Number</option> --}}
                                @foreach ($api['data'] as $apispec)
                                <option value="{{ $apispec['material_number'] }}" data-description="{{ $apispec['material_description'] }}" data-qty="{{ $apispec['qty'] }}" >
                                    {{ $apispec['material_number'] }}
                                    </option>
                                @endforeach
                        </select>
                    </div>
                </div>
            </div>
                
                <div class="table-responsive">
                    <table id="basic" class="table table table-striped table-bordered table-hover dataTable" role="grid" aria-describedby="add-row_info">
                        <thead class="table-light"> 
                        <tr style="background-color:#5A639C ; color: white;" role="row">
                            <th>No</th>
                            <th>PN</th>
                            <th>PN Description</th>
                            <th>Qty (1 UN)</th>
                            <th>Lead Time/Week</th>
                            <th>PIC</th>
                            <th>Incoming</th>
                            <th>Remark</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        <tr>
                            <td colspan="8" class="text-center">No data available in table</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        </div>

        <div class="tab-pane fade" id="scheduleIn" role="tabpanel"
            aria-labelledby="scheduleIn-tab">
            <div class="form-group mt-3">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Process</th>
                                <th>Description</th>
                                <th>Incoming Date</th>
                                <th>PIC</th>
                                <th>Remark</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Adding 18 rows as per the image -->
                            @for ($i = 1; $i <= 6; $i++)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td contenteditable="true"></td>
                                    <td contenteditable="true"></td>
                                    <td><input type="date" class="form-control" /></td>
                                    <td contenteditable="true"></td>
                                    <td contenteditable="true"></td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
                </div>
        </div>
        <div class="tab-pane fade" id="scheduleLine" role="tabpanel"
            aria-labelledby="scheduleLine-tab">
            <div class="form-group mt-3">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Process</th>
                                <th>Description</th>
                                <th>Start</th>
                                <th>Finish</th>
                                <th>Leadtime (days)</th>
                                <th>PIC</th>
                                <th>Remark</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Adding 18 rows as per the image -->
                            @for ($i = 1; $i <= 8; $i++)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td contenteditable="true"></td>
                                    <td contenteditable="true"></td>
                                    <td><input type="date" class="form-control" /></td>
                                    <td><input type="date" class="form-control" /></td>
                                    <td contenteditable="true"></td>
                                    <td contenteditable="true"></td>
                                    <td contenteditable="true"></td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="schedulePB" role="tabpanel"
            aria-labelledby="schedulePB-tab">
            <div class="form-group mt-3">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Process</th>
                                <th>Description</th>
                                <th>Material Readiness</th>
                                <th>PB Supply</th>
                                <th>Start Fabrikasi</th>
                                <th>Start Fabrikasi</th>
                                <th>PIC</th>
                                <th>Remark</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Adding 18 rows as per the image -->
                            @for ($i = 1; $i <= 8; $i++)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td contenteditable="true"></td>
                                    <td contenteditable="true"></td>
                                    <td contenteditable="true"></td>
                                    <td contenteditable="true"></td>
                                    <td><input type="date" class="form-control" /></td>
                                    <td><input type="date" class="form-control" /></td>
                                    <td contenteditable="true"></td>
                                    <td contenteditable="true"></td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="modal-footer no-bd">
            <button type="submit" class="btn btn-success">Save</button>
        </div>
    </div>
</form>
@endsection
@section('myscript')
<script>
    $(document).ready(function() {
        $('#basic').DataTable();
    });

    $("#basic").on('click', '.edit', function() {
        var id = $(this).attr('data-id');
        $.ajax({
            url: "{{ url('notulensi-edit') }}",
            type: "GET",
            data: {
                'id': id
            },
            dataType: "JSON",
            success: function(data) {
                console.log(data)
                $('#id').val(data.id);
                $('#po_interco').val(data.po);
            }
        });
    });

    $(document).ready(function() {
        // Initialize Select2
        $('.js-example-basic-multiple').select2({
            allowClear: true,
            width: "100%"
        });

        $('#attendance').on('change', function() {
            // Get selected values
            var selectedValues = $(this).val();
            // Clear previous options in the speaker select
            $('#speaker').empty();
            // Populate speaker select with the selected values
            if (selectedValues) {
                selectedValues.forEach(function(value) {
                    $('#speaker').append(new Option(value, value));
                });
            }
            // Trigger change event to update Select2
            $('#speaker').trigger('change');
        });
    });

    function goBack() {
        window.location.href = "{{ url('/detail-project-new/{id}') }}";
    }

    function getCustomer() {
        var po = $("#po_interco").val().split(",");
        var pointerco = po[0];
        var desc = po[1];
        // console.log(po)
        // console.log(pointerco)
        // console.log(desc)

        var prod = $("#po_interco").val();
        $.ajax({
            url: "{{ url('/getCustomer') }}?po=" + pointerco + "&desc=" + desc,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                console.log(data)
                custname = data[0].CUSTNAME.split(" ")
                cust = custname[0]
                prodNum = data[0].PRODUCT.split("-")
                product = custname[0]
                reqDeliv = data[0].REQDELIVDATPO
                rd = new Date(reqDeliv)
                deliv = ('0' + rd.getDate()).slice(-2) + '-' +
                    ('0' + (rd.getMonth() + 1)).slice(-2) + '-' +
                    rd.getFullYear();
                qty = parseInt(data[0].QTY)
                $('#customer').val(cust + " - " + data[0].ENDCUSTNAME);
                $('#customerpo').val(data[0].ENDCUSTPO);
                $('#projectName').val(qty + " " + data[0].UOM + " " + data[0].ENDCUSTNAME + " - " +
                    product);
                $('#quantity').val(qty + " " + data[0].UOM);
                $('#reqDelivery').val(deliv);
                $('#prodnum').val(data[0].PRODUCT);
                $('#proddesk').val(data[0].PRODUCTDESC);
                $('#prodgroup').val(data[0].MATGROUP);
            }
        });
    }
    $('#attendance').on('change', function() {
        // Dapatkan nilai yang dipilih pada elemen attendance
        var selectedAttendance = $(this).val();
        console.log(selectedAttendance)

        // Kosongkan opsi pada elemen speaker sebelum menambahkan yang baru
        $('#speaker').empty();

        // Tambahkan opsi pada elemen speaker berdasarkan nilai yang dipilih pada attendance
        for (var i = 0; i < selectedAttendance.length; i++) {
            var email = selectedAttendance[i];
            var name = $('#attendance option[value="' + email + '"]').text();
            console.log(selectedAttendance, name)
            $('#speaker').append('<option value="' + email + '">' + name + '</option>');
        }
        // Inisialisasi kembali atau perbarui tampilan select2 untuk elemen speaker
        $('#speaker').select2();
    });

    $('#MaterialNumber').on('change', function() {
    var selectedOptions = $(this).find('option:selected');
    var tableBody = $('#tableBody');
    tableBody.empty();

    if (selectedOptions.length === 0) {
        tableBody.append('<tr><td colspan="8" class="text-center">No data available in table</td></tr>');
    } else {
        selectedOptions.each(function(index) {
            var materialNumber = $(this).val();
            var description = $(this).data('description');
            var qty = $(this).data('qty');

            var row = `<tr>
                <td>${index + 1}</td>
                <td>${materialNumber}</td>
                <td>${description}</td>
                <td>${qty}</td>
                <td contenteditable="true"></td>
                <td contenteditable="true"></td>
                <td contenteditable="true"></td>
                <td contenteditable="true"></td>
            </tr>`;

            tableBody.append(row);
        });
    }
});
</script>
 @endsection
