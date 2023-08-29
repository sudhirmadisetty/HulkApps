@extends('layout')
  
@section('content')

{{-- message --}}

<style>
    .upload{
     width: 100%;
      height: 98px;
      background-color: rgb(233, 236, 239);
      border: 1px solid #ced4da;
      border-radius: 4px;
      display: flex;
      justify-content: center;
      align-items: center;
      margin-bottom: 30px;
      cursor: pointer;
      text-align: center;
}
</style>
<div class="container m-3">
    <div class="row justify-content-center">
        <div class="col-md-12 mr-4">
            <div class="cmn_card_view mb-3 cmn_ttl_sec">
                <div class="row">
                    <div class="col-md-6 lft">
                        <h4>Student Management</h4>
                        <h6>view the student data & manage the data</h6> 
                    </div>
                    <div class="col-md-6 d-flex justify-content-end">
                        <div class="icon_with_cnts"> <i class="fas fa-user-friends"></i>
                            <aside> <strong>{{ $student->count() }}</strong> <span>Total Students</span> </aside>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row justify-content-center">
        <div class="col-md-12 mr-4">
            <div class="cmn_card_view mb-3 cmn_ttl_sec">
                <div class="row">
                    <div class="col-md-6">
					    <p class="cnt_p_span"> Total registered students showing <b>{{ $student_reg->count() }}</b> in this platform</p>
				    </div>
                    <div class="col-md-6 text-right">

                    <?php  if(Auth::user()->role == 'admin') { ?> 
                        
                    <a href="{{ route('export.students') }}" class="btn cmn_btn cta_one mr-2">
                        Export Data
                    </a>

                    <button class="btn cmn_btn cta_one mr-2" data-toggle="modal" data-target="#add_bulk_upload"> 
                        Bulk Upload 
                    </button> 

                    <?php } ?>

                    <button class="btn cmn_btn cta_one" data-toggle="modal" data-target="#add_role"> 
                        Register 
                    </button> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 mt-3">
                        @if($student_reg->isEmpty())
                        <div class="alert alert-warning"> <strong> There are no students registered yet! </strong> </div>
                        @else
                            <table id="dataTable" class="table table-striped table-hover custom-table">
                                <thead>
                                    <tr>
                                        <th scope="col">S.no</th>
                                        <th scope="col">Student Name</th>
                                        <th scope="col">Student Email</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Student Address</th>
                                        <th scope="col">Created on </th>
                                        <?php  if(Auth::user()->role == 'admin') { ?> 
                                        <th scope="col">Action</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($student_reg as $key => $role)
                                    <tr>
                                        <td> {{ $key + 1 }} </td>
                                        <td> {{ $role->name }} </td>
                                        <td> {{ $role->email }} </td>
                                        <td> 
                                            @if($role->verification->status == true)
                                            <span class="badge badge-success">Verified</span>
                                            @else 
                                            <span class="badge badge-danger">Pending</span>
                                            @endif            
                                        </td>
                                        <td> {{ $role->address }} </td>
                                        <td> {{ $role->created_at->translatedFormat('j F Y') }} </td>
                                        <?php  if(Auth::user()->role == 'admin') { ?> 
                                        <td>  
                                            <a href="#" class="text-dark" role="button" onclick="edit_Modal(this)" data-name="{{$role->name}}" data-target="#editModal" data-toggle="modal" data-id="{{$role->id}}" data-email="{{$role->email}}" data-address="{{$role->address}}" data-dob="{{$role->date_of_birth}}" data-photo="{{$role->photo}}"><i class="fas fa-edit"></i></a>
                                        </td>
                                        <?php } ?>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>



<!-- Add Role Modal -->
<div id="add_role" class="modal custom-modal fademt-5 justify-content-center" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Please Register Youself</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('register-add') }}" method="POST">
                    @csrf
                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Student Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="name" name="name" placeholder="Enter Name" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Student Email <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="email" name="email" placeholder="Enter Email" required>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-form-label">Date of Birth <span class="text-danger">*</span></label>
                                <input class="form-control" type="date" id="dob" name="dob" placeholder="Chose DOB" required>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-form-label">Upload Photo </label>
                                <input class="form-control" type="file" id="dob" name="photo" placeholder="Upload Photo">
                            </div>
                        </div>

                        <div class="col-sm-4"></div>

                        <div class="col-sm-12">
                            <label class="col-form-label">Student Address <span class="text-danger">*</span></label>
                            <textarea class="form-control" name="address" placeholder="Enter Address" required></textarea>
                        </div>
                    </div>  

                    <div class="submit-section mt-3">
                        <div class="form-group text-center">
                            <button class="btn btn cmn_btn cta_one">Register</button>
                        </div>
                        
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<!-- /Add student role Modal -->


 <!-- Edit student Modal -->
 <div id="editModal" class="modal custom-modal fademt-5" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Please Edit Registration Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('register-edit') }}" method="POST">
                    {{ method_field('POST') }}

                    @csrf
                    <input type="hidden" class="form-control" id="id" name="id">

                    <div class="row">
                    <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Student Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="name" name="name" >
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-form-label">Student Email <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="email" name="email" placeholder="Enter Email">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-form-label">Date of Birth <span class="text-danger">*</span></label>
                                <input class="form-control" type="date" id="dob" name="dob" placeholder="Chose DOB">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-form-label">Upload Photo </label>
                                <input class="form-control" type="file" id="dob" name="photo" placeholder="Upload Photo">
                            </div>
                        </div>

                        <div class="col-sm-4"></div>

                        <div class="col-sm-12">
                            <label class="col-form-label">Student Address <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="address" name="address" placeholder="Enter Address"></textarea>
                        </div>
                    </div>  
                    </div>

                    <div class="submit-section mt-3">
                        <div class="form-group text-center">
                            <button class="btn btn cmn_btn cta_one">Update Record</button>
                        </div> 
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>
<!-- /Edit Student Modal -->



