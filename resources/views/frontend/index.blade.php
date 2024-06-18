
  @extends('frontend.main_master')
  @section('main')
  <!--==============================
      Hero Area Start 
    ==============================-->
  @include('frontend.home.hero')
      <!-- ============================
            Hero Area End 
          ==============================-->
    
      <!--==============================
        Tour Package Area Start 
      ==============================-->
    
      <!--==============================
        Tour Package Area End 
      ==============================-->
    
      <!--==============================
        About Area Start 
      ==============================-->
      @include('frontend.home.about')
      <!--==============================
        About Area End 
        <!--==============================
         Destiniations Area Start 
      ==============================-->
     @include('frontend.home.destination')
      {{-- ==============================--> --}}
      @include('frontend.home.voihebe')
          <!--==============================
               <!--==============================
         
        <!-- Features Area Start 
      ==============================-->
      {{-- @include('frontend.home.guide') --}}
      <!--==============================
        Features Area End 
      ==============================-->
      <!--==============================
        Gallery Area Start 
      ==============================-->
     @include('frontend.home.discover')
      <!--==============================
        Gallery Area End 
      ==============================-->
    
    
    
      <!--==============================
         Special Offer Area Start 
      ==============================-->
  {{-- @include('frontend.home.offer') --}}
      <!--==============================
         Special Offer Area End 
      ==============================-->
    
   

     @include('frontend.home.blog')
      @endsection  