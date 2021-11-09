<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>{{$comm->com_fullname}}</title>
</head>

<body style="margin:0px; background: #f8f8f8; ">
    <div width="100%" style="background: #f8f8f8; padding: 0px 0px; font-family:arial; line-height:28px; height:100%;  width: 100%; color: #514d6a;">
        <div style="max-width: 700px; padding:50px 0;  margin: 0px auto; font-size: 14px">
            <table border="0" cellpadding="0" cellspacing="0" style="width: 100%; margin-bottom: 20px">
                <tbody>
                    <tr>
                        <td style="vertical-align: top; padding-bottom:30px;" align="center"><img src="{{asset('images/logo/'.$comm->com_logo)}}" alt="{{$comm->com_shortname}}" style="border:none; max-height: 70px; max-width:150px"></td>
                    </tr>
                </tbody>
            </table>
            <div style="padding: 40px; background: #fff;">
                <table border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                    <tbody>
                        <tr>
                            <td><b>Dear {{$name}},</b>
                                <p>Thanks for showing interest in one of our products. One of us will contact you shortly</p>
                                <b>- Thanks ({{$comm->com_shortname}} team)</b> </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div style="text-align: center; font-size: 12px; color: #b2b2b5; margin-top: 20px">
                <p> Powered by {{$comm->com_shortname}}
                    <br>
                    <a href="javascript: void(0);" style="color: #b2b2b5;">{{$comm->com_fullname}}</a><br>
                    <a href="javascript: void(0);" style="color: #b2b2b5;">{{$comm->com_address}}</a><br>
                    <a href="javascript: void(0);" style="color: #b2b2b5;">{{$comm->com_tel}}</a>
                    <a href="javascript: void(0);" style="color: #b2b2b5;">{{$comm->com_tel2}}</a> <br>
                    <a href="javascript: void(0);" style="color: #b2b2b5;">{{$comm->com_email}}</a>
                    <a href="javascript: void(0);" style="color: #b2b2b5;">{{$comm->com_email2}}</a></p>
            </div>
        </div>
    </div>
</body>
</html>
