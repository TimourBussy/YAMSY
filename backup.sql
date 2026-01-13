-- MySQL dump 10.13  Distrib 8.0.44, for Linux (x86_64)
--
-- Host: localhost    Database: yamsy_db
-- ------------------------------------------------------
-- Server version	8.0.44

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `multiplayer_games`
--

DROP TABLE IF EXISTS `multiplayer_games`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `multiplayer_games` (
  `id` int NOT NULL AUTO_INCREMENT,
  `game_date` timestamp NOT NULL,
  `status` enum('in_progress','completed','abandoned') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'in_progress',
  `started_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `multiplayer_games`
--

LOCK TABLES `multiplayer_games` WRITE;
/*!40000 ALTER TABLE `multiplayer_games` DISABLE KEYS */;
/*!40000 ALTER TABLE `multiplayer_games` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `multiplayer_participants`
--

DROP TABLE IF EXISTS `multiplayer_participants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `multiplayer_participants` (
  `id` int NOT NULL AUTO_INCREMENT,
  `game_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `player_name` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `score` int NOT NULL DEFAULT '0',
  `rank` int DEFAULT NULL,
  `is_winner` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `multiplayer_participants_multiplayer_games_FK` (`game_id`),
  KEY `multiplayer_participants_users_FK` (`user_id`),
  CONSTRAINT `multiplayer_participants_multiplayer_games_FK` FOREIGN KEY (`game_id`) REFERENCES `multiplayer_games` (`id`),
  CONSTRAINT `multiplayer_participants_users_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `multiplayer_participants`
--

LOCK TABLES `multiplayer_participants` WRITE;
/*!40000 ALTER TABLE `multiplayer_participants` DISABLE KEYS */;
/*!40000 ALTER TABLE `multiplayer_participants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solo_games`
--

DROP TABLE IF EXISTS `solo_games`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `solo_games` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `score` int NOT NULL DEFAULT '0',
  `game_date` timestamp NOT NULL,
  `duration` int NOT NULL DEFAULT '0',
  `started_at` timestamp NOT NULL,
  PRIMARY KEY (`id`),
  KEY `solo_games_users_FK` (`user_id`),
  CONSTRAINT `solo_games_users_FK` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solo_games`
--

LOCK TABLES `solo_games` WRITE;
/*!40000 ALTER TABLE `solo_games` DISABLE KEYS */;
/*!40000 ALTER TABLE `solo_games` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `top_5_multiplayer_winners`
--

DROP TABLE IF EXISTS `top_5_multiplayer_winners`;
/*!50001 DROP VIEW IF EXISTS `top_5_multiplayer_winners`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `top_5_multiplayer_winners` AS SELECT 
 1 AS `username`,
 1 AS `victories_count`*/;
SET character_set_client = @saved_cs_client;

--
-- Temporary view structure for view `top_5_solo_scores`
--

DROP TABLE IF EXISTS `top_5_solo_scores`;
/*!50001 DROP VIEW IF EXISTS `top_5_solo_scores`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `top_5_solo_scores` AS SELECT 
 1 AS `username`,
 1 AS `score`,
 1 AS `game_date`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_uk_username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `top_5_multiplayer_winners`
--

/*!50001 DROP VIEW IF EXISTS `top_5_multiplayer_winners`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`yamsy_user`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `top_5_multiplayer_winners` AS select coalesce(`u`.`username`,`mp`.`player_name`) AS `username`,count(0) AS `victories_count` from (`multiplayer_participants` `mp` left join `users` `u` on((`mp`.`user_id` = `u`.`id`))) where (`mp`.`is_winner` = 1) group by coalesce(`u`.`id`,`mp`.`player_name`),coalesce(`u`.`username`,`mp`.`player_name`) order by `victories_count` desc limit 5 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `top_5_solo_scores`
--

/*!50001 DROP VIEW IF EXISTS `top_5_solo_scores`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`yamsy_user`@`%` SQL SECURITY DEFINER */
/*!50001 VIEW `top_5_solo_scores` AS select `u`.`username` AS `username`,`s`.`score` AS `score`,`s`.`game_date` AS `game_date` from (`solo_games` `s` join `users` `u` on((`s`.`user_id` = `u`.`id`))) order by `s`.`score` desc limit 5 */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-12-19 19:50:12
