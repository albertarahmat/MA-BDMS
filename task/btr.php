<?php
	require 'config.php';
	$action = $_POST['action'];
	error_reporting(E_ALL^(E_NOTICE|E_WARNING));
	$user_nip = $_POST['user_nip'];
	$user_jab = $_POST['user_jab'];
	
	$tahun = $_POST['tahun'];
	$npm = $_POST['npm'];
	$btr = $_POST['btr'];
	
	$tahun_edit = $_POST['tahun_edit'];
	$npm_edit = $_POST['npm_edit'];
	$btr_edit = $_POST['btr_edit'];
	
	if($action == 'show_btr'){
		echo show_data();
	}
	
	if($action == 'save_btr'){
		$btr = $npm * 5/100;
		$insert = $conn->query("insert into mst_btr (tahun,npm,btr) values ('$tahun','$npm','$btr')");	
		if($insert){
				$save = "Sukses";
			}else{
				$save = "Gagal";
			}
		echo show_data()."~$save";
	}
	
	if($action == 'edit_btr'){
		$insert = $conn->query("update mst_btr set npm='$npm_edit',btr='$btr_edit' where tahun='$tahun_edit'");	
		if($insert){
				$save = "Sukses";
			}else{
				$save = "Gagal";
			}
		echo show_data()."~$save";
	}
	
	if($action == 'delete_btr'){
		$insert = $conn->query("delete from mst_btr where tahun='$tahun'");	
		if($insert){
				$save = "Sukses";
			}else{
				$save = "Gagal";
			}
		echo show_data()."~$save";
	}
	
	if($action == 'form_edit'){
		echo form_edit($tahun);
	}
	
	function show_data(){
		global $conn;
		$qr=$conn->query("select * from mst_btr"); 
		while($sql = $qr->fetch_array()){
			
			$isi .= "<tr>
						<td align='center'>$sql[tahun]</td>
						<td align='center'>Rp ".number_format($sql['npm'],2)."</td>
						<td align='center'>Rp ".number_format($sql['btr'],2)."</td>
						<td class='project-actions text-center'>
                          <a class='btn btn-info btn-sm' href='#' data-toggle='modal' data-target='#edit_btr' id='btn_edit' name='btn_edit' data='$sql[tahun]'>
                              <i class='fas fa-pencil-alt'>
                              </i>
                          </a>
                          <a class='btn btn-danger btn-sm' href='#' id='btn_delete' name='btn_delete' data='$sql[tahun]'>
                              <i class='fas fa-trash'>
                              </i>
                          </a>
                      </td>
					  </tr>";
		}	
	return $isi;
	}
		
		
	function form_edit($tahun){
		global $conn;
		$qr=$conn->query("select * from mst_btr where tahun='$tahun'"); 
		$sql = $qr->fetch_assoc();
			
			$isi = "<div class='modal-body' id='modal_edit'>
					<form data-toggle='validator' action='#' method='POST'>
						<div class='form-group'>
							<label class='control-label' for='tahun'>Kode Departement</label>
							<input type='text' name='tahun_edit' id='tahun_edit' class='form-control' value='$sql[tahun]' disabled/>
						</div>
						<div class='form-group'>
							<label class='control-label' for='npm_edit'>Nama Departement</label>
							<input type='text' name='npm_edit' id='npm_edit' class='form-control' value='$sql[npm]' required />
						</div>
						
						<div class='form-group'>
							<button type='button' class='btn btn-info' id='btn_edit_data'>Save</button>
						</div>
					</form></div>";
		return $isi; 
	}
	
?>