<!-- validator -->
  <link rel="stylesheet" href="plugins/bootstrapvalidator/src/css/bootstrapValidator.css">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
 <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Resiko</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Risk Register</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
	
<section class="content">
	<div class="card">
		<div class="card-header">
			<h3 class="card-title">List Resiko</h3>
			
			<div class="card-tools">
            <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#create_nasabah">
              <i class="fa fa-plus"></i> Add New
          </div>
		 </div>
		<div class="card-body">
			<table class="table table-bordered table-striped">
				<thead>
					<tr align="center">
						<th class="align-middle" style="width: 6%">Kode Resiko</th>
						<th class="align-middle" style="width: 10%">Deskripsi Resiko</th>
						<th class="align-middle" style="width: 10%">Akar Penyebab</th>
						<th class="align-middle" style="width: 10%">Deskripsi Dampak</th>
						<th class="align-middle" style="width: 6%">Probabilitas</th>
						<th class="align-middle" style="width: 6%">Dampak</th>
						<th class="align-middle" style="width: 6%">Tingkat Resiko</th>
						<th class="align-middle" style="width: 10%">Penanganan Resiko</th>
						<th class="align-middle" style="width: 8%">Action</th>
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
					<h4 class="card-title" id="myModalLabel">New Risk</h4>
				</div>

				<div class="modal-body">
					<form id="addForm" data-toggle="validator" action="#" method="POST">
						<div class="form-group">
							<label class="control-label" for="desc_risk">Deskripsi Resiko</label>
							<textarea class="form-control" name="desc_risk" id="desc_risk" rows="4" cols="50" required /></textarea>
							<input type="hidden" name="user_nip" id="user_nip" class="form-control" value="<?php echo $_SESSION['nip'];?>"/>
							<input type="hidden" name="user_jab" id="user_jab" class="form-control" value="<?php echo $_SESSION['jabatan'];?>"/>
							<input type="hidden" name="departemen" id="departemen" class="form-control" value="<?php echo $_SESSION['departemen'];?>"/>
						</div>
						<div class="form-group">
							<label class="control-label" for="root_cause">Akar Penyebab</label>
							<textarea class="form-control" name="root_cause" id="root_cause" rows="4" cols="25" required /></textarea>
						</div>
						<div class="form-group">
							<label class="control-label" for="desc_dampak">Deskripsi Dampak</label>
							<textarea class="form-control" name="desc_dampak" id="desc_dampak" rows="4" cols="25" required /></textarea>
						</div>
						<div class="form-group">
							<label class="control-label" for="probabilitas">Probabilitas</label>
							<div id="option1"></div>
						</div>
						<div class="form-group">
							<label class="control-label" for="dampak">Dampak</label>
							<div id="option2"></div>
						</div>
						<div class="form-group">
							<label class="control-label" for="penanganan">Penanganan Resiko</label>
							<textarea class="form-control" name="penanganan" id="penanganan" rows="4" cols="25" required /></textarea>
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
					<h4 class="card-title" id="myModalLabel">Edit Resiko</h4>
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
			
			var desc_risk = $('#desc_risk').val();
			var root_cause = $('#root_cause').val();
			var desc_dampak = $('#desc_dampak').val();
			var probabilitas = $('#probabilitas').val();
			var departemen = $('#departemen').val();
			var dampak = $('#dampak').val();
			var penanganan = $('#penanganan').val();
			
			if(desc_risk != ""){
				error = 0;
			}else{
				error = 1;
			}
			
			if(root_cause != ""){
				error = 0;
			}else{
				error = 1;
			}
			
			if(desc_dampak != ""){
				error = 0;
			}else{
				error = 1;
			}
			
			if(probabilitas != ""){
				error = 0;
			}else{
				error = 1;
			}
			
			if(dampak != ""){
				error = 0;
			}else{
				error = 1;
			}
			
			if(penanganan != ""){
				error = 0;
			}else{
				error = 1;
			}
			
			
			if(error == 0){
				$.ajax({
					type: 'POST',
					url: 'task/registrasi.php',
					data: {'action':'save_register','user_nip':user_nip,'user_jab':user_jab,'desc_risk':desc_risk,'desc_dampak':desc_dampak,'probabilitas':probabilitas,'dampak':dampak,'root_cause':root_cause,'penanganan':penanganan,'departemen':departemen},
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
			var kode_risk = $(this).attr('data');
			
			var del=confirm("Are you sure you want to delete this record?");
			if (del==true){
				$.ajax({
					type: 'POST',
					url: 'task/registrasi.php',
					data: {'action':'delete_register','kode_risk':kode_risk},
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
			var kode_risk = $(this).attr('data');
			
				$.ajax({
					type: 'POST',
					url: 'task/registrasi.php',
					data: {'action':'form_edit','kode_risk':kode_risk},
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
			
			var desc_risk_edit = $('#desc_risk_edit').val();
			var root_cause_edit = $('#root_cause_edit').val();
			var root_cause_edit = $('#root_cause_edit').val();
			var root_cause_edit = $('#root_cause_edit').val();
			
			if(desc_risk_edit != ""){
				error = 0;
			}else{
				error = 1;
			}
			
			if(root_cause_edit != ""){
				error = 0;
			}else{
				error = 1;
			}
			
			if(error == 0){	
				$.ajax({
					type: 'POST',
					url: 'task/registrasi.php',
					data: {'action':'edit_register','user_nip':user_nip,'user_jab':user_jab,'desc_risk_edit':desc_risk_edit,'root_cause_edit':root_cause_edit},
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
		url: 'task/registrasi.php',
		data: {'action':'show_register'},
		success: function(data){
			sp = data.split('~');
			$(sp[0]).insertBefore("#isi");
			$(sp[1]).insertAfter("#option1");
			$(sp[2]).insertAfter("#option2");
		}
	});
}
</script>