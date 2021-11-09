@extends( 'layouts.admin' )

@section('title','Admin Users')

@section('style')
<!--Data Table-->
        <link href="{{asset('admins/bower_components/datatables/media/css/jquery.dataTables.css')}}" rel="stylesheet">
        <link href="{{asset('admins/bower_components/datatables-tabletools/css/dataTables.tableTools.css')}}" rel="stylesheet">
        <link href="{{asset('admins/bower_components/datatables-colvis/css/dataTables.colVis.css')}}" rel="stylesheet">
        <link href="{{asset('admins/bower_components/datatables-responsive/css/responsive.dataTables.scss')}}" rel="stylesheet">
        <link href="{{asset('admins/bower_components/datatables-scroller/css/scroller.dataTables.scss')}}" rel="stylesheet">
@endsection

@section('content')

<!--main content start-->
<div id="content" class="ui-content ui-content-aside-overlay">
                <!--page header start-->
                <div class="page-head-wrap">
                    <h4 class="margin0">
                        Admin Users
                    </h4>
                    <div class="breadcrumb-right">
                        <ol class="breadcrumb">
                            <li><a href="{{asset('/admin/dashboard')}}">Home</a></li>
                            <li class="active">Admin Users</li>
                        </ol>
                    </div>
                </div>
                <!--page header end-->

                <div class="ui-content-body">

                    <div class="ui-container">
                        <div class="row">
                            <form id="status_form" action='{{url("admin/admin-status")}}' method="POST">
                                {{ csrf_field() }}
                            <div class="col-sm-12">
                            <div class="mbot-20">
                                    <div class="btn-group">
                                       <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button" aria-expanded="false">Action <span class="caret"></span></button>
                                    <ul role="menu" class="dropdown-menu">
                                        <li><button class="btn btn-default" name="submit" type="button" onclick="status_form('active')">Active</button></li>
                                        <li><button class="btn btn-default" name="submit" type="button" onclick="status_form('inactive')">Inactive</button></li>
                                        <li class="divider"></li>
                                        <li><button class="btn btn-danger" name="submit" type="button" onclick="status_form('delete')">Delete</button></li>
                                    </ul>
                                    </div>
                                    <button type="button" data-toggle="modal" data-target="#admin" class="btn btn-default">Add New User</button>
                                </div>
                                <section class="panel">
                                    <header class="panel-heading panel-border">
                                      Admin Users
                                        <span class="tools pull-right">
                                            <a class="refresh-box fa fa-repeat" href="javascript:;"></a>
                                            <a class="collapse-box fa fa-chevron-down" href="javascript:;"></a>
                                            <a class="close-box fa fa-times" href="javascript:;"></a>
                                        </span>
                                    </header>
                                    <div class="panel-body">
                                        <table id="datatable" class="table responsive-data-table table-striped">
                                            <thead>
                                            <tr>
                                                <th><input type="checkbox" onClick="checkAllContestant()" id="chAllCon" /></th>
                                                <th>#</th>
                                                <th>Admin Name</th>
                                                <th>Email</th>
                                                <th>Phone Number</th>
                                                <th>Address</th>
                                                <th>Role</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($admin as $bl)
                                            <tr>
                                                <td><input class="contestantBox" type="checkbox" name="id[]" value="{{$bl->id}}" /> </td>
                                                @if(!empty($bl->image))
                                                <td><img src="{{asset('images/users/'.$bl->image)}}" style="max-height: 60px; max-width: 60px"></td>
                                                @else
                                                <td><img src="{{asset('images/avatar.png')}}" style="max-height: 60px; max-width: 60px"></td>
                                                @endif
                                                <td>{{$bl->fname}} {{$bl->lname}}</td>
                                                <td>{{$bl->email}}</td>
                                                <td>{{$bl->tel}}</td>
                                                <td>{{$bl->address}}</td>
                                                @if($bl->role==ADMIN)
                                                <td>ADMIN</td>
                                                @elseif($bl->role==SUPER_ADMIN)
                                                <td>SUPER ADMIN</td>
                                                @elseif($bl->role==MANAGER)
                                                <td>MANAGER</td>
                                                @endif
                                                @if($bl->status==ACTIVE)
                                                <td><span class="label label-success">Active</span></td>
                                                @else
                                                <td><span class="label label-warning">Inactive</span></td>
                                                @endif
                                                <td>
                                                <div class="btn-group">
                                                <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button" aria-expanded="false">Action <span class="caret"></span></button>
                                                    <ul role="menu" class="dropdown-menu">
                                                        <li><a href="javascript:void(0);" style="color: blue" onclick="update({{$bl}})">Update Role</a></li>
                                                        <li><a href="javascript:void(0);" style="color: blue" onclick="resetPassword({{$bl}})">Reset Password</a></li>
                                                    </ul>
                                                </div>
                                                </td>
                                            </tr>
                                                @endforeach
                                            
                                            </tbody>
                                        </table>
                                    </div>
                                </section>
                            </div>
                            </form>

                        </div>

                    </div>

                   
                </div>
            </div>
            <!--main content end-->
