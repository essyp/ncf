@extends( 'layouts.admin' )

@section('title','Orders')

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
                    Product Orders
                    </h4>
                    <div class="breadcrumb-right">
                        <ol class="breadcrumb">
                            <li><a href="{{url('/admin/dashboard')}}">Home</a></li>
                            <li class="active">Product Orders</li>
                        </ol>
                    </div>
                </div>
                <!--page header end-->

                <div class="ui-content-body">

                    <div class="ui-container">
                        <div class="row">
                            <form id="status_form" action='{{url("/admin/ajax/order/status")}}' method="POST">
                                {{ csrf_field() }}
                            <div class="col-sm-12">
                            <div class="mbot-20">
                                    <div class="btn-group">
                                       <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button" aria-expanded="false">Action <span class="caret"></span></button>
                                    <ul role="menu" class="dropdown-menu">
                                        <li><button class="btn btn-default" name="submit" type="button" onclick="status_form('processing')">Processing</button></li>
                                        <li><button class="btn btn-default" name="submit" type="button" onclick="status_form('processed')">Processed</button></li>
                                        <li class="divider"></li>
                                        <li><button class="btn btn-danger" name="submit" type="button" onclick="status_form('delete')">Delete</button></li>
                                    </ul>
                                    </div>
                            </div>
                                <section class="panel">
                                    <header class="panel-heading panel-border">
                                    Product Orders
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
                                                <th>Order ID</th>
                                                <th>Customer Name</th>
                                                <th>Total Amount ({{$comm->currency}})</th>
                                                <th>Created Date</th>
                                                <th>Payment Status</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($data as $bl)
                                            <tr>
                                                <td><input class="contestantBox" type="checkbox" name="id[]" value="{{$bl->id}}" /> </td>
                                                <td>{{$bl->order_code}}</td>
                                                <td>@if($bl->user) {{$bl->user->fname}} {{$bl->user->lname}} @else {{$bl->name}} @endif</td>
                                                <td>{{number_format($bl->total_amount)}}</td>
                                                <td>{{$bl->created_at}}</td>
                                                <td>
                                                @if($bl->payment_status==SUCCESSFUL)
                                                    <span class="label label-success">successful</span>
                                                    @else
                                                    <span class="label label-danger">unsuccessful</span>
                                                    @endif
                                                </td>
                                                <td><a href="javascript:void(0);" data-target="#order-view" data-toggle="modal" data-whatever="{{$bl->id}}"><i class="fa fa-eye"></i></a></td>
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


            <!-- =-=-=-=-=-=-= order view =-=-=-=-=-=-= -->
<div id="order-view" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="z-index: 100000 !important;">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
            <div class="dash">

        </div>
    </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $('#order-view').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var id = button.data('whatever') // Extract info from data-* attributes
        var modal = $(this);
        var dataString = 'id=' + id;

          $.ajax({
              type: "GET",
              url: "{{url('admin/order/view')}}",
              data: dataString,
              cache: false,
              success: function (data) {
                  //console.log(data);
                  modal.find('.dash').html(data);
              },
              error: function(err) {
                  //console.log(err);
              }
          });
  })

  $(function () {
    // when the modal is closed
    $('#order-view').on('hidden.bs.modal', function () {
        // remove the bs.modal data attribute from it
        $(this).removeData('bs.modal');
        // and empty the modal-content element
        $('#modal-container .modal-content').empty();
    });
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
					$( "#datatable" ).load( "{{url('/admin/product-orders')}} #datatable" );
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
