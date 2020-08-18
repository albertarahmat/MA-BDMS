<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">

<div class="container">
	<div class="row">
	   <h3>Update a User</h3>
	</div>
    <div class="row">
        <form method="POST" action="update.php?No=<?php echo $No;?>">
		<div class="col-md-6">
			<div class="form-group">
				<label for="inputFName">First Name</label>
				<input type="text" class="form-control" required="required" id="inputFName" value="<?php echo !empty($fname)?$fname:'';?>" name="fname" placeholder="First Name">
				<span class="help-block"></span>
			</div>
			
			<div class="form-group">
				<label for="inputLName">Last Name</label>
				<input type="text" class="form-control" required="required" id="inputLName" value="<?php echo !empty($lname)?$lname:'';?>" name="lname" placeholder="Last Name">
				<span class="help-block"></span>
			</div>
			
			<div class="form-group">
				<label for="inputAge">Age</label>
				<input type="number" required="required" class="form-control" id="inputAge" value="<?php echo !empty($age)?$age:'';?>" 
				 name="age" placeholder="Age">
				<span class="help-block"></span>
			</div>
			
			<div class="form-group">
				<label for="inputGender">Gender</label>
				<select class="form-control" required="required" id="inputGender" name="gender" >
				<option>Please Select</option>
				<option value="male" <?php echo $gender == 'Male'?'selected':'';?>>Male</option>
				<option value="female" <?php echo $gender == 'Female'?'selected':'';?>>Female</option>
				</select>
				<span class="help-block"></span>
			</div>
    
			<div class="form-actions">
				<button type="submit" class="btn btn-primary">Update</button>
				<a class="btn btn btn-default" href="index.php">Back</a>
			</div>
		</form>
		</div>
                
    </div> <!-- /row -->
</div>



</section>
<!-- /.Main content -->
</div>
<!-- /.content-wrapper -->