@endsection

<!-- Button add modal -->
<div  id="admin" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add New Admin User</h4>
            </div>
            <form class="cmxform form-horizontal " id="admin-form">
            <div class="modal-body">
            <div class="form">
                     {{ csrf_field() }}
                        <div class="form-group">
                            <label for="fname" class="control-label col-lg-3">First Name</label>
                            <div class="col-lg-9">
                                <input class=" form-control" id="fname" name="fname" type="text" required="required"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lname" class="control-label col-lg-3">Last Name</label>
                            <div class="col-lg-9">
                                <input class=" form-control" id="lname" name="lname" type="text" required="required"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="control-label col-lg-3">Email</label>
                            <div class="col-lg-9">
                                <input class=" form-control" id="email" name="email" type="text" required="required"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tel" class="control-label col-lg-3">Contact Number</label>
                            <div class="col-lg-9">
                                <input class=" form-control" id="tel" name="tel" type="text" required="required"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address" class="control-label col-lg-3">User Address</label>
                            <div class="col-lg-9">
                                <input class=" form-control" id="address" name="address" type="text"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="role" class="control-label col-lg-3">Admin Role</label>
                            <div class="col-lg-9">
                                <select class=" form-control" id="role" name="role" required="required">
                                 <option value="<?php echo ADMIN; ?>">ADMIN</option>
                                 <option value="<?php echo SUPER_ADMIN; ?>">SUPER ADMIN</option>
                                 <option value="<?php echo MANAGER; ?>">MANAGER</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="control-label col-lg-3">Password</label>
                            <div class="col-lg-9">
                                <input class=" form-control" id="pass1" name="password" type="password"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="repassword" class="control-label col-lg-3">Confirm Password</label>
                            <div class="col-lg-9">
                                <input class=" form-control" id="pass2" onkeyup="checkPass(); return false;" name="repassword" type="password"/>
                                <span id="confirmMessage" class="confirmMessage"></span>
                            </div>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
            <input class=" form-control" id="created_by" name="created_by" value="1" type="hidden" required="required"/>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>



