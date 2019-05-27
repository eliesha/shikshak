<?php 
    
    require $_SERVER['DOCUMENT_ROOT'].'/config/init.php';
    
    require CLASS_PATH.'news.php';
    
    $news = new News();
    
    $id = $_POST['id'];

    $newsList = $news->getNewsById($id); 
    
    $story = html_entity_decode($newsList[0]->story);
    
    $image = "http://oxygenaltitude.com/assets/img/logo.png";
    
    $doc_body ='<h1>'.$newsList[0]->title.'</h1><br><p>'.$story.'<p>';
 
 ?>
 
<?php
  if(isset($_POST['submit_docs'])){
          header("Content-Type: application/vnd.msword");
          header("Expires: 0");//no-cache
          header("Cache-Control: must-revalidate, post-check=0, pre-check=0");//no-cache
          header("content-disposition: attachment;filename=shikshak.doc");
  }          
          echo "<html>";
          echo "$doc_body";
          echo "</html>";       
?> 
<?php require 'inc/footer.php' ?>
<?php require 'inc/fotjava.php' ?>