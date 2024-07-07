@extends('qfd.layouts.master')

@section('content')
<div class="page-inner">
    <div class="page-header"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Management End Customer</h4>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title"></h4>
                        <button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
                            <i class="fa fa-plus"></i>
                            Add Row
                        </button>
                    </div>
                </div>
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
                    <!-- Add Modal -->
                    <div class="modal fade" id="addRowModal" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header no-bd">
                                    <h5 class="modal-title"><b>New End Customer</b></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <form action="{{ url('customer-store') }}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="customer_code">Customer Code<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" placeholder="Customer Code" name="customer_code" id="customer_code" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="customer_desc">Customer<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" placeholder="Customer" name="customer_desc" id="customer_desc" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="alias">Alias<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" placeholder="Alias" name="alias" id="alias" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="title">Title<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" placeholder="Title" name="title" id="title" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="street">Street<span class="text-danger">*</span></label>
                                                    <textarea class="form-control" placeholder="Street" name="street" id="street" required></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="city">City<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" placeholder="City" name="city" id="city" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="postal_code">Postal Code<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" placeholder="Postal Code" name="postal_code" id="postal_code" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer no-bd">
                                        <button type="submit" class="btn btn-primary">Add</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Modal -->

                    <div class="modal fade" id="editRowModal" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header no-bd">
                                    <h5 class="modal-title"><b>Edit Customer</b></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <form action="{{url('/customer-update') }}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="hidden" name="id" id="id">
                                                <div class="form-group">
                                                    <label for="customer_code">Customer Code<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" placeholder="Customer Code" name="customer_code" id="customer_code1">
                                                </div>
                                                <div class="form-group">
                                                    <label for="customer_desc">Customer<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" placeholder="Customer" name="customer_desc" id="customer_desc1" >
                                                </div>
                                                <div class="form-group">
                                                    <label for="alias">Alias<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" placeholder="Alias" name="alias" id="alias1" >
                                                </div>
                                                <div class="form-group">
                                                    <label for="title">Title<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" placeholder="Title" name="title" id="title1" >
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="street">Street<span class="text-danger">*</span></label>
                                                    <textarea class="form-control" placeholder="Street" name="street" id="street1" ></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="city">City<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" placeholder="City" name="city" id="city1" >
                                                </div>
                                                <div class="form-group">
                                                    <label for="postal_code">Postal Code<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" placeholder="Postal Code" name="postal_code" id="postal_code1">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer no-bd">
                                        <button type="submit" class="btn btn-primary">Edit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    

                    <!-- Delete Modal -->
                    <div class="modal fade" id="deleteRowModal" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header no-bd">
                                    <h5 class="modal-title"><b>Delete</b></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <form action="{{ url('/customer-delete') }}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <input hidden type="text" name="id" id="delete_id">
                                                Yakin ingin menghapus data customer?
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer no-bd">
                                        <button type="submit" class="btn btn-primary btn-sm">Delete</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="basic" class="table table-striped table-bordered table-hover dataTable" role="grid" aria-describedby="add-row_info">
                            <thead class="table-light">
                                <tr style="background-color: #5A639C; color: white;" role="row">
                                    <th style="width:5%">No</th>
                                    <th style="width:25%">Customer Code</th>
                                    <th style="width:30%">Customer</th>
                                    <th style="width:10%">Alias</th>
                                    <th style="width:40%">Street</th>
                                    <th style="width:20%">City</th>
                                    <th style="width:20%">Postal Code</th>
                                    <th style="width:20%">Title</th>
                                    <th style="width:10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @foreach($customer as $value)
                                <tr role="row" class="odd">
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $value->customer_code }}</td>
                                    <td>{{ $value->customer_desc }}</td>
                                    <td>{{ $value->alias }}</td>
                                    <td>{{ $value->street }}</td>
                                    <td>{{ $value->city }}</td>
                                    <td>{{ $value->postal_code }}</td>
                                    <td>{{ $value->title }}</td>
                                    <td>
                                        <div class="form-button-action">
                                            <a href="#" type="button" data-toggle="tooltip" title="Edit" class="btn btn-link btn-primary btn-lg edit" data-original-title="Edit" data-id="{{ $value->id }}">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <a href="#" type="button" data-toggle="tooltip" title="Delete" class="btn btn-link btn-danger btn-lg delete" data-original-title="Delete" data-id="{{ $value->id }}">
                                                <i class="fa fa-trash"></i>
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

$(document).ready(function() {
    $('#basic').DataTable();      
});

    $("#basic").on('click', '.edit', function() {
    var id = $(this).attr('data-id');
    $.ajax({
        url: "{{ url('/customer-edit') }}", 
        type: "GET",
        data: {
            'id': id
        },
        dataType: "JSON",
        success: function(data) {
            console.log(data);
            $('#id').val(data.id);
            $('#customer_code1').val(data.customer_code);
            $('#customer_desc1').val(data.customer_desc);
            $('#alias1').val(data.alias);
            $('#title1').val(data.title);
            $('#street1').val(data.street);
            $('#city1').val(data.city);
            $('#postal_code1').val(data.postal_code);
            // $('#customer-edit').val(data.customer);
            // Menampilkan modal
            $('#editRowModal').modal('show');
        },
    });
});


    $("#basic").on('click', '.delete', function(){
        var id = $(this).attr('data-id');
        $.ajax({
            url: "{{ url('/customer-edit') }}",
            type: "GET",
            data: { 'id' : id },
            dataType: "JSON",
            success: function(data) {
                console.log(data);  // Debugging line to check data in browser console
                $('#delete_id').val(data.id);
                $('#deleteRowModal').modal('show');
            }
        });
    });
</script>
@endsection