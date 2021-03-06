<?php
    $router = Config::get('router');
?>
<!DOCTYPE html>
<html>
<head>
    <title>
        punktacja.pl
    </title>
    <link rel="stylesheet" type="text/css" href="/assets/css/normalize.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/startPage.css">
    
    <link rel="stylesheet" type="text/css" href="/assets/css/home/homePageTop.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/home/homePageLoginForm.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/home/homePageIntroBanner.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/home/homePageContentSection.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/home/homePageHeader.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/home/homePageBanner.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/home/homePageHowItsWork.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/home/homePageCodeForm.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/home/homePageContact.css">
    <link rel="stylesheet" type="text/css" href="/assets/css/home/homePageFooter.css">

    <link rel="stylesheet" type="text/css" href="/assets/css/alerts.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800" rel="stylesheet"> 
    <script src="https://use.fontawesome.com/e806e76f5f.js"></script>
    <script type="text/javascript" src="/assets/javascript/alerts.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body id="home-page">

<div class="page">
    <a class="anchor" name="page-top"></a>

    <nav class="navbar navbar-default navbar-fixed-top top">
        <div class="container-fluid bar">
            <div class="logo scroll" data-bar="page-top"></div>
            <div class="menu">
                <div class="scroll" data-bar="more">DOWIEDZ SIĘ WIĘCEJ</div>
                <div class="scroll" data-bar="code">AKTYWUJ KOD</div>
                <div>POMOC</div>
                <div class="scroll" data-bar="contact">KONTAKT</div>
                <div class="join">DOŁĄCZ DO PROGRAMU</div>
                <div class="login">LOGOWANIE</div>
            </div>
            <div class="toggle-menu">
                <i class="fa fa-bars" aria-hidden="true"></i>
            </div>
            <form class="login-form" method="POST" action="<?= $router->generate('sign_in', []) ?>">
                <div class="tabs">
                    <span class="tab active" data-form="client">Klient</span><span class="tab inactive" data-form="promotor">Promotor</span>
                </div>
                <input type="email" name="client[email]" placeholder="email" required>
                <input type="password" name="client[password]" placeholder="hasło" required>
                <input type="submit" value="Zaloguj">
                <input type="hidden" name="page" value="home">
                <?php
                    if (isset($params['login-error'])) { ?>
                        <span class="login-error">Błędny login lub hasło</span>
                    <?php }
                ?>
            </form>
        </div>
        <?php Alerts::showAlert(); ?>
    </nav>

    <div class="intro-banner">
        <img src="/assets/image/home/logo-red.png">
        <h1>Lojalność Konkursy Opinie</h1>
        <a class="button join">DOŁĄCZ DO PROGRAMU</a>
        lub <a class="scroll" data-bar="more">dowiedz się więcej</a>
    </div>
    <div class="content-section">
        <h1>
            Zero abonamentu, zero inwestycji!<br />
            Dołącz do zabawy!
        </h1>
        <p>
            Nowoczesny i bardzo prosty sposób na poznanie swoich klientów i budowanie lojalności, a także umacnianie pozytywnych relacji poprzez konkursy, a także możliwość zbierania opinii o produktach i usługach.
        </p>
    </div>
    <a class="anchor" name="more"></a>
    <div class="header">
        <h1>Wyjątkowe funkcje programu Punktacja</h1>
        <p>Wypróbuj możliwości programu w swoim biznesie</p>
    </div>
    <div class="content-section">
        <div class="col">
            <h1>Program lojalnościowy z myślą o Twoich klientach</h1>
            <p>
                Dbanie o klienta jest dużo tańsze niż walka o nowego. Co robisz dla swoich klientów aby pamiętali o Tobie i wracali? Nic! PUNKTACJA jest rozwiązaniem idealnym dla Ciebie. Rozwiązaniem, które pozwoli rozpocząć budowanie pozytywnych relacji ze swoimi klientami.
            </p>
            <h2>Program lojalnościowy PUNKTACJA:</h2>
            <ul>
                <li><span>to proste i nowoczesne rozwiązanie - wystarczy smartfon, który zawsze jest pod ręką</span></li>
                <li><span>klient nie dostaje żadnych kart, które zajmują tylko miejsce w jego portfelu</span></li>
                <li><span>budujesz bazę swoich klientów i dostajesz możliwość kontaktu z nimi</span></li>
            </ul>
            <hr />
            <span class="more">Więcej informacji</span>
        </div>
        <div class="col">
            <h1>Konkursy, które kochają Twoi klienci</h1>
            <p>
                Gdy masz możliwość tworzenia konkursów w łatwy i prosty sposób, zyskujesz element przewagi konkurencyjnej. Twoje produkty staną się bardziej atrakcyjne, gdyż klient poza wartością samego produkty lub usługi otrzymuje wartość dodaną - emocje konkursowe.
            </p>
            <h2>Dlaczego warto?</h2>
            <ul>
                <li><span>tworząc konkurs, tworzysz news marketingowy, o którym możesz mówić</span></li>
                <li><span>dobierając ciekawe nagrody, wykorzystujesz ich atrakcyjność dla siebie</span></li>
                <li><span>nie interesują Cię kwestie formalne</span></li>
            </ul>
            <hr />
            <span class="more">Więcej informacji</span>
        </div>
        <div class="col">
            <h1>Feedback czyli opinie od Twoich klientów</h1>
            <p>
                Czy zadałeś sobie pytanie: jak dobre w odczuciu klienta są Twoje produkty? Które z oferowanych produktów są najlepsze? Lub co należy poprawić? Jeśli tak - Super! PUNKTACJA jest dla Ciebie.
            </p>
            <h2>Co dostajesz?</h2>
            <ul>
                <li><span>pięciogwiazdkowy model oceny produktów</span></li>
                <li><span>możliwość zbierania opini na zasadzie wzajemności, bo nagradzasz swojego klienta</span></li>
                <li><span>wszystko oparte o smartfon, który zawsze jest pod ręką</span></li>
            </ul>
            <hr />
            <span class="more">Więcej informacji</span>
        </div>
    </div>
    <div class="banner">
        <h1>Wystarczy smartfon, tablet lub komputer</h1>
        <img src="/assets/image/home/multiplatforma.png">
        <a class="button join">DOŁĄCZ DO PROGRAMU</a>
    </div>
    <div class="content-section">
        <div class="how-its-work">
            <h1>Jak działa program punktacja?</h1>
            <div class="text">
                PUNKTACJA działa w oparciu o <b>personalizowane naklejki i karty bonusowe</b>, które odpowiednio, albo są naklejane na sprzedawane produkty lub wydawane klientowi przy okazji transakcji. Wszystkie niezbędne czynności związane z aktywacją programu lojalnościowego, konkursu czy akcji zbierania opinii zrealizujesz online. Interakcja z klientem realizowana jest z wykorzystaniem smartfona, tabletu lub komputera z dostępem do internetu.
            </div>
            <iframe class="video" src="https://www.youtube.com/embed/OvWWVub9cc4" frameborder="0" allowfullscreen></iframe>
        </div>
    </div>
    <a id="code" class="anchor" name="code"></a>
    <div class="code">   
        <?php include $path; ?>
    </div>    
    <a class="anchor" name="contact"></a>
    <div class="contact">
        <h1>Zapraszamy do kontaktu</h1>
        <p>Dział obsługi klienta pracuje od poniedziałku do piątku, w godzinach 8-16</p>
        <?php
            $text = '';
            if (isset($params['mail'])) {
                if ($params['mail'] == 'error') {
                    $type = 'error';
                    $text = 'Nie udało się wysłać wiadomości, spróbuj jeszcze raz';
                }
                if ($params['mail'] == 'ok') {
                    $type = 'sended';
                    $text = 'Twoja wiadomość została wysłana';
                } ?>
                <p class="status <?= $type ?>"><?= $text ?></p>
            <?php }
        ?>
        <form method="POST" action="<?= $router->generate('send_contact_email', []) ?>">
            <div class="inputs">
                <input type="text" name="name" placeholder="Imię i nazwisko" required>
                <input type="text" name="contact" placeholder="Nr telefonu / e-mail" required>
            </div>
            <textarea name="text" placeholder="Wiadomość" required></textarea>
            <br />
            <input type="submit" value="WYŚLIJ WIADOMOŚĆ">
        </form>
    </div>
    <div class="rights">
        Operatorem programu Punktacja i właścicielem serwisu punktacja.pl jest Booklet Group S.C., Korzkwy 23, 63-300 Pleszew<br />
        &copy; Copyright 2017 Booklet Group S.C. Wszystkie prawa zastrzeżone / All rights reserved.
    </div>
    <div class="footer">
        <img src="/assets/image/home/booklet.png" alt="booklet">
    </div>
