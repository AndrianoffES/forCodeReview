<?php 
header ("Content-Type: text/html; charset=utf-8");
require ("functions.inc.php");
$conxml = simplexml_load_file("db/contacts.xml") or die ("Упс, произошла ошибка!");	
	if ((!empty($_GET['city']))&&($_GET['city']<7)&&($_GET['city']>0)) {	
		$page_city = clear_data($_GET['city'],'int');
		$flag = true;
		switch ($page_city) {
		 	case 1:
		 		$ldc = nl2br($conxml->kazan->long_description_contacts);
		 		$city = 'ИП Чебыкин - Казань';
		 		$content_map = 'ИП Чебыкин, Казань, улица Родина 7(здание КНИТИ ВТ), офисы: 142, 158';
		 		$shir = 55.769611;
		 		$dol = 49.199075;
		 		break;
		 	case 2:
		 		$ldc = nl2br($conxml->perm->long_description_contacts);
		 		$city = 'ООО "Новтех-норд" - Пермь';
		 		$content_map = 'ООО "Новтех-норд", Пермь, проспект Парковый, 28а';
		 		$shir = 57.997593;
		 		$dol = 56.151182;
		 		break;
		 	case 3:
		 		$ldc = nl2br($conxml->ekb->long_description_contacts);
		 		$city = 'ООО "Глобус" - Екатеринбург';
		 		$content_map = 'ООО "Глобус", Екатеринбург, ул. Старых Большевиков 2А, корпус 2, 2 этаж';
		 		$shir = 56.885761;
		 		$dol = 60.637315;
		 		break;
		 	case 4:
		 		$ldc = nl2br($conxml->omsk->long_description_contacts);
		 		$city = 'ООО "Глобус" - Омск';
		  		$content_map = 'ООО "Глобус", Омск, ул. Лермонтова, д. 81, корпус 2, офис 20';
		 		$shir = 54.98348378; 
		 		$dol = 73.40014750;
		 		break;
		 	case 5:
		 		$ldc = nl2br($conxml->novosib->long_description_contacts);
		 		$city = 'ИП Чебыкин - Новосибирск';
		 		$content_map = 'ИП Чебыкин А.А. ул. Дуси Ковальчук, 270/3, офис 3';
		 		$shir = 55.060467;
		 		$dol =  82.920861;
		 		break;
		 	case 6:
		 		$ldc = nl2br($conxml->ufa->long_description_contacts);
		 		$city = 'ООО "ГЛОБУС" - Уфа';
		 		$content_map = 'ИП Чебыкин А.А. ул. Владивостокская, д. 12 цокольный этаж';
		 		$shir = 54.73364456993463;
		 		$dol =  55.98667349999987;
		 		break;
		 	default:
		 		/*может быть тут сделать редирект*/
		 		break;
		}
	} else {
		$city = 'ООО "Глобус"';
		$flag = false;
	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Контакты ООО "Глобус" <?php echo $city?></title>
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/contacts.css">
	<script src="http://api-maps.yandex.ru/2.0-stable/?load=package.standard&lang=ru-RU" type="text/javascript"></script>
	<!--[if lte IE 6]>
	<script type="text/javascript" src="css/IE7.js"></script>
	<link rel="stylesheet" type="text/css" href="css/mainIE.css">
	<![endif]-->
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script>
	<?php if (isset($_GET['city'])) { ?>
			<script type="text/javascript">
			ymaps.ready(init);
		    var mymap, m_ekb;

		    function init(){     
		  
		           mymap = new ymaps.Map ("map", {
		           center: [<?php echo $shir,',',$dol ?>],
		           zoom: 16,
		        });

		         m_ekb = new ymaps.Placemark([<?php echo $shir,',',$dol ?>], {
		            content: '',
		            balloonContent: '<?php echo $content_map ?>'
		        });
		       	
				mymap.geoObjects.add(m_ekb);
				mymap.controls.add(
		   		new ymaps.control.ZoomControl());
		   		mymap.controls.add('typeSelector');
		    }
			</script>
	<?php } ?>
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
				<p id="homemargin" class="fontext"><a href="index.php" id="home" title="На главную"> Главная Глобус</a>Главная</p>
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
				<div id="ktomy" class="infopage"><h1>Контакты <?php echo $city?></h1></div>
				<?php 
				if ($flag) {
				?>
				<p class="zeltext"><?php echo $ldc ?></p>	
				<div id="p_map"><div id="map"></div></div>
				<?php
				} else{
				?>
				<div id="citys">Выберите город
				<a href="contacts.php?city=1" id="c1" title="Перейти на страницу контактов Казань">Казань</a>
				<a href="contacts.php?city=2" id="c2" title="Перейти на страницу контактов Пермь">Пермь</a>
				<a href="contacts.php?city=3" id="c3" title="Перейти на страницу контактов Екатеринбург">Екатеринбург</a>
				<a href="contacts.php?city=4" id="c4" title="Перейти на страницу контактов Омск">Омск</a>
				<a href="contacts.php?city=5" id="c5" title="Перейти на страницу контактов Новосибирск">Новосибирск</a>
				<a href="contacts.php?city=6" id="c6" title="Перейти на страницу контактов Уфа">Уфа</a>
				</div>
				<div id="onas"><span class="fontext2">О нас:</span>Наша компания самая лучшая компания :)<a href="#"></a></div>
				<?php
				}
				?>
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
       	 