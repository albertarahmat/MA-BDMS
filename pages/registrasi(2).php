<!-- validator -->
  <link rel="stylesheet" href="plugins/bootstrapvalidator/src/css/bootstrapValidator.css">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
 <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Register Resiko</h1>
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
			<h3 class="card-title">Input Resiko</h3>
		</div>
		<div class="card-body">
			<form id="addForm" data-toggle="validator" action="#" method="POST">
				<div class="form-group">
					<label class="control-label" for="sasaran">Sasaran Resiko</label>
					<textarea class="form-control" name="sasaran" id="sasaran" rows="4" cols="25" required /></textarea>
				</div>
				<div class="form-group">
					<label class="control-label" for="desc_risk">Deskripsi/ Kejadian Resiko</label>
					<textarea class="form-control" name="desc_risk" id="desc_risk" rows="4" cols="50" required /></textarea>
					<input type="hidden" name="user_nip" id="user_nip" class="form-control" value="<?php echo $_SESSION['nip'];?>"/>
					<input type="hidden" name="user_jab" id="user_jab" class="form-control" value="<?php echo $_SESSION['jabatan'];?>"/>
					<input type="hidden" name="departemen" id="departemen" class="form-control" value="<?php echo $_SESSION['departemen'];?>"/>
				</div>
				<div class="form-group">
					<div class="card-header">
					<h3 class="card-title"><b>Akar Penyebab</b></h3>
					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-toggle="modal" data-target="#akar_penyebab">
						  <i class="fa fa-plus"></i> Add New
					  </div>
					 </div>
					<div class="card-body">
						<table class="table table-bordered table-striped">
							<thead>
								<tr align="center">
									<th>No.</th>
									<th>Akar Penyebab</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<tr id="isi_ap"></tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="form-group">
					<div class="card-header">
					<h3 class="card-title"><b>Indikator Resiko</b></h3>
					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-toggle="modal" data-target="#indikator_resiko">
						  <i class="fa fa-plus"></i> Add New
					  </div>
					 </div>
					<div class="card-body">
						<table class="table table-bordered table-striped">
							<thead>
								<tr align="center">
									<th>No.</th>
									<th>Indikator Resiko</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<tr id="isi_ir"></tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="form-group">
					<div class="card-header">
					<h3 class="card-title"><b>Faktor Positif/ Internal Control yang ada saat ini</b></h3>
					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-toggle="modal" data-target="#modal_faktor_positif">
						  <i class="fa fa-plus"></i> Add New
					  </div>
					 </div>
					<div class="card-body">
						<table class="table table-bordered table-striped">
							<thead>
								<tr align="center">
									<th>No.</th>
									<th>Faktor Positif</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<tr id="isi_fp"></tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="form-group">
					<div class="card-header">
					<h3 class="card-title"><b>Deskripsi Dampak</b></h3>
					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-toggle="modal" data-target="#deskrip_dampak">
						  <i class="fa fa-plus"></i> Add New
					  </div>
					 </div>
					<div class="card-body">
						<table class="table table-bordered table-striped">
							<thead>
								<tr align="center">
									<th>No.</th>
									<th>Deskripsi Dampak</th>
									<th>Harga</th>
									<th>Keterangan</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<tr id="isi_dd"></tr>
							</tbody>
						</table>
					</div>
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
					<div class="card-header">
					<h3 class="card-title"><b>Penanganan Resiko</b></h3>
					<div class="card-tools">
						<button type="button" class="btn btn-tool" data-toggle="modal" data-target="#peng_resiko">
						  <i class="fa fa-plus"></i> Add New
					  </div>
					 </div>
					<div class="card-body">
						<table class="table table-bordered table-striped">
							<thead>
								<tr align="center">
									<th>No.</th>
									<th>Penanganan Resiko</th>
									<th>Harga</th>
									<th>Keterangan</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<tr id="isi_pr"></tr>
							</tbody>
						</table>
					</div>
				</div>
				<div class="form-group">
					<button type="button" class="btn btn-success" id='btn_add'>Save</button>
				</div>
			</form>
		</div>
	</div>
	
	<!--Modal Untuk Menapilkan Pop Up Create New -->
	<div class="modal fade" id="peng_resiko" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="card-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					<h4 class="card-title" id="myModalLabel">Tambah Penanganan Resiko</h4>
				</div>

				<div class="modal-body">
					<form id="addForm" data-toggle="validator" action="#" method="POST">
						<div class="form-group">
							<label class="control-label" for="penanganan">Penanganan Resiko</label>
							<textarea class="form-control" name="penanganan" id="penanganan" rows="4" cols="25" required /></textarea>
						</div>
						<div class="form-group">
							<label class="control-label" for="harga_penanganan">Harga</label>
							<input class="form-control" type="number" name="harga_penanganan" id="harga_penanganan" />
						</div>
						<div class="form-group">
							<label class="control-label" for="ket_penanganan">Keterangan</label>
							<textarea class="form-control" name="ket_penanganan" id="ket_penanganan" rows="4" cols="25"/></textarea>
						</div>
						<div class="form-group">
							<button type="button" class="btn btn-success" id='btn_penanganan'>Save</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	
	<!--Modal Dampak-->
	<div class="modal fade" id="deskrip_dampak" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="card-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					<h4 class="card-title" id="myModalLabel">Tambah Deskripsi Dampak</h4>
				</div>
				<div class="modal-body">
					<form id="addForm" data-toggle="validator" action="#" method="POST">
						<div class="form-group">
							<label class="control-label" for="desc_dampak">Deskripsi Dampak</label>
							<textarea class="form-control" name="desc_dampak" id="desc_dampak" rows="4" cols="25" required /></textarea>
						</div>
						<div class="form-group">
							<label class="control-label" for="harga_dampak">Harga</label>
							<input class="form-control" type="number" name="harga_dampak" id="harga_dampak" />
						</div>
						<div class="form-group">
							<label class="control-label" for="ket_dampak">Keterangan</label>
							<textarea class="form-control" name="ket_dampak" id="ket_dampak" rows="4" cols="25" /></textarea>
						</div>
						<div class="form-group">
							<button type="button" class="btn btn-success" id='btn_deskrip_dampak'>Save</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	
	<!--Modal Faktor Positif-->
	<div class="modal fade" id="modal_faktor_positif" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="card-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					<h4 class="card-title" id="myModalLabel">Tambah Faktor Positif</h4>
				</div>
				<div class="modal-body">
					<form id="addForm" data-toggle="validator" action="#" method="POST">
						<div class="form-group">
							<label class="control-label" for="faktor_positif">Faktor Positif</label>
							<textarea class="form-control" name="faktor_positif" id="faktor_positif" rows="4" cols="25" required /></textarea>
						</div>
						<div class="form-group">
							<button type="button" class="btn btn-success" id='btn_faktor_positif'>Save</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	
	<!--Modal Indikator Resiko-->
	<div class="modal fade" id="indikator_resiko" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="card-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					<h4 class="card-title" id="myModalLabel">Tambah Indikator Resiko</h4>
				</div>
				<div class="modal-body">
					<form id="addForm" data-toggle="validator" action="#" method="POST">
						<div class="form-group">
							<label class="control-label" for="indikator">Indikator Resiko</label>
							<textarea class="form-control" name="indikator" id="indikator" rows="4" cols="25" required /></textarea>
						</div>
						<div class="form-group">
							<button type="button" class="btn btn-success" id='btn_indikator_resiko'>Save</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	
	<!--Modal Akar Penyebab-->
	<div class="modal fade" id="akar_penyebab" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="card-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					<h4 class="card-title" id="myModalLabel">Tambah Akar Penyebab</h4>
				</div>
				<div class="modal-body">
					<form id="addForm" data-toggle="validator" action="#" method="POST">
						<div class="form-group">
							<label class="control-label" for="root_cause">Akar Penyebab</label>
							<textarea class="form-control" name="root_cause" id="root_cause" rows="4" cols="25" required /></textarea>
						</div>
						<div class="form-group">
							<button type="button" class="btn btn-success" id='btn_akar_penyebab'>Save</button>
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
			var departemen = $('#departemen').val();
			
			var desc_risk = $('#desc_risk').val();
			var root_cause = $('#root_cause').val();
			var probabilitas = $('#probabilitas').val();
			var dampak = $('#dampak').val();
			var desc_dampak = $('#desc_dampak').val();
			var penanganan = $('#penanganan').val();
			var harga_dampak = $('#harga_dampak').val();
			var harga_penanganan = $('#harga_penanganan').val();
			var ket_penanganan = $('#ket_penanganan').val();
			var ket_dampak = $('#ket_dampak').val();
			var faktor_positif = $('#faktor_positif').val();
			var indikator = $('#indikator').val();
			
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
					data: {'action':'save_register','user_nip':user_nip,'user_jab':user_jab,'departemen':departemen,'desc_risk':desc_risk,'desc_dampak':desc_dampak,'faktor_positif':faktor_positif,'indikator':indikator,'probabilitas':probabilitas,'dampak':dampak,'harga_dampak':harga_dampak,'ket_dampak':ket_dampak,'harga_penanganan':harga_penanganan,'ket_penanganan':ket_penanganan,'root_cause':root_cause,'penanganan':penanganan},
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
		
		$(document).on('click','#btn_penanganan',function(){
			alert('button penanganan');
			/* var desc_risk = $('#desc_risk').val();
			
			$.ajax({
				type: 'POST',
				url: 'task/registrasi.php',
				data: {'action':'add_penanganan','kode_risk':kode_risk},
				success: function(data){
					$('#modal_edit').remove();
					$(data).insertAfter("#form-edit");
					//alert(data);
				} 
			}); */
		});
		
		$(document).on('click','#btn_akar_penyebab',function(){
			alert('button akar penyebab');
			/* var desc_risk = $('#desc_risk').val();
			
			$.ajax({
				type: 'POST',
				url: 'task/registrasi.php',
				data: {'action':'add_penanganan','kode_risk':kode_risk},
				success: function(data){
					$('#modal_edit').remove();
					$(data).insertAfter("#form-edit");
					//alert(data);
				} 
			}); */
		});
		
		$(document).on('click','#btn_indikator_resiko',function(){
			alert('button indikator resiko');
			/* var desc_risk = $('#desc_risk').val();
			
			$.ajax({
				type: 'POST',
				url: 'task/registrasi.php',
				data: {'action':'add_penanganan','kode_risk':kode_risk},
				success: function(data){
					$('#modal_edit').remove();
					$(data).insertAfter("#form-edit");
					//alert(data);
				} 
			}); */
		});
		
		$(document).on('click','#btn_faktor_positif',function(){
			alert('button Faktor Positif');
			/* var desc_risk = $('#desc_risk').val();
			
			$.ajax({
				type: 'POST',
				url: 'task/registrasi.php',
				data: {'action':'add_penanganan','kode_risk':kode_risk},
				success: function(data){
					$('#modal_edit').remove();
					$(data).insertAfter("#form-edit");
					//alert(data);
				} 
			}); */
		});
		
		$(document).on('click','#btn_deskrip_dampak',function(){
			alert('button deskripsi dampak');
			/* var desc_risk = $('#desc_risk').val();
			
			$.ajax({
				type: 'POST',
				url: 'task/registrasi.php',
				data: {'action':'add_penanganan','kode_risk':kode_risk},
				success: function(data){
					$('#modal_edit').remove();
					$(data).insertAfter("#form-edit");
					//alert(data);
				} 
			}); */
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