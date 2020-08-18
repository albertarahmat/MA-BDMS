<?php
	require 'config.php';
	error_reporting(E_ALL^(E_NOTICE|E_WARNING));
	$action = $_POST['action'];
	$user_nip = $_POST['user_nip'];
	$user_jab = $_POST['user_jab'];
	$nip = $_POST['nip'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$nama_lengkap = $_POST['nama_lengkap'];
	$jabatan = $_POST['jabatan'];
	$dept = $_POST['dept'];
	$email = $_POST['email'];
	$nip_edit = $_POST['nip_edit'];
	$username_edit = $_POST['username_edit'];
	$password_edit = $_POST['password_edit'];
	$nama_lengkap_edit = $_POST['nama_lengkap_edit'];
	$jabatan_edit = $_POST['jabatan_edit'];
	$email_edit = $_POST['email_edit'];
	$hal = $_POST['hal'];
	
	if($action == 'show_nasabah'){
		$qr_dept= $conn->query("select * from mst_dept");
		while($sql_dept = $qr_dept->fetch_array()){
			$opt .= "<option value='$sql_dept[id_dept]'>$sql_dept[nama_dept]</option>";
		}
		
		$opt_dept = "<select class='custom-select' name='dept' id='dept'>
								<option value=''>--Select Departement--</option>
								$opt
					</select>";
		
		echo show_data($hal)."~$opt_dept";
	}
	
	if($action == 'save_user'){
		$insert = $conn->query("insert into user (nip,username,password,nama_lengkap,jabatan,departemen,email) values ('$nip','$username','$password','$nama_lengkap','$jabatan','$dept','$email'");	
		if($insert){
				$save = "Sukses";
			}else{
				$save = "Gagal";
			}
		echo show_data($hal)."~$save";
		//echo "insert into user (nip,username,password,nama_lengkap,jabatan,email) values ('$nip','$username','$password','$nama_lengkap','$jabatan','$email')  $save";
	}
	
	if($action == 'edit_user'){
		$insert = $conn->query("update user set username='$username_edit',password='$password_edit',nama_lengkap='$nama_lengkap_edit',jabatan='$jabatan_edit',email='$email_edit' where nip='$nip_edit'");	
		if($insert){
				$save = "Sukses";
			}else{
				$save = "Gagal";
			}
		echo show_data($hal)."~$save";
	}
	
	if($action == 'delete_user'){
		$insert = $conn->query("delete from user where nip='$nip'");	
		if($insert){
				$save = "Sukses";
			}else{
				$save = "Gagal";
			}
		echo show_data($hal)."~$save";
	}
	
	if($action == 'form_edit'){
		echo form_edit($nip);
	}
	
	function show_data($hal){
		global $conn;
		
		$page = (isset($hal)) ? $hal : 1;
		//if (isset($_GET["hal"])) { $page  = $_GET["hal"]; } else { $page=1; }; 
		$limit = 5; // Jumlah data per halamanya
		$limit_start = ($page - 1) * $limit;
		$no = $limit_start + 1; // Untuk penomoran tabel
		
		$qr=$conn->query("select * from user limit $limit_start, $limit"); 
		while($sql = $qr->fetch_array()){
			
			$nama_jabatan = $sql['jabatan'];
			if($nama_jabatan == "J01"){
				$nama_jabatan="Staff";
			}else if($nama_jabatan == "J02"){
				$nama_jabatan="Supervisi";
			}else if($nama_jabatan == "J03"){
				$nama_jabatan="Manager HO";
			}else if($nama_jabatan == "J04"){
				$nama_jabatan="Manager Site";
			}else if($nama_jabatan == "J05"){
				$nama_jabatan="Risk Admin";
			}else if($nama_jabatan == "J06"){
				$nama_jabatan="Administrator";
			}else{
				$nama_jabatan="";
			}
			
			$isi .= "<tr>
						<td>$no</td>
						<td>$sql[nip]</td>
						<td>$sql[username]</td>
						<td>$sql[nama_lengkap]</td>
						<td>$nama_jabatan</td>
						<td>$sql[email]</td>
						<td class='project-actions text-right'>
                          <a class='btn btn-info btn-sm' href='#' data-toggle='modal' data-target='#edit_nasabah' id='btn_edit' name='btn_edit' data='$sql[nip]'>
                              <i class='fas fa-pencil-alt'>
                              </i>
                          </a>
                          <a class='btn btn-danger btn-sm' href='#' id='btn_delete' name='btn_delete' data='$sql[nip]'>
                              <i class='fas fa-trash'>
                              </i>
                          </a>
                      </td>
					  </tr>";
			$no++; // Tambah 1 setiap kali looping
		}
		
		$qr_jum = $conn->query("select * from user");
		$sql_jum = $qr_jum->num_rows;
		
		$jumlah_page = ceil($sql_jum / $limit); // Hitung jumlah halamanya
		$jumlah_number = 2; // Tentukan jumlah link number sebelum dan sesudah page yang aktif
		$start_number = ($page > $jumlah_number) ? $page - $jumlah_number : 1; // Untuk awal link member
		$end_number = ($page < ($jumlah_page - $jumlah_number)) ? $page + $jumlah_number : $jumlah_page; // Untuk akhir link number
		
		$halaman = "<div class='card-footer clearfix'><ul class='pagination pagination-md m-0 float-right'>";
		if ($page == 1){
				$halaman .= "<li class='page-item disabled'><a class='page-link' href='#'>First</a></li>
							<li class='page-item disabled'><a class='page-link' href='#'>&laquo;</a></li>";
		}else{
			$link_prev = ($page > 1) ? $page - 1 : 1;
				$halaman .= "<li class='page-item'><a class='page-link' href='index.php?page=user&hal=1'>First</a></li>
							 <li class='page-item'><a class='page-link' href='index.php?page=user&hal=$link_prev'>&laquo;</a></li>";
		}
		
		for ($i = $start_number; $i <= $end_number; $i++) {
                $link_active = ($page == $i) ? 'class="page-item active"' : '';
				
				$halaman .= "<li $link_active><a class='page-link' href='index.php?page=user&hal=$i'>$i</a></li>";
		}
		
		if($page == $jumlah_page){
				$halaman .= "<li class='page-item disabled'><a class='page-link' href='#'>&raquo;</a></li>
							 <li class='page-item disabled'><a class='page-link' href='#'>Last</a></li>";
		}else{
				$link_next = ($page < $jumlah_page) ? $page + 1 : $jumlah_page;
				$halaman .= "<li class='page-item'><a class='page-link' href='index.php?page=user&hal=$link_next'>&raquo;</a></li>
							 <li class='page-item'><a class='page-link' href='index.php?page=user&hal=$jumlah_page'>Last</a></li>";
		}
		
		$halaman .= "</ul></div>";
		
		
		
		
	return $isi."~".$halaman;
	}
		
		
	function form_edit($nip){
		global $conn;
		$qr=$conn->query("select * from user where nip='$nip'"); 
		$sql = $qr->fetch_assoc();
		
		$opt_jab = $sql['jabatan'];
		if($opt_jab == "J01"){
				$option1 ="	<select class='custom-select' name='jabatan_edit' id='jabatan_edit'>
								<option value='J01' selected>Staff</option>
								<option value='J02'>Supervisi</option>
								<option value='J03'>Manager HO</option>
								<option value='J04'>Manager Site</option>
								<option value='J05'>Risk Admin</option>
								<option value='J06'>Administrator</option>
							</select>";
		}else if($opt_jab == "J02"){
				$option1 ="	<select class='custom-select' name='jabatan_edit' id='jabatan_edit'>
								<option value='J01'>Staff IT</option>
								<option value='J02' selected>Supervisi</option>
								<option value='J03'>Manager HO</option>
								<option value='J04'>Manager Site</option>
								<option value='J05'>Risk Admin</option>
								<option value='J06'>Administrator</option>
							</select>";
		}else if($opt_jab == "J03"){
				$option1 ="	<select class='custom-select' name='jabatan_edit' id='jabatan_edit'>
								<option value='J01'>Staff IT</option>
								<option value='J02'>Supervisi</option>
								<option value='J03' selected>Manager HO</option>
								<option value='J04'>Manager Site</option>
								<option value='J05'>Risk Admin</option>
								<option value='J06'>Administrator</option>
							</select>";
		}else if($opt_jab == "J04"){
				$option1 ="	<select class='custom-select' name='jabatan_edit' id='jabatan_edit'>
								<option value='J01'>Staff IT</option>
								<option value='J02'>Supervisi</option>
								<option value='J03'>Manager HO</option>
								<option value='J04' selected>Manager Site</option>
								<option value='J05'>Risk Admin</option>
								<option value='J06'>Administrator</option>
							</select>";
		}else if($opt_jab == "J05"){
				$option1 ="	<select class='custom-select' name='jabatan_edit' id='jabatan_edit'>
								<option value='J01'>Staff IT</option>
								<option value='J02'>Supervisi</option>
								<option value='J03'>Manager HO</option>
								<option value='J04'>Manager Site</option>
								<option value='J05' selected>Risk Admin</option>
								<option value='J06'>Administrator</option>
							</select>";
		}else if($opt_jab == "J06"){
				$option1 ="	<select class='custom-select' name='jabatan_edit' id='jabatan_edit'>
								<option value='J01'>Staff IT</option>
								<option value='J02'>Supervisi</option>
								<option value='J03'>Manager HO</option>
								<option value='J04'>Manager Site</option>
								<option value='J05'>Risk Admin</option>
								<option value='J06' selected>Administrator</option>
							</select>";
		}else{
				$option1 ="	<select class='custom-select' name='jabatan_edit' id='jabatan_edit'>
								<option value='J01'>Staff IT</option>
								<option value='J02'>Supervisi</option>
								<option value='J03'>Manager HO</option>
								<option value='J04'>Manager Site</option>
								<option value='J05'>Risk Admin</option>
								<option value='J06'>Administrator</option>
							</select>";
		}
			
			$isi = "<div class='modal-body' id='modal_edit'>
					<form data-toggle='validator' action='#' method='POST'>
						<div class='form-group'>
							<label class='control-label' for='nip'>NIP</label>
							<input type='text' name='nip_edit' id='nip_edit' class='form-control' value='$sql[nip]' disabled/>
						</div>
						<div class='form-group'>
							<label class='control-label' for='username'>Username</label>
							<input type='text' name='username_edit' id='username_edit' class='form-control' value='$sql[username]' required />
						</div>
						<div class='form-group'>
							<label class='control-label' for='password'>Password</label>
							<input type='password' name='password_edit' id='password_edit' class='form-control' value='$sql[password]' required data-bv-notempty-message='The password is required' />
						</div>
						<div class='form-group'>
							<label class='control-label' for='nama_lengkap'>Nama Karyawan</label>
							<input type='text' name='nama_lengkap_edit' id='nama_lengkap_edit' class='form-control' value='$sql[nama_lengkap]' required />
						</div>
						<div class='form-group'>
							<label class='control-label' for='jabatan'>Jabatan</label>
								$option1
						</div>
						<div class='form-group'>
							<label class='control-label' for='email'>Email</label>
							<input type='email' name='email_edit' id='email_edit' class='form-control' value='$sql[email]' required />
						</div>
						<div class='form-group'>
							<button type='button' class='btn btn-info' id='btn_edit_data'>Save</button>
						</div>
					</form></div>";
		return $isi; 
	}
	
?>