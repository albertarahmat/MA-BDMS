<!-- validator -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
 <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Data User</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
	
<section class="content">
	<div class="card">
		<div class="card-header">
			<h3 class="card-title">List User</h3>
			
			<div class="card-tools">
            <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#create_nasabah">
              <i class="fa fa-plus"></i> Add New
          </div>
		 </div>
		<div class="card-body">
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr align="center">
						<th>No <input type="hidden" name="hal" id="hal" class="form-control" value="<?php echo $_GET['hal']?>" /></th>
						<th>Kode User</th>
						<th>Username</th>
						<th>Nama User</th>
						<th>Jabatan</th>
						<th>Email</th>
						<th class="align-middle" style="width: 10%">Action</th>
						
					</tr>
				</thead>
				<tbody>
					<tr id="isi"></tr>
				</tbody>
			</table>
			<div id ="paging"></div>
			
		</div>
	</div>
	
	<!--Modal Untuk Menapilkan Pop Up Create New -->
	<div class="modal fade" id="create_nasabah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="card-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					<h4 class="card-title" id="myModalLabel">New User</h4>
				</div>

				<div class="modal-body">
					<form id="addForm" data-toggle="validator" action="#" method="POST">
						<div class="form-group">
							<label class="control-label" for="nip">Kode User</label>
							<input type="text" name="nip" id="nip" class="form-control" required />
							<input type="hidden" name="user_nip" id="user_nip" class="form-control" value="<?php echo $_SESSION['nip'];?>"/>
							<input type="hidden" name="user_jab" id="user_jab" class="form-control" value="<?php echo $_SESSION['jabatan'];?>"/>
						</div>
						<div class="form-group">
							<label class="control-label" for="username">Username</label>
							<input type="text" name="username" id="username" class="form-control" required />
						</div>
						<div class="form-group">
							<label class="control-label" for="password">Password</label>
							<input type="password" name="password" id="password" class="form-control" required />
						</div>
						<div class="form-group">
							<label class="control-label" for="nama_lengkap">Nama User</label>
							<input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" required />
						</div>
						<div class="form-group">
							<label class="control-label" for="jabatan">Jabatan</label>
							<select class="form-control" name="jabatan" id="jabatan" required />
								<option value="">--Select Jabatan--</option>
								<option value="J01">Staff</option>
								<option value="J02">Supervisi</option>
								<option value="J03">Manager HO</option>
								<option value="J04">Manager Site</option>
								<option value="J05">Risk Admin</option>
							</select>
						</div>
						<div class="form-group">
							<label class="control-label" for="dept">Departemen</label>
							<div id="option"></div>
						</div>
						<div class="form-group">
							<label class="control-label" for="email">Email</label>
							<input type="text" name="email" id="email" class="form-control" required />
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
					<h4 class="card-title" id="myModalLabel">Edit User</h4>
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
<script src="plugins/jquery/jquery.min.js"></script>

<script type="text/javascript">
	$(document).ready(function () {
		 viewnasabah();
		 
		$(document).on('click','#btn_add',function(){
			var error = 0;
			var user_nip = $('#user_nip').val();
			var user_jab = $('#user_jab').val();
			
			var nip = $('#nip').val();
			var username = $('#username').val();
			var password = $('#password').val();
			var nama_lengkap = $('#nama_lengkap').val();
			var jabatan = $('#jabatan').val();
			var dept = $('#dept').val();
			var email = $('#email').val();
			if(nip != ""){
				error = 0;
			}else{
				error = 1;
			}
			
			if(username != ""){
				error = 0;
			}else{
				error = 1;
			}
			
			if(password != ""){
				error = 0;
			}else{
				error = 1;
			}
			
			if(nama_lengkap != ""){
				error = 0;
			}else{
				error = 1;
			}
			
			if(jabatan != ""){
				error = 0;
			}else{
				error = 1;
			}
			
			if(dept != ""){
				error = 0;
			}else{
				error = 1;
			}
			
			if(email != ""){
				error = 0;
			}else{
				error = 1;
			}
			
			
			if(error == 0){
				$.ajax({
					type: 'POST',
					url: 'task/user.php',
					data: {'action':'save_user','user_nip':user_nip,'user_jab':user_jab,'nip':nip,'username':username,'password':password,'nama_lengkap':nama_lengkap,'jabatan':jabatan,'dept':dept,'email':email},
					success: function(data){
						sp = data.split('~');
						if(sp[2] == 'Sukses'){
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
			var nip = $(this).attr('data');
			
			var del=confirm("Are you sure you want to delete this record?");
			if (del==true){
				$.ajax({
					type: 'POST',
					url: 'task/user.php',
					data: {'action':'delete_user','nip':nip},
					success: function(data){
						sp = data.split('~');
						if(sp[2] == 'Sukses'){
							alert(sp[2]);
							location.reload();
						}else{
							alert('Saving Failed, please cek your data');
						}
					} 
				});
			}
		}); 
		
		$(document).on('click','#btn_edit',function(){
			var nip = $(this).attr('data');
			
				$.ajax({
					type: 'POST',
					url: 'task/user.php',
					data: {'action':'form_edit','nip':nip},
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
			
			var nip_edit = $('#nip_edit').val();
			var username_edit = $('#username_edit').val();
			var password_edit = $('#password_edit').val();
			var nama_lengkap_edit = $('#nama_lengkap_edit').val();
			var jabatan_edit = $('#jabatan_edit').val();
			var email_edit = $('#email_edit').val();
			var hal = $('#hal').val();
				
			if(nip_edit != ""){
				error = 0;
			}else{
				error = 1;
			}
			
			if(username_edit != ""){
				error = 0;
			}else{
				error = 1;
			}
			
			if(password_edit != ""){
				error = 0;
			}else{
				error = 1;
			}
			
			if(nama_lengkap_edit != ""){
				error = 0;
			}else{
				error = 1;
			}
			
			if(jabatan_edit != ""){
				error = 0;
			}else{
				error = 1;
			}
			
			if(email_edit != ""){
				error = 0;
			}else{
				error = 1;
			}
			
			if(error == 0){	
				$.ajax({
					type: 'POST',
					url: 'task/user.php',
					data: {'action':'edit_user','user_nip':user_nip,'user_jab':user_jab,'nip_edit':nip_edit,'username_edit':username_edit,'password_edit':password_edit,'nama_lengkap_edit':nama_lengkap_edit,'jabatan_edit':jabatan_edit,'email_edit':email_edit,'hal':hal},
					success: function(data){
						sp = data.split('~');
						if(sp[2] == 'Sukses'){
							$('#modal').modal('toggle');
							alert(sp[2]);
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
	var hal = $('#hal').val();
		
	$.ajax({
		type: 'POST',
		url: 'task/user.php',
		data: {'action':'show_nasabah','hal':hal},
		success: function(data){
			sp = data.split('~');
			$(sp[0]).insertBefore("#isi");
			$(sp[1]).insertAfter("#paging");
			$(sp[2]).insertAfter("#option");
		}
	});
}
</script>