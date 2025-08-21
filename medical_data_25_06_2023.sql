-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: medical
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Dumping data for table `appointment_status`
--

LOCK TABLES `appointment_status` WRITE;
/*!40000 ALTER TABLE `appointment_status` DISABLE KEYS */;
INSERT INTO `appointment_status` VALUES (1,'قيد الانتظار','Pending'),(2,'نشط','Active'),(3,'ملغي','Canceled'),(4,'زيارة أخرى','Another visit'),(5,'اكتمل','Completed');
/*!40000 ALTER TABLE `appointment_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `appointments`
--

LOCK TABLES `appointments` WRITE;
/*!40000 ALTER TABLE `appointments` DISABLE KEYS */;
INSERT INTO `appointments` VALUES (2,2,3,1,1,'2022-08-12','20:38:30',1000);
/*!40000 ALTER TABLE `appointments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `branches`
--

LOCK TABLES `branches` WRITE;
/*!40000 ALTER TABLE `branches` DISABLE KEYS */;
INSERT INTO `branches` VALUES (1,'ماكس سوفت','MaxSoft',NULL,'737191721','ذمار','images/branches/image_20220809011617.png','1','[\"Saturday\",\"Sunday\",\"Monday\"]');
/*!40000 ALTER TABLE `branches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `card_types`
--

LOCK TABLES `card_types` WRITE;
/*!40000 ALTER TABLE `card_types` DISABLE KEYS */;
INSERT INTO `card_types` VALUES (1,'شخصية','ID Card'),(2,'جواز سفر','Passport');
/*!40000 ALTER TABLE `card_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `cities`
--

LOCK TABLES `cities` WRITE;
/*!40000 ALTER TABLE `cities` DISABLE KEYS */;
INSERT INTO `cities` VALUES (1,'ذمار','Thamar'),(2,'صنعاء','Sana`a'),(3,'ddd','dd');
/*!40000 ALTER TABLE `cities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `departments`
--

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
INSERT INTO `departments` VALUES (1,'عام','general',1,'1');
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `doctor_nicknames`
--

LOCK TABLES `doctor_nicknames` WRITE;
/*!40000 ALTER TABLE `doctor_nicknames` DISABLE KEYS */;
INSERT INTO `doctor_nicknames` VALUES (1,'دكتور','Doctor','1');
/*!40000 ALTER TABLE `doctor_nicknames` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `doctor_services`
--

LOCK TABLES `doctor_services` WRITE;
/*!40000 ALTER TABLE `doctor_services` DISABLE KEYS */;
INSERT INTO `doctor_services` VALUES (1,1),(1,3),(1,4),(2,1),(2,3);
/*!40000 ALTER TABLE `doctor_services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `doctor_times`
--

LOCK TABLES `doctor_times` WRITE;
/*!40000 ALTER TABLE `doctor_times` DISABLE KEYS */;
/*!40000 ALTER TABLE `doctor_times` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `doctors`
--

LOCK TABLES `doctors` WRITE;
/*!40000 ALTER TABLE `doctors` DISABLE KEYS */;
INSERT INTO `doctors` VALUES (1,2,1,1,1,1000.00,150000.00),(3,4,1,1,1,1500.00,10000.00),(4,5,1,1,1,3000.00,200000.00);
/*!40000 ALTER TABLE `doctors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `drug_types`
--

LOCK TABLES `drug_types` WRITE;
/*!40000 ALTER TABLE `drug_types` DISABLE KEYS */;
INSERT INTO `drug_types` VALUES (1,'أقراص دوائية ','tablets'),(2,'كبسولة ','Capsule'),(3,'شراب ','Syrup'),(4,'قطرات ','Drops'),(5,'رذاذ للأنف ','nasal spray'),(6,'استنشاق ','inhalation'),(7,'أجهزة الاستنشاق ','Inhalers'),(8,'حقنة ','Injection'),(9,'أمبولة ','ampoule'),(10,'كريم ','cream'),(11,'مرهم ','ointment'),(12,'تحاميل ','Suppositories'),(13,'جل ','Gel');
/*!40000 ALTER TABLE `drug_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `drugs`
--

LOCK TABLES `drugs` WRITE;
/*!40000 ALTER TABLE `drugs` DISABLE KEYS */;
INSERT INTO `drugs` VALUES (2,'مرهم','jjj','',11,'1');
/*!40000 ALTER TABLE `drugs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `image_uploads`
--

LOCK TABLES `image_uploads` WRITE;
/*!40000 ALTER TABLE `image_uploads` DISABLE KEYS */;
/*!40000 ALTER TABLE `image_uploads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `lab_tests`
--

LOCK TABLES `lab_tests` WRITE;
/*!40000 ALTER TABLE `lab_tests` DISABLE KEYS */;
INSERT INTO `lab_tests` VALUES (1,'fjgkj','jkjjkj','00:10','1',1000);
/*!40000 ALTER TABLE `lab_tests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2019_12_14_000001_create_personal_access_tokens_table',1),(2,'2022_07_26_210026_create_appointment_status_table',1),(3,'2022_07_26_210027_create_user_groups_table',1),(4,'2022_07_26_210028_create_users_table',1),(5,'2022_07_26_210029_create_doctors_table',1),(6,'2022_07_26_210030_create_patients_table',1),(7,'2022_07_26_210031_create_appointments_table',1),(8,'2022_07_26_210032_create_branches_table',1),(9,'2022_07_26_210033_create_card_types_table',1),(10,'2022_07_26_210034_create_cities_table',1),(11,'2022_07_26_210035_create_departments_table',1),(12,'2022_07_26_210036_create_doctor_nicknames_table',1),(13,'2022_07_26_210037_create_services_table',1),(14,'2022_07_26_210038_create_doctor_services_table',1),(15,'2022_07_26_210039_create_doctor_times_table',1),(16,'2022_07_26_210040_create_drug_types_table',1),(17,'2022_07_26_210041_create_drugs_table',1),(18,'2022_07_26_210042_create_failed_jobs_table',1),(19,'2022_07_26_210043_create_lab_tests_table',1),(20,'2022_07_26_210044_create_nationalities_table',1),(21,'2022_07_26_210045_create_navbars_table',1),(22,'2022_07_26_210046_create_password_resets_table',1),(23,'2022_07_26_210047_create_patient_reviews_table',1),(24,'2022_07_26_210048_create_patient_test_files_table',1),(25,'2022_07_26_210049_create_patient_tests_table',1),(26,'2022_07_26_210050_create_patient_xray_files_table',1),(27,'2022_07_26_210051_create_patient_xrays_table',1),(28,'2022_07_26_210052_create_permissions_table',1),(29,'2022_07_26_210054_create_prescriptions_table',1),(30,'2022_07_26_210055_create_roles_table',1),(31,'2022_07_26_210056_create_roles_permissions_table',1),(32,'2022_07_26_210057_create_service_times_table',1),(33,'2022_07_26_210058_create_specifications_table',1),(34,'2022_07_26_210059_create_users_permissions_table',1),(35,'2022_07_26_210100_create_users_roles_table',1),(36,'2022_07_26_210101_create_xrays_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `nationalities`
--

LOCK TABLES `nationalities` WRITE;
/*!40000 ALTER TABLE `nationalities` DISABLE KEYS */;
INSERT INTO `nationalities` VALUES (1,'يمني','Yemeni'),(2,'سعودي','Saudi');
/*!40000 ALTER TABLE `nationalities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `navbars`
--

LOCK TABLES `navbars` WRITE;
/*!40000 ALTER TABLE `navbars` DISABLE KEYS */;
INSERT INTO `navbars` VALUES (1,'nationality','nationality','fa-user-secret',0),(2,'city','city','fa-hospital-o',1),(3,'branch','branch','fa-building-o',2),(4,'specification','specification','fa-list-ul',4),(5,'nickname','nickname','fa-lightbulb-o',4),(6,'users','users','fa-users',1),(7,'doctor','doctor','fa-user-md',6),(8,'departments','departments','fa-list-ul',3);
/*!40000 ALTER TABLE `navbars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `patient_reviews`
--

LOCK TABLES `patient_reviews` WRITE;
/*!40000 ALTER TABLE `patient_reviews` DISABLE KEYS */;
/*!40000 ALTER TABLE `patient_reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `patient_test_files`
--

LOCK TABLES `patient_test_files` WRITE;
/*!40000 ALTER TABLE `patient_test_files` DISABLE KEYS */;
/*!40000 ALTER TABLE `patient_test_files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `patient_tests`
--

LOCK TABLES `patient_tests` WRITE;
/*!40000 ALTER TABLE `patient_tests` DISABLE KEYS */;
/*!40000 ALTER TABLE `patient_tests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `patient_xray_files`
--

LOCK TABLES `patient_xray_files` WRITE;
/*!40000 ALTER TABLE `patient_xray_files` DISABLE KEYS */;
/*!40000 ALTER TABLE `patient_xray_files` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `patient_xrays`
--

LOCK TABLES `patient_xrays` WRITE;
/*!40000 ALTER TABLE `patient_xrays` DISABLE KEYS */;
/*!40000 ALTER TABLE `patient_xrays` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `patients`
--

LOCK TABLES `patients` WRITE;
/*!40000 ALTER TABLE `patients` DISABLE KEYS */;
INSERT INTO `patients` VALUES (1,'فاطمة حسين اليماني',NULL,NULL,'female',1,'cxc',5,NULL,'O+'),(2,'محمد حسن علي','737191721','admin@c.com','male',1,'cxc',5,NULL,'O+'),(3,'خالد حسين عبدة','737191721','admin@c.com','male',1,'cxc',5,NULL,'O+'),(4,'احمد محمد','737191721','admin@c.com','male',1,'cxc',5,NULL,'O+'),(5,'سعيد ناصر القوبري','737191721','admin@c.com','male',1,'cxc',5,NULL,'O+'),(6,'هدى علي البراشي','','','female',1,'cxc',15,NULL,'O+'),(7,'ناصر احمد قردع','','','male',1,'cxc',5,NULL,'O+'),(8,'سعاد خالد علي','','','female',1,'cxc',15,NULL,'O+'),(9,'خليل جبران محمد الشلالي','','','male',1,'cxc',25,NULL,'O+'),(10,'لمياء احمد الشيعاني','','','female',1,'cxc',15,NULL,'O+'),(11,'ناصر محمد الشلالي','','','male',1,'cxc',25,NULL,'O+'),(12,'روعة حفظ الله اليماني','','','female',1,'cxc',15,NULL,'O+'),(13,'صالح احمد صالح الغبر','','','male',1,'cxc',25,NULL,'O+'),(14,'امرية صالح عبدالله','','','female',1,'cxc',15,NULL,'O+'),(15,'سامر حسين ناصر','','','male',1,'cxc',25,NULL,'O+'),(16,'سرور حميد القادري','','','female',1,'cxc',15,NULL,'O+'),(17,'جميلة محمد علي القحوي','','','female',1,'cxc',15,NULL,'O+'),(18,'ايناس محمد القدسي','770326227','','female',1,'cxc',15,NULL,'O+'),(19,'رجاء علي محمد نشوان','775806443','','female',1,'cxc',15,NULL,'O+'),(20,'نجلاء علي محمد لهفان','','','female',1,'cxc',15,NULL,'O+'),(21,'غاده محسن علي جهوان','774711385','','female',1,'cxc',15,NULL,'O+'),(22,'رغداء عبدالله الماعطي','','','female',1,'cxc',15,NULL,'O+'),(23,'نجوى محمد البرارة','770309889','','female',1,'cxc',15,NULL,'O+'),(24,'نجوى محسن عبد الله شقير','777452993','','female',1,'cxc',15,NULL,'O+'),(25,'أفراح علي محمد معوضة','773081434','','female',1,'cxc',15,NULL,'O+'),(26,'بلقيس حسين الجنادي','770092826','','female',1,'cxc',15,NULL,'O+'),(27,'شيماء محمد محسن سقل','777453299','','female',1,'cxc',15,NULL,'O+'),(28,'zxzx',NULL,NULL,'male',1,'',10,'images/patients/image_20220812194704.png','O+');
/*!40000 ALTER TABLE `patients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (12,'add','city.add'),(51,'add','doctor.add'),(19,'add','nationality.add'),(36,'add','nickname.add'),(43,'add','specification.add'),(31,'add','users.add'),(3,'create','branch.create'),(70,'create','departments.create'),(61,'create','services.create'),(2,'data','branch.data'),(10,'data','city.data'),(69,'data','departments.data'),(49,'data','doctor.data'),(17,'data','nationality.data'),(34,'data','nickname.data'),(60,'data','services.data'),(42,'data','specification.data'),(24,'data','users.data'),(16,'delete','city.delete'),(55,'delete','doctor.delete'),(23,'delete','nationality.delete'),(40,'delete','nickname.delete'),(47,'delete','specification.delete'),(26,'delete','users.delete'),(8,'destroy','branch.destroy'),(75,'destroy','departments.destroy'),(66,'destroy','services.destroy'),(57,'doctorDays','doctor.doctorDays'),(6,'edit','branch.edit'),(14,'edit','city.edit'),(73,'edit','departments.edit'),(53,'edit','doctor.edit'),(21,'edit','nationality.edit'),(38,'edit','nickname.edit'),(64,'edit','services.edit'),(45,'edit','specification.edit'),(29,'edit','users.edit'),(1,'index','branch.index'),(11,'index','city.index'),(68,'index','departments.index'),(48,'index','doctor.index'),(18,'index','nationality.index'),(35,'index','nickname.index'),(59,'index','services.index'),(41,'index','specification.index'),(25,'index','users.index'),(5,'show','branch.show'),(72,'show','departments.show'),(63,'show','services.show'),(9,'status','branch.status'),(76,'status','departments.status'),(56,'status','doctor.status'),(67,'status','services.status'),(33,'status','users.status'),(4,'store','branch.store'),(13,'store','city.store'),(71,'store','departments.store'),(52,'store','doctor.store'),(20,'store','nationality.store'),(37,'store','nickname.store'),(62,'store','services.store'),(44,'store','specification.store'),(32,'store','users.store'),(58,'times','doctor.times'),(7,'update','branch.update'),(15,'update','city.update'),(74,'update','departments.update'),(54,'update','doctor.update'),(22,'update','nationality.update'),(39,'update','nickname.update'),(65,'update','services.update'),(46,'update','specification.update'),(30,'update','users.update'),(50,'view','doctor.view'),(28,'view','users.view'),(27,'viewdelete','users.destroy');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `prescriptions`
--

LOCK TABLES `prescriptions` WRITE;
/*!40000 ALTER TABLE `prescriptions` DISABLE KEYS */;
/*!40000 ALTER TABLE `prescriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'branch','branch'),(2,'city','city'),(9,'departments','departments'),(7,'doctor','doctor'),(3,'nationality','nationality'),(5,'nickname','nickname'),(8,'services','services'),(6,'specification','specification'),(4,'users','users');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `roles_permissions`
--

LOCK TABLES `roles_permissions` WRITE;
/*!40000 ALTER TABLE `roles_permissions` DISABLE KEYS */;
INSERT INTO `roles_permissions` VALUES (1,1),(1,2),(1,3),(1,4),(1,5),(1,6),(1,7),(1,8),(1,9),(2,10),(2,11),(2,12),(2,13),(2,14),(2,15),(2,16),(3,17),(3,18),(3,19),(3,20),(3,21),(3,22),(3,23),(4,24),(4,25),(4,26),(4,27),(4,28),(4,29),(4,30),(4,31),(4,32),(4,33),(5,34),(5,35),(5,36),(5,37),(5,38),(5,39),(5,40),(6,41),(6,42),(6,43),(6,44),(6,45),(6,46),(6,47),(7,48),(7,49),(7,50),(7,51),(7,52),(7,53),(7,54),(7,55),(7,56),(7,57),(7,58),(8,59),(8,60),(8,61),(8,62),(8,63),(8,64),(8,65),(8,66),(8,67),(9,68),(9,69),(9,70),(9,71),(9,72),(9,73),(9,74),(9,75),(9,76);
/*!40000 ALTER TABLE `roles_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `service_times`
--

LOCK TABLES `service_times` WRITE;
/*!40000 ALTER TABLE `service_times` DISABLE KEYS */;
INSERT INTO `service_times` VALUES (21,2,'Saturday','09:00','12:00',1),(22,2,'Saturday','14:00','17:00',2),(23,2,'Sunday','09:00','12:00',3),(24,2,'Monday','11:00','12:00',4),(25,1,'Saturday','09:30','11:30',1),(26,1,'Saturday','14:00','18:00',2),(27,1,'Sunday','09:30','11:30',3),(28,1,'Monday','09:30','11:30',4);
/*!40000 ALTER TABLE `service_times` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `services`
--

LOCK TABLES `services` WRITE;
/*!40000 ALTER TABLE `services` DISABLE KEYS */;
INSERT INTO `services` VALUES (1,'معاينة',1,'1',1000.00,'1'),(2,'استشارة',1,'0',0.00,'1');
/*!40000 ALTER TABLE `services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `specifications`
--

LOCK TABLES `specifications` WRITE;
/*!40000 ALTER TABLE `specifications` DISABLE KEYS */;
INSERT INTO `specifications` VALUES (1,'جلد','skin','1');
/*!40000 ALTER TABLE `specifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `user_groups`
--

LOCK TABLES `user_groups` WRITE;
/*!40000 ALTER TABLE `user_groups` DISABLE KEYS */;
INSERT INTO `user_groups` VALUES (1,'admin'),(2,'user'),(3,'doctor'),(4,'customer');
/*!40000 ALTER TABLE `user_groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','dfdfdf','male','737191721','admin@c.com','96e79218965eb72c92a549dd5a330112','1',1,1,'121212121',1,'2022-07-13','fdfdfd','images/users/img_2022_08_07_18_40.jpg'),(2,'خالد',NULL,'male','770646697','','96e79218965eb72c92a549dd5a330112','1',3,1,'0',0,'2022-07-17','','images/users/image_20220807225919.png'),(4,'محمد','mohammed','male','771664627','','96e79218965eb72c92a549dd5a330112','1',3,1,'45454',1,'1985-08-01','ذمار','images/users/image_20220807225711.png'),(5,'علي','ali','male','738896504','','96e79218965eb72c92a549dd5a330112','1',3,1,'0',0,'','ذمار','');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `users_permissions`
--

LOCK TABLES `users_permissions` WRITE;
/*!40000 ALTER TABLE `users_permissions` DISABLE KEYS */;
INSERT INTO `users_permissions` VALUES (1,1),(1,2),(1,3),(1,4),(1,5),(1,6),(1,7),(1,8),(1,9),(1,10),(1,11),(1,12),(1,13),(1,14),(1,15),(1,16),(1,17),(1,18),(1,19),(1,20),(1,21),(1,22),(1,23),(1,24),(1,25),(1,26),(1,27),(1,28),(1,29),(1,30),(1,31),(1,32),(1,33),(1,34),(1,35),(1,36),(1,37),(1,38),(1,39),(1,40),(1,41),(1,42),(1,43),(1,44),(1,45),(1,46),(1,47),(1,48),(1,49),(1,50),(1,51),(1,52),(1,53),(1,54),(1,55),(1,56),(1,57),(1,58),(1,59),(1,60),(1,61),(1,62),(1,63),(1,64),(1,65),(1,66),(1,67),(1,68),(1,69),(1,70),(1,71),(1,72),(1,73),(1,74),(1,75),(1,76),(2,1),(2,2),(2,3),(2,4),(2,5),(2,6),(2,7),(2,8),(2,9),(2,10),(2,11),(2,12),(2,13),(2,14),(2,15),(2,16),(2,17),(2,18),(2,19),(2,20),(2,21),(2,22),(2,23);
/*!40000 ALTER TABLE `users_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `users_roles`
--

LOCK TABLES `users_roles` WRITE;
/*!40000 ALTER TABLE `users_roles` DISABLE KEYS */;
INSERT INTO `users_roles` VALUES (1,1),(1,2),(1,3),(1,4),(1,5),(1,6),(1,7),(1,8),(1,9),(2,1),(2,2),(2,3);
/*!40000 ALTER TABLE `users_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `xrays`
--

LOCK TABLES `xrays` WRITE;
/*!40000 ALTER TABLE `xrays` DISABLE KEYS */;
INSERT INTO `xrays` VALUES (1,'cxc','cxc','40',12,'1');
/*!40000 ALTER TABLE `xrays` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-06-25 17:21:04
