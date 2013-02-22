<?php

class BlogControler extends Controler {
	
	public static $ID_NODE_ARTICLE = 1;
	public static $ID_NODE_NEWS = 2;
	public static $ID_NODE_NOTIFBO = 3;

	public function IndexAction($params) {
	    return $this->redirect(Kernel::getUrl(""));
	}
	public function ArticleAction($params) {
	    if($article = App::getTable("article")->getBySanitizeTitle($params[4])) {
		    $link = array(
		    	"en" => Kernel::getUrl("en/".$params[1]."/".$params[2]."/".Kernel::sanitize($article->get("category")->get("name", "en"))."/".Kernel::sanitize($article->get("title", "en"))),
		    	"fr" => Kernel::getUrl("fr/".$params[1]."/".$params[2]."/".Kernel::sanitize($article->get("category")->get("name", "fr"))."/".Kernel::sanitize($article->get("title", "fr")))
		    );
		    
		    $form = $this->getRequest();
		    if($form->isMethod("post")) {
			$data = $form->getData();
			
			$pseudo = htmlspecialchars($data["user"]);
			$message = htmlspecialchars($data["message-text"]);
			$article_id = intval($data["article"]);
			
			if(isset($message) && !empty($message)) {
			    if($user = App::getTable("user")->getBySanitizePseudo($pseudo)){

				
				
				$attr = array();
				$attr["article"] = $article_id;
				$attr["author"] = $user->get("id");
				$attr["text"] = $message;
				$attr["deleted"] = 0;
				$attr["date"] = date("Y-m-d H:i:s");
				
				if($comment = App::getClass("comment")->hydrate($attr)->save()){

				    return $this->render(array('article' => $article, 'link' => $link));
				}
			    }
			}
		    }
		    return $this->render(array('article' => $article, 'link' => $link));
		}
		else
			return $this->redirect(Kernel::getUrl("error/404"));
	}
	public function CategoryAction($params) {
	    if($category = App::getTable("category")->getBySanitizeName($params[3])) {
		    $link = array(
		    	"en" => Kernel::getUrl("en/".$params[1]."/".$params[2]."/".Kernel::sanitize($category->get("name", "en"))),
		    	"fr" => Kernel::getUrl("fr/".$params[1]."/".$params[2]."/".Kernel::sanitize($category->get("name", "fr")))
		    );
		    return $this->render(array('cat' => $category, 'link' => $link));
	    }
		else
			return $this->redirect(Kernel::getUrl("error/404"));
	}
	public function ArticlesAction($params) {
	    $news = App::getClassArray("article", array("where" => "node = " . self::$ID_NODE_NEWS));
		$articles = App::getClassArray("article", array("where" => "node = " . self::$ID_NODE_ARTICLE));
		return $this->render(array('articles' => $articles, "news" => $news));
	}
	public function CategoriesAction($params) {
	    $cats = App::getClassArray("category");
		$news = App::getClassArray("article", array("where" => "node = " . self::$ID_NODE_NEWS));
		return $this->render(array('cats' => $cats, "news" => $news));
	}
	public function ActualitesAction($params){
	    $news = App::getClassArray("article", array("where" => "node = " . self::$ID_NODE_NEWS));
	    $articles = App::getClassArray("article", array("where" => "node = " . self::$ID_NODE_ARTICLE, "limit" => 5));
	    return $this->render(array("news" => $news, "articles" => $articles));
	}
	

	/*
		Action : Actualite
		Description : 	Retourne un article selon le titre passé en paramêtre
	*/
	public function ActualiteAction($params){
	    // Récupère l'article
	    if($news = App::getTable("article")->getBySanitizeTitle($params[3])) { 
		    // Création des liens pour le changement de langue
		    $link = array(
		    	"en" => Kernel::getUrl("en/".$params[1]."/".$params[2]."/".Kernel::sanitize($news->get("title", "en"))),
		    	"fr" => Kernel::getUrl("fr/".$params[1]."/".$params[2]."/".Kernel::sanitize($news->get("title", "fr")))
		    );
		    // Retourne à la vue l'article et les liens
		    return $this->render(array("news" => $news, 'link' => $link));
		}
		else // Si aucun article n'est trouvé : page 404
			return $this->redirect(Kernel::getUrl("error/404"));
	}


	public function TagsAction($params){
	    $tags = App::getClassArray("tag");
	    return $this->render(array("tags" => $tags));
	}
	public function TagAction($params){
	    if($tag_target = App::getTable("tag")->getBySanitizeName($params[3])) {
		    $tags = App::getClassArray("tag");
		    $link = array(
		    	"en" => Kernel::getUrl("en/".$params[1]."/".$params[2]."/".Kernel::sanitize($tag_target->get("name", "en"))),
		    	"fr" => Kernel::getUrl("fr/".$params[1]."/".$params[2]."/".Kernel::sanitize($tag_target->get("name", "fr")))
		    );
		    return $this->render(array("tag_target" => $tag_target, "tags" => $tags));
		}
		else
			return $this->redirect(Kernel::getUrl("error/404"));
	}
	public function RssAction($params){
	    $articles = App::getClassArray("article", array("where" => "node = " . self::$ID_NODE_ARTICLE));
	    $return = array();
	    foreach ($articles as $article) {
	    	$link = Kernel::getUrl("blog/article/".$article->get("category")->get("name")."/".$article->get("title"));
	    	$return[] = array("title" => "".$article->get("title"), "link" => $link, "guid" => $link, "description" => "".$article->get("text"), "date" => "".$article->get("date"));
	    }
	    return $this->renderRSS("articles-".Kernel::get("lang"), $return);
	}
}

?>