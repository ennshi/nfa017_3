<?php
session_start();
$name = '';
$email = '';
$f_name = '';

if(count($_POST) > 0) {
    $name = htmlentities(trim($_POST['name']));
    $email =  htmlentities(trim($_POST['email']));
    $f_name = htmlentities(trim($_POST['f_name']));
    
    if(isset($_POST['name'])&&!empty($_POST['name'])&&isset($_POST['email'])&&!empty($_POST['email'])
        &&isset($_POST['f_name'])&&!empty($_POST['f_name'])){
        
        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $_SESSION['name'] = $name;
            $_SESSION['f_name'] = $f_name;
            $_SESSION['auth_timestamp'] = time();
            header('Location: home.php');
            
        } else {
            $msg = 'L\'adresse email n\'est pas valide.';
        }
        
    } else {
        $msg = 'Tous les champs du formulaire doivent être remplis.';
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
		<title>Formulaire de contact</title>
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
			<label for="name">Nom :</label>
				<input id="name" name="name" type="text" value= "<?php echo $name; ?>" autofocus /> <br/><br/>
			<label for="f_name">Pr&eacute;nom :</label>
				<input id="f_name" name="f_name" type="text" value= "<?php echo $f_name; ?>" /> <br/><br/>
			<label for="email">Adresse email :</label>
				<input id="email" name="email" type="text" value= "<?php echo $email; ?>"/><br/><br/>
			<button id="envoyer" type="submit">Entrer</button>
		</form>
		<div>
        	<?=$msg; ?>
        </div>

	</body>
</html>
