@extends( 'layouts.admin' )

@section('title','Company Social Accounts')

@section('style')
@endsection

@section('content')
<!--main content start-->
<div id="content" class="ui-content">
<!--page header start-->
<div class="page-head-wrap">
                    <h4 class="margin0">
                    Social Accounts
                    </h4>
                    <div class="breadcrumb-right">
                        <ol class="breadcrumb">
                            <li><a href="{{asset('/admin/dashboard')}}">Home</a></li>
                            <li class="active"> Social Accounts</li>
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
                                    Social Accounts
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
                                                <div class="form-group ">
                                                    <label for="facebook" class="control-label col-lg-3">Facebook Account</label>
                                                    <div class="col-lg-6">
                                                        <input class=" form-control" id="facebook" name="facebook" value="{{$com->facebook}}" type="url" />
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label for="twitter" class="control-label col-lg-3">Twitter Account</label>
                                                    <div class="col-lg-6">
                                                        <input class=" form-control" id="twitter" name="twitter" value="{{$com->twitter}}" type="url" />
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label for="instagram" class="control-label col-lg-3">Instagram Account</label>
                                                    <div class="col-lg-6">
                                                        <input class=" form-control" id="instagram" name="instagram" value="{{$com->instagram}}" type="url" />
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label for="linkedin" class="control-label col-lg-3">Linkedin Account</label>
                                                    <div class="col-lg-6">
                                                        <input class="form-control " id="linkedin" name="linkedin" value="{{$com->linkedin}}" type="url" />
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label for="youtube" class="control-label col-lg-3">Youtube Account</label>
                                                    <div class="col-lg-6">
                                                        <input class="form-control " id="youtube" name="youtube" value="{{$com->youtube}}" type="tel" />
                                                    </div>
                                                </div>
                                                                                                
                                                <div class="form-group">
                                                    <div class="col-lg-offset-3 col-lg-6">
                                                    <input class="form-control " id="id" name="id" value="{{$com->id}}" type="hidden" />
                                                        <button class="btn btn-primary" type="submit">Update Details</button>
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
			url: '{{url("admin/update-socials")}}',
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