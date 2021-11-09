@extends( 'layouts.admin' )

@section('title','Products')

@section('style')
<!--summer note-->
<link rel="stylesheet" href="{{asset('admins/bower_components/summernote/dist/summernote.css')}}">
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
                        Products
                    </h4>
                    <div class="breadcrumb-right">
                        <ol class="breadcrumb">
                            <li><a href="{{asset('/admin/dashboard')}}">Home</a></li>
                            <li class="active">Products</li>
                        </ol>
                    </div>
                </div>
                <!--page header end-->

                <div class="ui-content-body">

                    <div class="ui-container">
                        <div class="row">
                            <form id="status_form" action='{{url("admin/product-status")}}' method="POST">
                                {{ csrf_field() }}
                            <div class="col-sm-12">
                                <div class="mbot-20">
                                    <div class="btn-group">
                                       <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button" aria-expanded="false">Action <span class="caret"></span></button>
                                    <ul role="menu" class="dropdown-menu">
                                        <li><button class="btn btn-default" name="submit" type="button" onclick="status_form('featured')">Featured</button></li>
                                        <li><button class="btn btn-default" name="submit" type="button" onclick="status_form('unfeatured')">Unfeature</button></li>
                                        <li><button class="btn btn-default" name="submit" type="button" onclick="status_form('active')">Active</button></li>
                                        <li><button class="btn btn-default" name="submit" type="button" onclick="status_form('inactive')">Inactive</button></li>
                                        <li class="divider"></li>
                                        <li><button class="btn btn-danger" name="submit" type="button" onclick="status_form('delete')">Delete</button></li>
                                    </ul>
                                    </div>
                                    <button type="button" data-toggle="modal" data-target="#product" class="btn btn-default">Add New Product</button>
                                </div>
                                <section class="panel">
                                    <header class="panel-heading panel-border">
                                       Products
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
                                                <th>#</th>
                                                <th>Product Name</th>
                                                <th>Category</th>
                                                <th>Price</th>
                                                <th>Status</th>
                                                <th>Featured</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($data as $bl)
                                            <tr>
                                                <td><input class="contestantBox" type="checkbox" name="id[]" value="{{$bl->id}}" /> </td>
                                                <td><img src="{{asset('images/products/'.$bl->image)}}" style="max-height: 60px; max-width: 60px"></td>
                                                <td>{{$bl->key}}</td>
                                                <td>{{$bl->pname}}</td>
                                                <td>{{$bl->cat->name}}</td>
                                                <td>{{$comm->currency}}{{number_format($bl->price)}}</td>
                                                @if($bl->status==ACTIVE)
                                                <td><span class="label label-success">Active</span></td>
                                                @else
                                                <td><span class="label label-warning">Inactive</span></td>
                                                @endif
                                                @if($bl->featured==YES)
                                                <td><span class="label label-success">Yes</span></td>
                                                @else
                                                <td></td>
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
<div  id="product" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Add New Product</h4>
            </div>
            <form class="cmxform form-horizontal " id="product-form">
            {{ csrf_field() }}
            <div class="modal-body">
            <div class="form">

                        <div class="form-group">
                            <label for="pname" class="control-label col-lg-3">Product Name</label>
                            <div class="col-lg-9">
                                <input class=" form-control" name="pname" type="text" required="required"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cat_id" class="control-label col-lg-3">Category</label>
                            <div class="col-lg-9">
                                <select class=" form-control" name="cat_id" required="required">
                                @foreach($cat as $ch)
                                 <option value="{{$ch->id}}">{{$ch->name}}</option>
                                 @endforeach
                                </select>
                            </div>
                        </div>
                       <div class="form-group">
                            <label for="description" class="control-label col-lg-3">Description</label>
                            <div class="col-lg-9">
                                <textarea class=" form-control summernote" rows="5" name="description"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="keywords" class="control-label col-lg-3">Keywords</label>
                            <div class="col-lg-9">
                                <textarea class=" form-control" rows="3" name="keywords"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="price" class="control-label col-lg-3">Product Price</label>
                            <div class="col-lg-9">
                                <input class=" form-control" name="price" type="text"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="image" class="control-label col-lg-3">Product Image</label>
                            <div class="col-lg-6">
                                <input class=" form-control" id="imgInp" accept="image/*" name="image" type="file" required="required"/>
                            </div>
                            <div class="col-lg-3">
                                <img id="blah" src="" style="max-width: 100px; max-height: 100px"/>
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
                <h4 class="modal-title" id="myModalLabel">Update Product</h4>
            </div>
            <form class="cmxform form-horizontal " id="edit-form">
            {{ csrf_field() }}
            <div class="modal-body">
            <div class="form">

                        <div class="form-group">
                            <label for="pname" class="control-label col-lg-3">Product Name</label>
                            <div class="col-lg-9">
                                <input class=" form-control" id="editname" name="pname" type="text" required="required"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cat_id" class="control-label col-lg-3">Category</label>
                            <div class="col-lg-9">
                                <select class=" form-control" id="editcat" name="cat_id" required="required">
                                @foreach($cat as $ch)
                                 <option value="{{$ch->id}}">{{$ch->name}}</option>
                                 @endforeach
                                </select>
                            </div>
                        </div>
                       <div class="form-group">
                            <label for="description" class="control-label col-lg-3">Description</label>
                            <div class="col-lg-9">
                                <textarea class=" form-control summernote" id="editdescription" rows="5" name="description"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="keywords" class="control-label col-lg-3">Keywords</label>
                            <div class="col-lg-9">
                                <textarea class=" form-control" rows="3" id="editkeywords" name="keywords"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="price" class="control-label col-lg-3">Product Price</label>
                            <div class="col-lg-9">
                                <input class=" form-control" id="editprice" name="price" type="text"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="image" class="control-label col-lg-3">Product Image</label>
                            <div class="col-lg-6">
                                <input class=" form-control" id="imgInp2" accept="image/*" name="image" type="file"/>
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
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>


