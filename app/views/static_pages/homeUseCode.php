<form method="POST" action="<?= $router->generate('home_enter_code') ?>">
    <img src="/assets/image/home/intro-banner-logo.png">
    <h1>Aktywuj swój kod promocyjny</h1>
    <div>
        <input type="text" name="code" placeholder="Wprowadź kod" required maxlength="6">
        <input type="submit" value="Zatwierdź">
    </div>
</form>