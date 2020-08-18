<?php
	require 'config.php';
	$action = $_POST['action'];
	error_reporting(E_ALL^(E_NOTICE|E_WARNING));
	$user_nip = $_POST['user_nip'];
	$user_jab = $_POST['user_jab'];
	
	$id_prob = $_POST['id_prob'];
	$nama_prob = $_POST['nama_prob'];
	$desc_prob = $_POST['desc_prob'];
	
	$id_prob_edit = $_POST['id_prob_edit'];
	$nama_prob_edit = $_POST['nama_prob_edit'];
	$desc_prob_edit = $_POST['desc_prob_edit'];
	
	if($action == 'show_dept'){
		echo show_data();
	}
	
	if($action == 'save_dept'){
		$insert = $conn->query("insert into mst_probability (id_prob,nama_prob,desc_prob) values ('$id_prob','$nama_prob','$desc_prob')");	
		if($insert){
				$save = "Sukses";
			}else{
				$save = "Gagal";
			}
		echo show_data()."~$save";
	}
	
	if($action == 'edit_dept'){
		$insert = $conn->query("update mst_probability set nama_prob='$nama_prob_edit',desc_prob='$desc_prob_edit' where id_prob='$id_prob_edit'");	
		if($insert){
				$save = "Sukses";
			}else{
				$save = "Gagal";
			}
		echo show_data()."~$save";
	}
	
	if($action == 'delete_dept'){
		$insert = $conn->query("delete from mst_probability where id_prob='$id_prob'");	
		if($insert){
				$save = "Sukses";
			}else{
				$save = "Gagal";
			}
		echo show_data()."~$save";
	}
	
	if($action == 'form_edit'){
		echo form_edit($id_prob);
	}
	
	function show_data(){
		global $conn;
		$qr=$conn->query("select * from mst_probability"); 
		while($sql = $qr->fetch_array()){
			
			$isi .= "<tr>
						<td align='center'>$sql[id_prob]</td>
						<td>$sql[nama_prob]</td>
						<td>$sql[desc_prob]</td>
						<td class='project-actions text-center'>
                          <a class='btn btn-info btn-sm' href='#' data-toggle='modal' data-target='#edit_nasabah' id='btn_edit' name='btn_edit' data='$sql[id_prob]'>
                              <i class='fas fa-pencil-alt'>
                              </i>
                          </a>
                          <a class='btn btn-danger btn-sm' href='#' id='btn_delete' name='btn_delete' data='$sql[id_prob]'>
                              <i class='fas fa-trash'>
                              </i>
                          </a>
                      </td>
					  </tr>";
		}	
	return $isi;
	}
		
		
	function form_edit($id_prob){
		global $conn;
		$qr=$conn->query("select * from mst_probability where id_prob='$id_prob'"); 
		$sql = $qr->fetch_assoc();
			
			$isi = "<div class='modal-body' id='modal_edit'>
					<form data-toggle='validator' action='#' method='POST'>
						<div class='form-group'>
							<label class='control-label' for='id_prob'>Kode Probability</label>
							<input type='text' name='id_prob_edit' id='id_prob_edit' class='form-control' value='$sql[id_prob]' disabled/>
						</div>
						<div class='form-group'>
							<label class='control-label' for='nama_prob_edit'>Nama Probability</label>
							<input type='text' name='nama_prob_edit' id='nama_prob_edit' class='form-control' value='$sql[nama_prob]' required />
						</div>
						<div class='form-group'>
							<label class='control-label' for='desc_prob_edit'>Deskripsi</label>
							<textarea id='desc_prob_edit' name='desc_prob_edit' class='form-control' rows = '5' cols = '50'>$sql[desc_prob]</textarea>
						</div>
						
						<div class='form-group'>
							<button type='button' class='btn btn-info' id='btn_edit_data'>Save</button>
						</div>
					</form></div>";
		return $isi; 
	}
	
?>