@section('script')

<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/codemirror.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/mode/xml/xml.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/2.36.0/formatting.js"></script>
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

function readURL(input) {
    if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
        $('#blah').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
    }
}

$("#imgInp").change(function() {
    readURL(this);
});

function readURL2(input) {
    if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
        $('#editimage').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
    }
}

$("#imgInp2").change(function() {
    readURL2(this);
});

$('#product-form').submit(function(e){
		e.preventDefault();
        $('#product').modal('hide');
            open_loader('#page');

		var form = $("#product-form")[0];
		var _data = new FormData(form);
		$.ajax({
			url: '{{url("admin/create-product")}}',
			data: _data,
			enctype: 'multipart/form-data',
			processData: false,
			contentType:false,
			type: 'POST',
			success: function(data){
				//$("#service").modal("toggle");
				if(data.status == "success"){
					toastr.success(data.message, data.status);
					$( "#datatable" ).load( "{{url('/admin/products')}} #datatable" );
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
                    toastr.success(data.message, data.status);
					$( "#datatable" ).load( "{{url('/admin/products')}} #datatable" );
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
    }

    function update(event){
        //$('#modaltitle').text("Update " +event.title)
        $('#editname').val(event.pname)
        $('#editdescription').summernote('code', event.description)
        $('#editcat').val(event.cat_id)
        $('#editkeywords').val(event.keywords)
        $('#editprice').val(event.price)
        $('#editid').val(event.id)
        $("#editimage").attr('src', "{{asset('images/products')}}/"+event.image)
        $('#editmodal').modal('show')
    }

    $('#edit-form').submit(function(e){
        e.preventDefault();
        $('#editmodal').modal('hide');
            open_loader('#page');

        var form = $("#edit-form")[0];
        var _data = new FormData(form);
        $.ajax({
            url: '{{url("admin/update-product")}}',
            data: _data,
            enctype: 'multipart/form-data',
            processData: false,
            contentType:false,
            type: 'POST',
            success: function(data){
                //$("#service").modal("toggle");
                if(data.status == "success"){
                    toastr.success(data.message);
                    $( "#datatable" ).load( "{{url('/admin/products')}} #datatable" );
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
