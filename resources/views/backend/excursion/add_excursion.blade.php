@extends('admin.admin_dashboard')
@section('admin')

<style>
    .mb-10 {
        margin-bottom: 12px;
    }
</style>


<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!-- Quill CSS -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<!-- Quill JS -->
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

<div class="page-content">
    <!-- Breadcrumb -->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Excursion</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Ajouter aux excursions</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container">
        <div class="main-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body p-4">
                            <form class="row g-3" action="{{ route('store.excursion') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <!-- Étape 1 : Informations de base -->
                                <div class="col-md-6">
                                    <span class="badge bg-warning text-dark">ÉTAPE 1</span><br>
                                    <label class="form-label">Nom Excursion</label>
                                    <input type="text" name="name" class="form-control mb-10">

                                    <label class="form-label">Prix Excursion</label>
                                    <input type="number" name="prix" class="form-control mb-10">

                                    <label class="form-label">Prix Guide</label>
                                    <input type="number" name="prix_guide" class="form-control mb-10">

                                    <label class="form-label">Types Excursion</label>
                                    <input type="text" name="type_excursion" class="form-control mb-10">

                                    <label class="form-label">Lieux</label>
                                    <input type="text" name="lieux" class="form-control mb-10">

                                    <label class="form-label">Durée Excursion</label>
                                    <input type="text" name="dure_excursion" class="form-control mb-10">
                                </div>

                                <!-- Étape 2 : Zones de texte Quill -->
                                <div class="col-md-12">
                                    <label class="form-label">Offre Tout Compris</label>
                                    <div id="editor-information" style="height: 150px;"></div>
                                    <input type="hidden" name="information" id="input-information">
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Offre Guide Unique</label>
                                    <div id="editor-guide" style="height: 150px;"></div>
                                    <input type="hidden" name="offre_guide" id="input-guide">
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Courte Description</label>
                                    <div id="editor-short" style="height: 150px;"></div>
                                    <input type="hidden" name="short_descp" id="input-short">
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Description complète</label>
                                    <div id="editor-long" style="height: 150px;"></div>
                                    <input type="hidden" name="long_descp" id="input-long">
                                </div>

                                <!-- Étape 3 : Images -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <span class="badge bg-warning text-dark">ÉTAPE 5</span><br>
                                        <label class="form-label">Image Caption</label>
                                        <input class="form-control" name="image_cap" type="file" id="image">
                                    </div>

                                    <div class="col-md-6">
                                        <img id="showImage" src="{{ url('upload/no_image.jpg') }}" alt="Aperçu" class="rounded-circle p-1 bg-primary" width="80"/>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <span class="badge bg-warning text-dark">ÉTAPE 6</span><br>
                                    <label class="form-label">Image Bannière</label>
                                    <input class="form-control" name="image" type="file">
                                    <img src="{{ url('upload/no_image.jpg') }}" alt="Aperçu" class="rounded-circle p-1 bg-primary" width="80"/>
                                </div>

                                <!-- Étape 4 : Galerie -->
                                <div class="col-md-6">
                                    <span class="badge bg-warning text-dark">ÉTAPE 7</span><br>
                                    <label class="form-label">Images Galerie</label>
                                    <input type="file" name="multi_img[]" class="form-control" id="multiImg" multiple accept="image/jpeg,image/jpg,image/gif,image/png">
                                    <div class="row" id="preview_img"></div>
                                </div>

                                <!-- Bouton -->
                                <div class="col-md-12 mt-10">
                                    <div class="d-md-flex d-grid align-items-center gap-3">
                                        <button type="submit" class="btn btn-primary px-4">Enregistrer</button>
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

<!-- Affichage image -->
<script>
    $(document).ready(function () {
        $('#image').change(function (e) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files[0]);
        });
    });
</script>

<!-- Affichage miniatures images -->
<script>
    $(document).ready(function () {
        $('#multiImg').on('change', function () {
            if (window.File && window.FileReader && window.FileList && window.Blob) {
                var data = $(this)[0].files;
                $.each(data, function (index, file) {
                    if (/\.(gif|jpe?g|png)$/i.test(file.type)) {
                        var fRead = new FileReader();
                        fRead.onload = (function (file) {
                            return function (e) {
                                var img = $('<img/>').addClass('thumb').attr('src', e.target.result).width(100).height(80);
                                $('#preview_img').append(img);
                            };
                        })(file);
                        fRead.readAsDataURL(file);
                    }
                });
            } else {
                alert("Votre navigateur ne supporte pas l'API File.");
            }
        });
    });
</script>



<script>
    const toolbarOptions = [
        ['bold', 'italic', 'underline', 'strike'],
        [{ 'header': 1 }, { 'header': 2 }],
        [{ 'list': 'ordered' }, { 'list': 'bullet' }],
        [{ 'indent': '-1' }, { 'indent': '+1' }],
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

    function removeInvisibleChars(html) {
        return html.replace(/[\u200B-\u200D\uFEFF]/g, '');
    }

    editors.forEach(({ id, label }) => {
        quillInstances[id] = new Quill(`#${label}`, {
            theme: 'snow',
            modules: { toolbar: toolbarOptions }
        });

        // Nettoyer à la volée
        quillInstances[id].root.addEventListener('input', function () {
            this.innerHTML = removeInvisibleChars(this.innerHTML);
        });
    });

    document.querySelector('form').addEventListener('submit', function () {
        editors.forEach(({ id, input }) => {
            const raw = quillInstances[id].root.innerHTML;
            const clean = removeInvisibleChars(raw);
            document.getElementById(input).value = clean;
        });
    });
</script>

@endsection
