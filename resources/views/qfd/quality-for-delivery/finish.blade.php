@extends('qfd.layouts.master')

@section('content')
<div class="page-inner">
    <div class="page-header">
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Daftar Meeting QFD</h4>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title"></h4>
                        {{-- <button  class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
                            <i class="fa fa-plus"></i>
                            Add Meeting
                        </button>    --}}
                    </div>
                </div>
               @include('qfd.panel.cardmenu')
                @if(\Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <p>{{ \Session::get('success') }}</p>
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    </div>     
                @endif

                @if(\Session::has('info'))
                        <div class="alert alert-info alert-dismissible fade show">
                            <p>{{ \Session::get('info') }}</p>
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        </div>     
                @endif
            
                @if(\Session::has('delete'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            <p>{{ \Session::get('delete') }}</p>
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        </div>     
                @endif
                <div class="card-body">                  
                    <div class="table-responsive">
                        <table id="basic" class="table table table-striped table-bordered table-hover dataTable" role="grid" aria-describedby="add-row_info">
                            <thead class="table-light">
                                <tr style="background-color: #5A639C; color: white;" role="row">
                                    <th style="width:5%">No</th>
                                    <th style="width:30">PO Interco</th>
                                    <th style="width:10%">Product No</th>
                                    <th style="width:40%">Project Name</th>
                                    <th style="width:20%">Customer</th>
                                    <th style="width:20%">Request Delivery</th>
                                    <th style="width:20%">End Customer</th>
                                    <th style="width:10%" class="sorting" tabindex="0" aria-controls="add-row" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                                <?php $i = 0; ?>
                                 
                                @foreach($finish as $value) 
                                        <tr role="row" class="odd">
                                         <td>{{ ++$i }}</td>
                                         <td>{{ $value->po_interco }}</td>
                                         <td>{{ $value->product_no }}</td>
                                         <td>{{ $value->projectName }}</td>
                                         <td>{{ $value->customer }}</td>
                                         <td>{{ $value->reqDelivery }}</td>
                                         <td>{{ $value->end_customer }}</td>
                                         <td>
                                            <div class="form-button-action">
                                                <a href="{{url('/detail-project-new/'.$value->projectName)}}" type="button" data-toggle="tooltip" title="Detail" class="btn btn-link btn-primary btn-lg" data-original-title="Detail"> 
                                                {{-- <a href="{{url('/detail-meeting-qfd'.$value->id)}}" type="button" data-toggle="tooltip" title="Detail" class="btn btn-link btn-primary btn-lg" data-original-title="Detail">  --}}
                                                <i class="fa fa-eye"></i>
                                                </a>
                                            </div>
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
@endsection
@section('myscript')
<script>
    $("#basic").on('click', '.edit', function(){
        var id = $(this).attr('data-id');
        $.ajax({
            url: "{{ url('meeting-edit') }}",
            type: "GET",
            data: {
                'id' : id
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
        $('#basic').DataTable();   
        // Initialize Select2
        $('.js-example-basic-multiple').select2({
            allowClear: true,
            width:"100%"
        });

        $('#attendance').on('change', function() {
            // Get selected values
            var selectedValues = $(this).val();
            // Clear previous options in the speaker select
            $('#speaker').empty();
            // Populate speaker select with the selected values
            // if (selectedValues) {
            //     selectedValues.forEach(function(value) {
            //         $('#speaker').append(new Option(value, value));
            //     });
            // }
            for (var i = 0; i < selectedValues.length; i++) {
            var email = selectedValues[i];
            var name = $('#attendance option[value="' + email + '"]').text();
            console.log(selectedValues,name)
            $('#speaker').append('<option value="' + email + '">' + name + '</option>');
        }
        // Inisialisasi kembali atau perbarui tampilan select2 untuk elemen speaker
        // $('#speaker-add').select2();
        // Trigger change event to update Select2
        $('#speaker').trigger('change');
        });
    });

    $("#basic").on('click', '.delete', function(){
        var id    = $(this).attr('data-id');

        $.ajax({
            url: "{{ url('/qfd-edit') }}",
            type: "GET",
            data: {
                'id' : id
            },
            dataType: "JSON",
            success: function(data) {
                $('#delete_id').val(data.id);
                $('#delete_proses').val(data.proses);
                $('#deleteRowModal').modal('show');
            }
        });
    });
    function getCustomer(){
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
                reqDeliv = data[0].	REQDELIVDATPO
                rd = new Date(reqDeliv)
                deliv = ('0' + rd.getDate()).slice(-2) + '-' + 
                    ('0' + (rd.getMonth() + 1)).slice(-2) + '-' + 
                    rd.getFullYear();
                qty = parseInt(data[0].QTY)
                $('#customer').val(cust + " - " + data[0].ENDCUSTNAME);
                $('#customerpo').val(data[0].ENDCUSTPO);
                $('#projectName').val(qty + " " + data[0].UOM + " " + data[0].ENDCUSTNAME + " - " + product );
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
            console.log(selectedAttendance,name)
            $('#speaker').append('<option value="' + email + '">' + name + '</option>');
        }

        // Inisialisasi kembali atau perbarui tampilan select2 untuk elemen speaker
        $('#speaker').select2();
    });

</script>
@endsection