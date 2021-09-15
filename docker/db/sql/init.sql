SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- データベース: `quizy`
DROP SCHEMA IF EXISTS quizy;
CREATE SCHEMA quizy;
USE quizy;
--

-- --------------------------------------------------------

--
-- テーブルの構造 `tokyo`
--

DROP TABLE IF EXISTS questions;
CREATE TABLE questions (
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  name VARCHAR(140) NOT NULL
);

DROP TABLE IF EXISTS choices;
CREATE TABLE choices (
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  question_id INT NOT NULL,
  question_number INT NOT NULL,
  name VARCHAR(140) NOT NULL,
  valid BOOL NOT NULL
);

INSERT INTO questions (name) VALUES
('ガチで東京の人しか解けない！＃東京の難読地名クイズ'),
('ガチで広島の人しか解けない！＃広島の難読地名クイズ');

INSERT INTO choices (question_id, question_number, name, valid) VALUES
(1, 1, 'たかなわ', TRUE),
(1, 1, 'たかわ', FALSE),
(1, 1, 'こうわ', FALSE),
(1, 2, 'かめいど', TRUE),
(1, 2, 'かめと', FALSE),
(1, 2, 'かめど', FALSE),
(1, 3, 'こうじまち', TRUE),
(1, 3, 'かゆまち', FALSE),
(1, 3, 'おかとまち', FALSE),
(1, 4, 'おなりもん', TRUE),
(1, 4, 'おかどもん', FALSE),
(1, 4, 'ごせいもん', FALSE),
(1, 5, 'とどろき', TRUE),
(1, 5, 'たたら', FALSE),
(1, 5, 'たたりき', FALSE),
(1, 6, 'しゃくじい', TRUE),
(1, 6, 'せきこうい', FALSE),
(1, 6, 'いじい', FALSE),
(1, 7, 'ぞうしき', TRUE),
(1, 7, 'ざっしき', FALSE),
(1, 7, 'ざっしょく', FALSE),
(1, 8, 'おかちまち', TRUE),
(1, 8, 'みとちょう', FALSE),
(1, 8, 'ごしろちょう', FALSE),
(1, 9, 'ししぼね', TRUE),
(1, 9, 'しこね', FALSE),
(1, 9, 'ろっこつ', FALSE),
(1, 10, 'こぐれ', TRUE),
(1, 10, 'こばく', FALSE),
(1, 10, 'こしゃく', FALSE),
(2, 1, 'むかいなだ', TRUE),
(2, 1, 'むきひら', FALSE),
(2, 1, 'むこうひら', FALSE),
(2, 2, 'みつぎ', TRUE),
(2, 2, 'みよし', FALSE),
(2, 2, 'おしらべ', FALSE),
(2, 3, 'かなやま', TRUE),
(2, 3, 'ぎんざん', FALSE),
(2, 3, 'きやま', FALSE),
(2, 4, 'とよひ', TRUE),
(2, 4, 'とよか', FALSE),
(2, 4, 'としか', FALSE),
(2, 5, 'いしぐろ', TRUE),
(2, 5, 'いしあぜ', FALSE),
(2, 5, 'しゃくぜ', FALSE),
(2, 6, 'みよし', TRUE),
(2, 6, 'みつぎ', FALSE),
(2, 6, 'みかた', FALSE),
(2, 7, 'うずい', TRUE),
(2, 7, 'くもおり', FALSE),
(2, 7, 'もみち', FALSE),
(2, 8, 'すもも', TRUE),
(2, 8, 'でこぽん', FALSE),
(2, 8, 'ぽんかん', FALSE),
(2, 9, 'おおちごとうげ', TRUE),
(2, 9, 'おうちごとうげ', FALSE),
(2, 9, 'おおちごえとうげ', FALSE),
(2, 10, 'よおろほよばら', TRUE),
(2, 10, 'ていぼよはら', FALSE),
(2, 10, 'てっぽよばら', FALSE);

