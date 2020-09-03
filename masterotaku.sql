-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 28, 2019 at 12:11 PM
-- Server version: 5.6.44-cll-lve
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `masterotaku`
--

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tags` varchar(256) COLLATE utf8_bin NOT NULL,
  `views` bigint(20) NOT NULL,
  `thumbnail` varchar(256) COLLATE utf8_bin NOT NULL,
  `blogContent` mediumtext COLLATE utf8_bin NOT NULL,
  `images` varchar(256) COLLATE utf8_bin NOT NULL,
  `title` varchar(256) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `user_id`, `tags`, `views`, `thumbnail`, `blogContent`, `images`, `title`) VALUES
(1, 2, '#hellsing%20ultimate#fullmetal%20alchemist%20brotherhood#clannad#attack%20on%20titan#death%20note#steins;gate#code%20geass#gintama#fate/zero#sora%20yori%20mo%20tooi%20basho', 11, '1', 'We%20all%20love%20anime,%20and%20what%20better%20way%20to%20start%20the%20website%20with%20top%2010%20anime%20of%20all%20time.%20This%20list%20neither%20contains%20any%20movies%20nor%20it%20is%20ranked.\r\nAll%20following%20anime%20are%20best%20of%20best%20in%20my%20opinion,%20if%20your%20anime%20show%20doesn\'t%20made%20the%20cut%20then%20either%20I%20haven\'t%20watched%20that%20anime%20or%20our%20opinion%20differs%20as%20it%20should%20be.\r\n\r\n@header(Hellsing%20Ultimate)\r\n@image(1)\r\nYou%20know%20the%20list%20is%20ought%20to%20be%20awesome%20when%20the%20tenth%20position%20is%20taken%20by%20Hellsing%20Ultimate.The%20animation%20of%20Hellsing%20can%20be%20loved%20or%20hated.%20%20Antagonist%20of%20this%20show%20Major%20sure%20keeps%20things%20interesting,%20without%20a%20doubt%20he%20is%20one%20of%20the%20best%20antagonist%20of%20anime%20history.%20Its%20one%20of%20those%20show%20where%20Dub%20is%20just%20that%20good.%20If%20you%20liked%20this%20show%20don\'t%20forget%20to%20check%20Drifters%20as%20both%20has%20same%20art%20and%20creator.\r\n@header(Fullmetal%20Alchemist%20:%20Brotherhood)\r\n@image(2)\r\nThere%20are%20so%20many%20studios%20which%20empathize%20viewer%20prospective%20but%20fails%20to%20adapt%20a%20great%20manga%20to%20an%20anime%20*cough*Studio%20Pierrot\'s%20Tokyo%20Ghoul*cough*.%20Bones%20stayed%20true%20to%20manga%20and%20with%20their%20knowledge%20of%20making%20action%20scene%20they%20created%20an%20anime%20to%20reckon%20with.%20Thou%20shall%20not%20forget%20about%20the%20plot%20of%20this%20epic%20anime.\r\n@header(Clannad)\r\n@image(3)\r\nEnough%20with%20the%20blood%20shed%20and%20action%20lets%20head%20toward%20some%20slice%20of%20life.%20So%20Clannad%20series%20is%20approx%2050%20episodes%20broke%20up%20in%20two%20seasons.%20This%20show%20wants%20to%20tug%20your%20heartstrings%20and%20sure%20it%20does%20as%20the%20story%20progress%20to%20season%202.%20Some%20may%20be%20coming%20here%20after%20watching%20season%201,%20please%20do%20all%20of%20us%20a%20favor%20just%20watch%20season%202.%20You%20might%20be%20saying%20it\'s%20a%20another%20moe%20anime%20or%20it\'s%20so%20so%20or%20may%20be%20it\'s%20nothing%20great,%20just%20watch%20season%202.%20Personally%20I%20won\'t%20recommend%20to%20watch%20this%20show%20if%20you%20are%20not%20ready%20to%20cry%20your%20heart%20out.\r\n@header(Attack%20on%20Titan)\r\n@image(4)\r\nDid%20I%20say%20enough%20with%20blood%20shed,%20my%20bad.%20Thriller%20check,%20Mystery%20check,%20badass%20side-charterer%20check,%20action%20check.%20If%20you%20have%20never%20heard%20about%20this%20anime%20then%20you%20might%20be%20living%20under%20the%20rock.%20As%20the%20coming%20to%203rd%20Season%20ends%20its%20the%20perfect%20time%20to%20start%20watching%20or%20re%20watching%20this%20show.\r\n@header(Death%20Note)\r\n@image(5)\r\nAnother%20famous%20anime%20out%20their.%20This%20show%20is%20a%20masterpiece%20and%20the%20first%20half%20of%20this%20anime%20is%20beyond%20masterpiece.%20Sure%20the%20plot%20gets%20dull%20compared%20to%20first%20half.Plot%20is%20heavily%20focused%20on%20rivalry%20between%20L%20and%20Kira.%20This%20show%20only%20lack%209%20MAL%20rating%20is%20because%20of%20the%20last%20arc%20of%20this%20show.%20In%20my%20opinion%20this%20show%20would%20have%20been%20a%20perfect%2010%20if%20it%20stopped%20after%2024%20episode.\r\n@header(Steins;Gate)\r\n@image(6)\r\nFor%20the%20most%20part%20Steins;Gate%20is%20a%20surprisingly%20well%20thought%20out%20series%20that%20applies%20the%20notion%20of%20cause%20and%20effect%20in%20a%20reasonably%20intelligent%20manner%20and%20the%20plot%20follows%20a%20logical%20way.%20%20For%20those%20of%20you%20who%20haven\'t%20had%20the%20privilege%20of%20watching%20this%20show%20yet,%20the%20show%20rotate%20around%20our%20main%20character%20Okabe%20and%20at%20the%20beginning%20it%20might%20look%20like%20an%20another%20slice%20of%20life%20anime%20which%20is%20messing%20around%20with%20time%20but%20after%20certain%20point%20it%20gets%20real%20heavy%20real%20soon.%20\r\n@header(Code%20Geass)\r\n@image(7)\r\nWell%20some%20may%20say%20it\'s%20a%20cheap%20RIP%20off%20of%20Death%20Note%20or%20some%20may%20idealize%20this%20as%20the%20best%20anime%20of%20all%20time,%20but%20one%20thing%20is%20for%20sure%20it%20has%20the%20best%20ending%20of%20all%20anime.%20It\'s%20too%20hard%20to%20comment%20on%20Code%20Geass%20without%20spoiling%20anything.%20It%20provide%20experience%20that%20is%20trilling%20and%20intensified.\r\n@header(Gintama)\r\n@image(8)\r\nDebuting%20in%202006%20and%20still%20airing,%20Gintama%20is%20best%20comedy%20show%20coming%20from%20a%20person%20who%20to%20watch%20comedy%20shows.%20From%20gag%20comedy%20to%20blue%20comedy%20it%20beats%20all.%20As%20shounen%20prospective%20Gintama%20bears%20all%20stereotypical%20hallmarks%20of%20that%20genre%20of%20anime.%20Not%20only%20it%20portray%20creative%20ideas%20but%20also%20parody%20other%20shounen%20tales%20to%20real%20live%20events.%20Either%20it%20will%20make%20you%20laugh%20out%20loud%20or%20make%20you%20cry,%20either%20make%20care%20for%20character%20or%20make%20you%20hyped%20for%20upcoming%20battle.%20Sure%20their%20are%20anime%20which%20can%20rival%20Gintama%20but%20that\'s%20a%20tale%20for%20another%20day.%20\r\n@header(Fate/Zero)\r\n@image(9)\r\nIf%20their%20is%20any%20top%2010%20anime%20battles%20out%20their%20this%20show%20hold%20the%20beer.%20From%20one%20of%20best%20anime%20fights%20to%20one%20of%20the%20best%20written,%20it%20gets%20as%20good%20as%20possible.%20All%20the%20characters%20enough%20spot%20light%20for%20their%20and%20plot%20%20development.%20Prequel%20to%20Fate/Stay%20Night%20and%20Fate/Stay%20Night%20Unlimited%20Blade%20Works%20this%20show%20is%20a%20must%20watch.%20Bit%20of%20Advise:%20Don\'t%20watch%20Fate/Stay%20Night%20just%20jump%20to%20Fate/Zero%20then%20Fate/Stay%20Night%20Unlimited%20Blade%20Works%20(REMASTER%20of%20Fate/Stay%20Night).\r\n@header(Sora%20yori%20mo%20Tooi%20Basho)\r\n@image(10)\r\nSure%20your%20hipster%20otaku%20may%20say%20DBZ%20is%20the%20best%20or%20Naruto%20is%20the%20best%20anime%20in%20existence.%20You%20may%20be%20thinking%20what%20anime%20is%20this,%20never%20heard%20of%20this%20anime,%20shouldn\'t%20Boku%20no%20hero%20academia%20(by%20the%20way%20bnha%20is%20a%20great%20anime%20and%20you%20should%20watch%20that%20too)%20be%20in%20this%20list%20but%20think%20again%20Sora%20yori%20mo%20Tooi%20Basho%20is%20a%20show%20which%20touch%20your%20heart%20in%20weird%20way.%20At%20first%20glance%20it%20might%20look%20like%20a%20another%20moe%20anime%20but%20as%20you%20progress%20through%20the%20story-line%20you%20realize%20something,%20something%20more.%20In%20simple%20word%20it%20is%20the%20best%20adventure%20anime.', '[\"2\",\"3\",\"4\",\"5\",\"6\",\"7\",\"8\",\"9\",\"10\",\"11\"]', 'Top%2010%20anime%20of%20all%20time%20(SPOILER%20FREE)');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `files` ADD FULLTEXT KEY `tags` (`tags`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
