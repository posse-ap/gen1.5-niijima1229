<?php

$stmt = $db->query(
  "SELECT content_id, learning_contents . name, SUM(learning_time) AS content_learning_time, color 
  FROM content_learning_records 
  JOIN learning_contents 
  ON content_id = learning_contents . id 
  GROUP BY content_id;"
);

$learning_contents = $stmt->fetchAll();


$stmt = $db->query(
  "SELECT SUM(learning_time) AS content_learning_time 
  FROM content_learning_records
  WHERE DATE(learning_date) = DATE(now());"
);

$content_today_total_time = $stmt->fetch(PDO::FETCH_COLUMN) ?: 0;


$stmt = $db->query(
  "SELECT SUM(learning_time) AS content_learning_time 
  FROM content_learning_records
  WHERE DATE_FORMAT(learning_date, '%Y%m') = DATE_FORMAT(now(), '%Y%m');"
);

$content_month_total_time = $stmt->fetch(PDO::FETCH_COLUMN) ?: 0;


$stmt = $db->query(
  "SELECT SUM(learning_time) AS content_learning_time 
  FROM content_learning_records;"
);

$content_total_time = $stmt->fetch(PDO::FETCH_COLUMN) ?: 0;

// $stmt = $db->prepare(
//   "SELECT learning_date, learning_time 
//   FROM content_learning_records
//   WHERE DATE(learning_date) = DATE_FORMAT(now(), '%Y%m%?');"
// );

// $stmt->execute([$i]);

// $content_month_time = $stmt->fetch() ?: 0;
