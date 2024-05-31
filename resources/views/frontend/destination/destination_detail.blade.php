@extends('frontend.main_master')
@section('main')
 <!--==============================
	  Hero area Start
	==============================-->
    <div class="breadcumb-wrapper" data-bg-src="assets/img/breadcumb/breadcumb-bg.jpg">
        <div class="container z-index-common">
          <div class="breadcumb-content">
            <h1 class="breadcumb-title">Destination Details</h1>
            <div class="breadcumb-menu-wrap">
              <ul class="breadcumb-menu">
                <li><a href="index.html">Home</a></li>
                <li>Destination</li>
                <li>Spain</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <!--==============================
          Hero Area End
        ==============================-->
    
      <!--==============================
          Destination Details Area Start
        ==============================-->
      <section class="space">
        <div class="container">
          <div class="row">
            <div class="col-lg-8">
              <div class="destination-details">
                <h2 class="ds-title">{{$destination->name}}</h2>
                <div class="ds-img1">
                  <img src="{{asset($destination->image)}}" alt="image" style="width:1162px; height: 600px; ">
                </div>
                <p class="ds-text">{!!$destination->long_descp!!}</p>
                {{-- <div class="row gy-4">
                  <div class="col-md-6">
                    <div class="img-2">
                      <img src="assets/img/destinations/destination-s-1-2.jpg" alt="image">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="img-2">
                      <img src="assets/img/destinations/destination-s-1-3.jpg" alt="image">
                    </div>
                  </div>
                </div> --}}
          
                <h2 class="ds-title">Image {{$destination->name}}</h2>
                <p class="ds-text">.</p>
                <div class="mt-4">
                  <div class="row">
               
                   @foreach ($imageGalerie as $item)
                   <div class="col-lg-4 col-md-6 col-sm-6 col-auto">
                    <div class="gallery-img5">
                      <img src="{{asset('upload/destination/multi_img/'.$item->image)}}" style="width: 325px;height:275px" alt="images">
                      <div class="gallery-content">
                        <a href="{{asset('upload/destination/multi_img/'.$item->image)}}" class="popup-image"><i
                            class="fas fa-plus"></i></a>
                      </div>
                    </div>
                  </div>
                   @endforeach
                   
                
                  </div>
                </div>
    
                <!-- Comment Form -->
                <div class="vs-comment-form">
                  <div id="respond" class="comment-respond">
                    <h3 class="blog-inner-title">Leave a Comment</h3>
                    <div class="row">
                      <div class="col-md-6 form-group">
                        <input type="text" class="form-control" placeholder="Enter Your Name">
                      </div>
                      <div class="col-md-6 form-group">
                        <input type="email" class="form-control" placeholder="Email Address">
                      </div>
                      <div class="col-12 form-group">
                        <textarea class="form-control" placeholder="Write Your Comment"></textarea>
                      </div>
                      <div class="col-12 ">
                        <div class="custom-checkbox notice">
                          <input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox"
                            value="yes">
                          <label for="wp-comment-cookies-consent"> Save my name, email, and website in this browser for
                            the next time I comment.</label>
                        </div>
                      </div>
                      <div class="col-12 form-group pt-lg-2">
                        <button class="vs-btn style4">Post Comment</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="sidebar-area">
                {{-- <div class="widget widget_search">
                  <div class="widget_title">Search</div>
                  <form class="search-form">
                    <input type="text" placeholder="Search Tour">
                    <button type="submit"><i class="far fa-search"></i></button>
                  </form> 
                </div> --}}
             
{{--     
                <div class="widget widget_categories">
                  <h3 class="widget_title">Categories</h3>
                  <ul>
                    <li><a class="active" href="#">Adventure</a> <span>(10)</span></li>
                    <li><a href="#">Food</a> <span>(5)</span></li>
                    <li><a href="#">New Year</a> <span>(8)</span></li>
                    <li><a href="#">Summer</a> <span>(3)</span></li>
                    <li><a href="#">Travel</a> <span>(9)</span></li>
                  </ul>
                </div>
     --}}
                <div class="widget widget-newsletter">
                  <h3 class="widget_title">Demander Package  {{$destination->name}}</h3>
                  <form action="{{route('envoie.form')}}" method="POST" class="newsletter-form">
                    @csrf
                    <input class="form-control" name="email" type="email" placeholder="Entrer votre Email" />
                    <input class="form-control" type="hidden" name="destination" value="{{$destination->name}}"  />
                    <input class="form-control" type="text" name="nom" placeholder="Entrer votre nom" />
                    <input class="form-control" type="number" name="nbr_Pax" placeholder="Nombre de personne" />
                    <textarea class="form-control" type="text" id="bsValidation13" name="message" placeholder="message" rows="3" required=""></textarea>

                    


                    

                    <input class="form-check-input" type="checkbox" name="voiture" value="" id="flexCheckCheckedSuccess" checked="">
                    <label class="form-check-label" for="flexCheckCheckedSuccess">
                      Voiture
                    </label> 
                    <button type="submit" class="vs-btn style4">Envoyez</button>
                  </form>
                </div>
    
      
    
                <div class="widget widget-social">
                  <h3 class="widget_title">Never Miss News</h3>
                  <div class="social-style widget_social_style">
                    <a href="#" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="#" target="_blank"><i class="fab fa-pinterest-p"></i></a>
                    <a href="#" target="_blank"><i class="fab fa-twitter"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!--==============================
          Destination Details Area End
        ==============================-->
    
@endsection