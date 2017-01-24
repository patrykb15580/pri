<?php 
    $email = '';
    if (isset($_COOKIE['use_code_form_email']) && !empty($_COOKIE['use_code_form_email'])) {
        $email = 'value="'.$_COOKIE['use_code_form_email'].'"';
    }
    $action = $code->action();
    $promotor = $action->promotor();
?>
<form method="POST" action="<?= $router->generate('home_use_promotion_action_code', ['code'=>$code->code]) ?>">
    <img src="/assets/image/home/intro-banner-logo.png">
    <h1>Aktywuj swój kod promocyjny</h1>
    <p class="promotor"><?= $promotor->name ?></p>
    <p class="action"><?= $action->name ?></p>
    <div class="promotion-action">
        <span><?= $code->code ?></span><span>+ <?= $code->codeValue() ?> pkt</span>
        <input type="email" name="client[email]" placeholder="Adres e-mail" <?= $email ?> required>
        <input type="submit" value="Zatwierdź">
    </div>
</form>