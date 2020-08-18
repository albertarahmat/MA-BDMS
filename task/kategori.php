<?php
	require 'config.php';
	$action = $_POST['action'];
	error_reporting(E_ALL^(E_NOTICE|E_WARNING));
	$user_nip = $_POST['user_nip'];
	$user_jab = $_POST['user_jab'];
	
	$id_cat = $_POST['id_cat'];
	$nama_cat = $_POST['nama_cat'];
	
	$id_cat_edit = $_POST['id_cat_edit'];
	$nama_cat_edit = $_POST['nama_cat_edit'];
	
	if($action == 'show_dept'){
		echo show_data();
	}
	
	if($action == 'save_dept'){
		$insert = $conn->query("insert into mst_category (id_cat,nama_cat) values ('$id_cat','$nama_cat')");	
		if($insert){
				$save = "Sukses";
			}else{
				$save = "Gagal";
			}
		echo show_data()."~$save";
	}
	
	if($action == 'edit_dept'){
		$insert = $conn->query("update mst_category set nama_cat='$nama_cat_edit' where id_cat='$id_cat_edit'");	
		if($insert){
				$save = "Sukses";
			}else{
				$save = "Gagal";
			}
		echo show_data()."~$save";
	}
	
	if($action == 'delete_dept'){
		$insert = $conn->query("delete from mst_category where id_cat='$id_cat'");	
		if($insert){
				$save = "Sukses";
			}else{
				$save = "Gagal";
			}
		echo show_data()."~$save";
	}
	
	if($action == 'form_edit'){
		echo form_edit($id_cat);
	}
	
	function show_data(){
		global $conn;
		$qr=$conn->query("select * from mst_category"); 
		while($sql = $qr->fetch_array()){
			
			$isi .= "<tr>
						<td align='center'>$sql[id_cat]</td>
						<td>$sql[nama_cat]</td>
						<td class='project-actions text-center'>
                          <a class='btn btn-info btn-sm' href='#' data-toggle='modal' data-target='#edit_nasabah' id='btn_edit' name='btn_edit' data='$sql[id_cat]'>
                              <i class='fas fa-pencil-alt'>
                              </i>
                          </a>
                          <a class='btn btn-danger btn-sm' href='#' id='btn_delete' name='btn_delete' data='$sql[id_cat]'>
                              <i class='fas fa-trash'>
                              </i>
                          </a>
                      </td>
					  </tr>";
		}	
	return $isi;
	}
		
		
	function form_edit($id_cat){
		global $conn;
		$qr=$conn->query("select * from mst_category where id_cat='$id_cat'"); 
		$sql = $qr->fetch_assoc();
			
			$isi = "<div class='modal-body' id='modal_edit'>
					<form data-toggle='validator' action='#' method='POST'>
						<div class='form-group'>
							<label class='control-label' for='id_cat'>Kode Category</label>
							<input type='text' name='id_cat_edit' id='id_cat_edit' class='form-control' value='$sql[id_cat]' disabled/>
						</div>
						<div class='form-group'>
							<label class='control-label' for='nama_cat_edit'>Nama Category</label>
							<input type='text' name='nama_cat_edit' id='nama_cat_edit' class='form-control' value='$sql[nama_cat]' required />
						</div>
						
						<div class='form-group'>
							<button type='button' class='btn btn-info' id='btn_edit_data'>Save</button>
						</div>
					</form></div>";
		return $isi; 
	}
	
?>