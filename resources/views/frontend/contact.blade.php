@extends('layouts.app')
@section('title','Liên hệ')
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

<script>
  var swiper = new Swiper(".mySwiper", {
    pagination: {
      el: ".swiper-pagination",
    },
  });
</script>
<!-- ================ Home Banner Area ================= -->
<section class="banner_area">
  <div class="banner_inner d-flex align-items-center">
    <div class="container">
      <div class="banner_content d-md-flex justify-content-between align-items-center">
        <div class="mb-3 mb-md-0">
          <h2>Thông tin liên hệ</h2>
          <p>Very us move be blessed multiply night</p>
        </div>
        <div class="page_link">
          <a href="index.html">Home</a>
          <a href="{{asset('contact')}}">Contact Us</a>
        </div>
      </div>
    </div>
  </div>
</section>
<!--================End Home Banner Area =================-->

<!-- ================ contact section start ================= -->
<section class="section_gap">
  <div class="container">
    <h2 class="contact-title">Cửa hàng</h2>
    <div class="row ">
      <div class="col-md-6">
        <div id="carouselExampleIndicators" class="store-images carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img class="d-block w-100" src="{{asset('img/02.png')}}" alt="First slide">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="{{asset('img/03.png')}}" alt="Second slide">
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="{{asset('img/04.png')}}" alt="Third slide">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
        <!-- <div class="store-images swiper mySwiper">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <img class="" src="{{asset('img/shop-cosmetic.jpeg')}}" alt="">
            </div>
            <div class="swiper-slide">
              <img class="" src="{{asset('img/shop-cosmetic.jpeg')}}" alt="">
            </div>
            <div class="swiper-slide">
              <img class="" src="{{asset('img/shop-cosmetic.jpeg')}}" alt="">
            </div>
          </div>
          <div class="swiper-pagination"></div>
        </div> -->
      </div>
      <div class="col-md-6">
        <div class="store-item-info">
          <div class="contact-info address">
            <span class="contact-info__icon"><i class="ti-home"></i></span>
            <div class="media-body">
              <h3>482 Trưng Nữ Vương - TP Đà Nẵng</h3>
              <p>Hãy đến và trải nghiệm sản phẩm!</p>
            </div>
          </div>
          <div class="contact-info phone">
            <span class="contact-info__icon"><i class="ti-tablet"></i></span>
            <div class="media-body">
              <h3><a href="tel:0898238258">077 940 6396</a></h3>
              <p> Giờ mở cửa 9h - 21h </p>
            </div>
          </div>
          <div class="contact-info mail">
            <span class="contact-info__icon"><i class="ti-email"></i></span>
            <div class="media-body">
              <h3><a href="mailto:si.belle@gmail.com">si.belle@gmail.com</a></h3>
              <p> Gửi cho chúng tôi yêu cầu của bạn!</p>
            </div>
          </div>
        </div>
        <div class="store-item-map">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d958.5773382570048!2d108.21320646962457!3d16.04942889903922!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314219b89ef45939%3A0x184c6a10a8486124!2zNDgyIFRyxrBuZyBO4buvIFbGsMahbmcsIEjDsmEgVGh14bqtbiBOYW0sIEjhuqNpIENow6J1LCDEkMOgIE7hurVuZyA1NTAwMDAsIFZp4buHdCBOYW0!5e0!3m2!1svi!2sus!4v1719853590739!5m2!1svi!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>
    </div>


    <div class="row">
      <div class="col-12">
        <h2 class="contact-title">Get in Touch</h2>
      </div>
      <div class="col-lg-8 mb-4 mb-lg-0">
        <form class="form-contact contact_form" action="contact_process.php" method="post" id="contactForm" novalidate="novalidate">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <textarea class="form-control w-100" name="message" id="message" cols="30" rows="9" placeholder="Enter Message"></textarea>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <input class="form-control" name="name" id="name" type="text" placeholder="Enter your name">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <input class="form-control" name="email" id="email" type="email" placeholder="Enter email address">
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <input class="form-control" name="subject" id="subject" type="text" placeholder="Enter Subject">
              </div>
            </div>
          </div>
          <div class="form-group mt-lg-3">
            <button type="submit" class="main_btn">Send Message</button>
          </div>
        </form>


      </div>


    </div>
  </div>
</section>
<!-- ================ contact section end ================= -->



<!--================Contact Success and Error message Area =================-->
<div id="success" class="modal modal-message fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="fa fa-close"></i>
        </button>
        <h2>Thank you</h2>
        <p>Your message is successfully sent...</p>
      </div>
    </div>
  </div>
</div>

<!-- Modals error -->

<div id="error" class="modal modal-message fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <i class="fa fa-close"></i>
        </button>
        <h2>Sorry !</h2>
        <p> Something went wrong </p>
      </div>
    </div>
  </div>
</div>
<!--================End Contact Success and Error message Area =================-->
@endsection