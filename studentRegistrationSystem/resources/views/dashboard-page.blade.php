@extends('layout')
  
@section('content')
<div class="container m-3">
    <div class="row justify-content-center">
        <div class="col-md-11">
            <div class="card">

            <div class="cmn_card_view mb-4 cmn_ttl_sec">
            <div class="row">
                <div class="col-md-6 lft">
                    <h4>Dashboard Management</h4>
                    <h6>view the student data</h6> 
                </div>
                <div class="col-md-6 d-flex justify-content-end">
                    <div class="icon_with_cnts pr-3"> <i class="fas fa-user-friends"></i>
                        <aside> <strong>{{ $student->count() }}</strong> <span>Total Students</span> </aside>
                    </div>
                    <?php  if (Auth::user()->role == 'admin') { ?>  
                    <div class="icon_with_cnts"> <i class="fas fa-user-friends"></i>
                        <aside> <strong>{{ $admin->count() }}</strong> <span>Total Admins</span> </aside>
                    </div>
                    <?php } ?> 
                </div>
            </div>

            <div class="row m-3 mt-5">
                <div class="col-md-6 justify-content-center">
                <?php  if(Auth::user()->role == 'admin') { ?> 
                    <h3 class="text-secondary"> Hi <?php print(Auth::user()->name); ?>, <br>
                    Welcome to Admin Portal!</h3>        
                <?php } else{  ?>
                    <h3 class="text-secondary"> Hi <?php print(Auth::user()->name); ?> <br>
                    Welcome to Employee Portal! </h3>
                </div>
                <?php }  ?>
            </div>
                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection