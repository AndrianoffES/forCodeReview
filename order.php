<?php 
header ("Content-Type: text/html; charset=utf-8");
require ("functions.inc.php");
$report = $gotovo = false;
session_start();
	if (!empty($_GET['dellid'])) {
	$dellid = clear_data($_GET['dellid'],'str');
	unset($_SESSION[$dellid]);
	$url = 'http://'.$_SERVER['HTTP_HOST'].'/order.php';
	header("Location: $url");
	exit;
	}

	if ($_SERVER['REQUEST_METHOD']=='POST') {
		
		$SES = $_SESSION;
		setcookie('PHPSESSID',time() - 3600);
		session_destroy();
		
		foreach ($SES as $k => $v) {
			$SES[$k]['quantity'] = clear_data($_POST[$k],'int');
		}
		$dina = $dici = $diem = $dite='';
		$dina = clear_data($_POST['di_name'],'str');
		$diem = filter_var(clear_data($_POST['di_email'],'str'),FILTER_VALIDATE_EMAIL);
		$dite = clear_data($_POST['di_tel'],'str');
		$dici = clear_data($_POST['di_ci'],'int');

		if ((!empty($dina))&&(!empty($diem))&&(!empty($dite))) {
			
			switch ($dici) {
			 	case 1: // Екб
			 		$to = 'ekt@optic-opt.ru';
					$tocity = 'Екатеринбург';
			 		break;
			 	case 2: // Пермь
			 		$to = 'perm@optic-opt.ru, ekt@optic-opt.ru';
			 		$tocity = 'Пермь';
					break;
			 	case 3: // Казань
			 		$to = 'kazan@optic-opt.ru, ekt@optic-opt.ru';
			 		$tocity = 'Казань';
					break;
			 	case 4: // Омск
			 		$to = 'omsk@optic-opt.ru, ekt@optic-opt.ru';
			 		$tocity = 'Омск';
					break;
			 	case 5: // Новосибирск
			 		$to = 'novosib@optic-opt.ru, ekt@optic-opt.ru';
			 		$tocity = 'Новосибирск';
					break;
			}	

			if (isset($_POST['di_cb'])) {
					$to = $to.', '.$diem;
			}

			$subject = "$tocity - ООО Глобус, online заявка от $dina";	
			/* формируем внутренности таблицы*/
			$trtd="";
			foreach ($SES as $post_off_arr) {
				$trtd .= "<tr>";
					foreach ($post_off_arr as $kluc => $znac) {
						if ($kluc=='hna') $trtd .= "<td> $znac </td>";
						
						if ($kluc=='quantity') $trtd .="<td> $znac </td>";
					}
				$trtd .= "</tr>";		
			}
			/*конец формирования внутренностей таблицы*/
			$message = "
			<!DOCTYPE html>			
			<html>
			<head>
			<title>Заказ с сайта optic-opt.ru</title>
				<style type='text/css'>
				html {font-family: arial, verdana, sans-serif;}
				#foot {background: #B4DFF9; text-align: center; font-size: 18px;}
				table tr:nth-child(odd) {background: #FFF1D2;}
				table td {padding: 5px;}
				caption {background: #f60; color: #fff;	font-weight: bold; padding: 5px;}
				</style>
			</head>
			<body>
				<p>
					Название организации: <b>".$dina."</b>
				</p>
				<p>
					Контактный e-mail: <b>".$diem."</b>
				</p>
				<p>
					Контактный телефон: <b>".$dite."</b>
				</p>
				<table><caption>Заказ</caption>".$trtd."</table>
				<p id='foot'>
					<a href='http://optic-opt.ru'>ООО 'Глобус' optic-opt.ru</a>
				</p>
			</body>
			</html>
						";


			$massege = wordwrap($message, 70);
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
			$headers .= 'From: order@optic-opt.ru' . "\r\n";
			mail($to,$subject,$massege,$headers) or die("письмо не удалось отправить");
			$gotovo = true;

		} else {
			$report = true;
		}
	}

$conxml = simplexml_load_file("db/contacts.xml") or die ("Упс, произошла ошибка!");	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>ООО "Глобус" - Страница заказа</title>
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/contacts.css">
	<link rel="stylesheet" type="text/css" href="css/order.css">
	<script src="http://api-maps.yandex.ru/2.0-stable/?load=package.standard&lang=ru-RU" type="text/javascript"></script>
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
				<p id="homemargin" class="fontext"><a href="index.php" id="home" title="На главную"> Главная Глобус</a>Главная</p>
				<p class="fontext"><a href="contacts.php" id="contacts" title="Контакты">Контакты Глобус</a>Контакты</p>
				<p class="fontext"><a href="#" id="order" title="Оставить заявку">Заказать</a>Заказ</p>
			</div>
		
			<div id="navigation">
				<div id="catalog"><span class="fontext2">Каталог</span></div>
				<?php
					showMenu();
				?>
			</div>
			<div id="indexcontent">
			<div id="ktomy" class="infopage"><h1>Заказ</h1></div>
				<?php 
				if ($gotovo) {
			echo	"<p class='goltext'>Спасибо!</p>
					<p class='zeltext'>Ваш заказ отправлен! Сотрудники нашей компании непременно с вами свяжутся.</p>";
				}elseif ((!$gotovo)&&(!$_SESSION)) {
					echo "<p class='krtext'>Прежде чем заказывать нужно добавить товары к заказу.</p>";
				}elseif ($_SESSION) {
				?>
				<div class="fontext step">ШАГ 1. <p>Укажите количество товара.</p></div>	
				<form action="<?php echo 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; ?>" method="POST" accept-charset="UTF-8">
				<table>
					<col span='1' id='table_desc'>
					<col span='1' id='table_quan'>
					<col span='1' id='table_dell'>
					<tr>
						<th>Наименование</th>
						<th>Кол-во</th>
						<th>Удалить</th>
					</tr>
					<?php 
					$i = 0;
					foreach ($_SESSION as $key_pi => $arr_pi) {
						foreach ($arr_pi as $key => $value) {
								if ($key=='hna') $hna = $value;
								if ($key=='url') $url = $value;
								if ($key=='quantity') $quantity = $value;
						}
						echo 
						"<tr>",
						"<td><a href='http://".$url."'>$hna</a></td>",
						"<td>
							<input type='text' name='".$key_pi."' value='".$quantity."'>
						</td>",
						"<td><a href='order.php?dellid=",$key_pi,"'>Удалить</a></td>",
						"</tr>";
						}

					?>
				</table>
				<div class="fontext step">ШАГ 2. <p>Заполните контактную информацию о себе, чтобы мы могли с вами связаться.</p></div>
					<?php
					if ($report) {
					echo "<div id='report' class='zeltext'>Все поля обязательны для заполнения! <br> E-mail должен быть введен корректно!</div>";
					}
					?>
				<p>
					
					<input type="text" id="diname" name="di_name" required>
					<label for="diname">- Название вашей организации*</label>
				</p>
				<p>
					
					<input type="text" id="diemail" name="di_email" required>
					<label for="diemail">- Ваш Email*</label>
				</p>
				<p>
					<input type="text" id="ditel" name="di_tel" required>
					<label for="ditel">- Ваш телефон*</label>	
				</p>
				<p>
					<select name="di_ci" id='selCity'>
						<option value="1" selected="selected">Екатеринбург</option>
						<option value="2">Пермь</option>
						<option value="3">Казань</option>
						<option value="4">Омск</option>
						<option value="5">Новосибирск</option>
					</select>
					<!--<label for="disel"> - Выберите город</label>-->
				</p>
				<p>
					<input type="checkbox" name="di_cb" id="dicb" checked="checked">
					<label for="dicb">- Отправить копию заказа себе на e-mail?</label>
				</p>
				<input type="submit">
				</form>
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
       	 