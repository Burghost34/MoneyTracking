<!DOCTYPE html>
<html lang="mx">
<head>
	<meta charset="UTF-8">
	<title>Framework Básico
		<?php if(isset($this->titulo)) { 
		echo ": " .$this->titulo;
		 } ?>
	</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" href="<?php echo APP_URL_CSS; ?>bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $_layoutParams ["ruta_css"]; ?>style.css">
</head>
<body>
	<?php 

	if (isset($this->flashMessage)) {
		echo "<h3>".$this->flashMessage."</h3>";
	}
	 ?>
