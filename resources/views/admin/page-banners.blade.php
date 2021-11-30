@extends( 'layouts.admin' )

@section('title','Page Banners')

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
                    Page Banners
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
                                    Page Banners
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
                                                    <label class="control-label col-lg-3">NCF in Brief</label>
                                                    <div class="col-lg-4">
                                                        <input class="form-control" id="ncf_in_brief" name="ncf_in_brief" type="file" accept="image/*" />
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <img id="blah_ncf_in_brief" src="{{asset('images/banners/'.$banner->ncf_in_brief)}}" style="max-width: 50px; max-height: 50px"/>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="control-label col-lg-3">Vission & Mission Page</label>
                                                    <div class="col-lg-4">
                                                        <input class="form-control" id="vision_mission" name="vision_mission" type="file" accept="image/*" />
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <img id="blah_vision_mission" src="{{asset('images/banners/'.$banner->vision_mission)}}" style="max-width: 50px; max-height: 50px"/>
                                                    </div>
                                                </div>

                                                <div class="form-group ">
                                                    <label class="control-label col-lg-3">Milestone</label>
                                                    <div class="col-lg-4">
                                                        <input class="form-control" id="milestone" name="milestone" type="file" accept="image/*" />
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <img id="blah_milestone" src="{{asset('images/banners/'.$banner->milestone)}}" style="max-width: 50px; max-height: 50px"/>
                                                    </div>
                                                </div>

                                                <div class="form-group ">
                                                    <label class="control-label col-lg-3">Governing Bodies</label>
                                                    <div class="col-lg-4">
                                                        <input class="form-control" id="governing_bodies" name="governing_bodies" type="file" accept="image/*" />
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <img id="blah_governing_bodies" src="{{asset('images/banners/'.$banner->governing_bodies)}}" style="max-width: 50px; max-height: 50px"/>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="control-label col-lg-3">Contact us</label>
                                                    <div class="col-lg-4">
                                                        <input class="form-control" id="contact_us" name="contact_us" type="file" accept="image/*" />
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <img id="blah_contact_us" src="{{asset('images/banners/'.$banner->contact_us)}}" style="max-width: 50px; max-height: 50px"/>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="control-label col-lg-3">Habitat - Foreign Green</label>
                                                    <div class="col-lg-4">
                                                        <input class="form-control" id="habitat_foreign_green" name="habitat_foreign_green" type="file" accept="image/*" />
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <img id="blah_habitat_foreign_green" src="{{asset('images/banners/'.$banner->habitat_foreign_green)}}" style="max-width: 50px; max-height: 50px"/>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="control-label col-lg-3">Habitat - Marine Coastline</label>
                                                    <div class="col-lg-4">
                                                        <input class="form-control" id="habitat_marine_coastline" name="habitat_marine_coastline" type="file" accept="image/*" />
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <img id="blah_habitat_marine_coastline" src="{{asset('images/banners/'.$banner->habitat_marine_coastline)}}" style="max-width: 50px; max-height: 50px"/>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="control-label col-lg-3">Species</label>
                                                    <div class="col-lg-4">
                                                        <input class="form-control" id="species" name="species" type="file" accept="image/*" />
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <img id="blah_species" src="{{asset('images/banners/'.$banner->species)}}" style="max-width: 50px; max-height: 50px"/>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="control-label col-lg-3">Climate Change</label>
                                                    <div class="col-lg-4">
                                                        <input class="form-control" id="climate_change" name="climate_change" type="file" accept="image/*" />
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <img id="blah_climate_change" src="{{asset('images/banners/'.$banner->climate_change)}}" style="max-width: 50px; max-height: 50px"/>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="control-label col-lg-3">Environmental Education</label>
                                                    <div class="col-lg-4">
                                                        <input class="form-control" id="environmental_education" name="environmental_education" type="file" accept="image/*" />
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <img id="blah_environmental_education" src="{{asset('images/banners/'.$banner->environmental_education)}}" style="max-width: 50px; max-height: 50px"/>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="control-label col-lg-3">Policy Advocacy</label>
                                                    <div class="col-lg-4">
                                                        <input class="form-control" id="policy_advocacy" name="policy_advocacy" type="file" accept="image/*" />
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <img id="blah_policy_advocacy" src="{{asset('images/banners/'.$banner->policy_advocacy)}}" style="max-width: 50px; max-height: 50px"/>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="control-label col-lg-3">Our Community</label>
                                                    <div class="col-lg-4">
                                                        <input class="form-control" id="our_community" name="our_community" type="file" accept="image/*" />
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <img id="blah_our_community" src="{{asset('images/banners/'.$banner->our_community)}}" style="max-width: 50px; max-height: 50px"/>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="control-label col-lg-3">E_Library</label>
                                                    <div class="col-lg-4">
                                                        <input class="form-control" id="e_library" name="e_library" type="file" accept="image/*" />
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <img id="blah_e_library" src="{{asset('images/banners/'.$banner->e_library)}}" style="max-width: 50px; max-height: 50px"/>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="control-label col-lg-3">News Update page</label>
                                                    <div class="col-lg-4">
                                                        <input class="form-control" id="news_update" name="news_update" type="file" accept="image/*" />
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <img id="blah_news_update" src="{{asset('images/banners/'.$banner->news_update)}}" style="max-width: 50px; max-height: 50px"/>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="control-label col-lg-3">Other Resources Page</label>
                                                    <div class="col-lg-4">
                                                        <input class="form-control" id="other_resources" name="other_resources" type="file" accept="image/*" />
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <img id="blah_other_resources" src="{{asset('images/banners/'.$banner->other_resources)}}" style="max-width: 50px; max-height: 50px"/>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="control-label col-lg-3">Membership</label>
                                                    <div class="col-lg-4">
                                                        <input class="form-control" id="membership" name="membership" type="file" accept="image/*" />
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <img id="blah_membership" src="{{asset('images/banners/'.$banner->membership)}}" style="max-width: 50px; max-height: 50px"/>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="control-label col-lg-3">Bird Club Page</label>
                                                    <div class="col-lg-4">
                                                        <input class="form-control" id="bird_club" name="bird_club" type="file" accept="image/*" />
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <img id="blah_bird_club" src="{{asset('images/banners/'.$banner->bird_club)}}" style="max-width: 50px; max-height: 50px"/>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="control-label col-lg-3">Event Page</label>
                                                    <div class="col-lg-4">
                                                        <input class="form-control" id="events" name="events" type="file" accept="image/*" />
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <img id="blah_events" src="{{asset('images/banners/'.$banner->events)}}" style="max-width: 50px; max-height: 50px"/>
                                                    </div>
                                                </div>

                                                <div class="form-group ">
                                                    <label class="control-label col-lg-3">Volunteer Page</label>
                                                    <div class="col-lg-4">
                                                        <input class="form-control" id="volunteer" name="volunteer" type="file" accept="image/*" />
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <img id="blah_volunteer" src="{{asset('images/banners/'.$banner->volunteer)}}" style="max-width: 50px; max-height: 50px"/>
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label class="control-label col-lg-3">Support Nature Page</label>
                                                    <div class="col-lg-4">
                                                        <input class="form-control" id="support_nature" name="support_nature" type="file" accept="image/*" />
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <img id="blah_support_nature" src="{{asset('images/banners/'.$banner->support_nature)}}" style="max-width: 50px; max-height: 50px"/>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-lg-offset-3 col-lg-6">
                                                    <input class="form-control " id="id" name="id" value="{{$banner->id}}" type="hidden" />
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
function readURLncf_in_brief(input) {
    if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
        $('#blah_ncf_in_brief').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
    }
}

