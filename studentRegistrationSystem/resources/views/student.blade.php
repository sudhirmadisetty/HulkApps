@extends('layout')
  
@section('content')

{{-- message --}}

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
<div id="add_role" class="modal custom-modal fade justify-content-center mt-5 pt-5" style="top:15px;" role="dialog">
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
                                <input class="form-control" type="text" id="name" name="name" placeholder="Enter Name">
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
                            <textarea class="form-control" name="address" placeholder="Enter Address"></textarea>
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
 <div id="editModal" class="modal custom-modal fade mt-5 pt-5" style="top:15px;" role="dialog">
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