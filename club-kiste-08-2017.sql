-- phpMyAdmin SQL Dump
-- version 4.7.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Erstellungszeit: 10. Aug 2017 um 22:41
-- Server-Version: 5.7.19-0ubuntu0.16.04.1
-- PHP-Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `club-kiste`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `creator_id` int(11) DEFAULT NULL,
  `series_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `doorsopen` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `event`
--

INSERT INTO `event` (`id`, `creator_id`, `series_id`, `created_at`, `updated_at`, `doorsopen`) VALUES
(1, 1, 1, '2016-01-26 18:00:00', '2016-01-26 18:00:00', '2016-01-26 18:00:00'),
(2, 1, 1, '2016-02-09 18:00:00', '2016-02-09 18:00:00', '2016-02-09 18:00:00'),
(3, 1, 1, '2016-02-23 18:00:00', '2016-02-23 18:00:00', '2016-02-23 18:00:00'),
(4, 1, 2, '2016-04-28 18:00:00', '2016-04-28 18:00:00', '2016-04-28 18:00:00');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `eventseries`
--

CREATE TABLE `eventseries` (
  `id` int(11) NOT NULL,
  `creator_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `eventseries`
--

INSERT INTO `eventseries` (`id`, `creator_id`, `created_at`, `updated_at`, `title`, `content`, `image`) VALUES
(1, 1, '2017-08-10 22:27:07', '2017-08-10 22:27:28', 'Sprechcafé', 'Sprache - Spaß - Begegnung\r\n\r\nInterkultureller Austausch mit Deutsch-Muttersprachlern in familienfreundlicher Atmosphäre. Unabhängig vom Sprachniveau kann bei heißem Kaffee und Tee über alles gesprochen werden was bewegt.\r\n\r\nLanguage - Fun - Encounter\r\n\r\nFeel welcome for an intercultural exchange with native German speakers in a family friendly atmosphere. Talking about everything with a hot cup of coffee and tea, independent of language levels.\r\n\r\nLangue - Plaisir - Recontre\r\n\r\nVouse êtes invité pour un échange interculturel avec des Allemands natifs dans une ambiance familiale. On peut parler overtement de toutes les affaires en dégustant un café ou un thé chaud, indépendamment du niveau de lange.', '9706c93f3936906ecef6994a52c016b1.jpeg'),
(2, 1, '2017-08-10 22:29:19', '2017-08-10 22:29:33', 'Spielekiste', 'An alle Spiele(Abend)Liebhaber, Profi-Zocker und Abwechslung-Suchenden!\r\n\r\nDie Kiste veranstaltet für Euch an jedem Do, ab 18 Uhr ihren ersten großen Spieleabend! Es wird gerufen zu Dart, Kicker, Poker, Skat, Wizard, Activity, Siedler, Risiko, Bohnanza u.v.m. Und das mit Euren Freunden in geselligem Beisammensein und unverwechselbar \"kistiger\" Atmosphäre. Also kommt vorbei und bringt mit, auf wen oder was auch immer Ihr Lust habt!\r\n\r\nWir freuen Uns auf Euch,\r\n\r\nEuer Kiste- Team.', '08e7e1dd14af2e7bf1db50ac1c1a0a04.jpeg');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `film`
--

