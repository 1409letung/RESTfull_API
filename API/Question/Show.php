<?php
   header('Access-Control-Allow-Origin:*');
   header('Content-Type: application/json');

   include_once '../../config/db.php';
   include_once '../../models/Question.php';

   $db   = new db();
   $conn = $db->connect();
   $question = new Question($conn);
   $question->id_cauhoi = isset($_GET['id']) ? $_GET['id'] : die();
   $question->Show();
   $Question_Item = array(
            'id_cauhoi' => $question->id_cauhoi,
            'title' => $question->title,
            'cau_a' => $question->cau_a,
            'cau_b' => $question->cau_b,
            'cau_c' => $question->cau_c,
            'cau_d' => $question->cau_d,
            'caudung' => $question->caudung
        );
   print_r(json_encode($Question_Item));
   
?>