@extends( 'layouts.admin' )

@section('title','Messages')

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
                    Messages
                    </h4>
                    <div class="breadcrumb-right">
                        <ol class="breadcrumb">
                            <li><a href="{{asset('/admin/dashboard')}}">Home</a></li>
                            <li class="active">Messages</li>
                        </ol>
                    </div>
                </div>
                <!--page header end-->

                <div class="ui-content-body">

                    <div class="ui-container">
                        <div class="row">
                            <form id="status_form" action='{{url("admin/message-status")}}' method="POST">
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
                                    <button type="button" data-toggle="modal" data-target="#new" class="btn btn-default">Add New Message</button>
                                </div>
                                <section class="panel">
                                    <header class="panel-heading panel-border">
                                    Messages
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
                                                <th>Title</th>
                                                <th>Type</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($data as $bl)
                                            <tr>
                                                <td><input class="contestantBox" type="checkbox" name="id[]" value="{{$bl->id}}" /> </td>
                                                <td>
                                                    @if($bl->type == 'video')
                                                    <iframe class="youtube-player" type="text/html" width="150" height="100" src="https://www.youtube.com/embed/{{$bl->video}}" frameborder="0" allowFullScreen></iframe>
                                                    @else
                                                    <audio controls>
                                                        <source src="{{asset('messages/'.$bl->audio)}}" type="audio/ogg" />
                                                        <source src="{{asset('messages/'.$bl->audio)}}" type="audio/mpeg" />
                                                        <a href="{{asset('messages/'.$bl->audio)}}">horse</a>
                                                    </audio>
                                                    @endif
                                                </td>
                                                <td>{{$bl->title}}</td>
                                                <td>{{$bl->type}}</td>
                                                @if($bl->status==ACTIVE)
                                                <td><span class="label label-success">active</span></td>
                                                @else
                                                <td><span class="label label-warning">inactive</span></td>
                                                @endif
                                                <td>
                                                <div class="btn-group">
                                                <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button" aria-expanded="false">Action <span class="caret"></span></button>
                                                    <ul role="menu" class="dropdown-menu">
                                                        <li><a href="javascript:void(0);" style="color: blue" onclick="update({{$bl}})">Update</a></li>
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
<div  id="new" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add New Message</h4>
            </div>
            <form class="cmxform form-horizontal " id="new-form">
            {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form">
                    
                        <div class="form-group">
                            <label for="title" class="control-label col-lg-3">Message Title</label>
                            <div class="col-lg-9">
                                <input class=" form-control" name="title" type="text" required="required"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="public_key" class="control-label col-lg-3">Type</label>
                            <div class="col-lg-9">
                                <select class=" form-control" name="type" id="check" required="required">
                                   <option disabled selected>Select Message Type</option>
                                   <option value="audio">Audio</option>
                                   <option value="video">Video</option>
                                </select>
                            </div>
                        </div>
                        <div id="video-div" style="display: none;" class="form-group">
                            <label for="secret_key" class="control-label col-lg-3">Youtube Video ID</label>
                            <div class="col-lg-9">
                                <input class=" form-control" name="video" type="text"/>
                            </div>
                        </div>
                        <div id="audio-div" style="display: none;" class="form-group">
                            <label for="image" class="control-label col-lg-3">Upload Audio File</label>
                            <div class="col-lg-9">
                                <input class=" form-control" id="imgInp" accept=".mp3,audio/*;capture=microphone" name="audio" type="file"/>
                            </div>
                        </div>

                </div>
            </div>
            <div class="modal-footer">
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
                <h4 class="modal-title" id="myModalLabel">Update Message</h4>
            </div>
            <form class="cmxform form-horizontal " id="edit-form">
            {{ csrf_field() }}
            <div class="modal-body">
            <div class="form">
                    
                        <div class="form-group">
                            <label for="title" class="control-label col-lg-3">Message Title</label>
                            <div class="col-lg-9">
                                <input class=" form-control" id="edittitle" name="title" type="text" required="required"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="public_key" class="control-label col-lg-3">Type</label>
                            <div class="col-lg-9">
                                <select class=" form-control" name="type" id="edittype" required="required">
                                   <option disabled selected>Select Message Type</option>
                                   <option value="audio">Audio</option>
                                   <option value="video">Video</option>
                                </select>
                            </div>
                        </div>
                        <div id="video-div2" class="form-group">
                            <label for="secret_key" class="control-label col-lg-3">Youtube Video ID</label>
                            <div class="col-lg-9">
                                <input class=" form-control" name="video" id="editvideo" type="text"/>
                            </div>
                        </div>
                        <div id="audio-div2" class="form-group">
                            <label for="image" class="control-label col-lg-3">Audio File</label>
                            <div class="col-lg-6">
                                <input class=" form-control" id="imgInp2" accept=".mp3,audio/*;capture=microphone" name="audio" type="file"/>
                            </div>
                            <div class="col-lg-3">
                                <a id="editaudio" target="_blank"><p id="audiotext"></p></a>
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


@section('script')
<script>

  $('#new-form').submit(function(e){
		e.preventDefault();
        $('#new').modal('hide');
            open_loader('#page');
               
		var form = $("#new-form")[0];
		var _data = new FormData(form);
		$.ajax({
			url: '{{url("admin/create-message")}}',
			data: _data,
			enctype: 'multipart/form-data',
			processData: false,
			contentType:false,
			type: 'POST',
			success: function(data){
				//$("#service").modal("toggle");
				if(data.status == "success"){
					toastr.success(data.message, data.status);
					$( "#datatable" ).load( "{{url('/admin/messages')}} #datatable" );
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
					$( "#datatable" ).load( "{{url('/admin/messages')}} #datatable" );
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
            $('#edittitle').val(event.title)
            $('#edittype').val(event.type)
            $('#editvideo').val(event.video)
            $('#audiotext').text(event.audio)
            $('#editaudio').attr('href',"{{asset('messages')}}/"+event.audio)
            $('#editid').val(event.id)
            $('#editmodal').modal('show')
        }

        $('#edit-form').submit(function(e){
            e.preventDefault();
            $('#editmodal').modal('hide');
                open_loader('#page');

            var form = $("#edit-form")[0];
            var _data = new FormData(form);
            $.ajax({
                url: '{{url("admin/update-message")}}',
                data: _data,
                enctype: 'multipart/form-data',
                processData: false,
                contentType:false,
                type: 'POST',
                success: function(data){
                    //$("#service").modal("toggle");
                    if(data.status == "success"){
                        toastr.success(data.message);
                        $( "#datatable" ).load( "{{url('/admin/messages')}} #datatable" );
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

    $(document).ready(function(){
        $('#check').on('change', function() {
            if ( this.value == 'audio') {
                $("#audio-div").show();
                $("#video-div").hide();
            } else if ( this.value == 'video') {
                $("#audio-div").hide();
                $("#video-div").show();
            } else {
                $("#audio-div").hide();
                $("#video-div").hide();
            }
        });

    });

    $(document).ready(function(){
        $('#edittype').on('change', function() {
            if ( this.value == 'audio') {
                $("#audio-div2").show();
                $("#video-div2").hide();
            } else if ( this.value == 'video') {
                $("#audio-div2").hide();
                $("#video-div2").show();
            } else {
                $("#audio-div2").hide();
                $("#video-div2").hide();
            }
        });

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

@endsection