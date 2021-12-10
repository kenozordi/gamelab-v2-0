<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Intelbox Gamelabs">
    <meta name="keywords" content="gaming">
    <meta name="author" content="gamelab">
    <title>Admin Login</title>
    <link rel="apple-touch-icon" href="{{asset('/admin-assets/app-assets')}}/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('/admin-assets/app-assets')}}/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i%7CMuli:300,400,500,700" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('/admin-assets/app-assets')}}/css/vendors.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/admin-assets/app-assets')}}/app-assets/vendors/css/forms/icheck/icheck.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/admin-assets/app-assets')}}/app-assets/vendors/css/forms/icheck/custom.css">
    <!-- END VENDOR CSS-->
    <!-- BEGIN ROBUST CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('/admin-assets/app-assets')}}/css/app.css">
    <!-- END ROBUST CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('/admin-assets/app-assets')}}/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/admin-assets/app-assets')}}/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/admin-assets/app-assets')}}/css/pages/login-register.css">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('/admin-assets/assets')}}/css/style.css">
    <!-- END Custom CSS-->
</head>

<body class="vertical-layout vertical-menu 1-column   menu-expanded blank-page blank-page" data-open="click" data-menu="vertical-menu" data-col="1-column">


    <div id="invoice-template" class="card-body">
        <!-- Invoice Company Details -->
        <div id="invoice-company-details" class="row">
            <div class="col-md-6 col-sm-12 text-center text-md-left">
                <div class="media">
                    <img src="{{$message->embed('admin-assets/app-assets/images/logo/logo-light.png')}}" alt="company logo" class="" />
                    <div class="media-body">
                        <ul class="ml-2 px-0 list-unstyled">
                            <li class="text-bold-800">Gamelab</li>
                            <li>IntelBox Center,</li>
                            <li>4th Floor Lanre Shittu Building,</li>
                            <li>1504 Shehu Yar'adua Way,</li>
                            <li>Mabushi, Abuja</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12 text-center text-md-right">
                <h2>TICKET</h2>
                <p class="pb-3"># {{$ticket->booking->reference}}</p>
            </div>
        </div>
        <!--/ Invoice Company Details -->

        <!-- Invoice Customer Details -->
        <div id="invoice-customer-details" class="row pt-2">
            <div class="col-sm-12 text-center text-md-left">
                <p class="text-muted">Bill To</p>
            </div>
            <div class="col-md-6 col-sm-12 text-center text-md-left">
                <ul class="px-0 list-unstyled">
                    <li class="text-bold-800">{{$ticket->order->gamer->email}}</li>
                    <li>{{$ticket->order->gamer->fullname}}</li>
                </ul>
            </div>
            <div class="col-md-6 col-sm-12 text-center text-md-right">
                <p><span class="text-muted">Date Sent :</span> {{date('D jS M Y, h:i:sa')}}</p>
                <p><span class="text-muted">Ticket Expires :</span> {{$ticket->booking->expires_at}}</p>
            </div>
        </div>
        <!--/ Invoice Customer Details -->

        <!-- Invoice Items Details -->
        <div id="invoice-items-details" class="pt-2">
            <div class="row">
                <div class="table-responsive col-sm-12">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th scope="row">Game & Client</th>
                                <td>
                                    <p>{{$ticket->booking->game->title}}</p>
                                    <p class="text-muted">{{$ticket->booking->client->machinename}}</p>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Start Time</th>
                                <td class="text-right">{{$ticket->booking->start_time}}</td>
                            </tr>
                            <tr>
                                <th scope="row">End Time</th>
                                <td class="text-right">{{$ticket->booking->end_time}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Amount</th>
                                <td class="text-right">{{$ticket->booking->amount}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Invoice Footer -->
        <div id="invoice-footer">
            <div class="row">
                <div class="col-md-7 col-sm-12">
                    <h6>Terms & Condition</h6>
                    <p>You get no refunds once you have made payments for an order.</p>
                </div>
                <div class="col-md-5 col-sm-12 text-center">
                    <a href="https://gamelab.intelbox.tech/" type="button" class="btn btn-info btn-lg my-1"><i class="fa fa-paper-plane-o"></i> Visit Gamelab</a>
                </div>
            </div>
        </div>
        <!--/ Invoice Footer -->

    </div>

    <!-- BEGIN VENDOR JS-->
    <script src="{{asset('/admin-assets/app-assets')}}/vendors/js/vendors.min.js"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{{asset('/admin-assets/app-assets')}}/vendors/js/forms/icheck/icheck.min.js"></script>
    <script src="{{asset('/admin-assets/app-assets')}}/vendors/js/forms/validation/jqBootstrapValidation.js"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN ROBUST JS-->
    <script src="{{asset('/admin-assets/app-assets')}}/js/core/app-menu.js"></script>
    <script src="{{asset('/admin-assets/app-assets')}}/js/core/app.js"></script>
    <!-- END ROBUST JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{asset('/admin-assets/app-assets')}}/js/scripts/forms/form-login-register.js"></script>
    <!-- END PAGE LEVEL JS-->
</body>

</html>