@if ($paginator->hasPages())
    @if ($paginator->onFirstPage())
    <a class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
        <span aria-hidden="true"><i class="fas fa-chevron-left"></i></span>
    </a>
    @else
 
        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')"><i class="fas fa-chevron-left"></i></a>
  
    @endif

       {{-- Pagination Elements --}}
       @foreach ($elements as $element)
       {{-- "Three Dots" Separator --}}
       @if (is_string($element))
           <span>{{ $element }}</span>
       @endif

       {{-- Array Of Links --}}
       @if (is_array($element))
           @foreach ($element as $page => $url)
               @if ($page == $paginator->currentPage())
                   <span>{{ $page }}</span>
               @else
                  <a href="{{ $url }}">{{ $page }}</a>
               @endif
           @endforeach
       @endif
   @endforeach
     {{-- Next Page Link --}}
     @if ($paginator->hasMorePages())
    
         <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')"><i class="fas fa-chevron-right"></i></a>
     
 @else
     <a class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
         <span aria-hidden="true"><i class="fas fa-chevron-right"></i></span>
     </a>
 @endif


@endif
{{-- <ul>
    <li><a href="#"><i class="fas fa-chevron-left"></i></a></li>
    <li><a href="#">1</a></li>
    <li><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#"><i class="fas fa-chevron-right"></i></a></li>
  </ul> --}}

 
