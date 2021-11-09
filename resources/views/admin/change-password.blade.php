@extends( 'layouts.admin' )

@section('title','Change Password')

@section('style')
@endsection

@section('content')
<!--main content start-->
<div id="content" class="ui-content">
<!--page header start-->
<div class="page-head-wrap">
                    <h4 class="margin0">
                    Change Password
                    </h4>
                    <div class="breadcrumb-right">
                        <ol class="breadcrumb">
                            <li><a href="{{asset('/admin/dashboard')}}">Home</a></li>
                            <li class="active"> Change Password</li>
                        </ol>
                    </div>
                </div>
                <!--page header end-->

                <div class="ui-content-body">

                    <div class="ui-container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel">
                                    <header class="panel-heading">
                                    Change Password
                                        <span class="tools pull-right">
                                            <a class="refresh-box fa fa-repeat" href="javascript:;"></a>
                                            <a class="collapse-box fa fa-chevron-down" href="javascript:;"></a>
                                            <a class="close-box fa fa-times" href="javascript:;"></a>
                                        </span>
                                    </header>
                                    <div class="panel-body">
                                        <div class="form">
                                        <form class="cmxform form-horizontal " id="pass-form">
                                                    {{ csrf_field() }}
                                                <div class="form-group ">
                                                    <label for="curpass" class="control-label col-lg-3">Current Password</label>
                                                    <div class="col-lg-6">
                                                        <input class=" form-control" id="curpass" name="curpass" type="password" required="required"/>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label for="newpass" class="control-label col-lg-3">New Password</label>
                                                    <div class="col-lg-6">
                                                        <input class=" form-control" id="pass1" name="newpass" type="password" required="required"/>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label for="newpass2" class="control-label col-lg-3">Confirm New Pasword</label>
                                                    <div class="col-lg-6">
                                                        <input class=" form-control" id="pass2" onkeyup="checkPass(); return false;"  name="newpass2" type="password" required="required"/>
                                                        <span id="confirmMessage" class="confirmMessage"></span>
                                                    </div>
                                                </div>
                                                                                             
                                                <div class="form-group">
                                                    <div class="col-lg-offset-3 col-lg-6">
                                                        <button class="btn btn-primary" type="submit">Update Password</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!--main content end-->
@endsection

@section('script')
<script>

$('#pass-form').submit(function(e){
		e.preventDefault();
        //$('#admin-edit').modal('hide');
            open_loader('#page');
               
		var form = $("#pass-form")[0];
		var _data = new FormData(form);
		$.ajax({
			url: '{{url("admin/update-password")}}',
			data: _data,
			enctype: 'multipart/form-data',
			processData: false,
			contentType:false,
			type: 'POST',
			success: function(data){
				//$("#blog").modal("toggle");
				if(data.status == "success"){
					toastr.success(data.message, data.status);
					window.setTimeout(function(){location.reload();},2000);
                    close_loader('#page');
                    } else{
                        toastr.error(data.message, data.status);
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