</div>

<div class="join-form">
    <div class="header">
        <a class="close-form join-cancel">&times;</a>
        <img src="/assets/image/home/intro-banner-logo.png">
        Formularz zgłoszeniowy
    </div>
    <form method="POST" action="<?= $router->generate('promotor_application', []) ?>">
        <input class="first" type="email" name="email" placeholder="Adres e-mail" required>
        <input type="text" name="company" placeholder="Nazwa firmy" required>
        <input type="text" name="name" placeholder="Imię i nazwisko" required>
        <input class="last" type="text" name="phone_number" placeholder="Numer telefonu" required>
        <input type="submit" value="DOŁĄCZ DO PROGRAMU">
        <span class="join-cancel">Anuluj</span>
    </form>
    <br />
    <div class="rights">
        Operatorem programu Punktacja i właścicielem serwisu punktacja.pl jest Booklet Group S.C., Korzkwy 23, 63-300 Pleszew<br />
        &copy; Copyright 2017 Booklet Group S.C. Wszystkie prawa zastrzeżone / All rights reserved.
    </div>
    <div class="footer">
        <img src="/assets/image/home/booklet.png" alt="booklet">
    </div>
</div>

<script type="text/javascript">
    //$(window).scroll(function(){
    //    if ($(window).scrollTop() >= 0) {
    //        $('.top').css({ 'position': 'absolute', 'top': $(window).scrollTop() });
    //    } 
    //});

    

    //$('.top .logo').click(function(){
    //    if ($('.join-form').is(':visible')) {
    //        $('.join-form').fadeOut().promise().done(function(){
    //            $('#home-page').css({ 'background-color': '#FFFFFF' });
    //            $('.page').fadeIn();
    //            $('.top .logo').addClass('scroll');
    //            $('.top').css({ 'position': 'fixed' });
    //        });
    //    }
    //});

    
</script>
<script type="text/javascript" src="/assets/javascript/homePageScrollTo.js"></script>
<script type="text/javascript" src="/assets/javascript/bootstrap.min.js"></script>
<script type="text/javascript" src="/assets/javascript/home/homePageLogin.js"></script>
<script type="text/javascript" src="/assets/javascript/home/homePagePromotorApplication.js"></script>
<script type="text/javascript" src="/assets/javascript/home/homePageMenu.js"></script>
</body>
</html>
