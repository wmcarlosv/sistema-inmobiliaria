<script type="text/javascript">
	@if(Session::get('success'))
		Swal.fire({
		  position: 'top-end',
		  icon: 'success',
		  title: "{{ Session::get('success') }}",
		  showConfirmButton: false,
		  timer: 2500
		})
	@endif

	@if(Session::get('error'))
		Swal.fire({
		  position: 'top-end',
		  icon: 'error',
		  title: "{{ Session::get('error') }}",
		  showConfirmButton: false,
		  timer: 2500
		})
	@endif

	$("body").on('submit','form.form-delete', function(){
		if(!confirm("Estas seguro de eliminar esta Venta?")){
			return false;
		}
	});
</script>