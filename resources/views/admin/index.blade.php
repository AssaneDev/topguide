@extends('admin.admin_dashboard')
@section('admin')
    
<div class="page-content">
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-2 row-cols-xxl-4">
       <div class="col">
         <div class="card radius-10 bg-gradient-cosmic">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="me-auto">
                        <p class="mb-0 text-white">Total Orders</p>
                        <h4 class="my-1 text-white">4805</h4>
                        <p class="mb-0 font-13 text-white">+2.5% from last week</p>
                    </div>
                    <div id="chart1"></div>
                </div>
            </div>
         </div>
       </div>
       <div class="col">
        <div class="card radius-10 bg-gradient-ibiza">
           <div class="card-body">
               <div class="d-flex align-items-center">
                   <div class="me-auto">
                       <p class="mb-0 text-white">Total Revenue</p>
                       <h4 class="my-1 text-white">$84,245</h4>
                       <p class="mb-0 font-13 text-white">+5.4% from last week</p>
                   </div>
                   <div id="chart2"></div>
               </div>
           </div>
        </div>
      </div>
      <div class="col">
        <div class="card radius-10 bg-gradient-ohhappiness">
           <div class="card-body">
               <div class="d-flex align-items-center">
                   <div class="me-auto">
                       <p class="mb-0 text-white">Bounce Rate</p>
                       <h4 class="my-1 text-white">34.6%</h4>
                       <p class="mb-0 font-13 text-white">-4.5% from last week</p>
                   </div>
                   <div id="chart3"></div>
               </div>
           </div>
        </div>
      </div>
      <div class="col">
        <div class="card radius-10 bg-gradient-kyoto">
           <div class="card-body">
               <div class="d-flex align-items-center">
                   <div class="me-auto">
                       <p class="mb-0 text-dark">Total Customers</p>
                       <h4 class="my-1 text-dark">8.4K</h4>
                       <p class="mb-0 font-13 text-dark">+8.4% from last week</p>
                   </div>
                   <div id="chart4"></div>
               </div>
           </div>
        </div>
      </div> 
    </div><!--end row-->

   

 


   <center><h1 class="badge rounded-pill bg-success" style="font-size: 80px" >Bienvenue Admin de Top Guide</h1>
   </center> 
   <center>
    <button type="button" class="btn btn-outline-success px-5 radius-30">Liste Destination</button>
    <button type="button" class="btn btn-outline-info px-5 radius-30">Liste Categorie Blog</button>
    <button type="button" class="btn btn-outline-warning px-5 radius-30">Liste Article Blog</button>
   </center>
   

         
   
           
  
</div>

@endsection