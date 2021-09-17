<?php

$stmt = $db->query(
  "SELECT language_id, learning_languages . name, SUM(learning_time) AS language_learning_time, color 
  FROM language_learning_records 
  JOIN learning_languages 
  ON language_id = learning_languages . id 
  GROUP BY language_id;"
);

$learning_languages = $stmt->fetchAll();


$stmt = $db->query(
  "SELECT SUM(learning_time) AS language_learning_time 
  FROM language_learning_records
  WHERE DATE(learning_date) = DATE(now());"
);

$language_today_total_time = $stmt->fetch(PDO::FETCH_COLUMN) ?: 0;


$stmt = $db->query(
  "SELECT SUM(learning_time) AS language_learning_time 
  FROM language_learning_records
  WHERE DATE_FORMAT(learning_date, '%Y%m') = DATE_FORMAT(now(), '%Y%m');"
);

$language_month_total_time = $stmt->fetch(PDO::FETCH_COLUMN) ?: 0;

$stmt = $db->query(
  "SELECT SUM(learning_time) AS language_learning_time 
  FROM language_learning_records;"
);

$language_total_time = $stmt->fetch(PDO::FETCH_COLUMN) ?: 0;

$stmt = $db->query(
  "SELECT learning_date, learning_time 
  FROM language_learning_records
  WHERE DATE_FORMAT(learning_date, '%Y%m') = DATE_FORMAT(now(), '%Y%m');"
);

$language_month_time = $stmt->fetchAll();