<?php
require_once (MODELS.'ArticlesModel.php');
require_once (MODELS.'ArticlesCatsModel.php');

class ArticlesController{
    private $articlesModel; //Articles Model Object
    private $articlesCatsModel; //Articles CAtegory Model Object
    
    /**
     * Init Objects
     * @param type $articlesmodel
     * @param type $catsModel
     */
    public function __construct(ArticlesModel $articlesModel,  ArticlesCatsModel $catsModel) {
        $this->articlesModel= $articlesModel;
        $this->articlesCatsModel= $catsModel;
    }
    
    /**
     * Adding new article
     */
    public function add(){
        if (isset($_POST['addArticle'])){
            // Variables
            $title  = $_POST['title'];
            $content= $_POST['content'];
            $date   = date("d-m-y");
            $cat    = (int) $_POST['cat'];
            
            // Validation
            
            // data array
            $data= array(
                'title'     => $title,
                'content'   => $content,
                'date'      => $date,
                'cid'       => $cat
            );
            
            // insert
            if ($this->articlesModel->add($data)){
                System::Get('tpl')->assign('message','Article has been successfully added');
                System::Get('tpl')->draw('success');
            }  else {
                System::Get('tpl')->assign('message','Unexpectedly an error has been occured, the article hasn\'t been added');
                System::Get('tpl')->draw('error');
            }
        }  else {
                $cats= $this->articlesCatsModel->get();
                System::Get('tpl')->assign('cats',$cats);
                System::Get('tpl')->draw('addarticle');
        }
    }
    
    /**
     * Update article
     */
    public function update(){
        if (isset($_POST['updateArticle'])){
            // Confirming update
            // Variables
            $id     = 0;
            $id     = $_POST['id'];
            $title  = $_POST['title'];
            $content= $_POST['content'];
            $cat    = (int) $_POST['cat'];
            
            // Validation
            
            // Data array
            $data= array(
                'title'     => $title,
                'content'   => $content,
                'cid'       => $cat
            );
            
            // Update
            if ($this->articlesModel->update($id,$data)){
                System::Get('tpl')->assign('message','Article has been successfully updated');
                System::Get('tpl')->draw('success');
            }  else {
                System::Get('tpl')->assign('message','Unexpectedly an error has been occured, The article hasn\'t been updated');
                System::Get('tpl')->draw('error');
            }
        }  else {
            // View update page and the article to be updated
            $id= 0;
            if(isset($_GET['id'])&& (int)$_GET['id']>0){
                $id= $_GET['id'];
                $article=  $this->articlesModel->get_by_id($id);
                if(count($article)>0){
                    $cats= $this->articlesCatsModel->get();
                    System::Get('tpl')->assign('cats',$cats);
                    System::Get('tpl')->assign($article);
                    System::Get('tpl')->draw('updatearticle');
                } else {
                    System::Get('tpl')->assign('message','Unexpectedly an error has been occured, Article is not found');
                    System::Get('tpl')->draw('error');
                }
            }  else {
            System::Get('tpl')->assign('message','Invalid ID, Article is not found');
            System::Get('tpl')->draw('error');
            }
        }
    }
    
    /**
     * Delete one article of specific id
     */
    public function delete(){
        $id= 0;
        if (isset($_GET['id'])&& (int)$_GET['id']>0){
            $id= $_GET['id'];
            if ($this->articlesModel->delete($id)){
                System::Get('tpl')->assign('message','Article is successfully deleted');
                System::Get('tpl')->draw('success');
            }
            else {
                System::Get('tpl')->assign('message','Unexpectedly an error has been occured. Article has not been deleted');
                System::Get('tpl')->draw('error');
            }
        }  else {
            System::Get('tpl')->assign('message','Invalid ID, Article is not found');
            System::Get('tpl')->draw('error');
        }
    }
    
    /**
     * Show all the articles for the user in the blog.html and all the categories in sidebar nav
     */
    public function show(){
        $articles= $this->articlesModel->get();
        $cats= $this->articlesCatsModel->get();
        System::Get('tpl')->assign('articles',$articles);
        System::Get('tpl')->assign('cats',$cats);
        System::Get('tpl')->draw('blog');
    }
    
    /**
     * Show all the articles for the admin in the articles.html
     */
        public function showForAdmin(){
        $articles= $this->articlesModel->get();
        System::Get('tpl')->assign('articles',$articles);
        System::Get('tpl')->draw('articles');
    }
    
    /**
     * Show one article for the user in the blog-single.html and all the categories in sidebar nav
     */
    public function showArticle(){
        $id= 0;
        if (isset($_GET['id'])&& (int)$_GET['id']>0){
            $id= $_GET['id'];
            $article=  $this->articlesModel->get_by_id($id);
            if(count($article)>0){
                $cats= $this->articlesCatsModel->get();
                System::Get('tpl')->assign($article);
                System::Get('tpl')->assign('cats',$cats);
                System::Get('tpl')->draw('blog-single');
            }else
                System::Get('tpl')->draw('404');
        }else
            System::Get('tpl')->draw('404');
    }
    
    /**
     * Show the articles of specific category in blog.html and all the categories in sidebar nav
     */
    public function showCat(){
        $cid= 0;
        if (isset($_GET['cid'])&& (int) $_GET['cid']>0){
            $cid= $_GET['cid'];
            $articles= $this->articlesModel->get_by_cat($cid);
            if (count($articles)>0){
                $cats= $this->articlesCatsModel->get();
                System::Get('tpl')->assign('articles',$articles);
                System::Get('tpl')->assign('cats',$cats);
                System::Get('tpl')->draw('blog');
            }else
                System::Get ('tpl')->draw('404');
        }else
            System::Get ('tpl')->draw('404');
    }
    
    
    
    /******************* Categories *******************/
    
    public function addCat(){
        
    }
    
    public function updateCat(){
        
    }
    
    public function deleteCat(){
        
    }
    
    public function getCats(){
        
    }
}