    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="{{$setting->meta_description}}">
    <meta name="keywords" content="admin template, modern admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
    <meta name="author" content="PIXINVENT">
    <title>Dashboard | @yield('title')</title>
    {{-- <link rel="apple-touch-icon" href="{{asset('assets/dashboard')}}/images/ico/apple-icon-120.png"> --}}
    <link rel="apple-touch-icon" href="{{asset($setting->favicon)}}">

    {{-- <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/dashboard')}}/images/ico/favicon.ico"> --}}
    <link rel="shortcut icon" type="image/x-icon" href="{{asset($setting->favicon)}}">
    
    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
    rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css"
    rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard')}}/vendors/css/weather-icons/climacons.min.css"> 
    <link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard')}}/fonts/meteocons/style.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard')}}/vendors/css/charts/morris.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard')}}/vendors/css/charts/chartist.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard')}}/vendors/css/charts/chartist-plugin-tooltip.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard')}}/fonts/simple-line-icons/style.css">
    
    <!-- BEGIN VENDOR CSS-->

    @if(Config::get('app.locale') == 'ar')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard')}}/css-rtl/vendors.css">
   
    <!-- END VENDOR CSS-->
    <!-- BEGIN MODERN CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard')}}/css-rtl/app.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard')}}/css-rtl/custom-rtl.css">
    <!-- END MODERN CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard')}}/css-rtl/core/menu/menu-types/vertical-menu-modern.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard')}}/css-rtl/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard')}}/css-rtl/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard')}}/css-rtl/pages/timeline.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard')}}/css-rtl/pages/dashboard-ecommerce.css">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style-rtl.css">
    <!-- END Custom CSS-->
    @else
        
    <link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard')}}/css/vendors.css">
   
    <!-- END VENDOR CSS-->
    <!-- BEGIN MODERN CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard')}}/css/app.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard')}}/css/custom.css">
    <!-- END MODERN CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard')}}/css/core/menu/menu-types/vertical-menu-modern.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard')}}/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard')}}/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard')}}/css/pages/timeline.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/dashboard')}}/css/pages/dashboard-ecommerce.css">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END Custom CSS-->
    @endif

{{-- datatabel --}}
    {{-- bootstrap 5--}}
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.min.css">
{{-- buttons --}}
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.2.0/css/buttons.bootstrap5.min.css">
{{-- responsive --}}
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.3/css/responsive.bootstrap5.min.css">
{{-- ColReorder --}}
<link rel="stylesheet" href="https://cdn.datatables.net/colreorder/2.0.4/css/colReorder.bootstrap5.min.css">
{{-- RowReorder --}}
<link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.5.0/css/rowReorder.bootstrap5.min.css">
{{-- Select --}}
<link rel="stylesheet" href="https://cdn.datatables.net/select/2.1.0/css/select.bootstrap5.min.css">
{{-- FixedHeader --}}
<link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/4.0.1/css/fixedHeader.bootstrap5.min.css">
{{-- Scroller --}}
<link rel="stylesheet" href="https://cdn.datatables.net/scroller/2.4.3/css/scroller.bootstrap5.min.css">
{{--end datatabel --}}

{{-- file-input --}}
<link rel="stylesheet" href="{{ asset('vendor/file-input/css/fileinput.min.css') }}">
{{-- fontawesome --}}
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" crossorigin="anonymous" >
{{--end file-input --}}
    
{{-- summernote --}}
<link rel="stylesheet" href="{{ asset('vendor/summernote/summernote-bs4.min.css') }}">


  @auth
  <script src="https://js.pusher.com/8.4.0/pusher.min.js"></script>
  <script>
      Pusher.logToConsole = true;

      var pusher = new Pusher('99f5e74c14314b6979fa', {
          cluster: 'eu',
          forceTLS: true
      });


      var adminId = {{ auth('admin')->user()->id }};
console.log('Current adminId:', adminId);

var channel = pusher.subscribe('admins.' + adminId);

channel.bind('pusher:subscription_succeeded', function() {
    console.log('✅ Subscribed to admins.' + adminId);
});

channel.bind('pusher:subscription_error', function(error) {
    console.error('❌ Subscription failed:', error);
});

// channel.bind('order.created', function(data) {
//     console.log('📩 Received order.created:', data);
//     alert('New Order: ' + data.message);
// });
      
  </script>
@endauth


