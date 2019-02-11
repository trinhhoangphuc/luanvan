<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="csrf-token" content="{{ csrf_token()}}"/>

	<link rel="icon" type="image/png" sizes="16x16" href="{{asset('public/images/layouts/logo2.png')}}">
	<title>@yield('title')</title>

	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

	<link rel="stylesheet" href="{{asset('public/libs2/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="{{asset('public/libs2/bower_components/font-awesome/css/font-awesome.min.css')}}">
	<!-- Ionicons -->
	<link rel="stylesheet" href="{{asset('public/libs2/bower_components/Ionicons/css/ionicons.min.css')}}">
	<!-- daterange picker -->
	<link rel="stylesheet" href="{{asset('public/libs2/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
	<!-- bootstrap datepicker -->
	<link rel="stylesheet" href="{{asset('public/libs2/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
	<!-- iCheck for checkboxes and radio inputs -->
	<link rel="stylesheet" href="{{asset('public/libs2/plugins/iCheck/all.css')}}">
	<!-- Bootstrap Color Picker -->
	<link rel="stylesheet" href="{{asset('public/libs2/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css')}}">
	<!-- Bootstrap time Picker -->
	<link rel="stylesheet" href="{{asset('public/libs2/plugins/timepicker/bootstrap-timepicker.min.css')}}">
	<!-- Select2 -->
	<link rel="stylesheet" href="{{asset('public/libs2/bower_components/select2/dist/css/select2.min.css')}}">
	<!-- Theme style -->
	<link rel="stylesheet" href="{{asset('public/libs2/dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
  	folder instead of downloading all of them to reduce the load. -->
  	<link rel="stylesheet" href="{{asset('public/libs2/dist/css/skins/_all-skins.min.css')}}">


  	<!-- Google Font -->
  	<!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> -->
  	<link href="https://fonts.googleapis.com/css?family=Sawarabi+Gothic" rel="stylesheet"> 

	<!-- jQuery 3 -->
	<script src="{{asset('public/libs2/bower_components/jquery/dist/jquery.min.js')}}"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="{{asset('public/libs2/bower_components/jquery-ui/jquery-ui.min.js')}}"></script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<script>
		$.widget.bridge('uibutton', $.ui.button);
	</script>

	<!-- Bootstrap 3.3.7 -->
	<script src="{{asset('public/libs2/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
	<!-- Select2 -->
	<script src="{{asset('public/libs2/bower_components/select2/dist/js/select2.full.min.js')}}"></script>
	<!-- InputMask -->
	<script src="{{asset('public/libs2/plugins/input-mask/jquery.inputmask.js')}}"></script>
	<script src="{{asset('public/libs2/plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
	<script src="{{asset('public/libs2/plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
	<!-- date-range-picker -->
	<script src="{{asset('public/libs2/bower_components/moment/min/moment.min.js')}}"></script>
	<script src="{{asset('public/libs2/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
	<!-- bootstrap datepicker -->
	<script src="{{asset('public/libs2/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
	<!-- bootstrap color picker -->
	<script src="{{asset('public/libs2/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>
	<!-- bootstrap time picker -->
	<script src="{{asset('public/libs2/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
	<!-- SlimScroll -->
	<script src="{{asset('public/libs2/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
	<!-- iCheck 1.0.1 -->
	<script src="{{asset('public/libs2/plugins/iCheck/icheck.min.js')}}"></script>
	<!-- FastClick -->
	<script src="{{asset('public/libs2/bower_components/fastclick/lib/fastclick.js')}}"></script>

	<script src="{{asset('public/libs2/bower_components/ckeditor/ckeditor.js')}}"></script>
	<!-- AdminLTE App -->
	<script src="{{asset('public/libs2/dist/js/adminlte.min.js')}}"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="{{asset('public/libs2/dist/js/demo.js')}}"></script>




	<script src="{{asset('public/libs2/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{asset('public/libs2/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>


	<script src="{{asset('public/libs/angular-1.6.10/angular.min.js')}}"></script>

	<script src="{{asset('public/libs/angularDataTable/dist/angular-datatables.min.js')}}"></script>
	<link rel="stylesheet" href="{{asset('public/libs/angularDataTable/dist/css/angular-datatables.min.css')}}" />

	<link rel="stylesheet" href="{{asset('public/libs/starrr-gh-pages/dist/starrr.css')}}" />
	<script src="{{asset('public/libs/starrr-gh-pages/dist/starrr.js')}}"></script>

	<link rel="stylesheet" href="{{asset('public/libs/angular-file-upload/angular-file-upload.css')}}" />
	<!-- Fix for old browsers -->
	<script src="{{asset('public/libs/angular-file-upload/es5-shim.min.js')}}"></script>
	<script src="{{asset('public/libs/angular-file-upload/es5-sham.min.js')}}"></script>
	<script src="{{asset('public/libs/angular-file-upload/console-sham.min.js')}}"></script>

	<script src="{{asset('public/libs/angular-file-upload/angular-file-upload.min.js')}}"></script>
	<!-- <script src="{{asset('public/libs/ckeditor/ckeditor.js')}}"></script> -->
	<script src="{{asset('public/libs/angular-ckeditor-master/angular-ckeditor.min.js')}}"></script>


	<link rel="stylesheet" href="{{asset('public/libs/angular-1.6.10/docs/css/angular-material.min.css')}}">
	<script src="{{asset('public/libs/angular-1.6.10/angular-animate.min.js')}}"></script>
	<script src="{{asset('public/libs/angular-1.6.10/angular-aria.min.js')}}"></script>
	<script src="{{asset('public/libs/angular-1.6.10/angular-messages.min.js')}}"></script>
	<script src="{{asset('public/libs/angular-1.6.10/angular-material.min.js')}}"></script>

	<script src="{{asset('public/libs/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
	<link href="{{asset('public/css/lib/toastr/toastr.min.css')}}" rel="stylesheet">
	<script src="{{asset('public/js/lib/toastr/toastr.min.js')}}"></script>
    <script src="{{asset('public/js/lib/toastr/toastr.init.js')}}"></script>

	<script src="{{asset('public/libs/jquery-validate/jquery.validate.min.js')}}"></script>

	

	<!--Custom JavaScript -->
	<!-- <script src="{{asset('public/js/custom.min.js')}}"></script> -->
	<link rel="stylesheet" href="{{asset('public/css/styleAdmin.css')}}">
	<script src="{{asset('public/App/app.js')}}"></script>
	


</head>

<body class="hold-transition skin-blue sidebar-mini" ng-app="redshop">



	<div class="wrapper">
		@include('layouts.admin.header')
		
		@yield('noidung')


		@include('layouts.admin.footer')

	</div>
	


</body>
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
    //Date range as a button
    

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true,
      dateFormat: "dd-mm-yyyy"
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass   : 'iradio_minimal-red'
    })
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })
  })
</script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    // $('.textarea').wysihtml5()
  })
</script>
</html>