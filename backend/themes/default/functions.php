<?php
	


	$cache = new Cache(_theme_path_."cache/", 1);
	/*
	if(!$cache->start("test")) {

		echo "prout";
		sleep(2);
	}
	$cache->end();
*/

	function text($text) {
		$lang = file_get_contents(_theme_path_."lang/".__lang__.".json");
		$lang = json_decode($lang);
		foreach ($lang as $value) {
			if(!empty($value->$text)) {
				return $value->$text;
			}
		}
		return "This text doesn't has its traduction !";
	}

	function createLink($link) {
		if(Kernel::get("langdefault")!=Kernel::get("lang"))
			return "/".Kernel::get("lang").$link;
		else
			return $link;
	}

	//include(__library_dir__ . "lang/" . Kernel::get("lang") . ".php");
	function partial($page) {
		include(_theme_path_."partials/".$page.".php");
	}
	function img($name) {
		echo '/'._theme_path_ . 'images/'.$name;
	}
	function lang($lang){
		if($lang != "")
			return $lang;
		else
			return "This text doesn't has its traduction !";
	}
	
	function printDate($date){
		$dateExpl = explode(' ', $date);
		$day = explode('-', $dateExpl[0]);
		$time = explode(':', $dateExpl[1]);
		
		$month = array(	"01"=>text("january"),
						"02"=>text("february"),
						"03"=>text("march"),
						"04"=>text("april"),
						"05"=>text("may"),
						"06"=>text("june"),
						"07"=>text("july"),
						"08"=>text("august"),
						"09"=>text("september"),
						"10"=>text("october"),
						"11"=>text("november"),
						"12"=>text("december")					
					);
		
		return $day[2]." ".$month[$day[1]]." ".$day[0]." à ".$time[0]."H".$time[1];
	}
	
	function minifyText($title, $size_max = 25){	
		if(strlen($title) > $size_max){
			return substr($title, 0, $size_max)."...";
		}
		else{
			return $title;
		}
	}
?>