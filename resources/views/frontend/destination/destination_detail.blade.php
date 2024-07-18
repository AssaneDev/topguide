@extends('frontend.main_master')
@section('main')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >
 <!--==============================
	  Hero area Start
	==============================-->
    {{-- <div class="breadcumb-wrapper" data-bg-src="{{asset($destination->image)}}"style="width:1880px;height:587px; background-size:cover;" >
        <div class="container z-index-common">
          <div class="breadcumb-content"  >
            <h1 class="breadcumb-title" > <span style="background-color: rgba(0, 0, 0, 0.402);">{{$destination->name}}</span> </h1>
            
          </div>
        </div>
      </div> --}}
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
          
                <h2 class="ds-title">Gallery d'images </h2>
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
                {{-- <div class="vs-comment-form">
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
                </div> --}}
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
                  <h3 class="widget_title">Demander un programme {{$destination->name}}</h3>
                  <form action="{{route('envoie.form')}}" method="POST" class="newsletter-form">
                    @csrf
                    <input class="form-control" type="text" name="nom" placeholder="Entrer votre nom" />
                    <input class="form-control" name="email" type="email" placeholder="Entrer votre Email" />
                    <input class="form-control" name="tel" type="text" placeholder="Entrer votre numéro de Téléphone" />
                    <input class="form-control" type="hidden" name="destination" value="{{$destination->name}}"  />
                    <input class="form-control" type="number" name="nbr_Pax" placeholder="Nombre de personne" />
                    <textarea class="form-control" type="text" id="bsValidation13" name="message" placeholder="message" rows="3" required=""></textarea>

                    


                    

                    {{-- <input class="form-check-input" type="checkbox" name="voiture" value="" id="flexCheckCheckedSuccess" checked="">
                    <label class="form-check-label" for="flexCheckCheckedSuccess">
                      Voiture
                    </label>  --}}
                    <button type="submit" class="vs-btn style4">Envoyez</button>
                  </form>
                </div>
    
      
    
                <div class="widget widget-social">
                  <h3 class="widget_title">Suivez-Nous</h3>
                  <div class="social-style widget_social_style">
                    <a href="https://web.facebook.com/profile.php?id=61560799666028" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    {{-- <a href="#" target="_blank"><i class="fab fa-instagram"></i></a> --}}
                    {{-- <a href="#" target="_blank"><i class="fab fa-tiktok"></i></a> --}}
                    {{-- <a href="#" target="_blank"><i class="fab fa-twitter"></i></a> --}}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!--==============================
          Destination Details Area End
     <!--notification js -->
<script src="{{asset('backend/assets/plugins/notifications/js/lobibox.min.js')}}"></script>
<script src="{{asset('backend/assets/plugins/notifications/js/notifications.min.js')}}"></script>
<script src="{{asset('backend/assets/js/index3.js')}}"></script>
   ==============================-->
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
   <!-- Toaster-->
 <script>
  @if(Session::has('message'))
  var type = "{{ Session::get('alert-type','info') }}"
  switch(type){
   case 'info':
   toastr.info(" {{ Session::get('message') }} ");
   break;
 
   case 'success':
   toastr.success(" {{ Session::get('message') }} ");
   break;
 
   case 'warning':
   toastr.warning(" {{ Session::get('message') }} ");
   break;
 
   case 'error':
   toastr.error(" {{ Session::get('message') }} ");
   break; 
  }
  @endif 
 </script>
    
@endsection
