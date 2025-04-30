<?php
function vue_win(){
  $html="";
  $html.='<img src="./img/icons/trophy.png" alt="won"><h1>You Won !</h1>';
  return $html;
}

function vue_loose(){
  $html="";
  $html.='<img src="./img/icons/loose.png" alt="lost"><h1>You Lost !</h1>';
  return $html;
}

?>