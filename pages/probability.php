<!-- validator -->
  <link rel="stylesheet" href="plugins/bootstrapvalidator/src/css/bootstrapValidator.css">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
 <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Probability</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Data Probability</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
	
<section class="content">
	<div class="card">
		<div class="card-header">
			<h3 class="card-title">List Probability</h3>
			
			<div class="card-tools">
            <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#create_nasabah">
              <i class="fa fa-plus"></i> Add New
          </div>
		 </div>
		<div class="card-body">
			<table class="table table-bordered table-striped">
				<thead>
					<tr align="center">
						<th>Kode Probability</th>
						<th>Nama Probability</th>
						<th>Deskripsi</th>
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
					<h4 class="card-title" id="myModalLabel">New Probability</h4>
				</div>

				<div class="modal-body">
					<form id="addForm" data-toggle="validator" action="#" method="POST">
						<div class="form-group">
							<label class="control-label" for="id_prob">Kode Probability</label>
							<input type="text" name="id_prob" id="id_prob" class="form-control" required />
							<input type="hidden" name="user_nip" id="user_nip" class="form-control" value="<?php echo $_SESSION['nip'];?>"/>
							<input type="hidden" name="user_jab" id="user_jab" class="form-control" value="<?php echo $_SESSION['jabatan'];?>"/>
						</div>
						<div class="form-group">
							<label class="control-label" for="nama_prob">Nama Probability</label>
							<input type="text" name="nama_prob" id="nama_prob" class="form-control" required />
						</div>
						<div class="form-group">
							<label class="control-label" for="desc_prob">Deskripsi</label>
							<textarea class="form-control" name="desc_prob" id="desc_prob" required />
							</textarea>
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
					<h4 class="card-title" id="myModalLabel">Edit Probability</h4>
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
			
			var id_prob = $('#id_prob').val();
			var nama_prob = $('#nama_prob').val();
			var desc_prob = $('#desc_prob').val();
			
			if(id_prob != ""){
				error = 0;
			}else{
				error = 1;
			}
			
			if(nama_prob != ""){
				error = 0;
			}else{
				error = 1;
			}
			
			if(desc_prob != ""){
				error = 0;
			}else{
				error = 1;
			}
			
			
			if(error == 0){
				$.ajax({
					type: 'POST',
					url: 'task/probability.php',
					data: {'action':'save_dept','user_nip':user_nip,'user_jab':user_jab,'id_prob':id_prob,'nama_prob':nama_prob,'desc_prob':desc_prob},
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
			var id_prob = $(this).attr('data');
			
			var del=confirm("Are you sure you want to delete this record?");
			if (del==true){
				$.ajax({
					type: 'POST',
					url: 'task/probability.php',
					data: {'action':'delete_dept','id_prob':id_prob},
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
			var id_prob = $(this).attr('data');
			
				$.ajax({
					type: 'POST',
					url: 'task/probability.php',
					data: {'action':'form_edit','id_prob':id_prob},
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
			
			var id_prob_edit = $('#id_prob_edit').val();
			var nama_prob_edit = $('#nama_prob_edit').val();
			var desc_prob_edit = $('#desc_prob_edit').val();
			
			if(id_prob_edit != ""){
				error = 0;
			}else{
				error = 1;
			}
			
			if(nama_prob_edit != ""){
				error = 0;
			}else{
				error = 1;
			}
			
			if(desc_prob_edit != ""){
				error = 0;
			}else{
				error = 1;
			}
			
			if(error == 0){	
				$.ajax({
					type: 'POST',
					url: 'task/probability.php',
					data: {'action':'edit_dept','user_nip':user_nip,'user_jab':user_jab,'id_prob_edit':id_prob_edit,'nama_prob_edit':nama_prob_edit,'desc_prob_edit':desc_prob_edit},
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
		url: 'task/probability.php',
		data: {'action':'show_dept'},
		success: function(data){
			$(data).insertBefore("#isi");
		}
	});
}
</script>