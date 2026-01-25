<section class="feature-area pb-90px">
  <div class="container">
    <div class="row feature-content-wrap g-4">

      @foreach($all_info as $item)
        <div class="col-lg-4 col-md-6 responsive-column-half">
          <div class="info-box position-relative text-center p-4 rounded shadow-sm bg-white h-100 hover-effect">

            <!-- Overlay for hover -->
            <div class="info-overlay rounded"></div>

            <!-- Icon -->
            <div class="icon-element mx-auto mb-3 p-3 rounded-circle shadow-sm bg-primary text-white"
              style="width:80px; height:80px; display:flex; align-items:center; justify-content:center; transition: transform 0.3s, background-color 0.3s;">
              {!! $item->icon !!}
            </div>

            <!-- Title -->
            <h3 class="info__title fw-bold mb-2">{{ $item->title }}</h3>

            <!-- Description -->
            <p class="info__text text-muted">{{ $item->description }}</p>
          </div>
        </div>
      @endforeach

    </div>
  </div>
</section>

<!-- Custom CSS -->
<style>
  .info-box {
    position: relative;
    transition: transform 0.3s, box-shadow 0.3s, background-color 0.3s;
    cursor: pointer;
    background-color: #fff;
    /* default background */
  }

  .info-box:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
    background-color: #f0f8ff;
    /* background color on hover */
  }

  .info-box:hover .icon-element {
    transform: scale(1.2) rotate(10deg);
    background-color: #ff007b;
    /* optional: icon background change */
  }

  .info-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border-radius: 0.5rem;
    background: rgba(0, 123, 255, 0.05);
    opacity: 0;
    transition: opacity 0.3s;
    z-index: 0;
  }

  .info-box:hover .info-overlay {
    opacity: 1;
  }

  .info__title,
  .info__text {
    position: relative;
    z-index: 1;
    transition: color 0.3s;
  }

  .info-box:hover .info__title,
  .info-box:hover .info__text {
    color: #007bff;
  }
</style>