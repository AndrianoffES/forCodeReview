<?php
function showMenu() {
$sxml = simplexml_load_file('db/menu.xml');

	foreach ($sxml->menu as $menu) {
		if ($menu->caption) {
			echo "<p>".$menu->caption."</p>\n";
		}
		echo "<ul>\n";
		foreach ($menu->item as $item) {
			echo '<li><a href="'.$item->href.'" title="'.$item->title.'">'.$item->description.'</a>';
			if ($item->submenu) {
				echo '<div class="sys"><b></b><ul>';
				foreach ($item->submenu->item as $subitem) {
					echo '<li><a href="'.$subitem->href.'" title="'.$subitem->title.'">'.$subitem->description."</a></li>\n";
				}
			echo "</ul>\n</div>\n";
			}
			echo "</li>\n";
		}
		echo "</ul>\n";
	}
} 

function clear_data($value,$type) {
	switch ($type) {
		case 'int':
			return abs((integer)$value);
			break;
		
		case 'str':
			return trim(strip_tags($value));
			break; 
	}
}

function control_file($page,$id=0) {
	if ($id!=0){
		if (file_exists('db/'.$page.'/'.$page.'.xml')) {
			$sxml = simplexml_load_file('db/'.$page.'/'.$page.'.xml');
			$id-=1;
			if ($sxml->item[$id]) {
				return true;
			}else{
				$url = 'http://'.$_SERVER['HTTP_HOST'].'/catalog.php?page='.$page;
			  	header("HTTP/1.1 301 Moved Permanently");
			  	header("Location: $url");
			  	die();	
			}

		}else{
			$url = 'http://'.$_SERVER['HTTP_HOST'];
			header("HTTP/1.1 301 Moved Permanently");
			header("Location: $url");
			die();	
		}
	}else{
		if (file_exists('db/'.$page.'/'.$page.'.xml')) {
			return true;
		}else{
			$url = 'http://'.$_SERVER['HTTP_HOST'];
			header("HTTP/1.1 301 Moved Permanently");
			header("Location: $url");
			die();
		}
	}
}

?>