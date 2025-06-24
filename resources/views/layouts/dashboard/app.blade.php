<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="rtl">
<head>
  @include('layouts.dashboard.head')
@stack("css") 
@livewireStyles



</head>

<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">

  <!-- fixed-top-->
  @include('layouts.dashboard.header')
  

  <!-- ////////////////////////////////////////////////////////////////////////////-->

  @include('layouts.dashboard.sidebar')
  
  @yield('body')
 
  
  <!-- ////////////////////////////////////////////////////////////////////////////-->
@include('layouts.dashboard.footer')
  <script src="https://js.pusher.com/8.4.0/pusher.min.js"></script>
  @if (Auth::guard('admin')->check())
    <script>
      layout = "admin";
      adminId = "{{auth('admin')->user()->id}}";
      showOrderRoute = "{{route('dashboard.order.show',':id')}}";
      contactIndexRoute = "{{route('dashboard.contacts.index')}}"
    </script>
  @endif
  <script src="{{asset('build/assets/app-BH3ptorL.js')}}"></script>
  
@include('layouts.dashboard.script')

@stack("js") 
@livewireScripts


</body>

</html>