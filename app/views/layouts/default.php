<head>
  <meta charset="UTF-8">
  <?=$this->getMeta();?>

</head>
<body>
  Это шаблон
 <?=$content?>  
  <?php
    $logs = \R::getDatabaseAdapter()
      ->getDatabase()
      ->getLogger();

    debug( $logs->grep('SELECT') );
  ?>
</body>
</html>
