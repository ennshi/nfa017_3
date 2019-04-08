<?php
session_start();

$name = '';

if(count($_POST) > 0) {
    $name = htmlentities(trim($_POST['name']));
    $password = htmlentities($_POST['password']);
    
    if(isset($_POST['name'])&&!empty($_POST['name'])&&isset($_POST['password'])&&!empty($_POST['password'])){
        
        if($name=="admin" && $password=="admin123") {
            $_SESSION['name'] = $name;
            $_SESSION['password'] = $password;
            $_SESSION['auth_timestamp'] = time();
            header('Location: home.php');
            
        } else {
            $msg = 'Le mot de passe ou/et username ne sont pas valides.';
        }
        
    } else {
        $msg = 'Tous les champs doivent etre remplis.';
    }
}
else {
    $msg = '';
}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login</title>
		<style>
    		body {
    			padding-left: 10px;
    			font-family: Arial, sans-serif; }
    		label {
    			width: 130px;
    			display: inline-block; }
    		button {
    			margin-left: 130px;
    			width: 80px;
    			height: 30px; }
    		div {
    			margin-top: 20px; }
	   </style>
	</head>
	<body>
		<h1>Authentification</h1>
		<form method="post">
			<label for="name">Username :</label>
				<input id="name" name="name" type="text" value= "<?php echo $name; ?>" autofocus /> <br/><br/>
			<label for="password">Mot de passe:</label>
				<input id="password" name="password" type="password" value= ""/><br/><br/>
			<button id="envoyer" type="submit">Login</button>
		</form>
		<div>
        	<?=$msg; ?>
        </div>

	</body>
</html>
