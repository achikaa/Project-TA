@extends('qfd.layouts.master')
@include('sweetalert::alert')
@section('content')
<div class="page-inner">
    <div class="page-header">
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Management Truck</h4>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h4 class="card-title"></h4>
                        <button  class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
                            <i class="fa fa-plus"></i>
                            Add Truck
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
                        <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header no-bd">
                                    <h5 class="modal-title">
                                        {{-- <span class="fw-mediumbold">
                                        New</span> 
                                        <span class="fw-light">
                                            Meeting
                                        </span> --}}
                                        <b>New Truck</b>
                                        
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <form action="{{url('truck-store')}}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row" >
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="password">Truck <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control"  placeholder="Truck"  name="truck" id="truck" required ></input>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer no-bd">
                                        <button type="submit" class="btn btn-primary">Add</button>
                                        {{-- <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> --}}
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editRowModal" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header no-bd">
                                    <h5 class="modal-title">
                                        <b>Edit Truck</b>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <form action="{{url('/truck-update')}}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <input  type="hidden" name="id" id="id" >
                                        <div class="row" >
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="password">Truck <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control"  placeholder="Truck" name="truck" id="truck-edit" >
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer no-bd">
                                        <button type="submit" class="btn btn-primary btn-sm">Edit</button>
                                        {{-- <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> --}}
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
                                    <h5 class="modal-title">
                                        <b>Delete Truck</b>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <form action="{{url('/truck-delete')}}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row" >
                                            <div class="col-sm-12">
                                                <input hidden type="text" name="id" id="delete_id" >
                                                    Yakin ingin menghapus data truck ?
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer no-bd">
                                        <button type="submit" class="btn btn-primary btn-sm">Delete</button>
                                        {{-- <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button> --}}
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                       
                        <table id="basic" class="table table table-striped table-bordered table-hover dataTable" role="grid" aria-describedby="add-row_info">
                            <thead class="table-light">
                                <tr style="background-color: #5A639C; color: white;" role="row">
                                    <th style="width:5%">No</th>
                                    <th style="width:80%">Truck</th>
                                    {{-- <th style="width:80%" class="sorting_asc" tabindex="0" aria-controls="add-row" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">Status</th> --}}
                                    <th style="width:15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                                <?php $i = 0; ?>
                                
                                @foreach($truck as $value) 
                                <tr role="row" class="odd">
                                    <td style="width:5%"> <?php $i++; ?>
                                        <?php echo $i; ?>
                                    </td>
                                    <td style="width:80%" class="sorting" tabindex="0" aria-controls="add-row" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending">{{$value->truck}}</td>
                                    <td style="width:15%">
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

    $("#basic").on('click', '.edit', function(){
        var id = $(this).attr('data-id');
        $.ajax({
            url: "{{ url('/truck-edit') }}",
            type: "GET",
            data: {
                'id' : id
            },
            dataType: "JSON", 
            success: function(data) {
                console.log(data)
                $('#id').val(data.id);
                $('#truck-edit').val(data.truck);
            $('#editRowModal').modal('show');
            }
        });
    });

    $("#basic").on('click', '.delete', function(){
        var id    = $(this).attr('data-id');

        $.ajax({
            url: "{{ url('/truck-edit') }}",
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
</script>
@endsection