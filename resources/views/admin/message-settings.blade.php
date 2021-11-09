@extends( 'layouts.admin' )

@section('title','Message Settings')

@section('style')
@endsection

@section('content')
<!--main content start-->
<div id="content" class="ui-content">
<!--page header start-->
<div class="page-head-wrap">
                    <h4 class="margin0">
                    Mail Settings
                    </h4>
                    <div class="breadcrumb-right">
                        <ol class="breadcrumb">
                            <li><a href="{{asset('/admin/dashboard')}}">Home</a></li>
                            <li class="active"> Mail Settings</li>
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
                                    Mail Settings
                                        <span class="tools pull-right">
                                            <a class="refresh-box fa fa-repeat" href="javascript:;"></a>
                                            <a class="collapse-box fa fa-chevron-down" href="javascript:;"></a>
                                            <a class="close-box fa fa-times" href="javascript:;"></a>
                                        </span>
                                    </header>
                                    <div class="panel-body">
                                        <div class="form">
                                        <form class="cmxform form-horizontal " id="edit-form">
                                            {{ csrf_field() }}
                                            <!-- <h3><strong>MAIL SETTINGS</strong></h3> -->
                                                <div class="form-group ">
                                                    <label for="mail_host" class="control-label col-lg-3">Mail Host</label>
                                                    <div class="col-lg-6">
                                                        <input class=" form-control" id="mail_host" name="mail_host" value="{{$com->mail_host}}" type="text" />
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label for="mail_username" class="control-label col-lg-3">Mail Username</label>
                                                    <div class="col-lg-6">
                                                        <input class=" form-control" id="mail_username" name="mail_username" value="{{$com->mail_username}}" type="text" />
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label for="mail_password" class="control-label col-lg-3">Mail Password</label>
                                                    <div class="col-lg-6">
                                                        <input class=" form-control" id="mail_password" name="mail_password" value="{{$com->mail_password}}" type="password" />
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label for="mail_port" class="control-label col-lg-3">SMTP Port</label>
                                                    <div class="col-lg-6">
                                                        <input class="form-control " id="mail_port" name="mail_port" value="{{$com->mail_port}}" type="text" />
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label for="mail_secure" class="control-label col-lg-3">SMTP Secure</label>
                                                    <div class="col-lg-6">
                                                        <input class="form-control " id="mail_secure" name="mail_secure" value="{{$com->mail_secure}}" type="text" />
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label for="mail_debug" class="control-label col-lg-3">SMTP Debug</label>
                                                    <div class="col-lg-6">
                                                        <input class="form-control " id="mail_debug" name="mail_debug" value="{{$com->mail_debug}}" type="text" />
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label for="mail_auth" class="control-label col-lg-3">SMTP Auth</label>
                                                    <div class="col-lg-6">
                                                        <input class="form-control " id="mail_auth" name="mail_auth" value="{{$com->mail_auth}}" type="text" />
                                                    </div>
                                                </div>

                                                 <!-- <h3><strong>SMS SETTINGS</strong></h3>

                                                <div class="form-group ">
                                                    <label for="sms_host" class="control-label col-lg-3">SMS Host</label>
                                                    <div class="col-lg-6">
                                                        <input class="form-control " id="sms_host" name="sms_host" value="{{$com->sms_host}}" type="text" />
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label for="sms_username" class="control-label col-lg-3">SMS Account Username</label>
                                                    <div class="col-lg-6">
                                                        <input class="form-control " id="sms_username" name="sms_username" value="{{$com->sms_username}}" type="text" />
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label for="sms_password" class="control-label col-lg-3">SMS Account Password</label>
                                                    <div class="col-lg-6">
                                                        <input class="form-control " id="sms_password" name="sms_password" value="{{$com->sms_password}}" type="password" />
                                                    </div>
                                                </div> -->
                                                                                                
                                                <div class="form-group">
                                                    <div class="col-lg-offset-3 col-lg-6">
                                                    <input class="form-control " id="id" name="id" value="{{$com->id}}" type="hidden" />
                                                        <button class="btn btn-primary" type="submit">Update Settings</button>
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
   
$('#edit-form').submit(function(e){
		e.preventDefault();
        //$('#team-edit').modal('hide');
            open_loader('#page');
               
		var form = $("#edit-form")[0];
		var _data = new FormData(form);
		$.ajax({
			url: '{{url("admin/update-message-settings")}}',
			data: _data,
			enctype: 'multipart/form-data',
			processData: false,
			contentType:false,
			type: 'POST',
			success: function(data){
				//$("#blog").modal("toggle");
				if(data.status == "success"){
					toastr.success(data.message);
					window.setTimeout(function(){location.reload();},2000);
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

</script>
@endsection