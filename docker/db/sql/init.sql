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
DROP TABLE IF EXISTS quiz;
CREATE TABLE quiz (
  id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
  quiz_title_number int NOT NULL,
  question_number int NOT NULL,
  question varchar(30) NOT NULL,
  choice_1 varchar(30) NOT NULL,
  choice_2 varchar(30) NOT NULL,
  choice_3 varchar(30) NOT NULL
);

--
-- テーブルのデータのダンプ `tokyo`
--

-- quiz被り、
-- 問題文と選択肢のテーブルを分けた
-- 選択肢が３つ以外だとこの設計は耐えられない
-- question＿numberと紐づいた

INSERT INTO quiz (quiz_title_number, question_number, question, choice_1, choice_2, choice_3) VALUES
(1, 1, '高輪',   'たかなわ',   'たかわ',     'こうわ'),
(1, 2, '亀戸',   'かめいど',   'かめと',     'かめど'),
(1, 3, '麹町',   'こうじまち',  'おかとまち', 'かゆまち'),
(1, 4, '御成門', 'おなりもん',  'おかどもん', 'ごせいもん'),
(1, 5, '等々力', 'とどろき',    'たたら',    'たたりき'),
(1, 6, '石神井', 'しゃくじい',  'せきこうい', 'いじい'),
(1, 7, '雑色',   'ぞうしき',   'ざっしき',   'ざっしょく'),
(1, 8, '御徒町', 'おかちまち',  'みとちょう', 'ごしろちょう'),
(1, 9, '鹿骨',   'ししぼね',    'しこね',    'ろっこつ'),
(1, 10, '小榑',  'こぐれ',     'こばく',     'こしゃく'),
(2, 1, '向洋', 'むかいなだ', 'むきひら', 'むこうひら'),
(2, 2, '御調', 'みつぎ', 'みよし', 'おしらべ'),
(2, 3, '銀山', 'かなやま', 'ぎんざん', 'きやま'),
(2, 4, '十四日', 'とよひ', 'とよか', 'としか'),
(2, 5, '石畦', 'いしぐろ', 'いしあぜ', 'しゃくぜ'),
(2, 6, '三次', 'みよし', 'みつぎ', 'みかた'),
(2, 7, '雲通', 'うずい', 'くもおり', 'もみち'),
(2, 8, '李', 'すもも', 'でこぽん', 'ぽんかん'),
(2, 9, '大内越峠', 'おおちごとうげ', 'おうちごとうげ', 'おおちごえとうげ'),
(2, 10, '丁保余原', 'よおろほよばら', 'ていぼよはら', 'てっぽよばら');
COMMIT;