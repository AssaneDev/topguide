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

   

 

     <div class="card radius-10">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <div>
                    <h6 class="mb-0">Recent Orders</h6>
                </div>
                <div class="dropdown ms-auto">
                    <a class="dropdown-toggle dropdown-toggle-nocaret" href="#" data-bs-toggle="dropdown"><i class='bx bx-dots-horizontal-rounded font-22 text-option'></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="javascript:;">Action</a>
                        </li>
                        <li><a class="dropdown-item" href="javascript:;">Another action</a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="javascript:;">Something else here</a>
                        </li>
                    </ul>
                </div>
            </div>
         </div>
             <div class="card-body">
                
             <div class="table-responsive">
               <table class="table align-middle mb-0">
                <thead class="table-light">
                 <tr>
                   <th>Product</th>
                   <th>Photo</th>
                   <th>Product ID</th>
                   <th>Status</th>
                   <th>Amount</th>
                   <th>Date</th>
                   <th>Shipping</th>
                 </tr>
                 </thead>
                 <tbody><tr>
                  <td>Iphone 5</td>
                  <td><img src="assets/images/products/18.png" class="product-img-2" alt="product img"></td>
                  <td>#9405822</td>
                  <td><span class="badge bg-gradient-quepal text-white shadow-sm w-100">Paid</span></td>
                  <td>$1250.00</td>
                  <td>03 Feb 2020</td>
                  <td><div class="progress" style="height: 5px;">
                        <div class="progress-bar bg-gradient-quepal" role="progressbar" style="width: 100%"></div>
                      </div></td>
                 </tr>

                 <tr>
                  <td>Earphone GL</td>
                  <td><img src="assets/images/products/16.png" class="product-img-2" alt="product img"></td>
                  <td>#8304620</td>
                  <td><span class="badge bg-gradient-blooker text-white shadow-sm w-100">Pending</span></td>
                  <td>$1500.00</td>
                  <td>05 Feb 2020</td>
                  <td><div class="progress" style="height: 5px;">
                        <div class="progress-bar bg-gradient-blooker" role="progressbar" style="width: 60%"></div>
                      </div></td>
                 </tr>

                 <tr>
                  <td>HD Hand Camera</td>
                  <td><img src="assets/images/products/19.png" class="product-img-2" alt="product img"></td>
                  <td>#4736890</td>
                  <td><span class="badge bg-gradient-bloody text-white shadow-sm w-100">Failed</span></td>
                  <td>$1400.00</td>
                  <td>06 Feb 2020</td>
                  <td><div class="progress" style="height: 5px;">
                        <div class="progress-bar bg-gradient-bloody" role="progressbar" style="width: 70%"></div>
                      </div></td>
                 </tr>

                 <tr>
                  <td>Clasic Shoes</td>
                  <td><img src="assets/images/products/04.png" class="product-img-2" alt="product img"></td>
                  <td>#8543765</td>
                  <td><span class="badge bg-gradient-quepal text-white shadow-sm w-100">Paid</span></td>
                  <td>$1200.00</td>
                  <td>14 Feb 2020</td>
                  <td><div class="progress" style="height: 5px;">
                        <div class="progress-bar bg-gradient-quepal" role="progressbar" style="width: 100%"></div>
                      </div></td>
                 </tr>
                 <tr>
                  <td>Sitting Chair</td>
                  <td><img src="assets/images/products/11.png" class="product-img-2" alt="product img"></td>
                  <td>#9629240</td>
                  <td><span class="badge bg-gradient-blooker text-white shadow-sm w-100">Pending</span></td>
                  <td>$1500.00</td>
                  <td>18 Feb 2020</td>
                  <td><div class="progress" style="height: 5px;">
                        <div class="progress-bar bg-gradient-blooker" role="progressbar" style="width: 60%"></div>
                      </div></td>
                 </tr>
                 <tr>
                  <td>Hand Watch</td>
                  <td><img src="assets/images/products/17.png" class="product-img-2" alt="product img"></td>
                  <td>#8506790</td>
                  <td><span class="badge bg-gradient-bloody text-white shadow-sm w-100">Failed</span></td>
                  <td>$1800.00</td>
                  <td>21 Feb 2020</td>
                  <td><div class="progress" style="height: 5px;">
                        <div class="progress-bar bg-gradient-bloody" role="progressbar" style="width: 40%"></div>
                      </div></td>
                 </tr>
                </tbody>
              </table>
              </div>
             </div>
        </div>

      
         
   
           
         </div><!--end row-->
</div>

@endsection