<!-- Button edit modal -->
<div  id="editmodal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Update Admin User</h4>
            </div>
            <form class="cmxform form-horizontal " id="edit-form">
            <div class="modal-body">
            <div class="form">
                     {{ csrf_field() }}
                        <div class="form-group">
                            <label for="fname" class="control-label col-lg-3">First Name</label>
                            <div class="col-lg-9">
                                <input class=" form-control" id="editfname" name="fname" type="text" required="required"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lname" class="control-label col-lg-3">Last Name</label>
                            <div class="col-lg-9">
                                <input class=" form-control" id="editlname" name="lname" type="text" required="required"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="control-label col-lg-3">Email</label>
                            <div class="col-lg-9">
                                <input class=" form-control" id="editemail" name="email" type="text" required="required" readonly/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tel" class="control-label col-lg-3">Contact Number</label>
                            <div class="col-lg-9">
                                <input class=" form-control" id="edittel" name="tel" type="text" readonly/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address" class="control-label col-lg-3">User Address</label>
                            <div class="col-lg-9">
                                <input class=" form-control" id="editaddress" name="address" type="text"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="role" class="control-label col-lg-3">Admin Role</label>
                            <div class="col-lg-9">
                                <select class=" form-control" id="editrole" name="role" required="required">
                                 <option value="<?php echo ADMIN; ?>">ADMIN</option>
                                 <option value="<?php echo SUPER_ADMIN; ?>">SUPER ADMIN</option>
                                 <option value="<?php echo MANAGER; ?>">MANAGER</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="image" class="control-label col-lg-3">Avatar</label>
                            <div class="col-lg-6">
                                <input class=" form-control" id="imgInp" accept="image/*" name="image" type="file"/>
                            </div>
                            <div class="col-lg-3">
                                <img id="editimage" src="" style="max-width: 100px; max-height: 100px"/>
                            </div>
                        </div>
                        
                </div>
            </div>
            <div class="modal-footer">
                <input class=" form-control" id="editid" name="id" type="hidden" required="required"/>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>


<!-- Button password modal -->
<div  id="editpassword" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Reset User Password</h4>
            </div>
            <form class="cmxform form-horizontal " id="pass-form">
            <div class="modal-body">
            <div class="form">
                     {{ csrf_field() }}
                        <div class="form-group">
                            <label for="password" class="control-label col-lg-3">New Password</label>
                            <div class="col-lg-9">
                                <input class=" form-control" name="password" type="password"/>
                            </div>
                        </div>
                           
                </div>
            </div>
            <div class="modal-footer">
                <input class=" form-control" id="edit_id" name="id" type="hidden" required="required"/>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>


@section('script')
 <script>
   
