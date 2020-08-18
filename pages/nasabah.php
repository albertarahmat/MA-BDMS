<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">

<div class="container">
	<div class="row">
		<div class="col-lg-12 margin-tb">
			<h2>Data Nasabah</h2>
			<button type="button" class="btn btn-success" data-toggle="modal" data-target="#create_nasabah">
				<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add New
			</button>
			<br /><br />
		</div>
	</div>
</div>
 
            <!--<div class="panel panel-primary">
                <div class="panel-heading">Daftar Nasabah</div>
                <div class="panel-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No Rekening</th>
                                <th>Nama Nasabah</th>
                            </tr>
                        </thead>
                        <tbody>
							<tr id="isi"></tr>
                        </tbody>
                    </table>
                    <ul id="pagination" class="pagination-sm"></ul>
                </div>
            </div>-->

<!-- Modal untuk tambah nasabah -->
            <!--<div class="modal fade" id="create_nasabah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="modal-title" id="myModalLabel">New Nasabah</h4>
                        </div>
 
                        <div class="modal-body">
                            <form data-toggle="validator" action="#" method="POST">
                                <div class="form-group">
                                    <label class="control-label" for="acc_id">No. Rekening</label>
                                    <input type="text" name="acc_id" id="acc_id" class="form-control" required />
                                </div>
                                <div class="form-group">
                                    <label class="control-label" for="name">Nama Nasabah</label>
                                    <input type="text" name="name" id="name" class="form-control" required />
                                </div>
                                <div class="form-group">
                                    <button type="button" class="btn btn-success" id='btn_add'>Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>-->
 
            <!-- Modal untuk edit nasabah -->
            <!--<div class="modal fade" id="edit-nasabah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="modal-title" id="myModalLabel">Edit Nasabah</h4>
                        </div>
                        <div class="modal-body">
                            <form data-toggle="validator" action="#" method="put">
                                <input type="hidden" name="acc_id" class="acc_id">
                                <div class="form-group">
                                    <label class="control-label" for="name">Nama</label>
                                    <input type="text" name="name" class="form-control" required />
                                </div>
                                <div class="form-group">
                                    <button type="button" class="btn btn-success" id='btn_edit'>Edit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
</div>-->

<script type="text/javascript">
	/* $(document).ready(function () {
		viewnasabah();
		
		$(document).on('click','#btn_add',function(){
			var acc_id = $('#acc_id').val();
			var name = $('#name').val();
			
			$.ajax({
				type: 'POST',
				url: 'show_nasabah.php',
				data: {'action':'save_nasabah','acc_id':acc_id,'name':name},
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
	});
	
	function viewnasabah() {
	$.ajax({
		type: 'POST',
		url: 'show_nasabah.php',
		data: {'action':'show_nasabah'},
		success: function(data){
			$(data).insertBefore("#isi");
		}
	});
} */
</script>