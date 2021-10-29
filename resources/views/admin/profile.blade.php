@extends( 'layouts.admin' )

@section('title','Account Update')

@section('style')
@endsection

@section('content')
<!--main content start-->
<div id="content" class="ui-content ">
                <div class="ui-content-body">

                    <div class="ui-container">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel profile-wrap">
                                    <header class="panel-heading clearfix">
                                        <h3 class="profile-title pull-left">{{$admin->fname}} {{$admin->lname}}</h3>
                                        
                                    </header>
                                    <div class="panel-body row">
                                        <div class="col-md-4">
                                            <div class="profile-thumb">
                                            @if(!empty($admin->image))
                                                <img src="{{asset('images/users/'.$admin->image)}}" style="border-radius: 50px; max-height: 150px; max-width: 150px" alt=""/>
                                                @else
                                                <img src="{{asset('images/avatar.png')}}" style="border-radius: 50px; max-height: 150px; max-width: 150px" alt=""/>
                                                @endif
                                            </div>
                                            <div class="profile-info">
                                                <h5>General</h5>
                                                <ul class="list-unstyled">
                                                    <li>
                                                        <i class="fa fa-mortar-board"></i>
                                                        <div class="p-i-list">
                                                            <span class="text-muted">Admin Role</span>
                                                            @if($admin->role==ADMIN)
                                                            <span style="color: green">ADMIN</span>
                                                            @elseif($admin->role==SUPER_ADMIN)
                                                            <span style="color: green">SUPER ADMIN</span>
                                                            @elseif($admin->role==MANAGER)
                                                            <span style="color: green">MANAGER</span>
                                                            @endif
                                                        </div>
                                                    </li>
                                                   
                                                </ul>
                                            </div>


                                            <div class="profile-info">
                                                <ul class="list-unstyled">
                                                    <li>
                                                        <i class="fa fa-headphones"></i>
                                                        <div class="p-i-list">
                                                            <span class="text-muted">Mobile Number</span>
                                                            {{$admin->tel}}
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-envelope-o"></i>
                                                        <div class="p-i-list">
                                                            <span class="text-muted">E-mail</span>
                                                            {{$admin->email}}
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-map-marker"></i>
                                                        <div class="p-i-list">
                                                            <span class="text-muted">Address</span>
                                                            {{$admin->address}}
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="profile-tabs">
                                                <ul class="nav nav-tabs">
                                                    <li class="active"> <a href="#tab2"data-toggle="tab">Edit Profile</a></li>
                                                </ul>
                                                <div class="tab-content">
                                                    <div id="tab2" class="tab-pane fade in active">
                                                    <form class="cmxform form-horizontal " id="edit-form">
                                                    {{ csrf_field() }}
                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label">First Name</label>
                                                                <div class="col-sm-8"><input type="text" name="fname" class="form-control" value="{{$admin->fname}}"></div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label">Last Name</label>
                                                                <div class="col-sm-8"><input type="text" name="lname" class="form-control" value="{{$admin->lname}}"></div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label">Email</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" name="email" class="form-control" value="{{$admin->email}}" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label">Phone</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" name="tel" class="form-control" value="{{$admin->tel}}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group"><label class="col-sm-3 control-label">Address</label>
                                                                <div class="col-sm-8">
                                                                    <textarea class="form-control" name="address" rows="5">{{$admin->address}}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label">Profile Picture</label>
                                                                <div class="col-sm-5">
                                                                    <input type="file" name="image" id="imgInp2" class="form-control">
                                                                </div>
                                                                <div class="col-sm-3">
                                                                @if(!empty($admin->image))
                                                                    <img id="blah2" src="{{asset('images/users/'.$admin->image)}}" style="max-width: 100px; max-height: 100px"/>
                                                                    @else
                                                                    <img id="blah2" src="{{asset('images/avatar.png')}}" style="max-width: 100px; max-height: 100px"/>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="col-sm-offset-3 col-sm-5">
                                                                <input class="form-control" type="hidden" name="id" id="id" value="{{$admin->id}}" required="">
                                                                    <button type="submit" class="btn btn-sm btn-primary">
                                                                        Update Profile
                                                                    </button>
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

                    </div>

                </div>
            </div>
            <!--main content end-->
@endsection

@section('script')
<script>
function readURL(input) {

if (input.files && input.files[0]) {
var reader = new FileReader();

reader.onload = function(e) {
    $('#blah2').attr('src', e.target.result);
}

reader.readAsDataURL(input.files[0]);
}
}

$("#imgInp2").change(function() {
readURL(this);
});


$('#edit-form').submit(function(e){
		e.preventDefault();
        //$('#admin-edit').modal('hide');
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

</script>
@endsection