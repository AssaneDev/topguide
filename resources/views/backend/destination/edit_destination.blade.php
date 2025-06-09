@extends('admin.admin_dashboard')
@section('admin')

<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!-- Quill CSS -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<!-- Quill JS -->
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

<div class="page-content">
    <!-- Breadcrumb -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Modifier Destinations</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Modifier destinations</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body p-4">
                            <form class="row g-3" action="{{ route('update.destination') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $dataDesti->id }}">

                                <div class="col-md-6">
                                    <label class="form-label">Nom</label>
                                    <input type="text" name="name" class="form-control" id="input-name" value="{{ $dataDesti->name }}">

                                    <label class="form-label">Prix</label>
                                    <input type="number" name="prix" class="form-control mb-10" id="input-prix" value="{{ $dataDesti->prix }}">

                                    <label class="form-label">Prix Guide</label>
                                    <input type="number" name="prix_guide" class="form-control mb-10" id="input-prix-guide" value="{{ $dataDesti->prix_guide }}">

                                    <label class="form-label">Types Circuit</label>
                                    <input type="text" name="type_circuit" class="form-control mb-10" id="input-type-circuit" value="{{ $dataDesti->type_circuit }}">

                                    <label class="form-label">Lieux</label>
                                    <input type="text" name="lieux" class="form-control mb-10" id="input-lieux" value="{{ $dataDesti->lieux }}">

                                    <label class="form-label">Durée Séjours</label>
                                    <input type="text" name="dure_sejour" class="form-control mb-10" id="input-duree" value="{{ $dataDesti->dure_sejour }}">
                                </div>

                                <!-- Quill Editors -->
                                <div class="form-group mb-3">
                                    <label>Offre Tout Compris</label>
                                    <div id="editor-information">{!! $dataDesti->information !!}</div>
                                    <input type="hidden" name="information" id="input-information">
                                </div>

                                <div class="form-group mb-3">
                                    <label>Offre Guide Unique</label>
                                    <div id="editor-guide">{!! $dataDesti->offre_guide !!}</div>
                                    <input type="hidden" name="offre_guide" id="input-guide">
                                </div>

                                <div class="form-group mb-3">
                                    <label>Courte Description</label>
                                    <div id="editor-short">{!! $dataDesti->short_descp !!}</div>
                                    <input type="hidden" name="short_descp" id="input-short">
                                </div>

                                <div class="form-group mb-3">
                                    <label>Description complète</label>
                                    <div id="editor-long">{!! $dataDesti->long_descp !!}</div>
                                    <input type="hidden" name="long_descp" id="input-long">
                                </div>

                                <!-- Uploads -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="form-label">Image Caption</label>
                                        <input class="form-control" name="image_cap" type="file" id="image">
                                    </div>
                                    <div class="col-md-6">
                                        <img id="showImage" src="{{ asset($dataDesti->image_cap) }}" alt="Admin" class="rounded-circle p-1 bg-primary" width="80"/>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Image Baniere</label>
                                    <input class="form-control" name="image" type="file" id="image-banner">
                                    <img src="{{ asset($dataDesti->image) }}" alt="Admin" width="80" />
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Images Galerie</label>
                                    <input type="file" name="multi_img[]" class="form-control" id="multiImg" multiple accept="image/jpeg,image/jpg,image/gif,image/png">
                                    @foreach ($multiimgs as $item)
                                        <img src="{{ (!empty($item->image)) ? url('/upload/destination/multi_img/'.$item->image) : url('upload/no_image.jpg') }}" alt="Admin" class="bg-primary" width="70px" />
                                        <a href="{{ route('multi.image.delete', $item->id) }}"> <i class="lni lni-close"></i> </a>
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

<script>
    $(document).ready(function() {
        $('#image').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files[0]);
        });

        $('#multiImg').on('change', function() {
            var data = $(this)[0].files;
            $.each(data, function(index, file) {
                if (/\.(gif|jpe?g|png)$/i.test(file.name)) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        var img = $('<img/>').addClass('thumb').attr('src', e.target.result).width(100).height(80);
                        $('#preview_img').append(img);
                    }
                    reader.readAsDataURL(file);
                }
            });
        });
    });
</script>

<script>
    const toolbarOptions = [
        ['bold', 'italic', 'underline', 'strike'],
        [{ 'header': 1 }, { 'header': 2 }],
        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
        [{ 'script': 'sub'}, { 'script': 'super' }],
        [{ 'indent': '-1'}, { 'indent': '+1' }],
        [{ 'direction': 'rtl' }],
        [{ 'size': ['small', false, 'large', 'huge'] }],
        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
        [{ 'color': [] }, { 'background': [] }],
        [{ 'font': [] }],
        [{ 'align': [] }],
        ['clean']
    ];

    const editors = [
        { id: 'information', label: 'editor-information', input: 'input-information' },
        { id: 'guide', label: 'editor-guide', input: 'input-guide' },
        { id: 'short', label: 'editor-short', input: 'input-short' },
        { id: 'long', label: 'editor-long', input: 'input-long' }
    ];

    const quillInstances = {};

    editors.forEach(({ id, label, input }) => {
        quillInstances[id] = new Quill(`#${label}`, {
            theme: 'snow',
            modules: { toolbar: toolbarOptions }
        });

        document.querySelector('form').addEventListener('submit', function() {
            document.getElementById(input).value = quillInstances[id].root.innerHTML;
        });
    });
</script>
@endsection
