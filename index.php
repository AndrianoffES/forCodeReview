<?php 
header ("Content-Type: text/html; charset=utf-8");
require ("functions.inc.php");
$conxml = simplexml_load_file("db/contacts.xml") or die ("Упс, произошла ошибка!");
?>
<!DOCTYPE html>
<html>
<head>
	<meta name='yandex-verification' content='61d227ce0e467783' />
	<meta charset="utf-8">
	<meta name='description' content='ООО "Глобус". Мы предлагаем: Широкий спектр очковых оправ, готовых очков различных ценовых категорий а так же полимерные и мениральные линзы,
					контактные линзы, футляры для очков, солнцезащитные, компьютерные очки, антифары и другие аксессуары.'>
	<title>Глобус - Очковая ОПТИКА Оптом! Оправы, готовые очки, линзы.</title>
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<!--[if lte IE 6]>
	<script type="text/javascript" src="css/IE7.js"></script>
	<link rel="stylesheet" type="text/css" href="css/mainIE.css">
	<![endif]-->
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script>

</head>
<body>
	<div id="main">
		<div id="all">
			<div id="globus">
				<a href="contacts.php?city=1" class="city" id="city1">Казань
					<div id="info1"><?php echo nl2br($conxml->kazan->short_description_contacts); ?></div>
				</a>
				<a href="contacts.php?city=2" class="city" id="city2">Пермь
					<div id="info2"><?php echo nl2br($conxml->perm->short_description_contacts); ?></div>
				</a>
				<a href="contacts.php?city=3" class="city" id="city3">Екатеринбург
					<div id="info3"><?php echo nl2br($conxml->ekb->short_description_contacts); ?></div>
				</a>
				<a href="contacts.php?city=4" class="city" id="city4">Омск
					<div id="info4"><?php echo nl2br($conxml->omsk->short_description_contacts); ?></div>
				</a>
				<a href="contacts.php?city=5" class="city" id="city5">Новосибирск
					<div id="info5"><?php echo nl2br($conxml->novosib->short_description_contacts); ?></div>
				</a>
				<a href="contacts.php?city=6" class="city" id="city6">Уфа
					<div id="info6"><?php echo nl2br($conxml->ufa->short_description_contacts); ?></div>
				</a>
				<p id="homemargin" class="fontext"><a href="#" id="home" title="На главную"> Главная Глобус</a>Главная</p>
				<p class="fontext"><a href="contacts.php" id="contacts" title="Контакты">Контакты Глобус</a>Контакты</p>
				<p class="fontext"><a href="order.php" id="order" title="Оставить заявку">Заказать</a>Заказ</p>
			</div>
		
			<div id="navigation">
				<div id="catalog"><span class="fontext2">Каталог</span></div>
				<?php
					showMenu();
				?>
			</div>
			<div id="indexcontent">
				<div id="ktomy" class="fontext2"><p>Кто мы?</p></div>
				
					<div id="iglobus">
					<p>
					<b>ООО "Глобус" - Очковая ОПТИКА Оптом! </b> Мы предлагаем: Широкий спектр очковых оправ, готовых очков различных ценовых категорий а так же полимерные и минеральные линзы,
					контактные линзы, футляры для очков, солнцезащитные, компьютерные очки, антифары и другие аксессуары.  
	
					</p>
						<div>
							<div>
							Компания Глобус уже более 18 лет успешно занимается оптовой продажей оптической продукции, ориентированной на российский рынок.
							</div>
							<div>
							В нашем ассортименте вы всегда сможете приобрести товар, отвечающий самым актуальным тенденциям современной моды от эстетики минимализма до яркого, броского и харизматичного.
							Мы учитываем все потребности наших клиентов и индивидуально подходим к каждому заказу.
							</div>
							<div>
							Наш головной офис находится в городе Екатеринбурге, а его филиалы расположены в городах Казань, Пермь, Омск, Новосибирск, что позволяет нам ускорить  доставку продукции до клиента.
							Мы рады предложить вам оптом оправы, очковые и контактные линзы, готовые очки солнцезащитные, антифары, компьютерные, выполненные из современных материалов, коллекции которых постоянно обновляются.
							</div>
							<div>
							У нас вы можете подобрать сопутствующие аксессуары и запчасти.
							В наличие имеются коллекции  солнцезащитных, компьютерных, водительских и перфорационных очков, стандартная линейка очковых линз фирмы «Maksema», а также контактные линзы фирмы «Окей Вижен».
							</div>
							
							<div>
							Мы уверены, что наша продукция вас заинтересует. 
							Будем рады с вами сотрудничать.
							</div>
						</div>
					</div>
			</div>
		</div>
	</div>
	<div id="footer" class="fontext2">
		<span id="footerstr1"></span>
			Как с нами связаться?
		<span id="footerstr2"></span>
		<div id="tel">по телефону в Екатеринбурге<br><span>+7(343) 228 42 71&nbsp;(75,79)</span></div>
		<div id="rr">Понедельник - пятница<br>с 9:00 до 17:00</div>
		<div id="email">или по электронной почте<br><span>ekt@optic-opt.ru</span></div>
	
	</div>
	<div id="about">
			<div id ="cr">&copy; 2013 OOO "ГЛОБУС" - оптовый интернет-магазин. Данные размещенные на интернет-сайте optic-opt.ru, носят информационный характер и не являются публичной офертой, определяемой положениями Статьи 437 (2) ГК РФ</div>
			<div id ="In">Designed &amp; Developed <br> by Maxim Torskiy</div>
	</div>
<!--[if lte IE 8]>
<script type="text/javascript" src="css/mootools.js"></script>
<script type="text/javascript" src="css/selectivizr-min.js"></script>
<![endif]-->

<script type="text/javascript" src="css/scrollmenu.js"></script>

<!-- Yandex.Metrika informer
<a href="http://metrika.yandex.ru/stat/?id=22662145&amp;from=informer"
target="_blank" rel="nofollow"><img src="//bs.yandex.ru/informer/22662145/3_1_DFE8FFFF_BFC8FFFF_0_pageviews"
style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" onclick="try{Ya.Metrika.informer({i:this,id:22662145,lang:'ru'});return false}catch(e){}"/></a>
 /Yandex.Metrika informer -->

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter22662145 = new Ya.Metrika({id:22662145,
                    webvisor:true,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true});
        } catch(e) { }
    });

    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/22662145" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

</body>
</html>  
       	 