$("#ncf_in_brief").change(function() {
   readURLncf_in_brief(this);
});

function readURLvision_mission(input) {
    if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
        $('#blah_vision_mission').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
    }
}

$("#vision_mission").change(function() {
   readURLvision_mission(this);
});

function readURLmilestone(input) {
    if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
        $('#blah_milestone').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
    }
}

$("#milestone").change(function() {
    readURLmilestone(this);
});

function readURLgoverning_bodies(input) {
    if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
        $('#blah_governing_bodies').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
    }
}
$("#governing_bodies").change(function() {
    readURLgoverning_bodies(this);
});

function readURLcontact_us(input) {
    if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
        $('#blah_contact_us').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
    }
}
$("#contact_us").change(function() {
    readURLcontact_us(this);
});

function readURLhabitat_foreign_green(input) {
    if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
        $('#blah_habitat_foreign_green').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
    }
}
$("#habitat_foreign_green").change(function() {
    readURLhabitat_foreign_green(this);
});

function readURLhabitat_marine_coastline(input) {
    if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
        $('#blah_habitat_marine_coastline').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
    }
}
$("#habitat_marine_coastline").change(function() {
    readURLhabitat_marine_coastline(this);
});

function readURLspecies(input) {
    if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
        $('#blah_species').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
    }
}
$("#species").change(function() {
    readURLspecies(this);
});

function readURLclimate_change(input) {
    if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
        $('#blah_climate_change').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
    }
}
$("#climate_change").change(function() {
    readURLclimate_change(this);
});

function readURLenvironmental_education(input) {
    if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
        $('#blah_environmental_education').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
    }
}
$("#environmental_education").change(function() {
    readURLenvironmental_education(this);
});

function readURLpolicy_advocacy(input) {
    if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
        $('#blah_policy_advocacy').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
    }
}
$("#policy_advocacy").change(function() {
    readURLpolicy_advocacy(this);
});

function readURLour_community(input) {
    if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
        $('#blah_our_community').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
    }
}
$("#our_community").change(function() {
    readURLour_community(this);
});

function readURLe_library(input) {
    if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
        $('#blah_e_library').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
    }
}
$("#e_library").change(function() {
    readURLe_library(this);
});

function readURLnews_update(input) {
    if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
        $('#blah_news_update').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
    }
}
$("#news_update").change(function() {
    readURLnews_update(this);
});

function readURLother_resources(input) {
    if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
        $('#blah_other_resources').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
    }
}
$("#other_resources").change(function() {
    readURLother_resources(this);
});

function readURLmembership(input) {
    if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
        $('#blah_membership').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
    }
}
$("#membership").change(function() {
    readURLmembership(this);
});

function readURLbird_club(input) {
    if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
        $('#blah_bird_club').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
    }
}
$("#bird_club").change(function() {
    readURLbird_club(this);
});

function readURLevents(input) {
    if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
        $('#blah_events').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
    }
}
$("#events").change(function() {
    readURLevents(this);
});

function readURLvolunteer(input) {
    if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
        $('#blah_volunteer').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
    }
}
$("#volunteer").change(function() {
    readURLvolunteer(this);
});

function readURLsupport_nature(input) {
    if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
        $('#blah_support_nature').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
    }
}
$("#support_nature").change(function() {
    readURLsupport_nature(this);
});



$('#edit-form').submit(function(e){
		e.preventDefault();
        //$('#team-edit').modal('hide');
            open_loader('#page');

		var form = $("#edit-form")[0];
		var _data = new FormData(form);
		$.ajax({
			url: '{{url("admin/update-page-banner")}}',
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
