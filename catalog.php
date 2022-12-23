<?php
header ("Content-Type: text/html; charset=utf-8");
require ("functions.inc.php");
$conxml = simplexml_load_file("db/contacts.xml") or die ("Упс, произошла ошибка!");

if ((!empty($_GET['page']))&&(!empty($_GET['id']))&&(control_file($_GET['page'],$_GET['id']))) {
		$page = clear_data($_GET['page'],'int');
		$id = clear_data($_GET['id'],'int')-1;
		$sxml = simplexml_load_file('db/'.$page.'/'.$page.'.xml') or die ("Упс, произошла ошибка!");
		$page_or_id = 1;
		$s_pageid = $page.'-'.$id;
}
elseif ((!empty($_GET['page']))&&(control_file($_GET['page']))) {
		$page = clear_data($_GET['page'],'int');
		$sxml = simplexml_load_file('db/'.$page.'/'.$page.'.xml') or die ("Упс, произошла ошибка!");
		$page_or_id = 2;

} else {
	 	$url = 'http://'.$_SERVER['HTTP_HOST'];
	  	header("HTTP/1.1 301 Moved Permanently");
	  	header("Location: $url");	
	  	die();
 }
session_start();
  if ($_SERVER['REQUEST_METHOD']=='POST') {
		$pageid = clear_data($_POST['pageid'],'str');
		$hna     = clear_data($_POST['hna'],'str');
		$url = clear_data($_POST['url'],'str');

		if (!isset($_SESSION[$pageid])) {
			$_SESSION[$pageid]['hna']      = $hna;
			$_SESSION[$pageid]['url']      = $url;
			$_SESSION[$pageid]['quantity'] = 1;
		} else {
			unset($_SESSION[$pageid]);
		}
 }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<?php 
	if ($page_or_id==2) {
		echo "<meta name='description' content='$sxml->headtext'>";
	}
	?>
	
	<title>
	<?php 
	if ($page_or_id===1) {
		echo $sxml->item[$id]->h1,' ',$sxml->item[$id]->name,' - ',$sxml->item[$id]->art;
	}
	else {
		echo $sxml->caption;
	}

	?>
	</title>
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/catalog.css">
	<link rel="stylesheet" href="css/jquery.tooltip.css">
	<link rel="stylesheet" href="css/lightbox.css">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script src="css/jquery.dimensions.js" type="text/javascript"></script>
	<script src="css/jquery.tooltip.js" type="text/javascript"></script>
	<script src="css/lightbox.js" type="text/javascript"></script> 
	<!--[if lte IE 6]>
	<script type="text/javascript" src="css/IE7.js"></script>
	<link rel="stylesheet" type="text/css" href="css/mainIE.css">
	<![endif]-->

	<script>
	 $(document).ready(function(){
	 $("#indexcontent table td a img, #block_small_img a img").tooltip({
	 track: true,
	 delay: 400,
	 showURL: false,
	 fade: 200
	 });
	 });
	</script>
	<script src="css/jquery.scrollstop.js" type="text/javascript"></script> 
	<!--<script src="css/jquery.lazyload.js" type="text/javascript"></script>-->


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
				<?php	

					if ($page_or_id===1) {

						echo "<div id='ktomy' class='infopage'><h1><a href='http://".$_SERVER['HTTP_HOST']."/catalog.php?page=".$page."'>",$sxml->item[$id]->h1,' ',$sxml->item[$id]->name,'</a>',' - ',$sxml->item[$id]->art,"</h1></div>";
					
						
						echo "<div id='card_product'>
								<div id='block_small_img'>
									<a href='".$sxml->item[$id]->img_main."/lage-".$sxml->item[$id]->img_main['name']."' rel='lightbox[group]'><img src='".$sxml->item[$id]->img_main."/small-".$sxml->item[$id]->img_main['name']."' alt='".$sxml->item[$id]->alt."' title=\"<img src=".$sxml->item[$id]->img_main."/medium-".$sxml->item[$id]->img_main['name'].">\"></a>";
									foreach ($sxml->item[$id]->extra->img_extra as $ex) {
													echo "<a href='".$ex."/lage-".$ex['name']."' rel='lightbox[group]'><img src='".$ex."/small-".$ex['name']."' alt='".$sxml->item[$id]->alt."' title=\"<img src=".$ex."/medium-".$ex['name'].">\"></a>";
												}
							echo"</div>";
							echo nl2br($sxml->item[$id]->description_long);
						echo "</div>";
						echo "<form action='http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."' method='POST'>";
						if (!isset($_SESSION[$s_pageid])) {
							echo "<div id='but'><input type='image' src='img/add.jpg'></div>";
						}elseif(isset($_SESSION[$s_pageid])) {
							echo "<div id='but'><input type='image' src='img/cut.jpg'></div>";
						}
						echo "<input type='hidden' name='pageid' value='".$page."-".$id."'>",
							 "<input type='hidden' name='hna' value='".$sxml->item[$id]->h1." ".$sxml->item[$id]->name." ".$sxml->item[$id]->art."'>",
							 "<input type='hidden' name='url' value='".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."'>",
							 "</form>";
					} 

					elseif ($page_or_id===2) {

						$id = 0;
						echo "<div id='ktomy' class='infopage'><h1>", $sxml->caption, "</h1></div>";
						
						echo "<p class='zeltext'>",nl2br($sxml->headtext),"</p>";
						
							foreach ($sxml->item as $item) {
							
							echo "<span>
									<table>
										<tr>
											<td colspan='2'><a href='"."http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."&id=", $id+1 ,"' id='contenthead'>$item->name - $item->art</a></td>
										</tr>
										<tr>
											<td>";
								
											$strimgs = $item->img_main."/small-".$item->img_main['name'];
											$sizeimgs = getimagesize($strimgs);

								/*!*/		echo "<a href='".$sxml->item[$id]->img_main."/lage-".$sxml->item[$id]->img_main['name']."' rel='lightbox[group]'>
													<img width='".$sizeimgs[0]."' height='".$sizeimgs[1]."' src='".$item->img_main."/small-".$item->img_main['name'].
													"'alt='".$item->alt."' title=\"<img src=".$item->img_main."/medium-".$item->img_main['name'].">\"></a>
												<p>$item->description_short</p>
											</td>
											<td width='58px'>";
												foreach ($item->extra->img_extra as $extra) {
													$strimgss = $extra."/supersmall-".$extra['name'];
													$sizeimgss = getimagesize($strimgss);
													echo "<a href='".$extra."/lage-".$extra['name']."' rel='lightbox[group]'>
															<img width='".$sizeimgss[0]."' height='".$sizeimgss[1].
															"' src='".$extra."/supersmall-".$extra['name']."' alt='".$item->alt ."' title=\"<img src=".$extra."/medium-".$extra['name'].">\"></a>";
														
												}

							echo 			"</td>
										</tr>
										
									</table>
								</span>";
							$id++;
							}
						
						echo "<p>",nl2br($sxml->foottext),"</p>";
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
       	 