function readURL(input) {

    if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
        $('#editimage').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
    }
    }

    $("#imgInp").change(function() {
    readURL(this);
});
</script>
<!--Data Table-->
        <script src="{{asset('admins/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('admins/bower_components/datatables-tabletools/js/dataTables.tableTools.js')}}"></script>
        <script src="{{asset('admins/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
        <script src="{{asset('admins/bower_components/datatables-colvis/js/dataTables.colVis.js')}}"></script>
        <script src="{{asset('admins/bower_components/datatables-responsive/js/dataTables.responsive.js')}}"></script>
        <script src="{{asset('admins/bower_components/datatables-scroller/js/dataTables.scroller.js')}}"></script>

        <!--init data tables-->
        <script src="{{asset('admins/assets/js/init-datatables.js')}}"></script>


        <script>
		
		$('#admin-form').submit(function(e){
			e.preventDefault();
            $('#admin').modal('hide');
            open_loader('#page');
			$.ajax({
				url: '{{url("admin/create-admin-user")}}',
				type: 'POST',
				data: $(this).serialize(),
				success: function(data){
                    //$("#admin").modal("toggle");
                    if(data.status == "success"){
					toastr.success(data.message);
					$( "#datatable" ).load( "{{url('/admin/admin-users')}} #datatable" );
                    close_loader('#page');
                    } else{
                        toastr.error(data.message);
                        close_loader('#page');  
                    }
				},
				error: function(result){
                    toastr.error('Check Your Network Connection !!!','Network Error');
                    close_loader('#page');
				}
			});
			return false;
        });
        
        function status_form(value) {
        open_loader('#page');
              
		var form = document.getElementById('status_form');
        var _data = new FormData(form);
        _data.append('submit',value);
        
		$.ajax({
			url: form.action,
			data: _data,
			enctype: 'multipart/form-data',
			processData: false,
			contentType:false,
			type: form.method,
			success: function(data){
				//$("#blog").modal("toggle");
				if(data.status == "success"){
                    toastr.success(data.message);
					$( "#datatable" ).load( "{{url('/admin/admin-users')}} #datatable" );
                    close_loader('#page');
                    } else{
                        toastr.error(data.message);
                        close_loader('#page');  
                    }
			},
			error: function(result){
				toastr.error('Check Your Network Connection !!!','Network Error');
                close_loader('#page');
			}
		});
		return false;
    }


    function update(event){
        //$('#modaltitle').text("Update " +event.title)
        $('#editfname').val(event.fname)
        $('#editlname').val(event.lname)
        $('#editemail').val(event.email)
        $('#edittel').val(event.tel)
        $('#editaddress').val(event.address)
        $('#editrole').val(event.role)
        $('#editid').val(event.id)
        $("#editimage").attr('src', "{{asset('images/users')}}/"+event.image)
        $('#editmodal').modal('show')
    }

    function resetPassword(event){
        $('#edit_id').val(event.id)
        $('#editpassword').modal('show')
    }

    $('#edit-form').submit(function(e){
        e.preventDefault();
        $('#editmodal').modal('hide');
            open_loader('#page');

        var form = $("#edit-form")[0];
        var _data = new FormData(form);
        $.ajax({
            url: '{{url("admin/update-admin-user")}}',
            data: _data,
            enctype: 'multipart/form-data',
            processData: false,
            contentType:false,
            type: 'POST',
            success: function(data){
                //$("#service").modal("toggle");
                if(data.status == "success"){
                    toastr.success(data.message);
                    $( "#datatable" ).load( "{{url('/admin/admin-users')}} #datatable" );
                    close_loader('#page');
                    } else{
                        toastr.error(data.message);
                        close_loader('#page');
                    }
            },
            error: function(result){
                toastr.error('Check Your Network Connection !!!','Network Error');
                close_loader('#page');
            }
        });
        return false;
    });

    $('#pass-form').submit(function(e){
			e.preventDefault();
            $('#editpassword').modal('hide');
            open_loader('#page');
			$.ajax({
				url: '{{url("admin/reset-admin-password")}}',
				type: 'POST',
				data: $(this).serialize(),
				success: function(data){
                    //$("#admin").modal("toggle");
                    if(data.status == "success"){
					toastr.success(data.message);
					$( "#datatable" ).load( "{{url('/admin/admin-users')}} #datatable" );
                    close_loader('#page');
                    } else{
                        toastr.error(data.message);
                        close_loader('#page');  
                    }
				},
				error: function(result){
                    toastr.error('Check Your Network Connection !!!','Network Error');
                    close_loader('#page');
				}
			});
			return false;
        });

    function checkAllContestant(){
    var ch =document.getElementById('chAllCon').checked,
    checked = false;
    if(ch){
        checked=true;
    }
        var els = document.getElementsByClassName('contestantBox');
        
        for(var g=0;g<els.length;g++){
            els[g].checked=checked;
        }
        
        
    }

    function checkPass(){
    //Store the password field objects into variables ...
    var pass1 = document.getElementById('pass1');
    var pass2 = document.getElementById('pass2');
    //Store the Confimation Message Object ...
    var message = document.getElementById('confirmMessage');
    //Set the colors we will be using ...
    var goodColor = "#66cc66";
    var badColor = "#ff6666";
    //Compare the values in the password field 
    //and the confirmation field
    if(pass1.value == pass2.value){
        //The passwords match. 
        //Set the color to the good color and inform
        //the user that they have entered the correct password 
        pass2.style.backgroundColor = goodColor;
        message.style.color = goodColor;
        message.innerHTML = "Passwords Match!"
    }else{
        //The passwords do not match.
        //Set the color to the bad color and
        //notify the user.
        pass2.style.backgroundColor = badColor;
        message.style.color = badColor;
        message.innerHTML = "Passwords Do Not Match!"
    }
}  
</script>

@endsection