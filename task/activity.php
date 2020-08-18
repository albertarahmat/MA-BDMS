<?php
	require 'config.php';
	$action = $_POST['action'];
	error_reporting(E_ALL^(E_NOTICE|E_WARNING));
	$id = $_POST['id'];
	$user_nip = $_POST['user_nip'];
	$user_jab = $_POST['user_jab'];
	$start = $_POST['start'];
	$due = $_POST['due'];
	$actual = $_POST['actual'];
	$project = $_POST['project'];
	$activity = $_POST['activity'];
	$problem = $_POST['problem'];
	$status = $_POST['status'];
	$keterangan = $_POST['keterangan'];
	$tanggal_edit = $_POST['tanggal_edit'];
	$project_edit = $_POST['project_edit'];
	$activity_edit = $_POST['activity_edit'];
	$problem_edit = $_POST['problem_edit'];
	$status_edit = $_POST['status_edit'];
	$start_edit = $_POST['start_edit'];
	$due_edit = $_POST['due_edit'];
	$actual_edit = $_POST['actual_edit'];
	$keterangan_edit = $_POST['keterangan_edit'];
	
	if($action == 'show_activity'){
		echo show_data($user_nip);
	}
	
	if($action == 'save_activity'){
		$insert = $conn->query("insert into activity (project,activity,problem,keterangan,status,start_date,due_date,actual_date,created_by, created_date) values ('$project','$activity','$problem','$keterangan','$status','$start','$due','$actual','$user_nip',NOW())");	
		if($insert){
				$save = "Sukses";
			}else{
				$save = "Gagal";
			}
		echo show_data($user_nip)."~$save";
		//echo "insert into activity (tanggal,project,activity,problem,keterangan,status,created_by, created_date) values ('$tanggal','$project','$activity','$problem','$keterangan','$status','$project',NOW())";
	}
	
	if($action == 'edit_user'){
		$insert = $conn->query("update activity set project='$project_edit',activity='$activity_edit',problem='$problem_edit',keterangan='$keterangan_edit',status='$status_edit',start_date='$start_edit',due_date='$due_edit',actual_date='$actual_edit' where id='$id'");	
		if($insert){
				$save = "Sukses";
			}else{
				$save = "Gagal";
			}
		echo show_data($user_nip)."~$save";
		//echo "update activity set project='$project_edit',activity='$activity_edit',problem='$problem_edit',keterangan='$keterangan_edit',status='$status_edit',start_date='$start_edit',due_date='$due_edit',actual_date='$actual_edit' where id='$id'";
	}
	
	if($action == 'delete_user'){
		$insert = $conn->query("delete from activity where id='$id'");	
		if($insert){
				$save = "Sukses";
			}else{
				$save = "Gagal";
			}
		echo show_data($user_nip)."~$save";
	}
	
	if($action == 'form_edit'){
		echo form_edit($id);
	}
	
	function show_data($user_nip){
		global $conn;
		$qr=$conn->query("select * from activity where created_by = '$user_nip'"); 
		while($sql = $qr->fetch_array()){
			$j++;
			$status = $sql['status'];
			
			$qr_st = $conn->query("select * from status where id_status = '$status'");
			$sql_st = $qr_st->fetch_assoc();
			
			$nama_status = $sql_st['nama_status'];
			
			$isi .= "<tr>
						<td align='center'>$j</td>
						<td>$sql[project]</td>
						<td>$sql[activity]</td>
						<td>$sql[problem]</td>
						<td align='center'>$nama_status</td>
						<td align='center'><span class='badge badge-info'>".date('d-m-Y',strtotime($sql['start_date']))."</span></td>
						<td align='center'><span class='badge badge-danger'>".date('d-m-Y',strtotime($sql['due_date']))."</span></td>
						<td align='center'><span class='badge badge-success'>".date('d-m-Y',strtotime($sql['actual_date']))."</span></td>
						<td>$sql[keterangan]</td>
						<td class='project-actions text-right'>
                          <a class='btn btn-info btn-sm' href='#' data-toggle='modal' data-target='#edit_activity' id='btn_edit' name='btn_edit' data='$sql[id]'>
                              <i class='fas fa-pencil-alt'>
                              </i>
                          </a>
                          <a class='btn btn-danger btn-sm' href='#' id='btn_delete' name='btn_delete' data='$sql[id]'>
                              <i class='fas fa-trash'>
                              </i>
                          </a>
                      </td>
					  </tr>";
		}	
	return $isi;
	}
		
		
	function form_edit($id){
		global $conn;
		$qr=$conn->query("select * from activity where id='$id'"); 
		$sql = $qr->fetch_assoc();
		
		$status = $sql['status'];
		
		if($status == "S01"){
				$option ="	<select class='custom-select' name='status_edit' id='status_edit'>
								<option value=''>--Select Status--</option>
								<option value='S01' selected>Requirement</option>
								<option value='S02'>Development</option>
								<option value='S03'>UAT</option>
								<option value='S04'>Done</option>
							</select>";
		}else if($status == "S02"){
				$option ="	<select class='custom-select' name='status_edit' id='status_edit'>
								<option value=''>--Select Status--</option>
								<option value='S01'>Requirement</option>
								<option value='S02' selected>Development</option>
								<option value='S03'>UAT</option>
								<option value='S04'>Done</option>
							</select>";
		}else if($status == "S03"){
				$option ="	<select class='custom-select' name='status_edit' id='status_edit'>
								<option value=''>--Select Status--</option>
								<option value='S01'>Requirement</option>
								<option value='S02'>Development</option>
								<option value='S03' selected>UAT</option>
								<option value='S04'>Done</option>
							</select>";
		} else if($status == "S04"){
				$option ="	<select class='custom-select' name='status_edit' id='status_edit'>
								<option value=''>--Select Status--</option>
								<option value='S01'>Requirement</option>
								<option value='S02'>Development</option>
								<option value='S03'>UAT</option>
								<option value='S04' selected>Done</option>
							</select>";
		} else{
				$option ="	<select class='custom-select' name='status_edit' id='status_edit'>
								<option value=''>--Select Status--</option>
								<option value='S01'>Requirement</option>
								<option value='S02'>Development</option>
								<option value='S03'>UAT</option>
								<option value='S04'>Done</option>
							</select>";
		}
			
			$isi = "<div class='modal-body' id='modal_edit'>
					<form data-toggle='validator' action='#' method='POST'>
						<div class='form-group'>
							<label class='control-label' for='project'>Project</label>
							<input type='text' name='project_edit' id='project_edit' class='form-control' value='$sql[project]' required />
							<input type='hidden' name='id' id='id' class='form-control' value='$sql[id]' required />
						</div>
						<div class='form-group'>
							<label class='control-label' for='activity'>Activity</label>
							<textarea name='activity_edit' id='activity_edit' class='form-control' rows='3'>$sql[activity]</textarea>
						</div>
						<div class='form-group'>
							<label class='control-label' for='problem'>Problem</label>
							<textarea name='problem_edit' id='problem_edit' class='form-control' rows='3'>$sql[problem]</textarea>
						</div>
						<div class='form-group'>
							<label class='control-label' for='status'>Status</label>
								$option
						</div>
						<div class='form-group'>
							<label class='control-label' for='start'>Start Date</label>
							<input type='date' name='start_edit' id='start_edit' class='form-control' value='$sql[start_date]'/>
						</div>
						<div class='form-group'>
							<label class='control-label' for='due'>Due Date</label>
							<input type='date' name='due_edit' id='due_edit' class='form-control' value='$sql[due_date]'/>
						</div>
						<div class='form-group'>
							<label class='control-label' for='actual'>Actual Date</label>
							<input type='date' name='actual_edit' id='actual_edit' class='form-control' value='$sql[actual_date]'/>
						</div>
						<div class='form-group'>
							<label class='control-label' for='keterangan'>Keterangan</label>
							<textarea name='keterangan_edit' id='keterangan_edit' class='form-control' rows='3'>$sql[keterangan]</textarea>
						</div>
						<div class='form-group'>
							<button type='button' class='btn btn-info' id='btn_edit_data'>Save</button>
						</div>
					</form></div>";
		return $isi; 
	}
	
?>