<style>
table {
    table-layout: fixed;
    word-wrap: break-word;
}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
 <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Activity</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Activity</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
	
<section class="content">
	<div class="card">
		<div class="card-header">
			<h3 class="card-title">List Activity</h3>
			
			<div class="card-tools">
            <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#create_nasabah">
              <i class="fa fa-plus"></i> Add New
          </div>
		 </div>
		<div class="card-body">
			<table class="table table-bordered table-striped">
				<thead>
					<tr align="center">
						<th class="align-middle" style="width: 6%" >No</th>
						<th class="align-middle" style="width: 15%">Project</th>
						<th class="align-middle" style="width: 20%">Activity</th>
						<th class="align-middle" style="width: 20%">Problem</th>
						<th class="align-middle" style="width: 13%">Status</th>
						<th class="align-middle" style="width: 11%">Start Date</th>
						<th class="align-middle" style="width: 11%">Due Date</th>
						<th class="align-middle" style="width: 11%">Actual Date</th>
						<th class="align-middle" style="width: 20%">Keterangan</th>
						<th class="align-middle" style="width: 12%">Action</th>
						
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
					<h4 class="card-title" id="myModalLabel">New Activity</h4>
				</div>

				<div class="modal-body">
					<form data-toggle="validator" action="#" method="POST">
						<div class="form-group">
							<label class="control-label" for="project">Nama Project</label>
							<input type="text" name="project" id="project" class="form-control" required />
							<input type="hidden" name="user_nip" id="user_nip" class="form-control" value="<?php echo $_SESSION['nip'];?>"/>
							<input type="hidden" name="user_jab" id="user_jab" class="form-control" value="<?php echo $_SESSION['jabatan'];?>"/>
						</div>
						<div class="form-group">
							<label class="control-label" for="activity">Activity</label>
							<textarea name="activity" id="activity" class="form-control" rows="3" placeholder="Masukkan Activity"></textarea>
						</div>
						<div class="form-group">
							<label class="control-label" for="problem">Problem</label>
							<textarea name="problem" id="problem" class="form-control" rows="3" placeholder="Masukkan Problem"></textarea>
							
						</div>
						<div class="form-group">
							<label class="control-label" for="status">Status</label>
							<select class="form-control" name="status" id="status" required />
								<option value="">--Select Status--</option>
								<option value="S01">Requirement</option>
								<option value="S02">Development</option>
								<option value="S03">UAT</option>
								<option value="S04">Done</option>
							</select>
						</div>
						<div class="form-group">
							<label class="control-label" for="start">Start Date</label>
							<input type="date" name="start" id="start" class="form-control" required />
						</div>
						<div class="form-group">
							<label class="control-label" for="due">Due Date</label>
							<input type="date" name="due" id="due" class="form-control" required />
						</div>
						<div class="form-group">
							<label class="control-label" for="actual">Actual Date</label>
							<input type="date" name="actual" id="actual" class="form-control" required />
						</div>
						<div class="form-group">
							<label class="control-label" for="keterangan">Keterangan</label>
							<textarea name="keterangan" id="keterangan" class="form-control" rows="3" placeholder="Masukkan Keterangan"></textarea>
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
	<div class="modal fade" id="edit_activity" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="card-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					<h4 class="card-title" id="myModalLabel">Edit Karyawan</h4>
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
		 viewactivity();
		 
		 $(document).on('click','#btn_add',function(){
			var user_nip = $('#user_nip').val();
			var user_jab = $('#user_jab').val();
			 
			var start = $('#start').val();
			var due = $('#due').val();
			var actual = $('#actual').val();
			var project = $('#project').val();
			var activity = $('#activity').val();
			var problem = $('#problem').val();
			var status = $('#status').val();
			var keterangan = $('#keterangan').val();
			
			$.ajax({
				type: 'POST',
				url: 'task/activity.php',
				data: {'action':'save_activity','user_nip':user_nip,'user_jab':user_jab,'start':start,'due':due,'actual':actual,'project':project,'activity':activity,'problem':problem,'status':status,'keterangan':keterangan},
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
		}); 

		$(document).on('click','#btn_edit',function(){
			var id = $(this).attr('data');
				$.ajax({
					type: 'POST',
					url: 'task/activity.php',
					data: {'action':'form_edit','id':id},
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
			
			var id = $('#id').val();
			var project_edit = $('#project_edit').val();
			var activity_edit = $('#activity_edit').val();
			var problem_edit = $('#problem_edit').val();
			var start_edit = $('#start_edit').val();
			var due_edit = $('#due_edit').val();
			var actual_edit = $('#actual_edit').val();
			var status_edit = $('#status_edit').val();
			var keterangan_edit = $('#keterangan_edit').val();
				
			if(project_edit != ""){
				error = 0;
			}else{
				error = 1;
			}
			
			if(activity_edit != ""){
				error = 0;
			}else{
				error = 1;
			}
			
			if(problem_edit != ""){
				error = 0;
			}else{
				error = 1;
			}
			
			if(start_edit != ""){
				error = 0;
			}else{
				error = 1;
			}
			
			if(due_edit != ""){
				error = 0;
			}else{
				error = 1;
			}
			
			if(actual_edit != ""){
				error = 0;
			}else{
				error = 1;
			}
			
			if(status_edit != ""){
				error = 0;
			}else{
				error = 1;
			}
			
			if(error == 0){	
				$.ajax({
					type: 'POST',
					url: 'task/activity.php',
					data: {'action':'edit_user','user_nip':user_nip,'id':id,'user_jab':user_jab,'project_edit':project_edit,'activity_edit':activity_edit,'problem_edit':problem_edit,'start_edit':start_edit,'due_edit':due_edit,'actual_edit':actual_edit,'status_edit':status_edit,'keterangan_edit':keterangan_edit},
					success: function(data){
						//alert(data);
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
	
	
	function viewactivity() {
	
	var user_nip = $('#user_nip').val();
	var user_jab = $('#user_jab').val();
		
	$.ajax({
		type: 'POST',
		url: 'task/activity.php',
		data: {'action':'show_activity','user_nip':user_nip,'user_jab':user_jab},
		success: function(data){
			$(data).insertBefore("#isi");
		}
	});
}
</script>