<!-- bulk excel upload by admin "add_bulk_upload" btn -->
<div class="modal fademt-5 pt-5" style="top:15px;" id="add_bulk_upload" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Bulk Upload Students</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="uploadForm" action="{{ route('bulk-register-add') }}" method="POST" enctype="multipart/form-data">
      <div class="modal-body">
        <h6 class="text-grey">Please follow the instruction for excel upload.</h6>
        <h6 class="text-grey">How to upload?</h6>
        <ul class="text-grey">
            <li>Download a <a href="{{ asset('excel/sample_bulk_upload.xlsx') }}" target="_blank">template.</a></li>
            <li>Add your data to the template file.</li>
            <li>Upload it below for processing.</li>
        </ul><hr>

        @csrf
        <div class="form-group text-center upload">
            <label for="excel_file text-center ml-2">
                <i class="fas fa-upload"></i><br>
				&nbsp;Upload filled excel template here</label> <br>
                <input type="file" class="form-control-file text-center" id="excel_file" accept=".xlsx,.xls" name="excel_file">
        </div>
        
        <div class="form-group text-center">
            <button type="submit" class="btn btn cmn_btn cta_one">Upload</button> 
        </div>

      </div>
      </form>

    </div>
  </div>
</div>

<script type="text/javascript">
     //fetching pre-data from db for edit 
     function edit_Modal(el) {
            var link = $(el) 
            var modal = $("#editModal") //your modal id

            //here we have 5 field to update
            var name = link.data('name')
            var id = link.data('id')
            var email = link.data('email')
            var address = link.data('address')
            var dob = link.data('dob')
            var photo = link.data('photo')

            modal.find('#name').val(name);
            modal.find('#id').val(id);
            modal.find('#email').val(email);
            modal.find('#address').val(address);
            modal.find('#dob').val(dob);
            modal.find('#photo').val(photo);
        }
</script>
@endsection