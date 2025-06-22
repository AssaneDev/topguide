
  @extends('frontend.main_master')
  @section('main')
 
  @include('frontend.home.hero')
  
      @include('frontend.home.about')
    
     @include('frontend.home.destination')

      {{-- @include('frontend.home.voyagegroupe') --}}
     @include('frontend.home.blog')
     @include('frontend.home.discover')


     
      @endsection  