CREATE TABLE `film` (
  `id` int(11) NOT NULL,
  `creator_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tmdbId` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `doorsopen` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `film`
--

INSERT INTO `film` (`id`, `creator_id`, `created_at`, `updated_at`, `title`, `content`, `image`, `tmdbId`, `doorsopen`) VALUES
(2, 1, '2015-07-08 20:30:00', '2015-07-08 20:30:00', 'Birdman oder (Die unverhoffte Macht der Ahnungslosigkeit)', 'Die Karriere von Riggan Thomson ist quasi am Ende. Früher verkörperte er den ikonischen Superhelden Birdman, doch heutzutage gehört er zu den ausgedienten Stars einer vergangenen Ära. In seiner Verzweiflung versucht er, ein Broadway-Stück auf die Beine zu stellen, um sich und allen anderen zu beweisen, dass er noch nicht zum alten Eisen gehört. Als die Premiere näher rückt, fällt sein Hauptdarsteller aus, der daraufhin durch den neurotischen Mike Shiner ersetzt werden muss. Zusätzlich muss Riggan sich mit seiner Freundin Laura herumschlagen, der er eine Nebenrolle verschafft hat. Unterstützt wird er immerhin von seiner Tochter Sam, die gerade einen Drogenentzug hinter sich gebracht hat, und von seiner Ex-Frau Sylvia, die öfter herein schneit und alles am Laufen halten will.', '/nRIo8mW103lbHHwG6MtpL8YOCBb.jpg', '194662', '2015-07-08 20:30:00'),
(3, 1, '2015-10-14 20:00:00', '2015-10-14 20:00:00', 'Pulp Fiction', 'Vincent Vega und Jules Winnfield holen für ihren Boss Marsellus Wallace eine schwarze Aktentasche aus einer Wohnung ab. Drei Jungs, die ihnen dabei im Weg stehen, lassen ihr Leben. Die Killer machen sich mit einem vierten Jungen als Geisel auf den Weg ins Hauptquartier. Doch als das Auto über eine Straßenerhöhung schaukelt, erschießt Vincent aus Versehen die Geisel. Um den blutverspritzten Wagen zu reinigen, machen die beiden einen Abstecher zu Jules\'s Freund Jimmie, wo auf Befehl vom Boss ein Spezialist für schwierige Aufträge zu ihnen stößt: The Wolf...', '/g71Sk6usK5jgkqgJl3ZQ48G7djY.jpg', '680', '2015-10-14 20:00:00'),
(4, 1, '2015-10-22 20:00:00', '2015-10-22 20:00:00', 'The Imitation Game - Ein streng geheimes Leben', 'Nach einer unglücklichen Jugend beginnt der brillante Mathematiker Alan Turing während seines Studiums an der Cambridge-Universität, sein volles Potenzial zu entfalten. Schnell gehört er zu den führenden Denkern des Landes, besonders was seine Theorien zu Rechenmaschinen angeht. Genau diese machen auch den britischen Geheimdienst auf das Genie aufmerksam. Nach einem Test, den Alan mit Leichtigkeit besteht, wird er Mitglied einer geheimen Gruppe. Ihre Aufgabe: im Zweiten Weltkrieg die Kommunikation der Deutschen entschlüsseln. Mit Hilfe von Joan Clarke und Hugh Alexander und unter der Leitung von Stewart Menzies sowie Commander Denniston versucht Alan, den Verschlüsselungsapparat Enigma zu knacken, um an kriegsentscheidende Informationen zu kommen...', '/roJSN83jJe0s5lEjLVruRSJ0E60.jpg', '205596', '2015-10-22 20:00:00'),
(5, 1, '2015-10-22 22:00:00', '2015-10-22 22:00:00', 'Kingsman: The Secret Service', 'Harry Hart ist ein britischer Geheimagent der alten Schule – cool, charmant und abgebrüht. Er arbeitet für einen der geheimsten Nachrichtendienste überhaupt: die Kingsmen. die Agenten, die sich selbst als moderne Ritter verstehen, sind ständig auf der Suche nach neuen Rekruten. Harry wird auf den Straßenjungen Gary aufmerksam, der, wie er findet, einiges an Potenzial zeigt. allerdings liebäugelt dieser mit der Welt jenseits des Gesetzes und kennt keine Disziplin. Dennoch bewahrt ihn Harry vor dem Gefängnis und schleust ihn in das Rekrutierungsprogramm der Kingsmen ein. Dies ist das wohl härteste seiner Art und an vielen Stellen wirklich lebensgefährlich. Zu allem Überfluss bahnt sich noch während der Ausbildung eine weltweite Bedrohung an. Ein unglaublich gut organisiertes Verbrechersyndikat erscheint auf dem Plan und bedroht den internationalen Frieden und die Sicherheit. Gary muss sich nun beeilen, die Torturen der Ausbildung überstehen und, am aller Wichtigsten, erwachsen werden.', '/uJWr3V8KMh1oFLfzFPZYKYIw61V.jpg', '207703', '2015-10-22 22:00:00'),
(6, 1, '2015-11-18 20:00:00', '2015-11-18 20:00:00', 'Mad Max: Fury Road', 'An den äußersten Grenzen unseres Planeten, in einer trüben Wüstenlandschaft, wo die Menschheit verkommen und fast jeder bereit ist, für das Überlebensnotwendige bis an die Grenzen zu gehen, leben zwei Rebellen. Sie sind auf der Flucht und könnten der Schlüssel dazu sein, die zerfallene Ordnung wiederaufzurichten. Auf der einen Seite ist da Max ein Mann der Tat und weniger Worte, der nach dem Verlust seiner Frau und seines Kindes Seelenfrieden sucht. Auf der anderen Seite ist da Furiosa  eine Frau der Tat, die glaubt, dass sie ihr Überleben sichern kann, wenn sie es aus der Wüste bis in die Heimat ihrer Kindheit schafft. Als Max gerade beschlossen hat, dass er alleine eigentlich besser dran ist, trifft er auf eine Gruppe in einem Kampfwagen, an dessen Steuer sich die elitäre Herrscherin befindet. Die Rebellen sind dem Warlord Immortan Joe entkommen, der ihnen nun nachstellt.', '/i68IvNkUvqaKPY0UbadXcQ23aik.jpg', '76341', '2015-11-18 20:00:00'),
(7, 1, '2015-12-04 20:00:00', '2015-12-04 20:00:00', 'Die Feuerzangenbowle', 'Als in einer angeheiterten Herrenrunde Anekdoten über die Schulzeit ausgetauscht werden, muss der junge und erfolgreiche Schriftsteller Dr. Johannes Pfeiffer feststellen, dass er während seines Privatunterrichts nie in den Genuss der köstlichen Pennälerstreiche seiner Freunde kam. Kurzerhand entschließt er sich, die nie gemachten Erlebnisse nachzuholen und tarnt sich als Gymnasiast. In der Schule treibt er mit seinen geistreichen Witzen die Lehrer auf die Palme und erhält die Gelegenheit einer kleinen Liebesaffäre.', '/hpnng8FEULQpDmkqQf196jkmNFp.jpg', '878', '2015-12-04 20:00:00'),
(8, 1, '2015-12-16 20:00:00', '2015-12-16 20:00:00', 'Tatsächlich... Liebe', 'In der Vorweihnachtszeit schlagen die Gefühlswellen hoch. So verspürt etwa Englands Premier eine unziemliche Zuneigung zu einer Mitarbeiterin, zwei Pornodarsteller müssen ihre Schüchternheit überwinden und ein verstörter Schriftsteller findet erst in der Ferne sein Glück. Eine junge Werberin trifft in Beziehungsdingen immer die falschen Entscheidungen, während eine frischgebackene Ehefrau die Liebe des besten Freundes ihres Mannes entfacht und ein trauriger Witwer die Liebe erst (wieder) lernen muss.', '/peXMnd3hGtSwaVbXsiVBu3nQOKZ.jpg', '508', '2015-12-16 20:00:00'),
(9, 1, '2016-01-13 20:00:00', '2016-01-13 20:00:00', 'Victoria', 'Mitten in der Nacht lernt die junge Spanierin Victoria vor einem Club in Berlin die vier Freunde Sonne, Boxer, Blinker und Fuß kennen. Schnell kommen sich die Frau aus Madrid und der draufgängerische Sonne näher. Doch für die Jungs fängt die Nacht gerade erst an. Um eine Schuld bei Gangster Andi begleichen zu können, sehen sich die Vier gezwungen, eine krumme Sache durchzuziehen. Als einer aus der Gruppe schließlich unerwartet ausfällt, soll ausgerechnet Victoria als Fahrerin bei der heiklen Unternehmung einspringen. Was für sie zunächst wie ein spannendes Abenteurer klingt, entwickelt sich rasch zum Albtraum, denn der geplante Coup geht gründlich schief und das junge Glück von Victoria und Sonne wird knallhart auf die Probe gestellt...', '/3rJ4MgRQYMkkI1jYVh5P20FAZxH.jpg', '320007', '2016-01-13 20:00:00'),
(10, 1, '2016-01-27 20:00:00', '2016-01-27 20:00:00', 'Heil', 'Nach einem Schlag auf den Kopf plappert der auf Lesereise befindliche afrodeutsche Autor Sebastian wie ein Papagei die Parolen rechter Schläger nach, deren Anführer Sven ihn in Talkshows vorführt. Sebastians so hochschwangere wie eifersüchtige Freundin Nina verfolgt ihn mit dem suspendierten Dorfpolizisten Sascha. Aber Politiker Sven hat größenwahnsinnige Pläne, um eine Angebetete mit Taten zu beeindrucken: Er will in Polen einfallen.', '/1O9xlv2Q8Tht7DIMKKLHH0o5QtF.jpg', '346239', '2016-01-27 20:00:00'),
(11, 1, '2017-04-26 20:00:00', '2017-04-26 20:00:00', 'Doctor Strange', 'Doctor Stephen Strange ist ein arroganter, aber auch unglaublich talentierter Neurochirurg. Nach einem schweren Autounfall kann er seiner Tätigkeit trotz mehrerer Operationen und Therapien nicht mehr nachgehen. In seiner Verzweifelung wendet er sich schließlich von der Schulmedizin ab und reist nach Tibet, wo er bei der Einsiedlerin The Ancient One und ihrer Glaubensgemeinschaft lernt, sein verletztes Ego hinten anzustellen und in die Geheimnisse einer verborgenen mystischen Welt voller alternativer Dimensionen eingeführt wird. So entwickelt sich Doctor Strange nach und nach zu einem der mächtigsten Magier der Welt. Doch schon bald muss er seine neugewonnenen mystischen Kräfte nutzen, um die Welt vor einer Bedrohung aus einer anderen Dimension zu beschützen.', '/xxpEI8ni1SANIPKV3MA0BXwZcxo.jpg', '284052', '2017-04-26 20:00:00');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `partner`
--

CREATE TABLE `partner` (
  `id` int(11) NOT NULL,
  `creator_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `partner`
--

INSERT INTO `partner` (`id`, `creator_id`, `created_at`, `updated_at`, `title`, `content`, `image`, `link`) VALUES
(1, 1, '2014-08-10 21:04:53', '2014-08-10 21:04:53', 'INTRO', 'Musik und so. Pop, Kultur und gute Noten.', '71690e0c0fb894f1fee1ca2a079f91e7.gif', 'http://www.intro.de/'),
(2, 1, '2014-08-10 21:15:04', '2014-08-10 21:15:04', 'URBANITE', 'Das Magdeburger Stadtmagazin.', 'be0368dd9b717e70f7573d5dd1cac860.gif', 'http://www.urbanite.net/'),
(3, 1, '2014-08-10 21:15:37', '2014-08-10 21:15:37', 'DATEs', 'Das Magdeburger Stadtmagazin.', 'f1bac40112fc42ffb06d49cf1ede129d.gif', 'http://www.dates-md.de/'),
(4, 1, '2014-08-10 21:16:13', '2014-08-10 21:16:13', 'StuRa', 'Der Studierendenrat der Otto-von-Guericke-Universität Magdeburg.', '61a1218b64bbb21a434be66b6d53205c.png', 'http://www.stura-md.de/'),
(5, 1, '2014-08-10 21:17:18', '2014-08-10 21:17:18', 'FMMD', 'Der Förderverein der Medizinstudenten von Magdeburg', '7118d86dac49ef56e44e56ed1320d84b.jpeg', 'http://www.fmmd.de/'),
(6, 1, '2014-08-10 21:17:40', '2014-08-10 21:17:40', 'Med MD', 'Das Magdeburger Medizinstudentennetzwerk.', '0df088345e2da7ce219b766379390ee3.jpeg', 'http://www.medmd.de'),
(7, 1, '2014-08-10 21:18:15', '2014-08-10 21:18:15', 'FaRaMED', 'Der Fachschaftsrat der Magdeburger Medizinstudenten (auf Facebook).', '73ee97ef58c5aca5a66d0e27b22452cb.png', 'https://www.facebook.com/pages/FaRa-Medizin-Magdeburg/209332325823887');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `party`
--

CREATE TABLE `party` (
  `id` int(11) NOT NULL,
  `creator_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `doorsopen` datetime NOT NULL,
  `admission` double DEFAULT NULL,
  `boxoffice` tinyint(1) DEFAULT NULL,
  `preselling` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `party`
--

INSERT INTO `party` (`id`, `creator_id`, `created_at`, `updated_at`, `title`, `content`, `image`, `doorsopen`, `admission`, `boxoffice`, `preselling`) VALUES
(1, 1, '2015-07-04 22:00:00', '2015-07-04 22:00:00', 'Kiste Eröffnung', 'Am 04.07. ist die langersehnte Kisteeröffnung. Es gibt keinen Vorverkauf. Kommt einfach ab 22:00 Uhr vorbei, der Eintritt beträgt 1 € und dafür bekommt ihr sogar 3 Freigetränke. Euer Kiste-Team :-)', '057255c6b14f758edb855e54defc1a64.jpeg', '2015-07-04 22:00:00', 1, 1, 0),
(3, 1, '2015-10-09 20:30:00', '2015-10-09 20:30:00', 'Semesteranfangsparty mit The Anatomics', 'Wintersemester 2015..\r\ndraußen wird es kalt und ungemütlich..\r\ndie Semesterferien sind zu Ende..\r\n... Aber keine Sorge, die Feierei geht erst richtig los!\r\n\r\nAm 9.10 knallen bei uns die Korken, fliegen die Beine im Tanz und dröhnen die Ohren. Feiert mit uns in unserer neu gebauten Kiste, lasst uns das Semester standesgemäß einläuten!\r\n\r\nDie Anatomics bringen ab 20:30 die Luft zum Vibrieren und ihr habt die Gelegenheit, euch noch mal ordentlich von Professor Schwegler zu Verabschieden.\r\n\r\nIm Anschluss bringt Dj Maximus Green die Tanzfläche zum Beben und den Blutdruck nach oben!\r\n\r\nKiste 2.0\r\nWe are ready\r\nWe are thrilled\r\nFeiert mit uns.\r\n\r\nSemesteranfangsparty\r\nThe Anatomics - Schweglers Abschied\r\nEinlass zum Konzert - 20:30\r\nEinlass zur Party - 22:00\r\nEintritt - 1 Euro\r\n\r\nIf you are a racist, fascist or an asshole - stay at home.', 'a31dcacd73e1b2c782f0cea48b76e922.jpeg', '2015-10-09 20:30:00', 1, 1, 0),
(4, 1, '2015-11-11 19:11:00', '2015-11-11 19:11:00', 'Dschungel-Kiste - Fasching 2015', 'Welcome to the jungle\r\nLiebste Partypeople - es ist so weit.\r\nKistefasching 2015 steht vor der Tür.\r\nDie Junglekiste öffnet am 11.11 ihre Tore zu Film, Theater und Tanz. \r\nTaucht ein in die grüne Hölle, trinkt euer Bier umgeben von Urwaldvieh und Pyramiden und erlebt die Jagd auf den Grünen Diamanten live!\r\nFeiert mit uns, angefeuert von den Kiste resident Djs - Bendit und Flexe Pi!\r\nKartenverkauf Theater und Film - 4.11 11:11 und 5.11 17:17 \r\nEinlass Theater und Film - 19:11\r\nEinlass Party - 22:11\r\nEintrittspreis - 3,33 Euro\r\nEinlass nur in Verkleidung!\r\nKeine Abendkasse bei Theater und Film.\r\nReguläre Abendkasse zur Party.\r\nWir freuen uns auf euch.\r\nKiste loves you.', '9937ed1711d968a1b7377803f10ef10e.jpeg', '2015-11-11 19:11:00', 3.33, 1, 1),
(5, 1, '2015-12-15 22:00:00', '2015-12-15 22:00:00', 'Jahresabschlussparty 2015 - Kiste presents VeridisQuo', 'Kiste presents VeridisQuo by tasos dot k  \r\nUnd wieder einmal nähert sich ein Jahr seinem Ende.. gute Momente, schlechte Momente, gründe zum Feiern... und gründe zum Feiern. Lasst es uns ordentlich verabschieden! Noch ein mal tanzen, feiern und vergessen, alles geben und die Nacht zum Tag machen.\r\n\r\n Lasst euch vom brachial dj taso dot k und seinem Projekt VeridisQuo berauschen und 2015 endlich das zukommen, was es verdient.  \r\n\r\n15.12. 22:00 Eintritt 1 Euro Nur Abendkasse  VeridisQuo hosted by taso dot k www.facebook.com/VeridisQuoproject-938597409567940 www.mixcloud.com/tasodotK  \"What is VeridisQuo?\"  \"Veridis quo is a bit of clever wordplay on the Latin phrase \"Quo vadis?\", literally, \"Whither goest thou?\" or \"Where are you going?\".  The greater meaning of the phrase is, \"To what purpose?\" or, \"To what end are you doing this?\" There is a Christian usage of this phrase, asked to Jesus.  In Interstella 5555: The 5tory of the 5ecret 5tar 5ystem the phrase \"Veridis Quo\" appears as the title of a book during the track of the same name. The \"Quo vadis?\" meaning would seem to correspond very well to this. This also can mean \"Very Disco\", which can also be switched to \"discovery\".  \"Very Disco\", switching and joining words, results \"Discovery\", the name of the album.  \r\n\r\nMusically speaking,VeridisQuo is about fun,dance and a mixture of electronic disco,crossover house,eclectic pop,indie dance,rock remixes,funk,80s/90s re-edited tracks and sometimes,anything goes.The key point is to have a good time,it\'s just a party after all!!!\"  \"letz fetz\"', '8b3e96686fc2916bdcb2dda9faf65764.jpeg', '2015-12-15 22:00:00', 1, 1, 0),
(6, 1, '2016-01-08 22:00:00', '2016-01-08 22:00:00', 'Happy New Year Party - 2k16', 'Liebe Leute,\r\n\r\nlasst euch sagen, es hat 2k16 geschlagen!\r\nGemeinsam heute feiern wir, zu Cuba Libre, Sekt und Bier.\r\nFür Tanzerei ist wohl gesorgt, Musik von Taso ausgeborgt.\r\nLasset uns die Beine schwingen, unsre Freud\' zum Himmel singen.\r\nFara, Kiste, einerlei. Tanzen, singen, Feierei.\r\n\r\nTanzen, Tanzen, Tanzen, schrein!\r\nTanzen, Tanzen, glücklich sein!\r\n\r\nHappy New Year Party - 2k16\r\nKiste feat Fara\r\nMusic by Tasy dot K\r\n8.1. - 22:00', 'dbf3488e9106f0477ff17b8faafcd40d.jpeg', '2016-01-08 22:00:00', 1, 1, 0),
(8, 1, '2016-02-12 21:00:00', '2016-02-12 21:00:00', 'Semesterabschlussparty', 'Man hört in der Stadt ein Geflüster.\r\nEin Schiff habe am Strand geankert.\r\nWundersame Gestalten befinden sich darauf, manisch tanzend und singend.\r\nSeit Monaten schon ward dieses Schiff nicht mehr gesehen, niemand wagte noch zu hoffen, dass es wiederkehren würde.\r\nDoch hier ist es und bringt den Hauch der Ferne. Es bringt Waren aus einem Land, wo Becks und Pfeffi fließen, wo Saumseligkeit erstrebenswert und Delir keine Schande ist.\r\nWenn ihr bereit seid für ein Abenteuer, junger Mensch, so kommet am Freitag an Bord und stecht mit uns in See!\r\nIhr werdet es nicht bereuen, Abenteurer, denn dieses Schiff heißt Kiste... \r\nund das Ziel Semesterferien.\r\n\r\nWir freuen uns auf dich, Abenteurer.', 'a14172310837b83bf4af61d37c484083.jpeg', '2016-02-12 21:00:00', 1, 1, 0),
(9, 1, '2016-04-30 22:00:00', '2016-04-30 22:00:00', 'Good old 90s Party', 'Hit me baby one more time! It\'s time for 90s, baby! Spice girls, Micky Mouse club, drunk David Hasselhoff, everybody got some memories of his glorious 90s Adventures! Lets revive the past and celebrate the most hated and most missed time of our lifes. Lets fetz!  Einlass nur in Verkleidung, ob sexy Britney Spears, spiciges girl oder Hinterstraßen Boy, ihr seid uns alle willkommen!  30.04.2016 22:00 Eintritt: 1 Euro  Dj Marius and Fipsi on the decks.', '1044a77f6bef7b2a2f765994a5007af8.jpeg', '2016-04-30 22:00:00', 1, 1, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `creator_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subtitle` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `creator_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subtitle` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `alcoholic` tinyint(1) DEFAULT NULL,
  `source` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `product`
--

INSERT INTO `product` (`id`, `creator_id`, `created_at`, `updated_at`, `title`, `content`, `image`, `subtitle`, `link`, `alcoholic`, `source`) VALUES
(1, 1, '2014-08-10 21:26:12', '2014-08-10 21:26:12', 'Krombacher Alkoholfrei', 'Die Krombacher Brauerei Bernhard Schadeberg GmbH & Co. KG ist eine Brauerei aus der Stadt Kreuztal (Nordrhein-Westfalen) und liegt im Stadtteil Krombach. Mit einem Gesamtausstoß von 6,429 Mio. hl ist sie eine der größten deutschen Privatbrauereien. Die Sorte Krombacher Pils ist mit 4,4 Mio. hl die meistgekaufte Marke Pilsner Bier Deutschlands; das alkoholfreie Bier ist Marktführer in dieser Sparte.', '235e2635e8e1b57e4e789dc46a2221f6.jpeg', 'Alkohol ist entbehrlich, Geschmack nicht', 'https://www.krombacher.de/UnsereBiere/UnsereAlkoholfreien/PilsAlkoholfrei/', 0, 'Wikipedia'),
(2, 1, '2014-08-10 21:26:57', '2014-08-10 21:26:57', 'BIONADE', 'Bionade ist ein alkoholfreies Erfrischungsgetränk der Bionade GmbH aus Ostheim vor der Rhön in Unterfranken, die zur Radeberger Gruppe gehört. Es ist in den Geschmackssorten Holunder, Litschi, Kräuter, Ingwer-Orange mit zugesetztem Calcium und Magnesium im Handel. Des Weiteren gibt es die limitierten Varianten Himbeer-Pflaume und Streuobst. Bereits eingestellt wurden die Sorten Cola, Quitte und Aktiv. Bei uns bieten wir die Sorten Holunder, Litschi und Kräuter an.', 'b66f7b805d205ecb6abab48e0d8ae35d.png', 'Anders erfrischt besser', 'http://www.bionade.de/', 0, 'Wikipedia'),
(3, 1, '2014-08-10 21:30:55', '2014-08-10 21:30:55', 'CLUB-MATE', 'Club-Mate ist ein koffeinhaltiges, alkoholfreies Erfrischungsgetränk der Brauerei Loscher aus Münchsteinach. Club-Mate basiert auf der Pflanze Mate und hat einen Koffeingehalt von 20 Milligramm pro 100 Milliliter. Der Zuckergehalt beträgt 5 g/100 ml und der Kaloriengehalt 20,5 kcal/100 ml und liegt damit deutlich unter dem der meisten Colas und Energy-Drinks.', '0a2cf0432a1290e5f9429e9d6f2920d3.jpeg', 'Man gewöhnt sich dran', 'http://www.clubmate.de/', 0, 'Wikipedia'),
(4, 1, '2014-08-10 21:31:30', '2014-08-10 21:31:30', 'fritz-kola', 'fritz-kola ist eine eingetragene Getränkemarke für Cola und Limonaden, die seit 2003 anfangs von der fritz-kola Hampl und Wiegert GbR, später von der fritz-kola GmbH entwickelt und vertrieben wurden und werden. Der Firmensitz befindet sich in Hamburg. Die Getränke werden in Lohnbrauereien produziert und hauptsächlich in der Szene-Gastronomie angeboten.', '15c34b68c8947fedb2f2a3e7325d1af3.png', 'vielviel koffein', 'http://www.fritz-kola.de/', 0, 'Wikipedia'),
(5, 1, '2014-08-10 21:32:22', '2014-08-10 21:32:22', 'Krombacher Radler', 'Die Krombacher Brauerei Bernhard Schadeberg GmbH & Co. KG ist eine Brauerei aus der Stadt Kreuztal (Nordrhein-Westfalen) und liegt im Stadtteil Krombach. Mit einem Gesamtausstoß von 6,429 Mio. hl ist sie eine der größten deutschen Privatbrauereien. Die Sorte Krombacher Pils ist mit 4,4 Mio. hl die meistgekaufte Marke Pilsner Bier Deutschlands; das alkoholfreie Bier ist Marktführer in dieser Sparte.', 'd14c213039127a730e268931c7567196.jpeg', 'Mehr als die Summe seiner Teile', 'https://www.krombacher.de/UnsereBiere/KrombacherRadler/', 1, 'Wikipedia'),
(6, 1, '2014-08-10 21:33:03', '2014-08-10 21:33:13', 'Schöfferhofer Weizen-Mix', 'Du hast Lust auf eine fruchtig-herbe Erfrischung? Dann hol dir mit Schöfferhofer Grapefruit das Prickeln des Sommers! Die perfekte Kombination aus sanft prickelndem Schöfferhofer Weizen und dem Geschmack fruchtig-herber Grapefruit ist unsere beliebteste Sorte und verspricht einfach Sommer-Feeling und gute Laune pur. Mit nur 2,5% vol. Alkohol schmeckt Schöfferhofer Grapefruit am besten eisgekühlt und direkt aus der Flasche.', '59e40313aad7aa92420c1e51fd1cee8d.png', 'Erlebe die fruchtig-herbe Frische: Mit Schöfferhofer Grapefruit', 'http://www.schoefferhofer-weizen-mix.de/', 1, 'schoefferhofer-weizen-mix.de'),
(7, 1, '2014-08-10 21:33:47', '2014-08-10 21:33:47', 'Jever', 'Jever ist eine nach ihrer Herkunftsstadt Jever benannte deutsche Biermarke und wird seit 1848 vom Friesischen Brauhaus zu Jever gebraut.', 'd6d5da62a55071b93e51be0fb64015f3.jpeg', 'Wie das Land, so das Jever', 'http://www.jever.de/', 1, 'Wikipedia'),
(8, 1, '2014-08-10 21:34:22', '2014-08-10 21:34:22', 'Becks', 'Die Brauerei Beck GmbH & Co. KG stellt in Bremen unter dem Markennamen Beck’s Biere und Biermischgetränke für den deutschen und internationalen Markt her. 2002 wurde sie von der belgischen Interbrew-Gruppe aufgekauft. 2004 entstand aus den Unternehmen Interbrew und Companhia de Bebidas das Américas (AmBev) mit InBev der größte Brauereikonzern der Welt.', '2114e1bc284a098d415a1a8e840d8f2e.jpeg', 'Folge deinem inneren Kompass', 'https://www.becks.de/', 1, 'Wikipedia'),
(9, 1, '2014-08-10 21:34:57', '2014-08-10 21:34:57', 'Paulaner Hefe-Weißbier Naturtrüb', 'Die Mönche des Paulanerordens brauten seit dem Jahr 1634 ihr Bier für den Eigenbedarf. Das Paulanerbier, das an den Festtagen des Ordensgründers auch öffentlich ausgeschenkt werden durfte, war ein Bockbier, das bald lokale Berühmtheit erlangte. Das Rezept dieses Starkbiers soll auf den Braumeister Valentin Stephan Still zurückgehen, der 1774 als „Bruder Barnabas“ vom Paulanerkloster Amberg nach München wechselte. Nach diesem ist auch die Figur des heutigen Nockherberg-„Predigers“ benannt.', '6aed910ac38e8abc81517ad8bbad0024.jpeg', 'Die Ikone unter den Hefe-Weißbieren', 'https://www.paulaner.de/', 1, 'Wikipedia');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`) VALUES
(1, 'Admin', 'admin', 'kontakt@club-kiste.de', 'kontakt@club-kiste.de', 1, NULL, '$2y$13$r8BYqOlG9sHTKO0n0sDEEuNd69XYDTRWQLnpdkVeiiwOKr.DvlSMm', '2017-08-10 21:03:46', NULL, NULL, 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_3BAE0AA761220EA6` (`creator_id`),
  ADD KEY `IDX_3BAE0AA75278319C` (`series_id`);

--
-- Indizes für die Tabelle `eventseries`
--
ALTER TABLE `eventseries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_F1335C9D61220EA6` (`creator_id`);

--
-- Indizes für die Tabelle `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_8244BE2261220EA6` (`creator_id`);

--
-- Indizes für die Tabelle `partner`
--
ALTER TABLE `partner`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_312B3E1661220EA6` (`creator_id`);

--
-- Indizes für die Tabelle `party`
--
ALTER TABLE `party`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_89954EE061220EA6` (`creator_id`);

--
-- Indizes für die Tabelle `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_5A8A6C8D61220EA6` (`creator_id`);

--
-- Indizes für die Tabelle `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D34A04AD61220EA6` (`creator_id`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D64992FC23A8` (`username_canonical`),
  ADD UNIQUE KEY `UNIQ_8D93D649A0D96FBF` (`email_canonical`),
  ADD UNIQUE KEY `UNIQ_8D93D649C05FB297` (`confirmation_token`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT für Tabelle `eventseries`
--
ALTER TABLE `eventseries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT für Tabelle `film`
--
ALTER TABLE `film`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT für Tabelle `partner`
--
ALTER TABLE `partner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT für Tabelle `party`
--
ALTER TABLE `party`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT für Tabelle `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT für Tabelle `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `FK_3BAE0AA75278319C` FOREIGN KEY (`series_id`) REFERENCES `eventseries` (`id`),
  ADD CONSTRAINT `FK_3BAE0AA761220EA6` FOREIGN KEY (`creator_id`) REFERENCES `user` (`id`);

--
-- Constraints der Tabelle `eventseries`
--
ALTER TABLE `eventseries`
  ADD CONSTRAINT `FK_F1335C9D61220EA6` FOREIGN KEY (`creator_id`) REFERENCES `user` (`id`);

--
-- Constraints der Tabelle `film`
--
ALTER TABLE `film`
  ADD CONSTRAINT `FK_8244BE2261220EA6` FOREIGN KEY (`creator_id`) REFERENCES `user` (`id`);

--
-- Constraints der Tabelle `partner`
--
ALTER TABLE `partner`
  ADD CONSTRAINT `FK_312B3E1661220EA6` FOREIGN KEY (`creator_id`) REFERENCES `user` (`id`);

--
-- Constraints der Tabelle `party`
--
ALTER TABLE `party`
  ADD CONSTRAINT `FK_89954EE061220EA6` FOREIGN KEY (`creator_id`) REFERENCES `user` (`id`);

--
-- Constraints der Tabelle `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `FK_5A8A6C8D61220EA6` FOREIGN KEY (`creator_id`) REFERENCES `user` (`id`);

--
-- Constraints der Tabelle `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_D34A04AD61220EA6` FOREIGN KEY (`creator_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
