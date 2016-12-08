<p style="text-align: center; color: #373D42; font-size: 26px;">Witaj</p>

<p style="text-align: center; color: #7D8084;">Klikij poniższy przycisk aby zalogować się na swoje konto</p>
<br />
<a href="<?= Config::get('host') ?>/login?hash=<?= $client->hash ?>">
	<button>
		Przejdź do konta
	</button>
</a>
