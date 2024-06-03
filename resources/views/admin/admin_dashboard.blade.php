<!doctype html>
<html lang="en" class="semi-dark">

<head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--favicon-->
	<link rel="icon" href="{{asset('backend/assets/images/favicon-32x32.png')}}" type="image/png" />
	<!--plugins-->
	<link href="{{asset('backend/assets/plugins/notifications/css/lobibox.min.css')}}" rel="stylesheet"/>
	<link href="{{asset('backend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet"/>
	<link href="{{asset('backend/assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
	<link href="{{asset('backend/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
	<link href="{{asset('backend/assets/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />
	<!-- loader-->
	<link href="{{asset('backend/assets/css/pace.min.css')}}" rel="stylesheet"/>
	<script src="{{asset('backend/assets/js/pace.min.js')}}"></script>
	<!-- Bootstrap CSS -->
	<link href="{{asset('backend/assets/css/bootstrap.min.css')}}" rel="stylesheet">
	<link href="{{asset('backend/assets/css/bootstrap-extended.css')}}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
	<link href="{{asset('backend/assets/css/app.css')}}" rel="stylesheet">
	<link href="{{asset('backend/assets/css/icons.css')}}" rel="stylesheet">
	<!-- Theme Style CSS -->
	<link rel="stylesheet" href="{{asset('backend/assets/css/dark-theme.css')}}" />
	<link rel="stylesheet" href="{{asset('backend/assets/css/semi-dark.css')}}" />
	<link rel="stylesheet" href="{{asset('backend/assets/css/header-colors.css')}}" />
    <!-- Toster -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >
	
	{{-- Datatable --}}
	<link href=" {{asset('backend/assets/plugins/datatable/css/dataTables.bootstrap5.min.css')}}" rel="stylesheet" />
	<title>Soluguide Dashboard</title>
	<link href="node_modules/froala-editor/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
</head>

<body onload="info_noti()">
	<!--wrapper-->
	<div class="wrapper">
		<!--sidebar wrapper -->
		@include('admin.body.sidebare')
		<!--end sidebar wrapper -->
		<!--start header -->
        @include('admin.body.header')
		<!--end header -->
		<!--start page wrapper -->
		<div class="page-wrapper">
			@yield('admin')
		</div>
		<!--end page wrapper -->
		<!--start overlay-->
		<div class="overlay toggle-icon"></div>
		<!--end overlay-->
		<!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
		<!--End Back To Top Button-->
	@include('admin.body.footer')
	</div>
	<!--end wrapper-->





	<!--start switcher-->
	
	
	<!--end switcher-->
	<!-- Bootstrap JS -->
	<script src="{{asset('backend/assets/js/bootstrap.bundle.min.js')}}"></script>
	<!--plugins-->
	<script src="{{asset('backend/assets/js/jquery.min.js')}}"></script>
	<script src="{{asset('backend/assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
	<script src="{{asset('backend/assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
	<script src="{{asset('backend/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
	<script src="{{asset('backend/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>
    <script src="{{asset('backend/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
	<script src="{{asset('backend/assets/plugins/chartjs/js/chart.js')}}"></script>
	<script src="{{asset('backend/assets/plugins/chartjs/js/Chart.extension.js')}}"></script>
	<script src="{{asset('backend/assets/plugins/sparkline-charts/jquery.sparkline.min.js')}}"></script>
	<!--notification js -->
	<script src="{{asset('backend/assets/plugins/notifications/js/lobibox.min.js')}}"></script>
	<script src="{{asset('backend/assets/plugins/notifications/js/notifications.min.js')}}"></script>
	<script src="{{asset('backend/assets/js/index3.js')}}"></script>
	<!--app JS-->
	<script src="{{asset('backend/assets/js/app.js')}}"></script>

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- Toaster-->
	<script>
	 @if(Session::has('message'))
	 var type = "{{ Session::get('alert-type','info') }}"
	 switch(type){
		case 'info':
		toastr.info(" {{ Session::get('message') }} ");
		break;
	
		case 'success':
		toastr.success(" {{ Session::get('message') }} ");
		break;
	
		case 'warning':
		toastr.warning(" {{ Session::get('message') }} ");
		break;
	
		case 'error':
		toastr.error(" {{ Session::get('message') }} ");
		break; 
	 }
	 @endif 
	</script>

	{{-- Delete --}}
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

 <script src="{{ asset('backend/assets/js/code.js') }}"></script>


    <script>
		$(function(){
    $(document).on('click','#delete',function(e){
        e.preventDefault();
        var link = $(this).attr("href");

  
                  Swal.fire({
                    title: 'Vous etes sur ?',
                    text: "De vouloir supprimer?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Oui, Supprimer!'
                  }).then((result) => {
                    if (result.isConfirmed) {
                      window.location.href = link
                      Swal.fire(
                        'Deleted!',
                        'Suppprimer avec succes.',
                        'success'
                      )
                    }
                  }) 


    });

  });
	</script>
		 </script>
		 {{-- DataTable JS --}}
			 <script src=" {{asset('backend/assets/plugins/datatable/js/jquery.dataTables.min.js')}} "></script>
			 <script src=" {{asset('backend/assets/plugins/datatable/js/dataTables.bootstrap5.min.js')}} "></script>
			 <script>
				 $(document).ready(function() {
					 $('#example').DataTable();
				   } );
			 </script>
		 {{-- End DataTable JS --}}

		   {{-- TyniText Editor --}}
	 {{-- <script src="https://cdn.tiny.cloud/1/86rr80i272jvqoq70sl2bxtoo3ntpqozqnamhim37gh1l4qg/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script> --}}
	 <!-- Place the first <script> tag in your HTML's <head> -->
		<script src="https://cdn.tiny.cloud/1/ncgg3kfk200ae0f3hax0io2deq63iv2afbadbbdkgo0ymmn4/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

<!-- Place the following <script> and <textarea> tags your HTML's <body> -->
<script>
  tinymce.init({
    selector: 'textarea',
    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage advtemplate ai mentions tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss markdown',
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
    tinycomments_mode: 'embedded',
    tinycomments_author: 'Author name',
    mergetags_list: [
      { value: 'First.Name', title: 'First Name' },
      { value: 'Email', title: 'Email' },
    ],
    ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
  });
</script>
{{-- <textarea>
  Welcome to TinyMCE!
</textarea>
	 <script>
	 tinymce.init({
		 selector: 'textarea#myeditorinstance', // Replace this CSS selector to match the placeholder element for TinyMCE
		 plugins: 'powerpaste advcode table lists checklist markdown',
		 toolbar: 'undo redo | blocks| bold italic | bullist numlist checklist | code | table'
	 });
	 </script>
	
	 <script type="text/javascript" src="node_modules/froala-editor/js/froala_editor.pkgd.min.js"></script>
	 <script> 
		var editor = new FroalaEditor('#example');
	</script> --}}

	{{-- <script>
		tinymce.init({
		  selector: 'textarea',
		  plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage advtemplate ai mentions tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss markdown',
		  toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
		  tinycomments_mode: 'embedded',
		  tinycomments_author: 'Author name',
		  mergetags_list: [
			{ value: 'First.Name', title: 'First Name' },
			{ value: 'Email', title: 'Email' },
		  ],
		  ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
		});
	  </script>
	  <textarea>
		Welcome to TinyMCE!
	  </textarea> --}}
</body>

</html>