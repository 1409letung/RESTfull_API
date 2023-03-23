<?php
   header('Access-Control-Allow-Origin:*');
   header('Content-Type: application/json');

   include_once '../../config/db.php';
   include_once '../../models/Question.php';

   $db   = new db();
   $conn = $db->connect();
   $question = new Question($conn);
   $read = $question->Read();

   $num = $read->rowCount();
   if($num > 0)
   {
      $QuestionArray = [];
      $QuestionArray['Question'] = [];
      while($row = $read->fetch(PDO::FETCH_ASSOC))
      {
        extract($row);

        $Question_Item = array(
            'id_cauhoi' => $id_cauhoi,
            'title' => $title,
            'cau_a' => $cau_a,
            'cau_b' => $cau_b,
            'cau_c' => $cau_c,
            'cau_d' => $cau_d,
            'caudung' => $caudung
        );

        array_push($QuestionArray['Question'], $Question_Item);
      }
      echo json_encode($QuestionArray); 
   }
   else
   {

   }
?>