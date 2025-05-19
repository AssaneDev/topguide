@extends('frontend.main_master')
@section('main')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >
 


 <!--==============================
	  Hero area Start
	==============================-->
     <div class="breadcumb-wrapper" data-bg-src="assets/img/breadcumb/breadcumb-bg.jpg">
          <div class="container z-index-common">
            <div class="breadcumb-content">
              <h1 class="breadcumb-title">{{$destination->name}} / {{$destination->dure_sejour}}-Jours</h1>
              <div class="breadcumb-menu-wrap">
                <ul class="breadcumb-menu">
                  <li><a href="index.html">{{$destination->name}}</a></li>
                  <li>Circuit</li>
                  <li>{{$destination->dure_sejour}} - Jours / 7 Nuits</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <!--==============================
             Hero Area End
           ==============================-->
      
        <!--==============================
             Tours Booking Area Start
           ==============================-->
        <section class="space-bottom">
          <div class="outer-wrap">
            <div class="filter-menu1 filter-menu-active wow fadeInUp wow-animated">
              <button class="tab-button active" data-filter=".tab-content1"><i class="fas fa-info-circle"></i>
                Offre Tout Compris</button>
                <button class="tab-button active" data-filter=".tab-content5"><i class="fas fa-info-circle"></i>
                  Offre Guides Unique</button>
              <button class="tab-button" data-filter=".tab-content2"><i class="fas fa-calendar"></i> Itineraire Circuit</button>
              {{-- <button class="tab-button" data-filter=".tab-content3"><i class="fas fa-map-marker-alt"></i>
                Location</button> --}}
              <button class="tab-button" data-filter=".tab-content4"><i class="fas fa-camera-retro"></i> Gallery</button>
              {{-- <button class="tab-button" data-filter=".tab-content5"><i class="fas fa-comments"></i> Reviews</button> --}}
            </div>
            <div class="container">
              <div class="shadow-content1">
                <div class="row">
                  <div class="col-lg-9">
                    <div class="filter-active tour-booking-active">
                      <div class="filter-item tab-content1">
                        <h2 style="font-size: 40px" class="badge bg-warning text-dark">{{$destination->prix}} €/Pers</h2> </br>

                              <div class="info-image">
                                   <img src="{{asset($destination->image)}}" alt="tours-img">
                                   
                              </div>

                              {!!$destination->information!!}

                        
                      </div>
                     
                    <div class="filter-item tab-content5">
                      <h2 style="font-size: 40px" class="badge bg-warning text-dark">50€/Jours</h2> </br>
                      <div class="info-image">
                        <img src="{{asset($destination->image)}}" alt="tours-img">
                        
                     </div>

                    {!!$destination->offre_guide!!}
                    </div>
                      <div class="filter-item tab-content2">
                        <h2 class="tab-title">Plan Circuit</h2>
                        {!!$destination->long_descp!!}
                      </div>
                      <div class="filter-item tab-content3">
                        <h2 class="tab-title">Tour Location</h2>
                        <p class="tab-text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula
                          eget dolor. Aenean massa. Cum sociis Theme natoque penatibus et magnis dis parturient montes,
                          nascetur ridiculus mus</p>
                        <div class="google-map">
                          <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d327444.36007492756!2d8.306929323325667!3d50.12074543827437!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47bd096f477096c5%3A0x422435029b0c600!2sFrankfurt%2C%20Germany!5e0!3m2!1sen!2sbd!4v1695590486221!5m2!1sen!2sbd"
                            loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                      </div>
                      <div class="filter-item tab-content4">
                        <h2 class="tab-title">Top Gallery</h2>
                        <p class="tab-text">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula
                          eget dolor. Aenean massa. Cum sociis Theme natoque penatibus et magnis dis parturient montes,
                          nascetur ridiculus mus</p>
                        <div class="gx-gy gallery-mesonary">
                         @foreach ($imageGalerie as $item)
                         <div class="col-lg-4 col-md-6 col-sm-6 col-auto">
                          <div class="gallery-img5">
                            <img src="{{asset('upload/destination/multi_img/'.$item->image)}}"  alt="images">
                            <div class="gallery-content">
                              <a href="{{asset('upload/destination/multi_img/'.$item->image)}}" class="popup-image"><i
                                  class="fas fa-plus"></i></a>
                            </div>
                          </div>
                        </div>
                         @endforeach
                        </div>
                      </div>
                     
                    </div>
                  </div>
                  <div class="col-lg-3">
                    <div class="sidebar-area tours-sidebar">
                        
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
                              <h3 class="widget_title">Suivre sur</h3>
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
              </div>
            </div>
          </div>
        </section>
        <!--==============================
             Tours Booking Area End






<!--==============================
          Destination Details Area End
     <!--notification js -->
<script src="{{asset('backend/assets/plugins/notifications/js/lobibox.min.js')}}"></script>
<script src="{{asset('backend/assets/plugins/notifications/js/notifications.min.js')}}"></script>
<script src="{{asset('backend/assets/js/index3.js')}}"></script>
   
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
