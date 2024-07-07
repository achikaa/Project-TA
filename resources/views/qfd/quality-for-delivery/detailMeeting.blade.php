@extends('qfd.layouts.master')
@section('content')
    <div class="page-inner">
        <div class="page-header">
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Detail Meeting QFD</h4>
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
                        <div class="dt-layout-row">
                        </div>
                       

                        <div class="table-responsive">
                            <table id="basic" class="table table table-striped table-bordered table-hover dataTable" role="grid" aria-describedby="add-row_info">
                                <thead class="table-light">
                                    <tr style="background-color: #5A639C; color: white;" role="row">
                                        <th style="width:10%">Meeting ke</th>
                                        <th style="width:25%">Meeting Date</th>
                                        <th style="width:25%">Location</th>
                                        <th style="width:10%">Status</th>
                                        <th style="width:10%">PO</th>
                                        <th style="width:10%" class="sorting" tabindex="0" aria-controls="add-row" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    @foreach($detail as $value) 
                                        <tr role="row" class="odd">
                                            <td>{{ $i }}</td>
                                            <td>{{ $value->MeetingDate }}</td>
                                            <td>{{ $value->Location }}</td>
                                            <td>{{ $value->status }}</td>
                                            <td>{{ $value->po_interco }}</td>
                                            <td>
                                                <a href="{{url('/create-notulensi/'.$value->po_interco)}}" type="button" data-toggle="tooltip" title="Create Notulensi" class="btn btn-link btn-danger btn-lg" data-original-title="Create Notulensi" data-id="{{ $value->id}}">
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('myscript')
    <script>
        $(document).ready(function() {
            $('#basic').DataTable();      
        });

        $("#basic").on('click', '.edit', function() {
            var id = $(this).attr('data-id');
            $.ajax({
                url: "{{ url('meeting-edit') }}",
                type: "GET",
                data: {
                    'id': id
                },
                dataType: "JSON",
                success: function(data) {
                    console.log(data)
                    $('#id').val(data.id);
                    $('#qfd-edit').val(data.qfd);
                    $('#editRowModal').modal('show');
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

        
        $("#basic").on('click', '.detail', function(){
            var id = $(this).attr('data-id');
            $.ajax({
            url: "{{ url('detail-meeting-qfd') }}",
            type: "GET",
            data: {
                'id' : id
            },
            dataType: "JSON",
            success: function(data) {
                console.log(data)
                $('#id').val(data.id);
                $('#qfd-detail').val(data.qfd);
                $('#editRowModal').modal('show');
            }
        });
    });
    
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
        // $("#basic").on('click', '.delete', function() {
        //     var id = $(this).attr('data-id');
        
        //     $.ajax({
        //         url: "{{ url('/qfd-edit') }}",
        //         type: "GET",
        //         data: {
        //             'id': id
        //         },
        //         dataType: "JSON",
        //         success: function(data) {
        //             $('#delete_id').val(data.id);
        //             $('#delete_proses').val(data.proses);
        //             $('#deleteRowModal').modal('show');
        //         }
        //     });
        // });
        </script>
@endsection
