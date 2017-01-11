<!--
	Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
	quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
	consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
	cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
	proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
-->

<div id="home-page-title">
	<p class="title">
		Poznajmy się
	</p>
	<p class="text">
		Zbieraj punkty, zgarniaj nagrody
	</p>
	<a class="button" href="<?= $router->generate('app', []) ?>">Wprowadź kod</a>
</div>

<!--
<div id="home-page-wrapper" class="home-page-wrapper-1">
	<p class="title">
		Poznajmy się
	</p>
	<p class="text">
		Zbieraj punkty, zgarniaj nagrody
	</p>
</div>
-->

<div id="home-page-bar" class="about-punktacja">
	<div class="title">
		O Punktacja
	</div>
	<div class="content">
		<span class="text-with-image">
			<span class="highlighted-text">Punktacja.pl</span> pozwala na zbudowanie relacji pomiędzy klientem a partnerem i poznanie się bliżej. 
			<br /><br />
			Zbieraj punkty w programie lojalnościowym lub oceniaj partnerów w konkursach w zamian odbieraj nagrody. 
			<br /><br />
			Program oparty o naklejki lub wizytówki, bez pobierania aplikacji na telefon. 
		</span>
		<span class="image">
			<img src="/assets/image/app-screen3.png">
		</span>
	</div>
</div>

<!--
<div id="home-page-wrapper" class="home-page-wrapper-2"></div>
-->

<div id="home-page-bar" class="for-clients">
	<div class="title">
		Dla klienta
	</div>
	<div class="content">
		<span class="text-with-image">
			W trakcie codziennych zakupów, których i tak nie unikniesz, zbierasz punkty a potem możesz skorzystać z rabatów i prezentów oferowanych przez Promotorów.<br /> 
			Nie musisz nosić w portfelu kilka kart lojalnościowych wystarczy Twój telefon, który zawsze masz przy sobie.

			<h2>Jak to działa?</h2>
			Promotor oznacza swoje produkty kodem QR, który ma określoną wartość punktową.<br /><br />
			Ty robisz zakupy, skanujesz kod i zbierasz punkty na swoim koncie.<br />
			Odbierasz nagrody i korzystasz z promocji w dowolnym czasie i na dowolnym urządzeniu.
		</span>
		<span class="image">
			<img src="/assets/image/fotolia-test.jpg" alt="image">
		</span>
	</div>	
</div>

<!--
<div id="home-page-wrapper" class="home-page-wrapper-3"></div>
-->

<div id="home-page-bar" class="for-promotors">
	<div class="title">
		Korzyści dla Twojego biznesu
	</div>
	<div class="content">
		Otrzymujesz profesjonalne rozwiązanie, które wyróżni Cię wśród konkurencji i jest gotowe do wdrożenia w twoim biznesie już teraz.<br /><br />
		Łatwy i przejrzysty interfejs do samodzielnej obsługi.<br />
		Sam ustalasz jakie promocje oferujesz swoim klientom.<br />
		Sam wybierasz nagrody jakie mogą wybrać Twoi klienci.<br />
		Nie wiążesz się żadną stałą opłatą czy abonamentem.<br /><br />

		Co zyskujesz?
		<ul>
			<li>
				<span>Możliwość zdobycie danych kontaktowych swoich klientów</span>
			</li>
			<li>
				<span>Narzędzie do komunikacji ze swoimi klientami</span>
			</li>
			<li>
				<span>Dodatkową korzyść dla klienta - zbieranie punktów i wymiany ich na nagrody.</span>
			</li>
			<li>
				<span>Każdy klient jest dla Ciebie ważny i dzięki możliwościom jakie daje Punktacja.pl będzie do Ciebie wracał.</span>
			</li>
			<li>
				<span>Powracający klient zostanie ambasadorem Twojej marki i przyciągnie nowych klientów.</span>
			</li>
			<li>
				<span>Szeroką promocję w mediach społecznościowych</span>
			</li>
			<li>
				<span>Możliwość poznania preferencji swoich klientów</span>
			</li>
		</ul>
		
		<!--
		<span class="text-with-video">
			Poznaj swoich klientów, komunikuj się z nimi, zbuduj relacje ze swoimi klientami, dzięki temu będziesz zarabiał więcej.
			<br /><br />
			Dlaczego warto
			<ul>
				<li>Zbudujesz własny program lojalnościowy</li>
				<li>Będziesz mógł organizować konkursy promocyjne</li>
				<li>Zbierać opinie klientów o swoich produktach i/lub usługach</li>
				<li>i najważniejsze - Komunikować się ze swoimi klientami!</li>
				<li>brak abonamentów,</li>
			</ul>
			<br /><br />
			“Utrzymanie klienta jest tańsze niż walczenie o nowego!”
		</span>
		<iframe class="video" src="https://www.youtube.com/embed/g6DdX51fnxM" frameborder="0" allowfullscreen></iframe>
		-->
	</div>	
</div>

<!--
<div id="home-page-wrapper" class="home-page-wrapper-4"></div>
-->

<div id="home-page-bar" class="contact">
	<div class="title">
		Kontakt
	</div>
	<div class="content">
		info@punktacja.pl<br />
		tel. 733 450 001<br />
		Punktacja.pl<br />
		Booklet Group S.C.<br />
		Korzkwy 23, 63-300 Pleszew<br />
	</div>	
</div>

<!--
<div id="home-page-wrapper" class="home-page-wrapper-5"></div>
-->

<?php
	if (!DetectMobile::isMobile()) { ?>
		<div id="back-to-top">
			<i class="fa fa-angle-up" aria-hidden="true"></i>
		</div>
	<?php }
?>


<script type="text/javascript">
	/*$(window).scroll(function(){
		if ($(window).scrollTop() > 100 && $(window).scrollTop() <= 900) {
			$('.bg-slider-1').css({ 'position': 'fixed', 'top': '0px' });
		} else {
			$('.bg-slider-1').css({ 'position': 'absolute', 'top': '100px' });
		}

		if ($(window).scrollTop() > 646 && $(window).scrollTop() <= 2500) {
			$('.bg-slider-2').css({ 'position': 'fixed', 'top': 'auto', 'bottom': '0px' });
		} else {
			$('.bg-slider-2').css({ 'position': 'absolute', 'top': '900px' });
		}

		if ($(window).scrollTop() > 2500 && $(window).scrollTop() <= 4100) {
			$('.bg-slider-3').css({ 'position': 'fixed', 'top': 'auto', 'bottom': '0px' });
		} else {
			$('.bg-slider-3').css({ 'position': 'absolute', 'top': '2500px' });
		}

		if ($(window).scrollTop() > 4100) {
			$('.bg-slider-4').css({ 'position': 'fixed', 'top': '0px' });
		} else {
			$('.bg-slider-4').css({ 'position': 'absolute', 'top': '4100px' });
		}

		//'top': $(window).scrollTop() + 'px'
	});*/
</script>