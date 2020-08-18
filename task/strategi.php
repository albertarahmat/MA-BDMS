<?php
	require 'config.php';
	$action = $_POST['action'];
	error_reporting(E_ALL^(E_NOTICE|E_WARNING));
	$user_nip = $_POST['user_nip'];
	$user_jab = $_POST['user_jab'];
	
	$id_strategi = $_POST['id_strategi'];
	$nama_strategi = $_POST['nama_strategi'];
	
	$id_strategi_edit = $_POST['id_strategi_edit'];
	$nama_strategi_edit = $_POST['nama_strategi_edit'];
	
	if($action == 'show_strategi'){
		echo show_data();
	}
	
	if($action == 'save_strategi'){
		$insert = $conn->query("insert into mst_strategi (id_strategi,nama_strategi) values ('$id_strategi','$nama_strategi')");	
		if($insert){
				$save = "Sukses";
			}else{
				$save = "Gagal";
			}
		echo show_data()."~$save";
	}
	
	if($action == 'edit_strategi'){
		$insert = $conn->query("update mst_strategi set nama_strategi='$nama_strategi_edit' where id_strategi='$id_strategi_edit'");	
		if($insert){
				$save = "Sukses";
			}else{
				$save = "Gagal";
			}
		echo show_data()."~$save";
	}
	
	if($action == 'delete_strategi'){
		$insert = $conn->query("delete from mst_strategi where id_strategi='$id_strategi'");	
		if($insert){
				$save = "Sukses";
			}else{
				$save = "Gagal";
			}
		echo show_data()."~$save";
	}
	
	if($action == 'form_edit'){
		echo form_edit($id_strategi);
	}
	
	function show_data(){
		global $conn;
		$qr=$conn->query("select * from mst_strategi"); 
		while($sql = $qr->fetch_array()){
			
			$isi .= "<tr>
						<td align='center'>$sql[id_strategi]</td>
						<td>$sql[nama_strategi]</td>
						<td class='project-actions text-center'>
                          <a class='btn btn-info btn-sm' href='#' data-toggle='modal' data-target='#edit_nasabah' id='btn_edit' name='btn_edit' data='$sql[id_strategi]'>
                              <i class='fas fa-pencil-alt'>
                              </i>
                          </a>
                          <a class='btn btn-danger btn-sm' href='#' id='btn_delete' name='btn_delete' data='$sql[id_strategi]'>
                              <i class='fas fa-trash'>
                              </i>
                          </a>
                      </td>
					  </tr>";
		}	
	return $isi;
	}
		
		
	function form_edit($id_strategi){
		global $conn;
		$qr=$conn->query("select * from mst_strategi where id_strategi='$id_strategi'"); 
		$sql = $qr->fetch_assoc();
			
			$isi = "<div class='modal-body' id='modal_edit'>
					<form data-toggle='validator' action='#' method='POST'>
						<div class='form-group'>
							<label class='control-label' for='id_strategi'>Kode Category</label>
							<input type='text' name='id_strategi_edit' id='id_strategi_edit' class='form-control' value='$sql[id_strategi]' disabled/>
						</div>
						<div class='form-group'>
							<label class='control-label' for='nama_strategi_edit'>Nama Category</label>
							<input type='text' name='nama_strategi_edit' id='nama_strategi_edit' class='form-control' value='$sql[nama_strategi]' required />
						</div>
						
						<div class='form-group'>
							<button type='button' class='btn btn-info' id='btn_edit_data'>Save</button>
						</div>
					</form></div>";
		return $isi; 
	}
	
?>