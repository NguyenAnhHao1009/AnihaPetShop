-- MySQL Workbench dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: aniha_store_database
-- ------------------------------------------------------
-- Server version	8.0.36

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `category_id` int NOT NULL AUTO_INCREMENT,
  `category_name` varchar(50) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Chó'),(2,'Mèo'),(3,'Chuột'),(4,'Thức ăn'),(5,'Phụ kiện'),(6,'Thỏ'),(7,'Khác');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_details` (
  `order_detail_id` int NOT NULL AUTO_INCREMENT,
  `order_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  PRIMARY KEY (`order_detail_id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=213 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_details`
--

LOCK TABLES `order_details` WRITE;
/*!40000 ALTER TABLE `order_details` DISABLE KEYS */;
INSERT INTO `order_details` VALUES (152,28,143,3),(161,32,91,1),(162,32,99,1),(184,43,177,10),(186,44,135,8),(187,44,126,1),(191,45,168,5),(192,45,108,9),(193,45,197,1),(196,47,180,1),(197,47,83,3),(205,50,201,1),(206,50,184,1),(210,53,162,1),(211,53,203,1);
/*!40000 ALTER TABLE `order_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `order_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int DEFAULT '-1',
  PRIMARY KEY (`order_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (28,1,'2024-04-12 19:27:58',1),(32,38,'2024-04-13 04:58:48',1),(43,1,'2024-04-13 15:43:40',-1),(44,40,'2024-04-14 02:10:34',1),(45,40,'2024-04-14 02:12:22',0),(47,40,'2024-04-14 02:17:41',-2),(50,41,'2024-04-14 14:37:21',-2),(53,41,'2024-04-14 15:08:54',0);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `product_id` int NOT NULL AUTO_INCREMENT,
  `product_name` varchar(100) NOT NULL,
  `description` varchar(2000) DEFAULT NULL,
  `stock_quantity` int NOT NULL,
  `category_id` int NOT NULL,
  `unit_price` int NOT NULL,
  `product_avatar` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`product_id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=205 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (80,'Cún đáng yêu','Bé cún dễ thương, hiền lành, luôn ở bên cạnh bạn quấn quýt',35,1,20,'dog (1).jpg'),(83,'Thức ăn cho thú cưng','Cung cấp đầy đủ dinh dưỡng và năng lượng cho thú cưng của bạn',36,4,17,'1a6e503856c89da8e138c06554c838a3.jpg'),(84,'Mèo châu Úc','Một chú mèo đến từ austraylia sẽ rất là thú vị',5,2,12,'cat.jpg'),(85,'Lều cho mèo','Một chiếc lều giúp giữ ấm cho thú cưng trong mùa đông và mùa xuân',105,5,22,'21c1e98a0242213824fe2e5d0e226b04.jpg'),(87,'Chuột Hamster Cute','Bé chuột này biết xiếc và làm nhiều trò tiêu khiển để bạn vui',10,3,22,'hams.jpg'),(91,'Dụng cụ tắm cho chó','Dụng cụ này sẽ giúp cho chú chó của bạn luôn sạch sẽ và có một bộ lông mềm mượt và óng ả',121,5,13,'1b13fd5b950d3a0cb21d9126ce3f3cce.jpg'),(92,'Thỏ trăng Hà Lan','Chú thỏ nhảy nhót tung tăng cả ngày sẽ làm cho bạn cảm thấy vui vẻ, yêu đời và mang đến cho bạn nhiều năng lượng tích cực',12,6,30,'0b73a9b5978b3bc02b7429079a3d6a67.jpg'),(93,'Định vị thú cưng','Định vị này giúp tránh khỏi trường hợp thú cưng đi lạc, ta có thể dễ dàng tìm thấy chúng dựa vào GPS',44,7,22,'0cf9927103d81681ea8ce8d804de1636.jpg'),(94,'Thỏ Vườn','Chú thỏ được nuôi thả rong trong vườn có cơ bắp săn chắc và khỏe mạnh, ít bị bệnh và có sức đề kháng cao',12,6,32,'1b3393c9785dd7d65564657aca670b2f.jpg'),(95,'MeoMeo Fody','Cung cấp dinh dưỡng, năng lượng đầy đủ cho chú chuột của bạn, giúp chuột tăng sức đề kháng và tránh được các bệnh về đường tiêu hóa',100,4,12,'1b6617cf347d13acab4a1815223f1225.jpg'),(96,'Mèo Xám ','Mèo mang lại may mắn cho bạn, vui vẻ, hiền lành sẽ là một sự lựa chọn tuyệt vời khi bạn muốn có một người bạn thú cưng',33,2,29,'_d1e91c45-97fa-435c-978b-746712828289.jfif'),(98,'Hộp đựng thức ăn','Hộp đựng thức ăn giúp cho thú cưng của bạn gọn gàn sạch sẽ hơn trong lúc tận hưởng buổi ăn',10,5,22,'2ae86005c3efa3558ad0b0862167031f.jpg'),(99,'Thức ăn cho Mèo CRD','Thức ăn chuyên dành cho các bé mèo lười ăn, bảo đảm chúng sẽ thích thú và không bao giờ bỏ bữa',43,4,10,'crd.jpg'),(100,'Bình nước cho chuột','Bình nước giúp chuột có thể tự động uống nước mỗi khi cần, tiết kiệm thời gian và công sức cho chủ nuôi',55,5,8,'3dba5a88ca665e396a634f02aff53f7f.jpg'),(101,'Thức ăn cho cún','Các bé cún nhà bạn sẽ thích mê với món ăn này, vì nó chứa đầy đủ dưỡng chất và hương vị đặc biệt',90,4,22,'3de79f165bce962b0b45622267081169.jpg'),(102,'Thỏ đốm vàng','Bé thỏ còn bé xíu dễ thương dữ lắm bạn sẽ không hối hận khi sở hữu được bé thỏ này. Rất đáng yêu nhá',0,6,31,'3eb3c7e5a40896eaf2816115921225f8.jpg'),(103,'Dây cho cún','Trang bị cần thiết mỗi khi bạn muốn dẫn bé cún ra đường và đảm bảo rằng bé không chạy đi xa khỏi tầm kiểm soát của bạn',17,5,13,'3eb9f75731fa68301ffee16ec293e402.jpg'),(104,'Chuột trăng hiền hậu','Bé chuột cực đáng yêu luôn mọi người ơi, nhanh tay mua các bé về để cưng chiều cả ngày mà không biết chán',32,3,20,'3f427f84dd4ad6bab0140917d3d2f742.jpg'),(105,'Chuột bút chì','Nhìn thôi đã thấy được sự đáng yêu và ngộ nghĩnh của bé chuột cầm bút chì này rồi, nhanh tay mua đi nhé, số lượng có hạn',3,3,29,'3fae66cb5f433d025def6a280b91bb19.jpg'),(106,'Chuột áo choàng','Bé chuột mà lúc nào cũng thích được choàng một chiếc áo để giữ ấm cơ thể. Nhìn thấy cưng dữ lắm luôn',30,3,31,'5aee2ede5153180f17584db186470c60.jpg'),(107,'Thỏ tuyết mắt đen','Bé thỏ nhìn xinh xĩu mọi người ơi, nhanh tay sở hữu bé này không kẻo hết hàng bạn nhé',5,6,22,'6af454495747ec49d05c1492d36ac2a8.jpg'),(108,'Thỏ nâu Hàn','Một chiếc thỏ đến từ sứ sở kim chi với bộ lông mềm mịn và óng ả sẽ là một sự lựa chọn thú vị cho bạn',10,6,33,'6f210086cfc57753c1b87d3a80e72a0d (1).jpg'),(109,'Đĩa thức ăn','Dụng cụ chứa đồ ăn cho thú cưng nhỏ gọn tiện lợi có thể mang theo đến mọi nơi',30,5,12,'7adade97b95e81f4551655feafdf4801.jpg'),(110,'Cún xù xinh xắn','Về độ đáng yêu thì chắc chắn rằng không bé cún nào qua được em này, nhanh chóng sở hữu bé để không bỏ lỡ',12,1,30,'7f0f5ea2c81ceddb9678fc6f8489f91b.jpg'),(111,'Hamster Vàng','Bé chuột vàng này thuộc giống cực hiếm nên số lượng có hạn, các bạn nhanh tay để mang bé về nhà nhé',3,1,22,'8e615a237329dc34c9f4057901101459.jpg'),(112,'Chuột đeo dây','Bé chuột hamster đeo vòng quanh cổ sẽ là một sự lựa chọn tuyệt vời. Nhanh chóng mang bé này về nhé',32,3,22,'9f8ffadc6a65014614ce03cad04f09fe.jpg'),(113,'Hộp chứa thức ăn','Hộp chứa thức ăn trong suốt giúp bạn dễ dàng nhìn thấy và việc chứa thức ăn trở nên gọn gàn hơn',13,5,22,'17a6712307dd0c09b49929e2f52b16f8.jpg'),(114,'Xù Trắng Lông Dày','Một bé cún lông xù trắng tươi đến từ Việt Nam sẽ rất đáng để bạn sở hữu',32,1,22,'21f930c6377d855e5516f0d7074dfec0.jpg'),(115,'Máy thức ăn','Chiếc máy giúp tự động cho thú cưng của bạn thức ăn và nước uống, tự động hóa quy trình giúp tiết kiệm thời gian',33,5,12,'23e9d30dacaee6a033508fa93d71c4be.jpg'),(116,'Nhà cho mèo','Chiếc chuồn đáng yêu này sẽ làm bé mèo nhà bạn thích thú và vui vẻ mỗi ngày',29,5,22,'28f08803811ca9742f3c2163fbf404e9.jpg'),(117,'Chuột cài nơ','Một chiếc chuột xám cài nơ hồng có thu hút được bạn không? Hãy nhanh chóng đưa bé này về nhà bạn nhé',3,3,20,'31a1e991462500a8f0037c824ef9137a.jpg'),(118,'Vòng cổ cho cún','Một chiếc vòng cổ đặc biệt sẽ là điểm nhấn gây thu hút mọi ánh nhìn cho bé cún nhà bạn',32,5,22,'32dfd9328edb13717f5a7c39882b72ab.jpg'),(119,'Đồ chơi cho cún','Chắc hẳn rằng các bé cún cưng nhà bạn sẽ thích thú với các món đồ chơi đến từ cửa hàng AnihaStore',13,5,21,'32e40617e17b81859d2865893de0b191.jpg'),(120,'Thỏ Akako','Loài thỏ có sức khỏe vượt trội nhất và có tốc độ siêu nhanh sẽ là một sự lựa chọn hoàn hảo, bạn hãy sở hữu nó nhanh tay nhé',22,6,12,'48a6f26d1d99f052bb17235d5bcbf11e.jpg'),(121,'Nôi cho chuột','Một chiếc nôi cho bé chuột nhà bạn sẽ là một chổ ngủ lý tưởng mỗi khi chú chuột muốn nghỉ ngơi',12,5,11,'50d951f5b4dd492668663bc8ee0c62c7.jpg'),(122,'Áo cho cún','Một cặp áo giữ ấm cho cún sẽ là một món đồ hữu ích giúp bé cún nhà bạn mạnh khỏe và xinh xăn trong mùa đông lạnh giá',32,5,17,'51f41bbb174aa2c103862ea086c90637.jpg'),(123,'Thỏ nhỏ nhắn','Một chú thỏ siêu đáng yêu với bộ lông màu vàng trắng và thân hình tròn trịa, nhanh tay bấm nút mua nào',22,6,34,'056bd63530b7123fd0bee29cfc1a5819.jpg'),(124,'Mèo thuần Việt','Giống mèo phổ biến và được nuôi rộng rãi ở Việt Nam, với thân hình nhỏ nhắn và ngoan hiền đặc biệt rất nghe lời chủ nhân',33,2,22,'56ce5cf1623e3ee5d53ca85d156fcc98.jpg'),(125,'Thỏ Kurana','Giống thỏ phổ biến mang trong mình sức đề kháng cao, có thể vượt qua những cơn lạnh giá của mùa đông',31,6,22,'60bae9b0c022a851e8434ad4b7fcae58.jpg'),(126,'Dây cho mèo','Dây giúp giữ thú cưng không đi lung tung và quậy phá',15,5,9,'60d9fa5c07e5c85441950a3b93b403b2.jpg'),(127,'Thỏ baby','Bé thỏ nhỏ xíu chỉ to bằng bàn tay giúp bạn dễ dàng nâng niu và chăm sóc',21,6,22,'66b897928b03565cb4e3a5bb6e382de5.jpg'),(128,'Thức ăn đa dụng','Thức ăn dành cho tất cả các loại thú cưng từ mèo, chó đến thỏ, chuột đều có thể dùng được',47,4,15,'86a66c30b3728b15cf992cd68dd83b5d.jpg'),(129,'Cún nâu baby','Một em bé cún với bộ lông màu nâu hạt dẽ sẽ làm cho bạn thích mê và muốn mua ngay về nhà để nuôi',22,1,33,'176af1689980f9695d7f4b7b42007e30.jpg'),(130,'Nôi trái chuối','Một chiếc nôi hình trái chuối siêu đáng yêu, ngộ nghĩnh dành cho các bé chuột hamster',33,5,12,'376c985763f11177793484d2b5555676.jpg'),(131,'Thỏ Konia','Một giống thỏ đến từ Malaysia được thuần hóa để thích hợp với điều kiện khí hậu ở Việt Nam',10,6,29,'409f624d5bb29f13057bc2c8a0a368b4.jpg'),(132,'Thỏ Remi','Giống thỏ đến từ Đài Loan, bạn yên tâm về nguồn gốc cũng như xuất sứ của các bé thỏ này nhé vì đã có giấy chứng nhận',19,6,31,'828a0e47b3f427e720df61bd88dba7ee.jpg'),(133,'Nhà dễ thương','Một căn nhà mini cho các bé thú cưng của bạn. Chúng sẽ rất thích thú trước sự ngộ nghĩnh, đáng yêu này',34,5,18,'868ac54da73ed90e3b82e0a486a0ee39.jpg'),(134,'Túi đựng mèo','Một chiếc túi giúp bạn có thể mang thú cưng theo bên mình mỗi khi ra ngoài, rất tiện lợi đúng không nào',21,5,13,'897ba94009b723814683bd312ccc50e3.jpg'),(135,'Lều cho chuột','Một căn phòng thu nhỏ cho bé chuột nhà bạn có được một nơi ở đầy ấm áp và êm ái',23,5,12,'919a3268cdec10dc99507f356b860ea5.jpg'),(136,'Chén đôi','Chén được thiết kế thành 1 cặp giúp cho các thú cưng nhà bạn có thể ăn cùng một lúc với nhau',12,5,10,'949abab2f74d913b1b959fcc93412525.jpg'),(137,'Nâu lông xoăn','Chú cún đến từ Ấn Độ mang trên mình bộ lông xoăn sẽ thu hút mọi ánh nhìn của mọi người',18,1,26,'1070b2484894bb8050cce07455f8c72a.jpg'),(138,'Mèo Siêu Baby','Nhìn thôi là đủ hiểu độ dễ thương và đáng yêu của bé mèo này rồi đúng không cả nhà, nhanh tay sở hữu em nó nhé',23,2,19,'2865daefef89c92b137da34a5ad03f31.jpg'),(139,'Mèo Sữa Đốm','Chú mèo mang trong mình một chiếc áo đốm rất đáng yêu và ngộ nghĩnh, nhanh tay kẻo hết hàng nhé',21,2,31,'5255d4f6909d42c093aecc5265f38b46.jpg'),(140,'Chuột Dâu','Bé chuột này rất thích ăn dâu tây đấy nhé! Ắt hẳn sẽ là một bé thú cưng đáng yêu dữ lắm đây',11,3,27,'5377fd8568a2bba34965c3bc1b21da68.jpg'),(141,'Mèo tuyết','Chú mèo đến từ sứ lạnh Hàn Quốc mang trên mình bộ lông trắng muốt và dày dặn nhìn rất cuốn hút',12,2,40,'5979f30810f51dbc57e77cf4bc1e4656.jpg'),(142,'\"Cậu Vàng\"','Nhìn chú cún này rất là đặc biệt bởi nó mang trong mình bộ lông màu vàng rất đặc biệt',7,1,31,'8759d1ac7e2c8c987679f685d7dc367e.jpg'),(143,'Thức ăn KiKi','Thức ăn dành cho những chú cún giúp chúng trở nên khỏe mạnh và nhanh nhẹn hơn',29,4,15,'29640b93e33c03d7a8dd839e8c092933.jpg'),(144,'Thức ăn cho thỏ','Với mùi thơm đặc trưng và hương vị ngọt ngào sẽ làm cho các bé thỏ nhà bạn thích mê với món này',31,4,11,'029708f8c421d04c3ba271beb797ea74.jpg'),(145,'Chuột Hello','Bé chuột biết vẫy tay chào bạn mỗi khi bạn nhìn nó sẽ là một điểm rất đặc biệt để bạn sở hữu nó',31,3,23,'59078c8fdb9b8b8a354f1b2af8bbd288.jpg'),(146,'Phụ kiện cho mèo','Bé mèo nhà bạn sẽ rất mê mẫn với những món phụ kiện này, và trở nên năng động tự tin hơn rất nhiều đấy',32,5,12,'91451f759bace6deb469e3b97022c179.jpg'),(147,'Combo Tẩm bổ','Tổng hợp những món ăn cung cấp năng lượng, giúp thú cưng nhà bạn có thể khỏi bệnh trong thời gian ngắn',13,4,25,'3126361b4c0ac761ea28d18efa83a11b.jpg'),(148,'Thỏ tai dài','Bé thỏ với chiếc tai rất dài sẽ trông thật ngộ nghĩnh và đáng yêu',12,6,31,'92911cde0c75fe84dbed08fc480ea954.jpg'),(149,'Chuột Jerry','Chú chuột đến từ đất nước Hoa Kỳ siêu đáng yêu và năng động sẽ không làm bạn thất vọng',11,3,39,'0759766b925e322d26c1f6a552b01f4c.jpg'),(150,'Bộ dây cho thỏ','Đảm bảo các bé thỏ không chạy lung tung và còn tăng thêm sự thời trang, phong cách cho thú cưng của bạn',22,6,19,'763371dd730ab8dc9cc80bae9dab2803.jpg'),(151,'Thức ăn tổng hợp','Thức ăn dành cho tất cả các loại thú cưng bị biến ăn, giúp chúng giảm cảm giác lười ăn và cảm thấy ngon miệng',31,4,23,'2296192b347a14f44300b04d3e5ba416.jpg'),(152,'Dụng cụ rửa chân','Dụng cụ này giúp việc giữ sạch cho chiếc chân của thú cưng trở nên dễ dàng và nhanh chóng hơn',23,5,11,'216217199ecfc500dd0df7a624eb96d8.jpg'),(153,'Chuột boxing','Em chuột này rất là năng động suốt ngày luôn quấn quýt theo chủ và truyền đến bạn những năng lượng tích cực',21,3,31,'713400905fc591eaf4890e5a08de9d26.jpg'),(154,'Chuột Booky','Bé chuột ham mê đọc sách cả ngày mà không biến chán, quả thật là một chú chuột kỳ diệu',11,3,32,'70648798900c42c5bda6bb9770e9952f.jpg'),(155,'Meèo Foody','Thức ăn mà mọi bé mèo đều muốn được thưởng thức bởi sự thơm ngon và dinh dưỡng mà nó mang lại',7,4,12,'a1bc288ed2b2f25e79f27922d0d2b750.jpg'),(156,'Thỏ tai đứng','Bé thỏ với đôi tay lúc nào cũng vểnh lên trông thật đáng yêu đúng không các bạn',12,6,32,'a1c9fe68afb5d905bbef8c47f53d72d7.jpg'),(157,'Cún Bagy','Bé cún với bộ lông trắng đang đeo thêm ba lo trông thật ngộ nghĩnh và dễ thương',21,1,31,'a4e391d96805b6ecca54c66c73e78184.jpg'),(158,'Dây giữ mèo','Chiếc dây không làm bé mèo cảm thấy khó chịu mà còn làm tăng sự thời trang cho bé',22,5,12,'a09a66f7eb5c0482335cfe134a6c8972.jpg'),(159,'Hạt SoCoLy','Với hương thơm ngọt ngào ắt hẳn các bé thú cưng nhà bạn sẽ thích mê với món ăn này',22,4,12,'a24a46dc8548a5e288681576f4c890a4.jpg'),(160,'Bình đựng thức ăn','Cặp bình giúp thú cưng có thể ăn và uống một cách tự động, tiết kiệm thời gian, công sức cho bạn',22,5,11,'a349107c1ace48295047aea8520461b8.jpg'),(161,'Cún ú ì','Bé cún siêu ú nhìn cực kỳ đáng yêu, bạn sẽ rất thích nó bởi sự ngộ nghĩnh và năng động mà nó đem lại',11,1,31,'a8850702e70e70b2cc56ca00bd6089e8.jpg'),(162,'Đai nịt mèo','Màu hồng đáng yêu sẽ là màu thích hợp cho các bé mèo yêu thích sự ngọt ngào, dịu dàng',10,5,13,'acf06980d2fd64a1c5176e39ecfea5a6.jpg'),(163,'Hộp đựng Kahas','Hộp đựng thức ăn đến từ nhà Kahas sẽ là một lựa chọn tuyệt vời cho các bé thú cưng nhà bạn',33,5,11,'ada269ca00581814776b96755b9d28dd.jpg'),(164,'Khăn tắm mèo','Chiếc khăn chắc chắn rất cần thiết mỗi khi bạn muốn tắm cho thú cưng của mình, nhanh tay sở hữu ngay nhé',11,5,8,'afa8e5ee0b96042b877bf31de67f68d5.jpg'),(165,'Cún Sadness','Bé cún buồn hiu, rưng rưng đang chờ bạn rước về đấy, nhanh tay bấm mua bé ngay nhé',12,1,24,'b4fd0bf7276d1f98064862b160459f01.jpg'),(166,'Thỏ Doremi','Bé thỏ đáng yêu với đôi mắt to tròn đầy sự dịu dàng và ngọt ngào, nhanh tay sở hữu bé nhá',11,6,21,'b6729434a8c7ab40ab59e261a47d25f5.jpg'),(167,'Balo cho cún','Chiếc balo giúp cho bé cún nhà bạn trở nên thu hút hơn trong mắt mọi người vì sự ngộ nghĩnh và đáng yêu',11,5,21,'bb45ee60e472a21b6632bb40a1e5c290.jpg'),(168,'Chuột Hasi','Bé chuột đến từ nhật bản với sức khỏe vượt trội ít khi mắc bệnh và luô luôn năng động, vui vẻ',12,3,32,'bb77ae43e7798bb94c7c9ab0d8057b87.jpg'),(169,'Mèo tai hường','Bé mèo có bộ lông trắng tươi và đôi tai màu hồng sẽ là điểm nhấn trong mắt của mọi người',12,2,31,'bd9c931ca152a2323a4293ff5ad9846b.jpg'),(170,'Chuột Mike','Giống chuột này mang trong mình sự ngây ngô, ngộ nghĩnh mà chắc hẳn ai cũng muốn sở hửu',22,3,19,'c15afcb4350316251130a58ae0688dcb.jpg'),(171,'Chuột Xám Trắng','Bé chuột với đôi tay vểnh cao cùng với bộ lông xám đặc biệt, sẽ là một sự lựa chọn tuyệt vời',5,3,26,'c76a68e83c2e58a06755c62d8c627860.jpg'),(172,'FoCat Food','Thức ăn chuyên dành cho mèo với chất lượng được đảm bảo đến từ nhà sản xuất FoCat',12,4,14,'cac00c5cb2431b0117202b35c99ff1ef.jpg'),(173,'Đai nịt DaNiHa','Một chiến đai nịch giúp giữ thú cưng không đi lung tung cùng với màu sắc thu hút',12,5,24,'cffecb7cb49dfdfb34154d8111898ac1.jpg'),(174,'Nhà CatHomePi','Chiếc nhà hồng dành cho các bé mèo thích sự ấm áp và dễ thương',11,5,21,'d1cb6ee2a19e8f2c0ab3de314018ee86.jpg'),(175,'Hamster Sofa','Một chiếc sofa mini dành cho các bé hamster nhỏ nhắn trông thật đáng yêu đúng không các bạn',8,5,17,'df0e812f906a9213bbf1780a54cd528d.jpg'),(176,'Dây nịt B-Fly','Chiếc dây dành cho các bé cún với đôi cánh thiên thần nhìn thật đáng yêu và ngộ nghĩnh',12,5,9,'df249801591a2e4d1bdb418b98108735.jpg'),(177,'Hộp thức ăn Fody','Hộp đựng thức ăn có thể chứa rất nhiều loại cũng như là nước, giúp tiết kiệm không gian của bạn',2,5,20,'e2c59fecc936de2e424472a3ed9d2a5d.jpg'),(178,'Mini Bed','Chiếc giường nhỏ dành cho các bé chuột mini nhìn siêu đáng yêu và dễ thương',18,5,5,'e4c72628157131eec6a7ae0ded9e5413.jpg'),(179,'Chuột Tudy','Bé chuột ham học đọc sách chăm chỉ là một sự lựa chọn tuyệt vời ',6,3,12,'e14e5b6cbb81844d4aa720ff89ba15a7.jpg'),(180,'FoHa Food','Thức ăn chuyên dành cho hamster giúp các bé khỏe mạnh chống lại được nhiều loại bệnh',25,4,22,'e48e0f7dc14dfd0be06b7861462f47df.jpg'),(181,'Chén đôi RaBo','Chén đôi dành cho các bé thú cưng giúp chúng có thể ăn cùng lúc với nhau',21,7,112,'eb15109ff10b35b27caa137c04aa2445.jpg'),(182,'Thỏ Stick','Bé thỏ nhìn giống nhân vật hoạt hình liệu có thu hút được ánh nhìn của bạn',8,6,21,'ed1dab040a325715a86c2315a4a67d89.jpg'),(183,'Mèo Wimi','Bé mèo với bộ lông trắng vàng và ú nu sẽ là một chiếc thú cưng đặt biệt mà mọi người đều muốn sở hữu',11,2,21,'ed0358de38c38331cf0997105e00ec26.jpg'),(184,'Dofo Foody','Thức ăn dành cho các bé cún gặp vấn đề về đường tiêu hóa, nó sẽ giúp thú cưng nhà bạn mau khỏe bệnh',20,4,20,'f95db8e3cd56c14739f55702181a66ff.jpg'),(197,'Cún MIU','Một bé cún đến từ nhà MIU rất ngoan hiền và xinh xắn',9,1,22,'MUI dog.jpg'),(198,'Hai bé cún','Hai chú cún sinh đôi siêu dễ thương với bộ lông xù đẹp lắm cả nhà',2,1,12,'_d1e91c45-97fa-435c-978b-746712828289.jfif'),(201,'Thức ăn mèo','Một món ăn vô cùng thơm ngon và bổ dưỡng',2,4,13,'thucanmoi.jfif'),(203,'Thỏ Xinh Xắn','Một chiếc thỏ rất đáng yêu đến từ nhà AniHa',9,6,27,'rabits.jfif');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `address` varchar(50) NOT NULL,
  `is_admin` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Gia Bảo','user@gmail.com','202cb962ac59075b964b07152d234b70','0706703949','Vĩnh Long Bình Tân\r\n',0),(2,'Jane Smith','jane@example.com','0','0988787666','456 Elm Street',0),(3,'Thiên Phú','haob2111838@student.ctu.edu.vn','202cb962ac59075b964b07152d234b70','0706703845','Thừa Thiên Huế',0),(31,'Hào Admin','admin@gmail.com','202cb962ac59075b964b07152d234b70','0328931694','Mậu Thân',1),(32,'Công Thiên','user123@gmail.com','82d8ecc7dab2452547dae65e61478777','0706703846','Bình Thủy',0),(33,'Nguyễn Anh Hào','user1@gmail.com','202cb962ac59075b964b07152d234b70','0706703847','Nguyễn Văn Cừ',0),(34,'Anh Thái','user2@gmail.com','82d8ecc7dab2452547dae65e61478777','0706703848','An Hòa',0),(35,'Võ Thị Bảo Trân','tranb2204974@student.ctu.edu.vn','202cb962ac59075b964b07152d234b70','0328931695','Đà Nẵng',0),(36,'Nguyễn Bảo Lan','user111@gmail.com','82d8ecc7dab2452547dae65e61478777','0706703840','Sóc Trăng',0),(37,'Nguyễn Phước Sang','nguyensang250593@gmail.com','73c337edaf63ad3e83c122e968aeaee8','0799595919','Hùng Vương',0),(38,'Nguyễn Tấn Trọng','trong@gmail.com','82d8ecc7dab2452547dae65e61478777','0793071384','Tân Lược , Bình Tân , Vĩnh Long ',0),(39,'Nguyễn Thanh Trân','thanhtran@gmail.com','82d8ecc7dab2452547dae65e61478777','0706703885','Quận Bình Tân, TP HCM',0),(40,'Võ Đức Anh','duy@gmail.com','202cb962ac59075b964b07152d234b70','0556559865','Hoàn Kiếm, Hà Nội',0),(41,'Võ Văn Đức','duc@gmail.com','82d8ecc7dab2452547dae65e61478777','0706703800','Quận Thủ Đức, TP Hà Nội',0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-04-14 22:43:54
