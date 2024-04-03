<?php 
   
   require 'conexao.php';
   $qr_consulta_toppicos = $pdo->prepare("SELECT * FROM topicos"); 
   $qr_consulta_toppicos->execute();  
   $topicos = $qr_consulta_toppicos->fetchAll(PDO::FETCH_ASSOC);
   





?> 