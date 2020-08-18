<?php
	require 'config.php';
	$action = $_POST['action'];
	error_reporting(E_ALL^(E_NOTICE|E_WARNING));
	$user_nip = $_POST['user_nip'];
	$user_jab = $_POST['user_jab'];
	$departemen = $_POST['departemen'];
	
	$kode_risk = $_POST['kode_risk'];
	$desc_risk = $_POST['desc_risk'];
	$root_cause = $_POST['root_cause'];
	$sasaran = $_POST['sasaran'];
	$probabilitas = $_POST['probabilitas'];
	$dampak = $_POST['dampak'];
	$penanganan = $_POST['penanganan'];
	$harga_penanganan = $_POST['harga_penanganan'];
	$ket_penanganan = $_POST['ket_penanganan'];
	$desc_dampak = $_POST['desc_dampak'];
	$harga_dampak = $_POST['harga_dampak'];
	$ket_penanganan = $_POST['ket_penanganan'];
	$ket_dampak = $_POST['ket_dampak'];
	$faktor_positif = $_POST['faktor_positif'];
	$indikator = $_POST['indikator'];
	
	$kode_risk_edit = $_POST['kode_risk_edit'];
	$desc_risk_edit = $_POST['desc_risk_edit'];
	$root_cause_edit = $_POST['root_cause_edit'];
	$desc_dampak_edit = $_POST['desc_dampak_edit'];
	$probabilitas_edit = $_POST['probabilitas_edit'];
	$dampak_edit = $_POST['dampak_edit'];
	$penanganan_edit = $_POST['penanganan_edit'];
	
	if($action == 'show_register'){
		$qr_prob= $conn->query("select * from mst_probability");
		while($sql_prob = $qr_prob->fetch_array()){
			$opt1 .= "<option value='$sql_prob[id_prob]'>$sql_prob[nama_prob]</option>";
		}
		
		$qr_dampak= $conn->query("select * from mst_dampak");
		while($sql_dampak = $qr_dampak->fetch_array()){
			$opt2 .= "<option value='$sql_dampak[id_dampak]'>$sql_dampak[nama_dampak]</option>";
		}
		
		$opt_prob = "<select class='custom-select' name='probabilitas' id='probabilitas'>
								<option value=''>--Select Probabilitas--</option>
								$opt1
					</select>";
					
		$opt_dampak = "<select class='custom-select' name='dampak' id='dampak'>
					<option value=''>--Select Dampak--</option>
					$opt2
		</select>";
		echo show_data()."~$opt_prob~$opt_dampak";
	}
	
	if($action == 'save_register'){
		$qr_cek = $conn->query("select kode_risk from risk_register where departemen = '$departemen' order by kode_risk desc limit 1");
		$sql_cek = $qr_cek->fetch_assoc();
		
		if(!$sql_cek){
			$no = 1;
		}else{
			$no = substr($sql_cek['kode_risk'], -3) + 1;
		}
		
		if($no < 10){
			$no = "00".$no;
		}else if($no >10 && $no <100){
			$no = "0".$no;
		}else{
			$no=$no;
		}
		
		$qr_depar = $conn->query("select nama_dept from mst_dept where id_dept = '$departemen'");
		$sql_depar = $qr_depar->fetch_assoc();
		
		$depar = $sql_depar['nama_dept'];
		
		$kode_risk = "MA-".$depar."-".$no;
		
		$tingkat_resiko = $probabilitas * $dampak;
		
		$insert = $conn->query("insert into risk_register (kode_risk,desc_risk,root_cause,desc_dampak,probabilitas,dampak,tingkat_resiko,penanganan, departemen) values ('$kode_risk','$desc_risk','$root_cause','$desc_dampak','$probabilitas','$dampak','$tingkat_resiko','$penanganan','$departemen')");	
		if($insert){
				$save = "Sukses";
				
				//sent Email
				date_default_timezone_set('Etc/UTC');

				require '../PHPMailer/PHPMailerAutoload.php';
				
				$qr_data = $conn->query("select * from risk_register where kode_risk='$kode_risk'");
				$sql_data = $qr_data->fetch_assoc();
				
				$prob = $sql_data['probabilitas'];
				$imp = $sql_data['dampak'];
				
				$qr_probability = $conn->query("select * from mst_probability where id_prob = '$prob'");
				$sql_probability = $qr_probability->fetch_assoc();
				
				$probability = $sql_probability['id_prob']." = ".$sql_probability['nama_prob'];
				
				$qr_impact = $conn->query("select * from mst_dampak where id_dampak = '$imp'");
				$sql_impact = $qr_impact->fetch_assoc();
				
				$impact = $sql_impact['id_dampak']." = ".$sql_impact['nama_dampak'];
				
				$tingkat_resiko = $sql['tingkat_resiko'];
				
				if($tingkat_resiko >= 1 && $tingkat_resiko <= 3 ){
					$tingkat_resiko = "<td align='center'><span class='badge badge-success'>Low Risk</span></td>";
				}else if($tingkat_resiko > 3 && $tingkat_resiko <= 8){
					$tingkat_resiko = "<td align='center'><span class='badge badge-warning'>Medium Risk</span></td>";
				}else if($tingkat_resiko > 8 && $tingkat_resiko <= 14){
					$tingkat_resiko = "<td align='center'><span class='badge bg-orange'>High Risk</span></td>";
				}else{
					$tingkat_resiko = "<td align='center'><span class='badge badge-danger'>Extreme Risk</span></td>";
				}
				
				$isi = "<table border='1'>
							<tr>
								<th>Kode Resiko</th></th>
								<th>Deskripsi Resiko</th>
								<th>Akar Penyebab</th>
								<th>Deskripsi Dampak<th>
								<th>Probabilitas</th>
								<th>Dampak</th>
								<th>Tingkat Resiko</th>
								<th>Penanganan Resiko</th>
							</th>
							<tr>
								<td align='center'>$sql_data[kode_risk]</td>
								<td>$sql_data[desc_risk]</td>
								<td>$sql_data[root_cause]</td>
								<td>$sql_data[desc_dampak]</td>
								<td>$probability</td>
								<td>$impact</td>
								$tingkat_resiko
								<td>$sql_data[penanganan]</td>
							</tr>
						</table>";

				$mail = new PHPMailer;

				$mail->isSMTP(); 
				$mail->SMTPAuth = true;
				$mail->SMTPDebug = 2; 

				$mail->Host ='mail.baramultigroup.co.id'; 
				$mail->Username = 'alberta_r@baramultigroup.co.id';
				$mail->Password = '@Lb3rt4r';
				$mail->SMTPSecure = 'ssl';
				$mail->Port = 465;

				$mail->setFrom('alberta_r@baramultigroup.co.id', 'Alberta');
				$mail->addAddress('andreas_rw@baramultigroup.co.id', 'wiwit');
				$mail->Subject = 'Approval Risk Register Testing';
				$mail->msgHTML($isi); 
				$mail->AltBody = 'HTML messaging not supported';

				if (!$mail->send()) {
					echo "Mailer Error: " . $mail->ErrorInfo;
				} else {
					echo "Message sent!";
				}
				
			}else{
				$save = "Gagal";
			} 
		echo show_data()."~$save";
	}
	
	if($action == 'save_root_cause'){
		$insert = $conn->query("insert into input_root_cause (kode_risk, root_cause, created_by, created_date) values ('$kode_risk','$root_cause', '$user_nip', now())");
		if($insert){
			$save = "Sukses";
		}else{
			$save = "Gagal";
		}
		
		show_data()."~$save";
	}
	
	if($action == 'save_indikator'){
		$insert = $conn->query("insert into input_indikator (kode_risk, indikator, created_by, created_date) values ('$kode_risk','$indikator', '$user_nip', now())");
		if($insert){
			$save = "Sukses";
		}else{
			$save = "Gagal";
		}
		
		show_data()."~$save";
	}
	
	if($action == 'save_faktor'){
		$insert = $conn->query("insert into input_faktor (kode_risk, faktor_positif, created_by, created_date) values ('$kode_risk','$faktor_positif', '$user_nip', now())");
		if($insert){
			$save = "Sukses";
		}else{
			$save = "Gagal";
		}
		
		show_data()."~$save";
	}
	
	if($action == 'save_dampak'){
		$insert = $conn->query("insert into input_dampak (kode_risk, desc_dampak, harga_dampak, created_by, created_date) values ('$kode_risk','$desc_dampak', '$harga_dampak', '$user_nip', now())");
		if($insert){
			$save = "Sukses";
		}else{
			$save = "Gagal";
		}
		
		show_data()."~$save";
	}
	
	if($action == 'save_penanganan'){
		$insert = $conn->query("insert into input_penanganan (kode_risk, penanganan, harga_penanganan, created_by, created_date) values ('$kode_risk','$penanganan', '$harga_penanganan', '$user_nip', now())");
		if($insert){
			$save = "Sukses";
		}else{
			$save = "Gagal";
		}
		
		show_data()."~$save";
	}
	
	if($action == 'edit_register'){
		$insert = $conn->query("update risk_register set desc_risk='$desc_risk_edit', root_cause='$root_cause_edit', desc_dampak='$desc_dampak_edit', probabilitas='$probabilitas_edit', dampak='$dampak_edit', penanganan='$penanganan_edit' where kode_risk='$kode_risk_edit'");	
		if($insert){
			$save = "Sukses";
		}else{
			$save = "Gagal";
		}
		echo show_data()."~$save";
	}
	
	if($action == 'delete_register'){
		$insert = $conn->query("delete from risk_register where kode_risk='$kode_risk'");	
		if($insert){
				$save = "Sukses";
			}else{
				$save = "Gagal";
			}
		echo show_data()."~$save";
	}
	
	if($action == 'form_edit'){
		echo form_edit($kode_risk);
	}
	
	function show_data(){
		global $conn;
		
		$qr=$conn->query("select * from risk_register"); 
		while($sql = $qr->fetch_array()){
			$probabilitas = $sql['probabilitas'];
			$impact = $sql['dampak'];
			
			$qr_proba = $conn->query("select * from mst_probability where id_prob = '$probabilitas'");
			$sql_proba = $qr_proba->fetch_assoc();
			
			$probability = $sql_proba['id_prob']." = ".$sql_proba['nama_prob'];
			
			$qr_imp = $conn->query("select * from mst_dampak where id_dampak = '$impact'");
			$sql_imp = $qr_imp->fetch_assoc();
			
			$impact = $sql_imp['id_dampak']." = ".$sql_imp['nama_dampak'];
			
			$tingkat_resiko = $sql['tingkat_resiko'];
			
			if($tingkat_resiko >= 1 && $tingkat_resiko <= 3 ){
				$tingkat_resiko = "<td align='center'><span class='badge badge-success'>Low Risk</span></td>";
			}else if($tingkat_resiko > 3 && $tingkat_resiko <= 8){
				$tingkat_resiko = "<td align='center'><span class='badge badge-warning'>Medium Risk</span></td>";
			}else if($tingkat_resiko > 8 && $tingkat_resiko <= 14){
				$tingkat_resiko = "<td align='center'><span class='badge bg-orange'>High Risk</span></td>";
			}else{
				$tingkat_resiko = "<td align='center'><span class='badge badge-danger'>Extreme Risk</span></td>";
			}
			
			$isi .= "<tr>	
						<td align='center'>$sql[kode_risk]</td>
						<td>$sql[desc_risk]</td>
						<td>$sql[root_cause]</td>
						<td>$sql[desc_dampak]</td>
						<td>$probability</td>
						<td>$impact</td>
						$tingkat_resiko
						<td>$sql[penanganan]</td>
						<td class='project-actions text-right'>
                          <a class='btn btn-info btn-sm' href='#' data-toggle='modal' data-target='#edit_nasabah' id='btn_edit' name='btn_edit' data='$sql[kode_risk]'>
                              <i class='fas fa-pencil-alt'>
                              </i>
                          </a>
                          <a class='btn btn-danger btn-sm' href='#' id='btn_delete' name='btn_delete' data='$sql[kode_risk]'>
                              <i class='fas fa-trash'>
                              </i>
                          </a>
                      </td>
					  </tr>";
		}	
		return $isi;
	}
		
		
	function form_edit($kode_risk){
		global $conn;
		
		$qr=$conn->query("select * from risk_register where kode_risk='$kode_risk'"); 
		$sql = $qr->fetch_assoc();
			
			$isi = "<div class='modal-body' id='modal_edit'>
					<form data-toggle='validator' action='#' method='POST'>
						<div class='form-group'>
							<label class='control-label' for='kode_risk_edit'>Kode Resiko</label>
							<input type='text' name='kode_risk_edit' id='kode_risk_edit' class='form-control' value='$sql[kode_risk]' disabled/>
						</div>
						<div class='form-group'>
							<label class='control-label' for='desc_risk_edit'>Nama Category</label>
							<textarea class='form-control' name='desc_risk_edit' id='desc_risk_edit' rows='4' cols='50'>$sql[desc_risk]</textarea>
						</div>
						<div class='form-group'>
							<label class='control-label' for='root_cause_edit'>Akar Penyebab</label>
							<textarea class='form-control' name='root_cause_edit' id='root_cause_edit' rows='4' cols='50'>$sql[root_cause]</textarea>
						</div>
						<div class='form-group'>
							<label class='control-label' for='desc_dampak_edit'>Deskripsi Dampak</label>
							<textarea class='form-control' name='desc_dampak_edit' id='desc_dampak_edit' rows='4' cols='50'>$sql[desc_dampak]</textarea>
						</div>
						<div class='form-group'>
							<label class='control-label' for='probabilitas'>Probabilitas</label>
						</div>
						<div class='form-group'>
							<label class='control-label' for='dampak'>Dampak</label>
						</div>
						<div class='form-group'>
							<label class='control-label' for='penanganan_edit'>Penanganan Resiko</label>
							<textarea class='form-control' name='penanganan_edit' id='penanganan_edit' rows='4' cols='50'>$sql[penanganan]</textarea>
						</div>
						
						<div class='form-group'>
							<button type='button' class='btn btn-info' id='btn_edit_data'>Save</button>
						</div>
					</form></div>";
		return $isi; 
	}
	
?>