<html>
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="icon" href="{{asset('img/favicon.png')}}" type="image/png" />

  <title>SI.BELLE Cosmetic | @yield('title')</title>
  <!-- Bootstrap CSS -->
  <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">

  <link rel="stylesheet" href="{{asset('css/fonts/flaticon.css')}}">
  <link rel="stylesheet" href="{{asset('css/fonts/font-awesome.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/fonts/themify-icons.css')}}">
  <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}" />
  <link rel="stylesheet" href="{{asset('css/style.css')}}" />
  <link rel="stylesheet" href="{{asset('css/fonts/themify-icons.css')}}" />
  <link rel="stylesheet" href="{{asset('css/owlcarousel/owl.carousel.min.css')}}" />
  
  <!-- main css -->
  <link rel="stylesheet" href="{{asset('css/style.css')}}" />
  <link rel="stylesheet" href="{{asset('css/responsive.css')}}" />
  
  <link rel="stylesheet" href="{{asset('css/owlcarousel/owl.carousel.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/owlcarousel/owl.theme.default.min.css')}}">

  <link rel="stylesheet" href="{{asset('css/swiper-bundle.min.css')}}">
  <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css"
    />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</head>
<body>
 <!--================Header Menu Area =================-->
@include('frontend.header')
  <!-- ================ End Header Menu Area ================= -->

@yield('content')

<!--================ start footer Area  =================-->
@include('frontend.footer')
<!--================ end footer Area  =================-->
  <!-- jQuery ajax -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

   <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS Contact -->
    <script src="{{asset('js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{asset('js/popper.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/stellar.js')}}"></script>
    <script src="{{asset('js/owlcarousel/owl.carousel.min.js')}}"></script>
    <script src="{{asset('js/jquery.ajaxchimp.min.js')}}"></script>
    <script src="{{asset('js/mail-script.js')}}"></script>

    <!-- contact js -->
    <script src="{{asset('js/jquery.form.js')}}"></script>
    <script src="{{asset('js/jquery.validate.min.js')}}"></script>
    <!-- <script src="{{asset('js/contact.js')}}"></script> -->
    <!--gmaps Js-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
    <script src="{{asset('js/gmaps.min.js')}}"></script>
    <script src="{{asset('js/theme.js')}}"></script>

    <!-- owl-carousel js -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="{{asset('js/owlcarousel/owl.carousel.min.js')}}"></script>

    <!-- Swiper demos-->
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

    <script src="{{asset('js/script.js')}}"></script>
    <!-- <script src="{{asset('js/swiper-bundle.min.js')}}"></script> -->

   <script type="text/javascript">
    $(document).ready(function(){
      $('#sort').on('change',function(){
          var url = $(this).val();
         if(url){
              window.location = url;
         }return false;
      });
    });
   </script>
</body>

</html>