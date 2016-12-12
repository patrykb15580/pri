<p style="text-align: center; color: #373D42; font-size: 26px;">Witaj</p>

<p style="text-align: center; color: #7D8084;">Klikij poniższy przycisk aby zalogować się na swoje konto</p>
<br />
<a href="<?= Config::get('host') ?>/login?hash=<?= $client->hash ?>">
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
		Przejdź do konta
	</button>
</a>
