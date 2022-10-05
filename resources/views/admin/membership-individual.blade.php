@extends( 'layouts.admin' )

@section('title','Individual Membership')

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
                    Individual Membership History
                    </h4>
                    <div class="breadcrumb-right">
                        <ol class="breadcrumb">
                            <li><a href="{{asset('/admin/dashboard')}}">Home</a></li>
                            <li class="active">Individual Membership</li>
                        </ol>
                    </div>
                </div>
                <!--page header end-->

                <div class="ui-content-body">

                    <div class="ui-container">
                        <div class="row">
                            <form>
                                {{ csrf_field() }}
                            <div class="col-sm-12">
                            <!-- <div class="mbot-20">
                                    <div class="btn-group">
                                       <button data-toggle="dropdown" class="btn btn-default dropdown-toggle" type="button" aria-expanded="false">Action <span class="caret"></span></button>
                                    <ul role="menu" class="dropdown-menu">
                                        <li><button class="btn btn-default" name="submit" type="button" onclick="status_form('active')">Active</button></li>
                                        <li><button class="btn btn-default" name="submit" type="button" onclick="status_form('inactive')">Inactive</button></li>
                                        <li class="divider"></li>
                                        <li><button class="btn btn-danger" name="submit" type="button" onclick="status_form('delete')">Delete</button></li>
                                    </ul>
                                    </div>
                                </div> -->
                                <section class="panel">
                                    <header class="panel-heading panel-border">
                                    Individual Membership
                                        <span class="tools pull-right">
                                            <a class="refresh-box fa fa-repeat" href="javascript:;"></a>
                                            <a class="collapse-box fa fa-chevron-down" href="javascript:;"></a>
                                            <a class="close-box fa fa-times" href="javascript:;"></a>
                                        </span>
                                    </header>
                                    <div class="panel-body" style="overflow-x:auto;">
                                        <table id="datatable" class="table responsive-data-table table-striped">
                                            <thead>
                                            <tr>
                                                <th><input type="checkbox" onClick="checkAllContestant()" id="chAllCon" /></th>
                                                <th>Type</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Tel</th>
                                                <th>Sex</th>
                                                <th>Marital Status</th>
                                                <th>Location</th>
                                                <th>Occupation</th>
                                                <th>Institution</th>
                                                <th>Previous Mem. No</th>
                                                <th>Status</th>
                                                <th>Created Date</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($data as $bl)
                                            <tr>
                                                <td><input class="contestantBox" type="checkbox" name="id[]" value="{{$bl->id}}" /> </td>
                                                <td>{{$bl->type}}</td>
                                                <td>{{$bl->name}} {{$bl->other_name}}</td>
                                                <td>{{$bl->email}}</td>
                                                <td>{{$bl->phone_number}}</td>
                                                <td>{{$bl->sex}}</td>
                                                <td>{{$bl->marital_status}}</td>
                                                <td>{{$bl->city?$bl->city->name.',':''}} {{$bl->state?$bl->state->name.',':''}} {{$bl->country?$bl->country->name:''}}</td>
                                                <td>{{$bl->occupation}}</td>
                                                <td>{{$bl->institution}}</td>
                                                <td>{{$bl->previous_mem_no}}</td>
                                                @if($bl->status==1)
                                                <td><span class="label label-success">Active</span></td>
                                                @else
                                                <td><span class="label label-warning">Inactive</span></td>
                                                @endif
                                                <td>{{$bl->created_at}}</td>
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

@section('script')

@endsection