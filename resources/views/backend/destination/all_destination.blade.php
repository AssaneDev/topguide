@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
 
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">LISTE DES DESTINATIONS</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">
            <div class="btn-group">
                <a href="{{route('add.destination')}}" class="btn btn-primary px-5 "> Ajouter une destination</a>
               
            </div>
        </div>
    </div>
    <!--end breadcrumb-->
   
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                      
                            
                        
                        <tr>
                            <th>S1</th>
                            <th>Nom</th>
                            <th>Courte description</th>
                            <th>Image destination</th>
                            <th>Action</th>

                            
                           
                        </tr>
                    </thead>
                    <tbody>
                      @foreach ($desti as $key=>$item)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->short_descp}}</td>
                            <td><img src="{{asset($item->image_cap)}}" alt="" style="width: 70px; height: 40px;"></td>
                           
                            <td>
                                <a href=" {{route('edit.destination',$item->id)}}  " class="btn btn-warning px-3 radius-30"> Modifier</a>
                                <a href="{{route('delete.destination',$item->id)}}" class="btn btn-danger px-3 radius-30" id="delete"> Supprimer</a>

                            </td>
                        </tr>
                      @endforeach
                       
                    </tbody>
               
                </table>
            </div>
        </div>
    </div>
   
    <hr/>
   
</div>
@endsection