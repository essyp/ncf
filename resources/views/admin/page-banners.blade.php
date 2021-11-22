@extends( 'layouts.admin' )

@section('title','Ministry Setup')

@section('style')
<!--summer note-->
<link rel="stylesheet" href="{{asset('admins/bower_components/summernote/dist/summernote.css')}}">
@endsection

@section('content')
<!--main content start-->
<div id="content" class="ui-content">
<!--page header start-->
<div class="page-head-wrap">
                    <h4 class="margin0">
                    Ministry Setup Information
                    </h4>
                    <div class="breadcrumb-right">
                        <ol class="breadcrumb">
                            <li><a href="{{asset('/admin/dashboard')}}">Home</a></li>
                            <li class="active">Setup</li>
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
                                    Company Informations
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
                                                    <label for="com_fullname" class="control-label col-lg-3">Ministry Full Name</label>
                                                    <div class="col-lg-6">
                                                        <input class=" form-control" name="fullname" value="{{$com->fullname}}" type="text" />
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label for="com_shortname" class="control-label col-lg-3">Ministry Short Name</label>
                                                    <div class="col-lg-6">
                                                        <input class=" form-control" name="shortname" value="{{$com->shortname}}" type="text" />
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label for="com_email" class="control-label col-lg-3">Email Address</label>
                                                    <div class="col-lg-6">
                                                        <input class=" form-control" name="email" value="{{$com->email}}" type="email" />
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label for="com_email2" class="control-label col-lg-3">Email Address2</label>
                                                    <div class="col-lg-6">
                                                        <input class="form-control " name="email2" value="{{$com->email2}}" type="email" />
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label for="com_tel" class="control-label col-lg-3">Tel</label>
                                                    <div class="col-lg-6">
                                                        <input class="form-control " name="tel" value="{{$com->tel}}" type="tel" />
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label for="com_tel2" class="control-label col-lg-3">Tel2</label>
                                                    <div class="col-lg-6">
                                                        <input class="form-control " name="tel2" value="{{$com->tel2}}" type="tel" />
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label for="com_tel3" class="control-label col-lg-3">Tel3</label>
                                                    <div class="col-lg-6">
                                                        <input class="form-control " name="tel3" value="{{$com->tel3}}" type="tel" />
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label for="com_address" class="control-label col-lg-3">Ministry Main Address</label>
                                                    <div class="col-lg-6">
                                                        <input class="form-control " name="address" value="{{$com->address}}" type="text" />
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label for="com_address2" class="control-label col-lg-3">Ministry Address2</label>
                                                    <div class="col-lg-6">
                                                        <input class="form-control " name="address2" value="{{$com->address2}}" type="text" />
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label for="com_shortdescrpt" class="control-label col-lg-3">Ministry Short Description</label>
                                                    <div class="col-lg-6">
                                                        <textarea class="form-control summernote" rows="5" name="shortdescrpt">{{$com->shortdescrpt}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label for="com_fulldescrpt" class="control-label col-lg-3">Ministry Full Description</label>
                                                    <div class="col-lg-6">
                                                        <textarea class="form-control summernote" rows="5" name="fulldescrpt">{{$com->fulldescrpt}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label for="com_vision" class="control-label col-lg-3">Ministry Vision</label>
                                                    <div class="col-lg-6">
                                                        <textarea class="form-control" rows="5" name="vision">{{$com->vision}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label for="com_mission" class="control-label col-lg-3">Ministry Mission</label>
                                                    <div class="col-lg-6">
                                                        <textarea class="form-control" rows="5" name="mission">{{$com->mission}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label for="com_value" class="control-label col-lg-3">Ministry Core Values</label>
                                                    <div class="col-lg-6">
                                                        <textarea class="form-control" rows="5" name="value">{{$com->value}}</textarea>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group ">
                                                    <label for="to_join" class="control-label col-lg-3">What it takes to join and become a member of the prayer group</label>
                                                    <div class="col-lg-6">
                                                        <textarea class="form-control summernote" rows="5" name="to_join">{{$com->to_join}}</textarea>
                                                    </div>
                                                </div>
                                                {{-- <div class="form-group ">
                                                    <label for="benefits" class="control-label col-lg-3">Benefits for  joining the prayer group</label>
                                                    <div class="col-lg-6">
                                                        <textarea class="form-control summernote" rows="5" name="benefits">{{$com->benefits}}</textarea>
                                                    </div>
                                                </div> --}}
                                                <div class="form-group ">
                                                    <label for="history" class="control-label col-lg-3">Our History</label>
                                                    <div class="col-lg-6">
                                                        <textarea class="form-control summernote" rows="5" name="history">{{$com->history}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label for="com_fulldescrpt" class="control-label col-lg-3">Privacy Policy</label>
                                                    <div class="col-lg-6">
                                                        <textarea class="form-control summernote" rows="5" id="privacy" name="privacy">{{$com->privacy}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label for="com_fulldescrpt" class="control-label col-lg-3">Terms & Conditions of Use</label>
                                                    <div class="col-lg-6">
                                                        <textarea class="form-control summernote" rows="5" id="terms" name="terms">{{$com->terms}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="currency" class="control-label col-lg-3">Currency</label>
                                                    <div class="col-lg-6">
                                                        <select class=" form-control" id="currency" name="currency">
                                                        <option value="{{$com->currency}}">{{$com->currency}}</option>
                                                        <option value="&#8358;">Naira - ₦</option>
                                                        <option value="$">Dollar - $</option>
                                                        <option value="£">Pounds - £</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- <div class="form-group ">
                                                    <label for="com_tel3" class="control-label col-lg-3">Youtube Video ID</label>
                                                    <div class="col-lg-6">
                                                        <input class="form-control " name="youtube_video" value="{{$com->youtube_video}}" type="text" />
                                                    </div>
                                                </div> -->
                                                <div class="form-group ">
                                                    <label for="com_logo" class="control-label col-lg-3">Favicon</label>
                                                    <div class="col-lg-4">
                                                        <input class="form-control " id="favicon" name="favicon" type="file" />
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <img id="blah2" src="{{asset('images/logo/'.$com->favicon)}}" style="max-width: 20px; max-height: 20px"/>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label for="com_logo" class="control-label col-lg-3">Company Logo</label>
                                                    <div class="col-lg-4">
                                                        <input class="form-control " id="logo" name="image" type="file" />
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <img id="blah1" src="{{asset('images/logo/'.$com->logo)}}" style="max-width: 50px; max-height: 50px"/>
                                                    </div>
                                                </div>

                                                <div class="form-group ">
                                                    <label for="com_logo" class="control-label col-lg-3">About Image</label>
                                                    <div class="col-lg-4">
                                                        <input class="form-control " id="about" name="about" type="file" />
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <img id="blah3" src="{{asset('images/logo/'.$com->about)}}" style="max-width: 50px; max-height: 50px"/>
                                                    </div>
                                                </div>

                                                <div class="form-group ">
                                                    <label for="background" class="control-label col-lg-3">Background Image</label>
                                                    <div class="col-lg-4">
                                                        <input class="form-control " id="background" name="background" type="file" />
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <img id="blah4" src="{{asset('images/logo/'.$com->background_image)}}" style="max-width: 50px; max-height: 50px"/>
                                                    </div>
                                                </div><br>

                                                <h3>For Search Engines</h3>
                                                <div class="form-group ">
                                                    <label for="com_keywords" class="control-label col-lg-3">Meta Keywords</label>
                                                    <div class="col-lg-6">
                                                        <textarea class="form-control" rows="5" name="keywords">{{$com->keywords}}</textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label for="com_descrpt" class="control-label col-lg-3">Meta Short Description</label>
                                                    <div class="col-lg-6">
                                                        <textarea class="form-control" rows="5" name="meta_descrpt">{{$com->meta_descrpt}}</textarea>
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
<!--summer note-->
<script src="{{asset('admins/bower_components/summernote/dist/summernote.js')}}"></script>
<script>
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 300,                 // set editor height
            minHeight: null,             // set minimum height of editor
            maxHeight: null,             // set maximum height of editor
            focus: true,
            fontSizes: ['8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18'],
            fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Helvetica', 'Impact', 'Tahoma', 'Times New Roman', 'Verdana', 'Roboto'],
            fontNamesIgnoreCheck: ['Roboto'],
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['style', 'bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'hr']],
                ['view', ['fullscreen', 'codeview']],
                ['help', ['help']]
            ]
        });
    });

function readURL1(input) {
    if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
        $('#blah1').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
    }
}

$("#logo").change(function() {
   readURL1(this);
});

function readURL2(input) {
    if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
        $('#blah2').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
    }
}

$("#favicon").change(function() {
   readURL2(this);
});

function readURL3(input) {
    if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
        $('#blah3').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
    }
}

$("#about").change(function() {
    readURL3(this);
});

function readURL4(input) {
    if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
        $('#blah4').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
    }
}

$("#background").change(function() {
    readURL4(this);
});


$('#edit-form').submit(function(e){
		e.preventDefault();
        //$('#team-edit').modal('hide');
            open_loader('#page');

		var form = $("#edit-form")[0];
		var _data = new FormData(form);
		$.ajax({
			url: '{{url("admin/update-company")}}',
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
