SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- データベース: `webapp`
DROP SCHEMA IF EXISTS webapp;
CREATE SCHEMA webapp;
USE webapp;
--

-- --------------------------------------------------------

DROP TABLE IF EXISTS learning_record;
CREATE TABLE learning_record (
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  learning_date DATETIME NOT NULL,
  learning_time INT NOT NULL
);

INSERT INTO learning_record (learning_date, learning_time) VALUES
('2021-07-05', 12),
('2021-08-24', 2),
('2021-09-30', 7),
('2020-10-27', 5);

-- 学習コンテンツ自体のテーブル

DROP TABLE IF EXISTS learning_contents;
CREATE TABLE learning_contents (
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  name VARCHAR(140) NOT NULL,
  color VARCHAR(20) NOT NULL
);

DROP TABLE IF EXISTS content_learning_records;
CREATE TABLE content_learning_records (
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  user_id INT NOT NULL,
  content_id INT NOT NULL,
  learning_date DATETIME NOT NULL,
  learning_time INT NOT NULL
);


DROP TABLE IF EXISTS learning_languages;
CREATE TABLE learning_languages (
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  name VARCHAR(140) NOT NULL,
  color VARCHAR(20) NOT NULL
);

DROP TABLE IF EXISTS language_learning_records;
CREATE TABLE language_learning_records (
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  user_id INT NOT NULL,
  language_id INT NOT NULL,
  learning_date DATETIME NOT NULL,
  learning_time INT NOT NULL
);

INSERT INTO learning_languages (name, color) VALUES
('JavaScript', '#2A54EF'),
('CSS', '#1B71BD'),
('PHP', '#21BDDE'),
('HTML', '#3DCEFD'),
('Laravel', '#B39EF3'),
('SQL', '#6D47EC'),
('SHELL', '#4A18EF'),
('情報システム基礎知識(その他)', '#3107BF');

INSERT INTO language_learning_records (user_id, language_id, learning_date, learning_time) VALUES
(1, 1, '2021-09-17', 4),
(1, 2, '2021-09-24', 8),
(1, 3, '2021-09-08', 9),
(1, 4, '2021-03-16', 4),
(1, 4, '2021-05-09', 6),
(1, 5, '2020-09-17', 2),
(1, 6, '2021-09-17', 4),
(1, 7, '2021-09-16', 4),
(1, 8, '2021-11-19', 5);

INSERT INTO learning_contents (name, color) VALUES
('N予備校', '#2A54EF'),
('ドットインストール', '#1B71BD'),
('課題', '#21BDDE');


INSERT INTO content_learning_records (user_id, content_id, learning_date, learning_time) VALUES
(1, 1, '2021-09-17', 4),
(1, 2, '2021-03-24', 8),
(1, 3, '2021-09-08', 9),
(1, 1, '2021-09-30', 3),
(1, 2, '2021-07-08', 5),
(1, 3, '2020-10-08', 4);


-- INSERT INTO learning_record SET learning_date='2021-09-16', learning_time=8;

-- SELECT * FROM learning_record ORDER BY learning_date;

-- 今日の学習時間を取得
-- SELECT learning_time FROM learning_record WHERE DATE(learning_date) = DATE(now()) ORDER BY learning_date;

-- 今月を取得
-- SELECT learning_date, SUM(learning_time) AS month_total_time FROM learning_record WHERE DATE_FORMAT(learning_date, '%Y%m') = DATE_FORMAT(now(), '%Y%m') GROUP BY learning_date ORDER BY learning_date;
-- SELECT SUM(learning_time) AS month_total_time FROM learning_record WHERE DATE_FORMAT(learning_date, '%Y%m') = DATE_FORMAT(now(), '%Y%m');

-- 全ての学習時間を取得
-- SELECT SUM(learning_time) FROM learning_record;

-- SELECT * FROM learning_record ORDER BY learning_date;

-- SELECT SUM(language_learning_records . learning_time), SUM(content_learning_records . learning_time) FROM language_learning_records JOIN content_learning_records ON language_learning_records . user_id = content_learning_records . user_id;

-- SELECT SUM(learning_time), SUM(learning_time) FROM language_learning_records JOIN content_learning_records ON language_learning_records . user_id = content_learning_records . user_id;


-- SELECT SUM(language_learning_records . learning_time) FROM language_learning_records JOIN content_learning_records ON language_learning_records . user_id = content_learning_records . user_id;

-- select sum(content_learning_records . learning_time) from content_learning_records;



-- SELECT learning_languages . name, SUM(learning_time) AS language_learning_time, color FROM language_learning_records JOIN learning_languages ON language_id = learning_languages . id GROUP BY language_id;

-- SELECT * FROM language_learning_records JOIN content_learning_records ON language_learning_records . user_id = content_learning_records . user_id;


SELECT learning_contents . name, SUM(learning_time) AS content_learning_time, color FROM content_learning_records JOIN learning_contents ON content_id = learning_contents . id GROUP BY content_id;