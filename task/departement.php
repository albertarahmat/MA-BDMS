<?php
	require 'config.php';
	$action = $_POST['action'];
	error_reporting(E_ALL^(E_NOTICE|E_WARNING));
	$user_kode_dept = $_POST['user_kode_dept'];
	$user_jab = $_POST['user_jab'];
	
	$kode_dept = $_POST['kode_dept'];
	$nama_dept = $_POST['nama_dept'];
	$lokasi = $_POST['lokasi'];
	
	$kode_dept_edit = $_POST['kode_dept_edit'];
	$nama_dept_edit = $_POST['nama_dept_edit'];
	$lokasi_edit = $_POST['lokasi_edit'];
	
	if($action == 'show_dept'){
		echo show_data();
	}
	
	if($action == 'save_dept'){
		$insert = $conn->query("insert into mst_dept (id_dept,nama_dept,lokasi) values ('$kode_dept','$nama_dept','$lokasi')");	
		if($insert){
				$save = "Sukses";
			}else{
				$save = "Gagal";
			}
		echo show_data()."~$save";
	}
	
	if($action == 'edit_dept'){
		$insert = $conn->query("update mst_dept set nama_dept='$nama_dept_edit',lokasi='$lokasi_edit' where id_dept='$kode_dept_edit'");	
		if($insert){
				$save = "Sukses";
			}else{
				$save = "Gagal";
			}
		echo show_data()."~$save";
	}
	
	if($action == 'delete_dept'){
		$insert = $conn->query("delete from mst_dept where id_dept='$kode_dept'");	
		if($insert){
				$save = "Sukses";
			}else{
				$save = "Gagal";
			}
		echo show_data()."~$save";
	}
	
	if($action == 'form_edit'){
		echo form_edit($kode_dept);
	}
	
	function show_data(){
		global $conn;
		$qr=$conn->query("select * from mst_dept"); 
		while($sql = $qr->fetch_array()){
			$nama_lokasi = $sql['lokasi'];
			if($nama_lokasi == "HO"){
				$nama_lokasi="<span class='badge badge-success'>Head Officer</span>";
			}else{
				$nama_lokasi="<span class='badge badge-info'>Site</span>";
			}
			
			$isi .= "<tr>
						<td>$sql[id_dept]</td>
						<td>$sql[nama_dept]</td>
						<td align='center'>$nama_lokasi</td>
						<td class='project-actions text-center'>
                          <a class='btn btn-info btn-sm' href='#' data-toggle='modal' data-target='#edit_nasabah' id='btn_edit' name='btn_edit' data='$sql[id_dept]'>
                              <i class='fas fa-pencil-alt'>
                              </i>
                          </a>
                          <a class='btn btn-danger btn-sm' href='#' id='btn_delete' name='btn_delete' data='$sql[id_dept]'>
                              <i class='fas fa-trash'>
                              </i>
                          </a>
                      </td>
					  </tr>";
		}	
	return $isi;
	}
		
		
	function form_edit($kode_dept){
		global $conn;
		$qr=$conn->query("select * from mst_dept where id_dept='$kode_dept'"); 
		$sql = $qr->fetch_assoc();
		
		$lokasi = $sql['lokasi'];
		if($status == "1"){
				$option ="	<select class='custom-select' name='lokasi_edit' id='lokasi_edit'>
								<option value='HO' selected>Head Officer</option>
								<option value='Site'>Site</option>
							</select>";
		}else{
				$option ="	<select class='custom-select' name='lokasi_edit' id='lokasi_edit'>
								<option value='HO'>Head Officer</option>
								<option value='Site' selected>Site</option>
							</select>";
		}
			
			$isi = "<div class='modal-body' id='modal_edit'>
					<form data-toggle='validator' action='#' method='POST'>
						<div class='form-group'>
							<label class='control-label' for='kode_dept'>Kode Departement</label>
							<input type='text' name='kode_dept_edit' id='kode_dept_edit' class='form-control' value='$sql[id_dept]' disabled/>
						</div>
						<div class='form-group'>
							<label class='control-label' for='nama_dept_edit'>Nama Departement</label>
							<input type='text' name='nama_dept_edit' id='nama_dept_edit' class='form-control' value='$sql[nama_dept]' required />
						</div>
						<div class='form-group'>
							<label class='control-label' for='lokasi_edit'>Lokasi</label>
								$option
						</div>
						
						<div class='form-group'>
							<button type='button' class='btn btn-info' id='btn_edit_data'>Save</button>
						</div>
					</form></div>";
		return $isi; 
	}
	
?>