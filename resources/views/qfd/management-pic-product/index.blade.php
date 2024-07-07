@extends('qfd.layouts.master')
@section('content')
<div class="page-inner">
    <div class="page-header">
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Management PIC Product</h4>
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
                            Add PIC Product
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
                                        <b>New PIC Product</b>   
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <form action="{{url('pic-store')}}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row" >
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="pic">PIC<span class="text-danger">*</span></label>
                                                    <select class="form-control" name="name" id="name" onchange="getEmail()">
                                                        <option value="">select an option</option>
                                                        @foreach($user as $item)
                                                        <option value="{{ $item->name }}">{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" placeholder="Email" name="email" id="email" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="initial">Initial PIC<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" placeholder="Initial PIC" name="initial" id="initial" required>
                                                    
                                                </div>
                                                <div class="form-group">
                                                    <label for="gproduct">Group Product<span class="text-danger">*</span></label>
                                                    <select class="form-control" name="gproduct" id="gproduct" required>
                                                        <option value="">select an option</option>
                                                        @foreach($groupProducts as $gp)
                                                        <option value="{{$gp->group_product}}">{{ $gp->group_product }}</option>
                                                        @endforeach
                                                    </select>
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
                                        <b>Edit PIC Produk</b>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <form action="{{url('/pic-update')}}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <input  type="hidden" name="id" id="id" >
                                        <div class="row" >
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="pic">PIC<span class="text-danger">*</span></label>
                                                    <select class="form-control" name="name" id="name1" onchange="getEmail()">
                                                        @foreach($user as $item)
                                                            <option value="{{ $item->name }}">{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" placeholder="Email" name="email" id="email1">
                                                </div>
                                                <div class="form-group">
                                                    <label for="initial">Initial PIC<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" placeholder="Initial PIC" name="inisial_nama" id="initial1">
                                                </div>
                                                <div class="form-group">
                                                    <label for="gproduct">Group Product<span class="text-danger">*</span></label>
                                                    <select class="form-control" name="gproduct" id="gproduct" required>
                                                        @foreach($groupProducts as $gp)
                                                        <option value="{{$gp->group_product}}">{{ $gp->group_product }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                {{-- <div class="form-group">
                                                    <label for="gproduct">Group Product<span class="text-danger">*</span></label>
                                                    <input type="dropdown" class="form-control" placeholder="Group Product" name="gproduct" id="gproduct1">
                                                </div> --}}
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
                                        <b>Delete PIC  Produk</b>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <form action="{{url('/pic-delete')}}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row" >
                                            <div class="col-sm-12">
                                                <input hidden type="text" name="id" id="delete_id" >
                                                    Yakin ingin menghapus data PIC Produk ?
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
                                    <th style="width:25%">PIC</th>
                                    <th style="width:30">Email</th>
                                    <th style="width:10%">Initial PIC</th>
                                    <th style="width:20%">Group Product</th>
                                    <th style="width:10%" class="sorting" tabindex="0" aria-controls="add-row" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                                <?php $i = 0; ?>
                                
                                @foreach($pic as $value)
                                         <tr role="row" class="odd">
                                         <td>{{ ++$i }}</td>
                                         <td>{{ $value->name }}</td>
                                         <td>{{ $value->email }}</td>
                                         <td>{{ $value->inisial_nama }}</td>
                                         <td>{{ $value->group_product }}</td>
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

   $("#basic").on('click', '.edit', function(){
    var id = $(this).attr('data-id');
    $.ajax({
        url: "{{ url('/pic-edit') }}", 
        type: "GET",
        data: {
            'id': id
        },
        dataType: "JSON",
        success: function(data) {
            console.log(data);
            $('#id').val(data.id);
            $('#name1').val(data.name); // Ini untuk dropdown list
            $('#email1').val(data.email);
            $('#initial1').val(data.inisial_nama);
            $('#gproduct1').val(data.group_product);
            // Menampilkan modal
            $('#editRowModal').modal('show');
        },
    });
});


    $("#basic").on('click', '.delete', function(){
        var id    = $(this).attr('data-id');

        $.ajax({
            url: "{{ url('/pic-edit') }}",
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

   function getEmail(){
    var name    = $("#name").val();
        $.ajax({
            url: "{{ url('/getEmail') }}?name=" + name,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                console.log(data)
                $('#email').val(data[0].email);
                // $('#delete_proses').val(data.proses);
            }
        });
   }
</script>
@endsection