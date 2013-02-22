<?php

class HomeControler extends Controler {
	public function IndexAction($params) {
	    $cats = App::getClassArray("category", array("limit" => 6));
	    
	    $news = App::getClassArray("article", array("where" => "node = " . BlogControler::$ID_NODE_NEWS, "limit" => 5));
	    $articles = App::getClassArray("article", array("where" => "node = " . BlogControler::$ID_NODE_ARTICLE, "limit" => 5));
	    
	    return $this->render(array('cats' => $cats, 'articles' => $articles, 'news' => $news));
	}
}

?>