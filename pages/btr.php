<!-- validator -->
  <link rel="stylesheet" href="plugins/bootstrapvalidator/src/css/bootstrapValidator.css">
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
 <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data BTR</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Data BTR</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
	
<section class="content">
	<div class="card">
		<div class="card-header">
			<h3 class="card-title">List BTR</h3>
			
			<div class="card-tools">
            <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#create_btr">
              <i class="fa fa-plus"></i> Add New
          </div>
		 </div>
		<div class="card-body">
			<table class="table table-bordered table-striped">
				<thead>
					<tr align="center">
						<th>Tahun</th>
						<th>NPM</th>
						<th>BTR (5% NPM)</th>
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
	<div class="modal fade" id="create_btr" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="card-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					<h4 class="card-title" id="myModalLabel">New BTR</h4>
				</div>

				<div class="modal-body">
					<form id="addForm" data-toggle="validator" action="#" method="POST">
						<div class="form-group">
							<label class="control-label" for="tahun">tahun</label>
							<input type="text" name="tahun" id="tahun" class="form-control" maxlength="4" required />
							<input type="hidden" name="user_nip" id="user_nip" class="form-control" value="<?php echo $_SESSION['nip'];?>"/>
							<input type="hidden" name="user_jab" id="user_jab" class="form-control" value="<?php echo $_SESSION['jabatan'];?>"/>
						</div>
						<div class="form-group">
							<label class="control-label" for="npm">NPM</label>
							<input type="text" name="npm" id="npm" class="form-control" required />
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
	<div class="modal fade" id="edit_btr" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="card-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					<h4 class="card-title" id="myModalLabel">Edit BTR</h4>
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
			
			var tahun = $('#tahun').val();
			var npm = $('#npm').val();
			var btr = $('#btr').val();
			
			if(tahun != ""){
				error = 0;
			}else{
				error = 1;
			}
			
			if(npm != ""){
				error = 0;
			}else{
				error = 1;
			}
			
			if(btr != ""){
				error = 0;
			}else{
				error = 1;
			}
			
			
			if(error == 0){
				$.ajax({
					type: 'POST',
					url: 'task/btr.php',
					data: {'action':'save_btr','user_nip':user_nip,'user_jab':user_jab,'tahun':tahun,'npm':npm,'btr':btr},
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
			var tahun = $(this).attr('data');
			
			var del=confirm("Are you sure you want to delete this record?");
			if (del==true){
				$.ajax({
					type: 'POST',
					url: 'task/btr.php',
					data: {'action':'delete_btr','tahun':tahun},
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
			var tahun = $(this).attr('data');
			
				$.ajax({
					type: 'POST',
					url: 'task/btr.php',
					data: {'action':'form_edit','tahun':tahun},
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
			
			var tahun_edit = $('#tahun_edit').val();
			var npm_edit = $('#npm_edit').val();
			var btr_edit = $('#btr_edit').val();
			
			if(tahun_edit != ""){
				error = 0;
			}else{
				error = 1;
			}
			
			if(npm_edit != ""){
				error = 0;
			}else{
				error = 1;
			}
			
			if(btr_edit != ""){
				error = 0;
			}else{
				error = 1;
			}
			
			if(error == 0){	
				$.ajax({
					type: 'POST',
					url: 'task/btr.php',
					data: {'action':'edit_btr','user_nip':user_nip,'user_jab':user_jab,'tahun_edit':tahun_edit,'npm_edit':npm_edit,'btr_edit':btr_edit},
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
		url: 'task/btr.php',
		data: {'action':'show_btr'},
		success: function(data){
			$(data).insertBefore("#isi");
		}
	});
}
</script>