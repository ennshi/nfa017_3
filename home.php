<?php
session_start();

if(isset($_SESSION['name'])){
//  stocker dans un cookies le nombre de visites client: 
    function counter() {
        if(isset($_COOKIE['count'])){
            $_COOKIE['count']++;
        } else {
            $_COOKIE['count'] = 1;
        }
        return $_COOKIE['count'];
    }
    setcookie('count', counter(), time()+86400);

// deconnecter et supprimer la session:
    if(time() - $_SESSION['auth_timestamp'] > 60) {
        header('Location: logout.php');
    }
    
/*stocker dans un fichier contact.log, les informations:
     - La date et l’heure de visite client;
     - Le nom et le prénom du client;
     - Son adresse IP */
    $currentTime = date('Y-m-d h:i:s');
    $fp = fopen('contact_log.txt', 'a');
    fwrite($fp, "/\n {$currentTime}\t{$_SESSION['f_name']} {$_SESSION['name']}\t{$_SERVER['REMOTE_ADDR']}/\t");
    fclose($fp);
    
} else {
    header('Location: index.php');
}


?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Home</title>
		<style>
    		body {
    			text-align: center;
    			font-family: Arial, sans-serif;
    			background-image: url('image/1.jpg');
    			background-repeat: no-repeat;
    			background-size: cover;
    			
    		}
    		button {
    		    background-color: white;
    			width: 150px;
    			height: 30px;
    		}
	   </style>
	</head>
	<body>
		<div>
    		<h1>Bonjour, <?=$_SESSION['f_name']; ?></h1>
    		<p> Vous avez visit&eacute; ce site <?=$_COOKIE['count']; ?> fois.</p>
    		<p>Vous serez d&eacute;connect&eacute; dans <span id="counter"> </span> secondes automatiquement.</p><br/>
    		<a href="logout.php"><button>Se d&eacute;connecter</button></a>
		</div>
		<script>
		let counter = document.getElementById("counter");
		let currentTime = <?php echo 60 - time() + $_SESSION['auth_timestamp']; ?>;
		counter.textContent = currentTime;
		let countDown = function() {
			if(counter.textContent > 0){
				counter.textContent -= 1;
			} else {
    			window.clearInterval(timer);
    			window.location='index.php';
			}

		};
		let timer = window.setInterval(countDown, 1000);		
		</script>

	</body>
</html>