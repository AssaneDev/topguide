@php
    $destination = App\Models\Destination::latest()->get();
    use Illuminate\Support\Facades\App;
    use Illuminate\Support\Facades\Session;
       $locale = Session::get('local') ?? 'fr';
        Session::put('local',$locale);
        App::setLocale($locale);

@endphp

 
      <section class="space space-extra-bottom bg-light shape-mockup-wrap" data-bg-src=" {{asset('frontend/assets/img/shape/Bg.png')}} ">
        <div class="shape-mockup d-none d-xl-block spin z-index-negative" data-top="-20%" data-right="-8%">
          <img src=" {{asset('frontend/assets/img/shape/circle1.png')}} " alt="circle">
        </div>
        <div class="shape-mockup d-none d-xl-block  z-index-negative" data-bottom="13%" data-left="0%">
          <img src=" {{asset('frontend/assets/img/shape/walk.png')}} " alt="circle">
        </div>

        @if ($locale == 'en')
          <div class="container">
            <div class="row justify-content-between align-items-center">
              <div class="col-lg-5">
                <div class="title-area">
                  <span class="sec-subtitle">Extraordinary Places in Senegal </span>
                  <h2 class="sec-title h1">Memorable Sites</h2>
                  <p class="sec-text">During your excursions, mini-tours, or circuits, we will help you explore Senegal..</p>
                </div>
              </div>
              <div class="col-auto">
                <div class="sec-btns">
                  <button class="icon-btn" data-slick-prev=".destinationSlide"><i class="fas fa-chevron-left"></i></button>
                  <button class="icon-btn" data-slick-next=".destinationSlide"><i class="fas fa-chevron-right"></i></button>
                </div>
              </div>
            </div>
            <div class="row destinationSlide vs-carousel" data-slide-show="3" data-arrows="false" data-lg-slide-show="2"
              data-md-slide-show="2" data-sm-slide-show="1">
          

              @foreach ($destination as $item)
                  <div class="col-xl-4">
                    <div class="destination-style1">
                      <a href="{{ url('destination/detail/'.$item->id) }}"> <img src=" {{asset($item->image_cap)}} " alt="destination image"></a>
                      {{-- <span class="destination-price">$369</span> --}}
                      <div class="destination-info">
                        <h4 class="destination-name"><a href="{{ url('destination/detail/'.$item->id) }}"> {{$item->name_en}} </a></h4>
                        <p class="destination-text">{{$item->short_desc}}</p>
                      </div>
                    </div>
                  </div>
              @endforeach
            
          
              </div>
            </div>
          </div>
        @endif

        @if ($locale == 'fr')
          <div class="container">
            <div class="row justify-content-between align-items-center">
              <div class="col-lg-5">
                <div class="title-area">
                  <span class="sec-subtitle">Des endroits Extraordinaires au Sénégal</span>
                  <h2 class="sec-title h1">Des sites mémorables</h2>
                  <p class="sec-text">Lors de vos excursions, mini-circuits ou circuits, nous vous ferons explorer le Sénégal.</p>
                </div>
              </div>
              <div class="col-auto">
                <div class="sec-btns">
                  <button class="icon-btn" data-slick-prev=".destinationSlide"><i class="fas fa-chevron-left"></i></button>
                  <button class="icon-btn" data-slick-next=".destinationSlide"><i class="fas fa-chevron-right"></i></button>
                </div>
              </div>
            </div>
            <div class="row destinationSlide vs-carousel" data-slide-show="3" data-arrows="false" data-lg-slide-show="2"
              data-md-slide-show="2" data-sm-slide-show="1">
          
      
              @foreach ($destination as $item)
                  <div class="col-xl-4">
                    <div class="destination-style1">
                      <a href="{{ url('destination/detail/'.$item->id) }}"> <img src=" {{asset($item->image_cap)}} " alt="destination image"></a>
                      {{-- <span class="destination-price">$369</span> --}}
                      <div class="destination-info">
                        <h4 class="destination-name"><a href="{{ url('destination/detail/'.$item->id) }}"> {{$item->name}} </a></h4>
                        <p class="destination-text">{{$item->short_desc}}</p>
                      </div>
                    </div>
                  </div>
              @endforeach
            
          
              </div>
            </div>
          </div>
        @endif

        @if ($locale == 'es')
        <div class="container">
          <div class="row justify-content-between align-items-center">
            <div class="col-lg-5">
              <div class="title-area">
                <span class="sec-subtitle">Lugares extraordinarios en Senegal</span>
                <h2 class="sec-title h1">Lugares memorables</h2>
                <p class="sec-text">Durante sus excursiones, minitours o circuitos, le ayudaremos a explorar Senegal.</p>
              </div>
            </div>
            <div class="col-auto">
              <div class="sec-btns">
                <button class="icon-btn" data-slick-prev=".destinationSlide"><i class="fas fa-chevron-left"></i></button>
                <button class="icon-btn" data-slick-next=".destinationSlide"><i class="fas fa-chevron-right"></i></button>
              </div>
            </div>
          </div>
          <div class="row destinationSlide vs-carousel" data-slide-show="3" data-arrows="false" data-lg-slide-show="2"
            data-md-slide-show="2" data-sm-slide-show="1">
        
    
            @foreach ($destination as $item)
                <div class="col-xl-4">
                  <div class="destination-style1">
                    <a href="{{ url('destination/detail/'.$item->id) }}"> <img src=" {{asset($item->image_cap)}} " alt="destination image"></a>
                    {{-- <span class="destination-price">$369</span> --}}
                    <div class="destination-info">
                      <h4 class="destination-name"><a href="{{ url('destination/detail/'.$item->id) }}"> {{$item->name_es}} </a></h4>
                      <p class="destination-text">{{$item->short_desc_es}}</p>
                    </div>
                  </div>
                </div>
            @endforeach
          
        
            </div>
          </div>
        </div>
      @endif

      </section>

     
  