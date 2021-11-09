
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <link rel="shortcut icon" type="image/png" href="/imgs/favicon.png" /> -->
        <title>Login</title>

        <!-- inject:css -->
        <link rel="stylesheet" href="{{asset('admins/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('admins/bower_components/font-awesome/css/font-awesome.min.css')}}">
        <link rel="stylesheet" href="{{asset('admins/bower_components/simple-line-icons/css/simple-line-icons.css')}}">
        <link rel="stylesheet" href="{{asset('admins/bower_components/weather-icons/css/weather-icons.min.css')}}">
        <link rel="stylesheet" href="{{asset('admins/bower_components/themify-icons/css/themify-icons.css')}}">
        <!-- endinject -->

        <!-- Main Style  -->
        <link rel="stylesheet" href="{{asset('admins/dist/css/main.css')}}">
        <link rel="stylesheet" href="{{asset('admins/assets/css/toastr.min.css')}}">
        <link rel="stylesheet" href="{{asset('admins/assets/css/waitMe.min.css')}}">

        <script src="{{asset('admins/assets/js/modernizr-custom.js')}}"></script>
    </head>
    <body id="page">

        <div class="sign-in-wrapper">
            <div class="sign-container">
                <div class="text-center">
                    <h2 class="logo"><img src="{{asset('images/logo/'.$comm->logo)}}" style="max-height: 70px; max-width: 70px;" alt=""/></h2>
                    <h4>Login to Admin</h4>
                    
                </div>

                <form class="sign-in-form" id="login-form">
                {{ csrf_field() }}
                    <div class="form-group">
                    <label for="email" class="control-label">E-Mail Address</label>
                        <input type="text" class="form-control" placeholder="Email Address" name="email" required="">
                        
                    </div>
                    <div class="form-group">
                    <label for="password" class="control-label">Password</label>
                        <input type="password" class="form-control" placeholder="Password" name="password" required="">
                        
                    </div>
                    <button type="submit" class="btn btn-info btn-block">Login</button>
                    
                </form>
                <div class="text-center copyright-txt">
                    <small>{{$comm->fullname}} - Copyright © <?php echo date("Y"); ?></small>
                </div>
            </div>
        </div>

        <!-- inject:js -->
        <script src="{{asset('admins/bower_components/jquery/dist/jquery.min.js')}}"></script>
        <script src="{{asset('admins/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('admins/bower_components/jquery.nicescroll/dist/jquery.nicescroll.min.js')}}"></script>
        <script src="{{asset('admins/bower_components/autosize/dist/autosize.min.js')}}"></script>
        <!-- endinject -->

        <!-- Common Script   -->
        <script src="{{asset('admins/dist/js/main.js')}}"></script>
        
    </body>
</html>
<script src="{{asset('admins/assets/js/toastr.min.js')}}"></script>
        <script src="{{asset('admins/assets/js/waitMe.min.js')}}"></script>
        <script>
        function open_loader(container) {
        $(container).waitMe({
            effect : 'bounce',
            text : '',
            bg : 'rgba(255,255,255,0.7)',
            color : '#000',
            maxSize : '',
            waitTime : '-1',
            textPos : 'vertical',
            fontSize : '',
            source : '',
            onClose : function() {}
        });
    }
    
    function close_loader(container) {
        $(container).waitMe("hide");
    }
        </script>
 <script>
$('#login-form').submit(function(e){
		e.preventDefault();
        open_loader('#page');
               
		var form = $("#login-form")[0];
		var _data = new FormData(form);
		$.ajax({
			url: '{{url("/admin/login")}}',
			data: _data,
			enctype: 'multipart/form-data',
			processData: false,
			contentType:false,
			type: 'POST',
			success: function(data){
				if(data.status == "success"){
					toastr.success(data.message);
					setTimeout("window.location.href='{{url("/admin/")}}';",2000);
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