@extends('admin.admin_dashboard')
@section('admin')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Modifier Excursion</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Modifier Exursion</li>
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
                              
                        <form class="row g-3"  action="{{route('update.excursion')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$dataDesti->id}}" id="">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="input1" class="form-label">Nom Excursion</label>
                                                <input type="text" name="name"  class="form-control" id="input1" value="{{$dataDesti->name}}" >
                                                <label for="input1"  class="form-label">Prix</label>
                                                <input  type="number" name="prix"  class="form-control mb-10" id="input1" value="{{$dataDesti->prix}}" >
                                                <label for="input1"  class="form-label">Prix Guide</label>
                                                <input  type="number" name="prix_guide"  class="form-control mb-10" id="input1" value="{{$dataDesti->prix_guide}}"  >
                                                <label for="input1"  class="form-label">Types Excursion</label>
                                                <input  type="text" name="type_excursion"  class="form-control mb-10" id="input1" value="{{$dataDesti->type_excursion}}" >
                                                <label for="input1"  class="form-label">Lieux</label>
                                                <input  type="text" name="lieux"  class="form-control mb-10" id="input1"value="{{$dataDesti->lieux}}" >
                                                <label for="input1"  class="form-label">Durée Séjours</label>
                                                <input  type="number" name="dure_sejour"  class="form-control mb-10" id="input1"value="{{$dataDesti->dure_sejour}}" >
                                                {{-- <label for="input1" class="form-label ">Nom ANGLAIS</label>
                                                <input type="text" name="name_en"  class="form-control mb-10" id="input1" value="{{$dataDesti->name_en}}">
                                                <label for="input1" class="form-label">Nom ESPAGNOL</label>
                                                <input type="text" name="name_es"  class="form-control  mb-10" id="input1" value="{{$dataDesti->name_en}}"> --}}
                                            </div>
                                        
                                         
                                        </div>
                                        <div class="col-md-12 ">
                                            <span class="badge bg-warning text-dark">ETAPE  2</span> </br>

                                            <label for="input11" class="form-label">Offre Tout Compris</label>
                                            <textarea class="form-control" name="information" id="myeditorinstance" placeholder="" rows="3">{{$dataDesti->information}}</textarea>

                                            {{-- <label for="input11" class="form-label mb-10">Courte Description <span class="badge rounded-pill text-bg-primary">ENGLAIS</span></label>
                                            <textarea class="form-control" name="short_descp_en" id="myeditorinstance" placeholder="" rows="3"></textarea>

                                            <label for="input11" class="form-label mb-10"> Courte Description <span class="badge rounded-pill text-bg-primary">ESPAGNOL</span></label>
                                            <textarea class="form-control" name="short_descp_es" id="myeditorinstance" placeholder="" rows="3"></textarea> --}}
                                        </div>
                                        <div class="col-md-12 ">
                                         

                                            <label for="input11" class="form-label">Offre Guide Unique</label>
                                            <textarea class="form-control" name="offre_guide" id="myeditorinstance" placeholder="" rows="3">{{$dataDesti->offre_guide}}</textarea>

                                            {{-- <label for="input11" class="form-label mb-10">Courte Description <span class="badge rounded-pill text-bg-primary">ENGLAIS</span></label>
                                            <textarea class="form-control" name="short_descp_en" id="myeditorinstance" placeholder="" rows="3"></textarea>

                                            <label for="input11" class="form-label mb-10"> Courte Description <span class="badge rounded-pill text-bg-primary">ESPAGNOL</span></label>
                                            <textarea class="form-control" name="short_descp_es" id="myeditorinstance" placeholder="" rows="3"></textarea> --}}
                                        </div>
                                        <div class="col-md-12 ">
                                            <label for="input11" class="form-label">Courte Description</label>
                                            
                                           
                                            <textarea class="form-control" name="short_descp"  id="myeditorinstance" name="description" value rows="3">{{$dataDesti->short_descp}}</textarea>


                                            {{-- <label for="input11" class="form-label mb-10">Courte Description <span class="badge rounded-pill text-bg-primary">ENGLAIS</span></label>
                                            <textarea class="form-control" name="short_descp_en" id="myeditorinstance" placeholder="" rows="3">{{$dataDesti->short_descp_en}}</textarea>

                                            <label for="input11" class="form-label mb-10"> Courte Description <span class="badge rounded-pill text-bg-primary">ESPAGNOL</span></label>
                                            <textarea class="form-control" name="short_descp_es" id="myeditorinstance" placeholder="" rows="3">{{$dataDesti->short_descp_es}}</textarea> --}}
                                        </div>

                                        <div class="col-md-12">
                                            <label for="input11" class="form-label">Description</label>
                                            <textarea class="form-control" name="long_descp"  id="myeditorinstance" name="description" value rows="3">{{$dataDesti->long_descp}}</textarea>

                                            {{-- <label for="input11" class="form-label mb-10">Description <span class="badge rounded-pill text-bg-primary">ENGLAIS</span></label>
                                            <textarea class="form-control" name="long_descp_en"  id="myeditorinstance" name="description" value rows="3">{{$dataDesti->long_descp_en}}</textarea>

                                            <label for="input11" class="form-label mb-10">Description <span class="badge rounded-pill text-bg-primary">ESPAGNOL</span></label>
                                            <textarea class="form-control" name="long_descp_es"  id="myeditorinstance" name="description" value rows="3">{{$dataDesti->long_descp_es}}</textarea> --}}
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="input11" class="form-label">Image Caption</label>
                                                <input class="form-control" name="image_cap" type="file" id="image">
                                            </div>
                                           
    
                                            <div class="col-md-6">
                                                <img id="showImage" src="{{ asset($dataDesti->image_cap)}} " alt="Admin" class="rounded-circle p-1 bg-primary" width="80"/>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <label for="input11" class="form-label">Image Baniere</label>
                                               
                                            <input class="form-control" name="image" type="file" id="image">
                                            <img id="showImage" src="{{asset($dataDesti->image)}} " alt="Admin"  width="80" />

                                        </div>


                                        <div class="col-md-6">
                                            <label for="input4" class="form-label">Images Galerie</label>
                                            <input type="file" name="multi_img[]" class="form-control" id="multiImg" multiple accept="image/jpeg,image/jpg,image/gif,image/png">
                                             
                                             @foreach ($multiimgs as $item)
                                            <img src=" {{ (!empty($item->image)) ? url('/upload/excursion/multi_img/'.$item->image)  : url('upload/no_image.jpg') }} " alt="Admin" class="bg-primary" width="70px" />
                                            <a href="{{route('multi.image.delete',$item->id)}}"> <i class="lni lni-close"></i> </a>
                                            @endforeach 

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
