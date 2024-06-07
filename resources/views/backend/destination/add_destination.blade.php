@extends('admin.admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Destinations</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Ajouter aux destinations</li>
                </ol>
            </nav>
        </div>
       
    </div>
    <!--end breadcrumb-->
    <div class="container">
        <div class="main-body">
            <div class="row">
               
                <div class="col-lg-12">
                    <div class="card">
                             
                   
                            <div class="card">
                                <div class="card-body p-4">
                              
                        <form class="row g-3"  action="{{route('store.destination')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <span class="badge bg-warning text-dark">ETAPE  1</span> </br>
                                                <label for="input1" class="form-label">Nom</label>
                                                <input type="text" name="name"  class="form-control" id="input1" >
                                            </div>
                                        
                                         
                                        </div>
                                        <div class="col-md-12 ">
                                            <span class="badge bg-warning text-dark">ETAPE  2</span> </br>

                                            <label for="input11" class="form-label">Courte Description</label>
                                            <textarea class="form-control" name="short_descp" id="input11" placeholder="" rows="3"></textarea>
                                        </div>

                                        <div class="col-md-12">
                                            <span class="badge bg-warning text-dark">ETAPE  3</span> </br>

                                            <label for="input11" class="form-label">Description</label>
                                            <textarea class="form-control" name="long_descp"  id="myeditorinstance" name="description" value rows="3"></textarea>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                            <span class="badge bg-warning text-dark">ETAPE  4</span> </br>

                                                <label for="input11" class="form-label">Image Caption</label>
                                                <input class="form-control" name="image_cap" type="file" id="image">
                                            </div>
                                           
    
                                            <div class="col-md-6">
                                                <img id="showImage" src=" {{  url('upload/no_image.jpg')}} " alt="Admin" class="rounded-circle p-1 bg-primary" width="80"/>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <span class="badge bg-warning text-dark">ETAPE  5</span> </br>

                                            <label for="input11" class="form-label">Image Baniere</label>
                                               
                                            <input class="form-control" name="image" type="file" id="image">
                                            <img id="showImage" src="{{url('upload/no_image.jpg')}}" alt="Admin" class="rounded-circle p-1 bg-primary" width="80" />
                                        </div>


                                        <div class="col-md-6">
                                            <span class="badge bg-warning text-dark">ETAPE  6</span> </br>

                                            <label for="input4" class="form-label">Images Galerie</label>
                                            <input type="file" name="multi_img[]" class="form-control" id="multiImg" multiple accept="image/jpeg,image/jpg,image/gif,image/png">
                                             
                                            {{-- @foreach ($multiimgs as $item)
                                            <img src=" {{ (!empty($item->multi_img)) ? url('upload/roomimg/multi_img/'.$item->multi_img)  : url('upload/no_image.jpg') }} " alt="Admin" class="bg-primary" width="70px" />
                                            <a href="{{route('multi.image.delete',$item->id)}}"> <i class="lni lni-close"></i> </a>
                                            @endforeach --}}

                                            <div class="row" id="preview_img"></div>
                                        </div>
                                     
                                        
                                        <div class="col-md-12 mt-10">
                                            <div class="d-md-flex d-grid align-items-center gap-3">
                                                <button type="submit" class="btn btn-primary px-4">Enrigistrer</button>
                                               
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                  
                </div>
            </div>
        </div>
    </div>
</div>

   <script type="text/javascript">
        $(document).ready(function(){
            $('#image').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            });
        });
   </script>

   <!--------===Show MultiImage ========------->
<script>
    $(document).ready(function(){
     $('#multiImg').on('change', function(){ //on file input change
        if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
        {
            var data = $(this)[0].files; //this file data
             
            $.each(data, function(index, file){ //loop though each file
                if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                    var fRead = new FileReader(); //new filereader
                    fRead.onload = (function(file){ //trigger function on successful read
                    return function(e) {
                        var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(100)
                    .height(80); //create image element 
                        $('#preview_img').append(img); //append image to output element
                    };
                    })(file);
                    fRead.readAsDataURL(file); //URL representing the file's data.
                }
            });
             
        }else{
            alert("Your browser doesn't support File API!"); //if File API is absent
        }
     });
    });
 </script>
@endsection
