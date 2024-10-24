<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src=" {{asset('backend/assets/images/logo-icon.png')}} " class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">SoluGuide</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-back'></i>
        </div>
     </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{route('admin.dashboard')}}">
                <div class="parent-icon"><i class='bx bx-home-alt'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>
       

        <li>
            {{-- <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Destination</div>
            </a> --}}
            <ul>
                <li> <a href="{{route('all.destinations')}}"><i class='bx bx-radio-circle'></i>Destination</a>
                </li>
                
               
            </ul>
        </li>
        <li class="menu-label">Blog</li>
       
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cart'></i>
                </div>
                <div class="menu-title">Article Blog</div>
            </a>
            <ul>
                <li> <a href="{{route('blog.category')}}"><i class='bx bx-radio-circle'></i>Cétégorie Blog</a>
                </li>
                <li> <a href="{{route('all.blog.post')}}"><i class='bx bx-radio-circle'></i>Tous Les Articles</a>
                </li>

                <li> <a href="{{url('/optimize')}}"><i class='bx bx-radio-circle'></i>Clear Cache</a>
                </li>
               
            </ul>
        </li>

        <li class="menu-label">Guides</li>
       
        <li>
            <a href="javascript:;" class="has-arrow">
               
                <div class="menu-title">Gestion Guides</div>
            </a>
            <ul>
                <li> <a href="{{route('blog.category')}}"><i class='bx bx-radio-circle'></i>Ajouter Un Guide</a>
                </li>
                <li> <a href="{{route('all.blog.post')}}"><i class='bx bx-radio-circle'></i>Liste Guides</a>
                </li>

                
               
            </ul>
        </li>
    </ul>
    <!--end navigation-->
</div>