<?php 
	$router = Config::get('router');
?>
<p style="text-align: center; color: #373D42; font-size: 26px;">Witaj</p>

<p style="text-align: center; color: #7D8084;">Klikij poniższy przycisk aby utworzyć nowe hasło dla twojego konta</p>
<br />
<a href="<?= Config::get('host').$router->generate('new_password', ['token'=>$token->token]) ?>">
	<button style="display: block;
			margin: 0 auto; 
			background-color: #60C43E;
			text-align: center;
			border: 0px solid;
			border-radius: 3px;
			color: white;
			font-weight: 600;
			font-size: 16px;
			padding: 8px 16px;">
		Zmień hasło
	</button>
</a>
