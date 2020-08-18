<?php
	require 'config.php';
	$action = $_POST['action'];
	error_reporting(E_ALL^(E_NOTICE|E_WARNING));
	$user_nip = $_POST['user_nip'];
	$user_jab = $_POST['user_jab'];
	
	$id_dampak = $_POST['id_dampak'];
	$nama_dampak = $_POST['nama_dampak'];
	$desc_dampak = $_POST['desc_dampak'];
	
	$id_dampak_edit = $_POST['id_dampak_edit'];
	$nama_dampak_edit = $_POST['nama_dampak_edit'];
	$desc_dampak_edit = $_POST['desc_dampak_edit'];
	
	if($action == 'show_dept'){
		echo show_data();
	}
	
	if($action == 'save_dept'){
		$insert = $conn->query("insert into mst_dampak (id_dampak,nama_dampak,desc_dampak) values ('$id_dampak','$nama_dampak','$desc_dampak')");	
		if($insert){
				$save = "Sukses";
			}else{
				$save = "Gagal";
			}
		echo show_data()."~$save";
	}
	
	if($action == 'edit_dept'){
		$insert = $conn->query("update mst_dampak set nama_dampak='$nama_dampak_edit',desc_dampak='$desc_dampak_edit' where id_dampak='$id_dampak_edit'");	
		if($insert){
				$save = "Sukses";
			}else{
				$save = "Gagal";
			}
		echo show_data()."~$save";
	}
	
	if($action == 'delete_dept'){
		$insert = $conn->query("delete from mst_dampak where id_dampak='$id_dampak'");	
		if($insert){
				$save = "Sukses";
			}else{
				$save = "Gagal";
			}
		echo show_data()."~$save";
	}
	
	if($action == 'form_edit'){
		echo form_edit($id_dampak);
	}
	
	function show_data(){
		global $conn;
		$qr=$conn->query("select * from mst_dampak"); 
		while($sql = $qr->fetch_array()){
			
			$isi .= "<tr>
						<td align='center'>$sql[id_dampak]</td>
						<td>$sql[nama_dampak]</td>
						<td>$sql[desc_dampak]</td>
						<td class='project-actions text-right'>
                          <a class='btn btn-info btn-sm' href='#' data-toggle='modal' data-target='#edit_nasabah' id='btn_edit' name='btn_edit' data='$sql[id_dampak]'>
                              <i class='fas fa-pencil-alt'>
                              </i>
                          </a>
                          <a class='btn btn-danger btn-sm' href='#' id='btn_delete' name='btn_delete' data='$sql[id_dampak]'>
                              <i class='fas fa-trash'>
                              </i>
                          </a>
                      </td>
					  </tr>";
		}	
	return $isi;
	}
		
		
	function form_edit($id_dampak){
		global $conn;
		$qr=$conn->query("select * from mst_dampak where id_dampak='$id_dampak'"); 
		$sql = $qr->fetch_assoc();
			
			$isi = "<div class='modal-body' id='modal_edit'>
					<form data-toggle='validator' action='#' method='POST'>
						<div class='form-group'>
							<label class='control-label' for='id_dampak'>Kode Dampak</label>
							<input type='text' name='id_dampak_edit' id='id_dampak_edit' class='form-control' value='$sql[id_dampak]' disabled/>
						</div>
						<div class='form-group'>
							<label class='control-label' for='nama_dampak_edit'>Nama Dampak</label>
							<input type='text' name='nama_dampak_edit' id='nama_dampak_edit' class='form-control' value='$sql[nama_dampak]' required />
						</div>
						<div class='form-group'>
							<label class='control-label' for='desc_dampak_edit'>Deskripsi</label>
							<textarea id='desc_dampak_edit' name='desc_dampak_edit' class='form-control' rows = '5' cols = '50'>$sql[desc_dampak]</textarea>
						</div>
						
						<div class='form-group'>
							<button type='button' class='btn btn-info' id='btn_edit_data'>Save</button>
						</div>
					</form></div>";
		return $isi; 
	}
	
?>