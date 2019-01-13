<!DOCTYPE html>
<html>
<head>
	<title>Beer Game登入</title>
	<link rel="stylesheet" type="text/css" href="https://bootswatch.com/4/sandstone/bootstrap.min.css">
</head>
<body>
	
<form method="post" action="loginControl.php">
	<fieldset>
    <legend>Login Form</legend>
    
    <div class="form-group">
      <label >loginID</label>
      <input type="text" class="form-control" id="loginID" name="id"  placeholder="Enter loginID">
      
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Password</label>
      <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Password">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</fieldset>
</form>
</body>
</html>
