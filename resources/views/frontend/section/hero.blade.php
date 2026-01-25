<section class="hero-area relative">
  <div class="hero-slider owl-carousel owl-theme">

    @foreach($all_sliders as $item)
      <div class="hero-slider-item relative h-screen flex items-center justify-center bg-cover bg-center"
        style="background-image: url('{{ asset($item->image) }}');">

        <!-- Dark overlay for readability -->
        <div class="absolute inset-0 bg-black bg-opacity-50"></div>

        <div class="container relative z-10 text-center px-4">
          <div class="hero-content max-w-3xl mx-auto animate-fade-in">

            <!-- Title -->
            <h2 class="text-white text-4xl md:text-6xl font-bold leading-tight mb-4 drop-shadow-lg">
              {{ $item->title }}
            </h2>

            <!-- Short Description -->
            <p class="text-white text-lg md:text-xl mb-6 drop-shadow-md">
              {{ $item->short_description }}
            </p>

            <!-- Buttons -->
            <div class="hero-btn-box flex flex-wrap justify-center gap-4">
              <a href="#" class="btn theme-btn mr-4 mb-4">
                Join with Us <i class="la la-arrow-right icon ml-1"></i>
              </a>
              <a href="{{ $item->video_url }}?autoplay=0" data-fancybox class="btn-text video-play-btn mb-4">
                Watch Preview <i class="la la-play icon-btn ml-2"></i>
              </a>
            </div>
          </div><!-- end hero-content -->
        </div><!-- end container -->
      </div><!-- end hero-slider-item -->
    @endforeach

  </div><!-- end hero-slider -->
</section>

<!-- Owl Carousel JS -->
<script>
  $(document).ready(function () {
    $(".hero-slider").owlCarousel({
      items: 1,
      loop: true,
      autoplay: true,
      autoplayTimeout: 6000,      // 6 seconds per slide
      autoplayHoverPause: true,
      animateOut: 'fadeOut',      // smooth fade
      animateIn: 'fadeIn',        // smooth fade
      smartSpeed: 1200,           // slide transition speed
      nav: true,
      dots: true,
      mouseDrag: true,
      touchDrag: true,
      navText: [
        "<i class='la la-angle-left text-white text-3xl'></i>",
        "<i class='la la-angle-right text-white text-3xl'></i>"
      ],
      onTranslated: function () {
        // Animate content on each slide
        $('.hero-slider-item.active .hero-content').addClass('animate-fade-in');
      }
    });

    // Trigger animation on first slide
    $('.hero-slider-item.active .hero-content').addClass('animate-fade-in');
  });
</script>

<!-- Styles for fade-in and professional look -->
<style>
  .animate-fade-in {
    opacity: 0;
    animation: fadeInUp 1s forwards;
  }

  @keyframes fadeInUp {
    0% {
      opacity: 0;
      transform: translateY(30px);
    }

    100% {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .hero-slider-item {
    min-height: 600px;
    /* full-screen height */
    position: relative;
  }

  .hero-content {
    text-align: center;
  }

  .btn.theme-btn {
    background-color: #ff7f50;
    color: #fff;
    padding: 12px 25px;
    border-radius: 50px;
    font-weight: 600;
    transition: all 0.3s ease;
  }

  .btn.theme-btn:hover {
    background-color: #ff5722;
    text-decoration: none;
  }

  .btn-text.video-play-btn {
    color: #fff;
    font-weight: 500;
    text-decoration: none;
  }

  .btn-text.video-play-btn:hover {
    color: #ff7f50;
  }

  @media (max-width: 768px) {
    .hero-content h2 {
      font-size: 36px !important;
    }

    .hero-content p {
      font-size: 16px !important;
    }
  }
</style>