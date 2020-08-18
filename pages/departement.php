<!-- validator -->
  <link rel="stylesheet" href="plugins/bootstrapvalidator/src/css/bootstrapValidator.css">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
 <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Departement</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Data Departement</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
	
<section class="content">
	<div class="card">
		<div class="card-header">
			<h3 class="card-title">List Departement</h3>
			
			<div class="card-tools">
            <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#create_nasabah">
              <i class="fa fa-plus"></i> Add New
          </div>
		 </div>
		<div class="card-body">
			<table class="table table-bordered table-striped">
				<thead>
					<tr align="center">
						<th>Kode Dept</th>
						<th>Nama Departement</th>
						<th>Lokasi</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<tr id="isi"></tr>
				</tbody>
			</table>
			<ul id="pagination" class="pagination-sm"></ul>
		</div>
	</div>
	
	<!--Modal Untuk Menapilkan Pop Up Create New -->
	<div class="modal fade" id="create_nasabah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="card-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					<h4 class="card-title" id="myModalLabel">New Departement</h4>
				</div>

				<div class="modal-body">
					<form id="addForm" data-toggle="validator" action="#" method="POST">
						<div class="form-group">
							<label class="control-label" for="kode_dept">Kode Departement</label>
							<input type="text" name="kode_dept" id="kode_dept" class="form-control" required />
							<input type="hidden" name="user_nip" id="user_nip" class="form-control" value="<?php echo $_SESSION['nip'];?>"/>
							<input type="hidden" name="user_jab" id="user_jab" class="form-control" value="<?php echo $_SESSION['jabatan'];?>"/>
						</div>
						<div class="form-group">
							<label class="control-label" for="nama_dept">Nama Departement</label>
							<input type="text" name="nama_dept" id="nama_dept" class="form-control" required />
						</div>
						<div class="form-group">
							<label class="control-label" for="lokasi">Lokasi</label>
							<select class="form-control" name="lokasi" id="lokasi" required />
								<option value="">--Select Lokasi--</option>
								<option value="HO">Head Officer</option>
								<option value="Site">Site</option>
							</select>
						</div>
						<div class="form-group">
							<button type="button" class="btn btn-success" id='btn_add'>Save</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	
	<!--Modal Untuk Menapilkan Pop Up Edit -->
	<div class="modal fade" id="edit_nasabah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="card-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					<h4 class="card-title" id="myModalLabel">Edit Departement</h4>
				</div>
				<div id="form-edit">
					
				</div>
			</div>
		</div>
	</div>
     <!-- /row -->
</section>
<!-- /.Main content -->
</div>
<!-- /.content-wrapper -->

<script src="plugins/jquery/jquery.min.js"></script>

<script type="text/javascript">
	$(document).ready(function () {
		 viewnasabah();
		 
		$(document).on('click','#btn_add',function(){
			var error = 0;
			var user_nip = $('#user_nip').val();
			var user_jab = $('#user_jab').val();
			
			var kode_dept = $('#kode_dept').val();
			var nama_dept = $('#nama_dept').val();
			var lokasi = $('#lokasi').val();
			
			if(kode_dept != ""){
				error = 0;
			}else{
				error = 1;
			}
			
			if(nama_dept != ""){
				error = 0;
			}else{
				error = 1;
			}
			
			if(lokasi != ""){
				error = 0;
			}else{
				error = 1;
			}
			
			
			if(error == 0){
				$.ajax({
					type: 'POST',
					url: 'task/departement.php',
					data: {'action':'save_dept','user_nip':user_nip,'user_jab':user_jab,'kode_dept':kode_dept,'nama_dept':nama_dept,'lokasi':lokasi},
					success: function(data){
						sp = data.split('~');
						if(sp[1] == 'Sukses'){
							$('#modal').modal('toggle');
							alert(sp[1]);
							location.reload();
						}else{
							alert('Saving Failed, please cek your data');
						}
					} 
				});
			}else{
				alert("Lengkapi Data");
			}
		}); 
		
		$(document).on('click','#btn_delete',function(){
			var kode_dept = $(this).attr('data');
			
			var del=confirm("Are you sure you want to delete this record?");
			if (del==true){
				$.ajax({
					type: 'POST',
					url: 'task/departement.php',
					data: {'action':'delete_dept','kode_dept':kode_dept},
					success: function(data){
						sp = data.split('~');
						if(sp[1] == 'Sukses'){
							alert(sp[1]);
							location.reload();
						}else{
							alert('Saving Failed, please cek your data');
						}
					} 
				});
			}
		}); 
		
		$(document).on('click','#btn_edit',function(){
			var kode_dept = $(this).attr('data');
			
				$.ajax({
					type: 'POST',
					url: 'task/departement.php',
					data: {'action':'form_edit','kode_dept':kode_dept},
					success: function(data){
						$('#modal_edit').remove();
						$(data).insertAfter("#form-edit");
						//alert(data);
					} 
				});
		}); 
		
		$(document).on('click','#btn_edit_data',function(){
			var error = 0;
			var user_nip = $('#user_nip').val();
			var user_jab = $('#user_jab').val();
			
			var kode_dept_edit = $('#kode_dept_edit').val();
			var nama_dept_edit = $('#nama_dept_edit').val();
			var lokasi_edit = $('#lokasi_edit').val();
			
			if(kode_dept_edit != ""){
				error = 0;
			}else{
				error = 1;
			}
			
			if(nama_dept_edit != ""){
				error = 0;
			}else{
				error = 1;
			}
			
			if(lokasi_edit != ""){
				error = 0;
			}else{
				error = 1;
			}
			
			if(error == 0){	
				$.ajax({
					type: 'POST',
					url: 'task/departement.php',
					data: {'action':'edit_dept','user_nip':user_nip,'user_jab':user_jab,'kode_dept_edit':kode_dept_edit,'nama_dept_edit':nama_dept_edit,'lokasi_edit':lokasi_edit},
					success: function(data){
						sp = data.split('~');
						if(sp[1] == 'Sukses'){
							$('#modal').modal('toggle');
							alert(sp[1]);
							location.reload();
						}else{
							alert('Saving Failed, please cek your data');
						}
					} 
				});
			}else{
				alert("Lengkapi Data")
			}
		}); 
	});
	
	
	function viewnasabah() {
	$.ajax({
		type: 'POST',
		url: 'task/departement.php',
		data: {'action':'show_dept'},
		success: function(data){
			$(data).insertBefore("#isi");
		}
	});
}
</script>