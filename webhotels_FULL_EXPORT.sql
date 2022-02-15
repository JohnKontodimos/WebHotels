-- MySQL dump 10.13  Distrib 8.0.25, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: webhotels
-- ------------------------------------------------------
-- Server version	5.7.31

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
-- Table structure for table `hotels`
--

DROP TABLE IF EXISTS `hotels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `hotels` (
  `TITLE` varchar(35) NOT NULL,
  `STATE` varchar(16) NOT NULL,
  `DESTINATION` varchar(30) NOT NULL,
  `ADDRESS` varchar(30) NOT NULL,
  `PHONE` bigint(10) NOT NULL,
  `STARS` int(1) NOT NULL,
  `users_USERNAME` varchar(10) NOT NULL,
  `DESCRIPTION` varchar(2000) NOT NULL,
  `rooms_opt_1` varchar(5) DEFAULT NULL,
  `rooms_opt_2` varchar(5) DEFAULT NULL,
  `rooms_opt_3` varchar(5) DEFAULT NULL,
  `rooms_opt_4` varchar(5) DEFAULT NULL,
  `rooms_opt_5` varchar(5) DEFAULT NULL,
  `parking` varchar(5) DEFAULT NULL,
  `wifi` varchar(5) DEFAULT NULL,
  `bar` varchar(5) DEFAULT NULL,
  `restaurant` varchar(5) DEFAULT NULL,
  `room_service` varchar(5) DEFAULT NULL,
  `24_hours_reception` varchar(5) DEFAULT NULL,
  `pets` varchar(5) DEFAULT NULL,
  `pool` varchar(5) DEFAULT NULL,
  `ac` varchar(5) DEFAULT NULL,
  `gym` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`TITLE`,`users_USERNAME`),
  KEY `fk_hotels_users_idx` (`users_USERNAME`),
  CONSTRAINT `fk_hotels_users` FOREIGN KEY (`users_USERNAME`) REFERENCES `users` (`USERNAME`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hotels`
--

LOCK TABLES `hotels` WRITE;
/*!40000 ALTER TABLE `hotels` DISABLE KEYS */;
INSERT INTO `hotels` VALUES ('Anatolia Hotel','Θεσσαλονίκης','Θεσσαλονίκη','Λαγκαδά 13',2341567677,4,'username13','Το Anatolia Hotel απέχει λίγα λεπτά με τα πόδια από το κέντρο της Θεσσαλονίκης και προσφέρει όμορφα καταλύματα με μπαλκόνι και θέα στην πόλη. Διαθέτει άρτια εξοπλισμένο γυμναστήριο, σπα και βεράντα στον τελευταίο όροφο με χαλαρωτικό περιβάλλον όπου σερβίρονται γεύματα και ποτά όλη την ημέρα.\r\n\r\nΤα κλιματιζόμενα δωμάτια και οι σουίτες του Hotel Anatolia έχουν καλαίσθητη επίπλωση σε φυσικά χρώματα. Όλα περιλαμβάνουν δορυφορική τηλεόραση LCD και δωρεάν Wi-Fi.\r\n\r\nΤο Secret Terrace Lounge του τελευταίου ορόφου σερβίρει διάφορα πιάτα, καφέδες και ποτά όλη την ημέρα. Απολαύστε ένα ποτήρι κρασί στο Take It Easy Living Room, όπου θα βρείτε βιβλιοθήκη με πολλά ελληνικά και ξένα βιβλία. Το All Senses Fitness & Health Club προσφέρει διάφορες εξειδικευμένες περιποιήσεις προσώπου και σώματος, όπως μασάζ και αρωματοθεραπείες. Μπορείτε να χαλαρώσετε στη σάουνα και στο ατμόλουτρο, χωρίς επιπλέον χρέωση.\r\n\r\nΤο Hotel Anatolia βρίσκεται σε μικρή απόσταση με τα πόδια από τους εμπορικούς δρόμους της Θεσσαλονίκης, τις περιοχές διασκέδασης και σημαντικά αξιοθέατα, όπως τα Λαδάδικα και ο Λευκός Πύργος. Ο σιδηροδρομικός σταθμός της Θεσσαλονίκης απέχει 300μ. και το αεροδρόμιο Μακεδονία είναι 18χλμ. μακριά. Σε κοντινή τοποθεσία από το Anatolia υπάρχει δωρεάν κοινόχρηστος χώρος στάθμευσης.','true','true','true','true','false','true','true','true','false','false','false','true','false','false','true'),('Aqua Blue Beach Hotel','Κυκλάδων','Σαντορίνη','Περίσσα 84703',2346345516,5,'username25','Το Aqua Blue Hotel βρίσκεται ακριβώς στην παραλία της Περίσσας και διαθέτει ιδιωτικό χώρο στην παραλία με ξαπλώστρες και ομπρέλες. Προσφέρει 3 εξωτερικές πισίνες, συμπεριλαμβανομένης μιας παιδικής πισίνας, και δωμάτια με δωρεάν Wi-Fi.\r\n\r\nΤα δωμάτια στο Aqua Blue είναι φωτεινά και μοντέρνα επιπλωμένα με κλιματισμό, δορυφορική τηλεόραση επίπεδης οθόνης, ψυγείο, ιδιωτικό μπάνιο, μπαλκόνι ή βεράντα, παράθυρα με διπλά τζάμια και θυρίδα ασφαλείας.\r\n\r\nΤο ξενοδοχείο διαθέτει εστιατόριο με μπουφέ για πρωινό και δείπνο, καθώς και lounge bar που σερβίρει ποτά δίπλα στην πισίνα.\r\n\r\nΥπάρχει 24ωρη ρεσεψιόν, ενώ στη ρεσεψιόν θα βρείτε επίσης υπολογιστές με πρόσβαση στο internet με χρέωση. Μπορείτε να οργανώσετε εκδρομές και ενοικιάσεις αυτοκινήτων, καθώς και υπηρεσία πλυντηρίου, σιδερώματος και πετσέτες.\r\n\r\nΤα Φηρά, η πολυσύχναστη πρωτεύουσα της Σαντορίνης, απέχουν 15χλμ., ενώ το αεροδρόμιο και το λιμάνι της Θήρας είναι 20 λεπτά μακριά με το αυτοκίνητο. Θα βρείτε θαλάσσια σπορ, εστιατόρια και άλλες επιλογές διασκέδασης κοντά στο ξενοδοχείο.','true','true','true','true','true','true','true','true','true','false','true','false','true','true','true'),('B4B Athens Signature Hotel','Αττικής','Αθήνα','Θεοφιλόπουλου 18,Πλ Καληρόης',2343165464,5,'username17','Το ολοκαίνουργιο B4B Athens Signature Hotel του ομίλου B for Boutique Hotels βρίσκεται σε κεντρικό σημείο στην Αθήνα, μόλις 6 λεπτά με τα πόδια από το Μουσείο της Ακρόπολης. Στις εγκαταστάσεις λειτουργεί μπαρ. Το κατάλυμα προσφέρει κομψά δωμάτια και σουίτες με δωρεάν Wi-Fi. Παρέχεται ένα smartphone της εταιρείας handy για απεριόριστες διεθνείς και τοπικές κλήσεις.\r\n\r\nΤα δωμάτια και οι σουίτες του B4B Athens Signature Hotel έχουν παρκέ δάπεδα, διακόσμηση σε γήινα χρώματα και περιλαμβάνουν τηλεόραση smart 32 ιντσών, καφετιέρα Dolce Gusto, μίνι μπαρ και θυρίδα ασφαλείας. Το μοντέρνο μπάνιο σε κάθε μονάδα είναι εξοπλισμένο με ξεχωριστό ντους ψιλής βροχής, δωρεάν προϊόντα περιποίησης, μπουρνούζια και παντόφλες. Ορισμένες μονάδες έχουν θέα στην Ακρόπολη ή στην πόλη.\r\n\r\nΚαθημερινά σερβίρεται μπουφές πρωινού στην τραπεζαρία. Στο μπαρ θα απολαύσετε ποτά, καφέδες και κοκτέιλ οποιαδήποτε ώρα της ημέρας.\r\n\r\nΗ πλατεία Συντάγματος απέχει 15 λεπτά με τα πόδια από το B4B Athens Signature Hotel, ενώ ο σταθμός Ακρόπολη του μετρό είναι 400μ. μακριά. Ο σταθμός Συγγρού-Φιξ του μετρό βρίσκεται σε απόσταση 6 λεπτών με τα πόδια. Το πλησιέστερο αεροδρόμιο είναι το Αεροδρόμιο Ελευθέριος Βενιζέλος, στα 35χλμ. από το κατάλυμα.\r\n\r\nΑυτό είναι το αγαπημένο μέρος των επισκεπτών μας στον προορισμό Αθήνα σύμφωνα με ανεξάρτητα σχόλια.','true','true','true','true','true','true','true','true','true','false','false','false','false','false','false'),('Centrotel Hotel','Αττικής','Αθήνα','Παιωνίου 11Α',2341264556,2,'username19','Το Centrotel Hotel βρίσκεται στο κέντρο της Αθήνας, μόλις 500μ. από τον σταθμό Λαρίσης και προσφέρει μοντέρνα καταλύματα με υδρομασάζ και δωρεάν ασύρματο internet.\r\n\r\nΤα δωμάτια στο Centrotel Hotel είναι άρτια εξοπλισμένα και χαρακτηρίζονται από σύγχρονο ντιζάιν. Περιλαμβάνουν κλιματισμό, μπανιέρα-υδρομασάζ, δορυφορική τηλεόραση και ψυγείο. Τα περισσότερα έχουν μπαλκόνι.\r\n\r\nΚαθημερινά σερβίρεται ευρωπαϊκό πρωινό στο δωμάτιο ή στην τραπεζαρία. Το ξενοδοχείο Centrotel αποτελεί την ιδανική βάση για να εξερευνήσετε την Αθήνα, παρέχοντας πρόσβαση στο μετρό και στον προαστιακό σιδηρόδρομο, αφού απέχει μόλις 300μ. από τον σταθμό Βικτώρια και 500μ. από τον σιδηροδρομικό σταθμό Λαρίσης. Διατίθεται δωρεάν ιδιωτικός υπόγειος χώρος στάθμευσης για οχήματα ύψους έως 1,80 μέτρων.','false','true','true','true','false','true','true','true','false','false','true','false','false','false','false'),('Crystal City Hotel','Αττικής','Αθήνα','Αχιλλέως 4, Πλατεία Καραϊσκάκη',2341567568,3,'username18','Το Crystal City Hotel βρίσκεται σε κεντρική τοποθεσία στην Αθήνα, σε απόσταση μόλις 100μ. από τον σταθμό Μεταξουργείο του μετρό. Προσφέρει δωρεάν Wi-Fi στους κοινόχρηστους χώρους και εστιατόριο στον τελευταίο όροφο με πανοραμική θέα στην πόλη.\r\n\r\nΤα κλιματιζόμενα δωμάτια στο Crystal City διαθέτουν τηλεόραση με δορυφορικά και καλωδιακά κανάλια, ψυγείο και θυρίδα ασφαλείας. Καθένα περιλαμβάνει ιδιωτικό μπάνιο με στεγνωτήρα μαλλιών. Ορισμένα δωμάτια έχουν μπαλκόνι με θέα στην Ακρόπολη.\r\n\r\nΚαθημερινά σερβίρονται μπουφές ευρωπαϊκού πρωινού και ελληνικό πρωινό. Το Athina Restaurant & Lounge προσφέρει ελληνικά πιάτα για μεσημεριανό γεύμα και δείπνο και έχει εκπληκτική θέα στην Ακρόπολη και στον λόφο του Λυκαβηττού. Στο μπαρ του τελευταίου ορόφου μπορείτε να απολαύσετε φρέσκα πιάτα της ελληνικής κουζίνας και αρτοσκευάσματα.\r\n\r\nΤο Crystal City απέχει 1χλμ. από την Πλάκα και 2χλμ. από την Ακρόπολη και το Εθνικό Αρχαιολογικό Μουσείο. Σε κοντινή απόσταση με τα πόδια θα βρείτε μουσεία, μπαρ και εστιατόρια.','false','true','true','false','false','true','true','true','true','false','true','false','false','false','false'),('Electra Palace Thessaloniki','Θεσσαλονίκης','Θεσσαλονίκη','Πλατεία Αριστοτέλους 9',2310923211,5,'username10','Το Electra Palace Thessaloniki είναι ένα εμβληματικό ξενοδοχείο 5 αστέρων στην καρδιά της Θεσσαλονίκης, στην εντυπωσιακή Πλατεία Αριστοτέλους. Στον τελευταίο όροφο βρίσκεται το εστιατόριο Orizontes Roof Garden Restaurant Bar με πανοραμική θέα στον Θερμαϊκό Κόλπο. Μπορείτε να χαλαρώσετε στην πισίνα του τελευταίου ορόφου ή να αναζωογονηθείτε στο σπα με τη θερμαινόμενη πισίνα. Στο ισόγειο θα βρείτε ένα lounge bar βρετανικού στυλ με τζάκι και καναπέδες Chesterfield.\r\n\r\nΤα δωμάτια και οι σουίτες του Electra Palace έχουν ξύλινα δάπεδα, ξύλινη επίπλωση και πολυτελείς κουρτίνες. Περιλαμβάνουν θυρίδα ασφαλείας μεγέθους φορητού υπολογιστή, μίνι μπαρ και δορυφορική τηλεόραση επίπεδης οθόνης. Τα μαρμάρινα μπάνια είναι εξοπλισμένα με μπανιέρα, μπουρνούζια, παντόφλες και δωρεάν προϊόντα περιποίησης.\r\n\r\nΣτο εστιατόριο του τελευταίου ορόφου σερβίρεται καθημερινά πλούσιο ελληνικό πρωινό με φρέσκα προϊόντα. Μπορείτε να θαυμάσετε την πανοραμική θέα στον Θερμαϊκό Κόλπο, στον Όλυμπο και στην πόλη. Για μεσημεριανό γεύμα ή δείπνο έχετε την ευκαιρία να δοκιμάσετε διάφορα μεσογειακά πιάτα συνοδευόμενα από ένα κοκτέιλ ή ένα μπουκάλι εκλεκτό κρασί. Το μπαρ Excelsior στο λόμπι είναι ιδανικό για να χαλαρώσετε μετά από μια γεμάτη ημέρα, πίνοντας ένα σπάνιο single malt ουίσκι ή ένα γαλλικό κονιάκ.\r\n\r\nΠαρέχονται 24ωρη ρεσεψιόν και υπηρεσία δωματίου. Σε αυτό το ξενοδοχείο 5 αστέρων θα βρείτε 5 αίθουσες συνεδριάσεων με σύγχρονο εξοπλισμό, καθώς και χώρο δεξιώσεων χωρητικότητας 350 ατόμων.\r\n\r\nΤο Electra Palace βρίσκεται σε ιδανική τοποθεσία, στο επιχειρηματικό, πολιτιστικό και εμπορικό κέντρο της πόλης. Στα δημοφιλή αξιοθέατα της περιοχής συμπεριλαμβάνονται μεταξύ άλλων ο Λευκός Πύργος και το Μουσείο Βυζαντινής Ιστορίας, ενώ η διάσημη περιοχή Λαδάδικα βρίσκεται σε κοντινή απόσταση με τα πόδια. Το Electra Palace απέχει 15χλμ. από το Διεθνές Αεροδρόμιο Μακεδονία, 1χλμ. από τον Κεντρικό Σιδηροδρομικό Σταθμό και 500μ. από το λιμάνι.','true','true','true','true','true','true','true','true','true','true','true','false','true','true','false'),('Grand Hyatt Athens Hotel','Αττικής','Αθήνα','Πλατεία Συγγρού 115',2345234534,5,'username15','Το Grand Hyatt Athens άνοιξε τον Αύγουστο του 2018. Προσφέρει ολοκαίνουριο σπα, αίθριο με πισίνα και μπαρ, καθώς και εκπληκτική θέα στην Ακρόπολη από τον τελευταίο όροφο. Διαθέτει επίσης κλιματιζόμενες μονάδες με κομψή επίπλωση και σύγχρονο τεχνολογικό εξοπλισμό, γυμναστήριο, κέντρο σπα και εστιατόριο.\r\n\r\nΌλα τα δωμάτια και οι σουίτες του Grand Hyatt Athens είναι διακοσμημένα με έργα μοντέρνας τέχνης και εξοπλισμένα με τηλεόραση επίπεδης οθόνης 55 ιντσών, επιφάνεια εργασίας και μίνι μπαρ. Περιλαμβάνουν μαρμάρινο μπάνιο με δωρεάν προϊόντα περιποίησης, μπουρνούζια και στεγνωτήρα μαλλιών, θυρίδα ασφαλείας και 24ωρη υπηρεσία δωματίου. Βάσει διαθεσιμότητας, το κατάλυμα μπορεί να σας παραχωρήσει φορητό υπολογιστή. Παρέχονται δωρεάν επιπλέον πετσέτες κατόπιν αιτήματος.\r\n\r\nΤα εστιατόρια του ξενοδοχείου σερβίρουν μεσογειακή και ασιατική κουζίνα. Στο καλαίσθητο μπαρ της πισίνας και στο lobby bar μπορείτε να απολαύσετε γνωστά κοκτέιλ. Προσφέρεται πρωινό νωρίς, ενώ έχετε τη δυνατότητα να πάρετε το πρωινό σας και σε πακέτο.\r\n\r\nΤο γυμναστήριο λειτουργεί καθημερινά, όλο το 24ωρο. Στο Grand Hyatt θα βρείτε ακόμα επιχειρηματικό κέντρο και αίθουσες συνεδριάσεων με υπερσύγχρονο εξοπλισμό, ιδανικές για ιδιωτικές ή εταιρικές εκδηλώσεις. Στην τιμή συμπεριλαμβάνονται υπηρεσία αχθοφόρου και υπηρεσία προετοιμασίας κρεβατιού.\r\n\r\nΗ διαδρομή για το Λιμάνι του Πειραιά διαρκεί 20 λεπτά με το αυτοκίνητο, ενώ το κέντρο της Αθήνας βρίσκεται σε κοντινή απόσταση, επίσης με το αυτοκίνητο. Η περίφημη Ακρόπολη είναι 3χλμ. μακριά. Το Διεθνές Αεροδρόμιο της Αθήνας απέχει 32χλμ. από το Grand Hyatt Athens.','true','true','true','true','true','true','true','true','true','true','true','false','true','true','true'),('Hotel Rex','Θεσσαλονίκης','Θεσσαλονίκη','Μοναστηρίου 39',2134123456,2,'username14','Το οικογενειακά διοικούμενο Hotel Rex βρίσκεται στο κέντρο της Θεσσαλονίκης, κοντά στο σιδηροδρομικό σταθμό και στο σταθμό των υπεραστικών λεωφορείων. Προσφέρει δωμάτια με μπαλκόνι, ενώ παρέχεται δωρεάν Wi-Fi σε όλους τους χώρους.\r\n\r\nΌλα τα καταλύματα στο Rex περιλαμβάνουν κλιματισμό, τηλεόραση και μίνι μπαρ. Έχουν ιδιωτικό μπάνιο με στεγνωτήρα μαλλιών και ντους.\r\n\r\nΞεκινήστε τη μέρα σας με το πρωινό που σερβίρεται στην τραπεζαρία του καταλύματος ή στο δωμάτιό σας. Στη γύρω περιοχή θα βρείτε διάφορα εστιατόρια, μπαρ και καφέ.\r\n\r\nΤο Διεθνές Αεροδρόμιο Μακεδονία είναι 15χλμ. μακριά. Σε κοντινή απόσταση υπάρχει δωρεάν δημόσιος χώρος στάθμευσης, ενώ παρέχεται ιδιωτικός χώρος στάθμευσης στης εγκαταστάσεις με πρόσθετη χρέωση.','true','true','true','false','false','true','true','false','false','false','true','false','false','false','false'),('Memories Beach Hotel','Κυκλάδων','Σαντορίνη','Βόθον 84700',2342341239,2,'username23','Στο όμορφο νησί της Σαντορίνης, το Memories Beach Hotel είναι ένα σύγχρονο ξενοδοχείο που προσφέρει εξαιρετικά καταλύματα δίπλα στο Αιγαίο.\r\n\r\nΤο Memories Beach Hotel βρίσκεται στην νοτιοανατολική ακτή της Σαντορίνης, στην ήσυχη περιοχή του Βόθου . Είναι ιδανικό μέρος για χαλαρωτικές διακοπές, όπου μπορείτε να απολαύσετε τα κρυστάλλινα νερά μαζί με τον ήλιο.\r\n\r\nΑπολαύστε δροσιστικά ποτά στο μπαλκόνι σας, ενώ θαυμάζετε τη θέα στη θάλασσα. Τα δωμάτια έχουν κλιματισμό και διαθέτουν ξεχωριστό μπάνιο με ανέσεις μπάνιου.','false','true','true','true','false','true','true','true','false','false','false','false','true','false','false'),('Olympic Hotel Santorini','Κυκλάδων','Σαντορίνη','Βόθον 84703',2341345364,4,'username22','Το Olympic Hotel Santorini προσφέρει εξωτερική πισίνα και ηλιόλουστη βεράντα με ξαπλώστρες. Βρίσκεται στον Βόθωνα της Σαντορίνης, σε απόσταση 10χλμ. από την Οία. Στις εγκαταστάσεις λειτουργεί μπαρ. Παρέχονται δωρεάν WiFi σε όλους τους χώρους και δωρεάν ιδιωτικός χώρος στάθμευσης.\r\n\r\nΤα δωμάτια στο Olympic περιλαμβάνουν τηλεόραση επίπεδης οθόνης και ιδιωτικό μπάνιο με μπανιέρα ή ντους. Θα βρείτε δωρεάν προϊόντα περιποίησης και στεγνωτήρα μαλλιών για μεγαλύτερη άνεση. Ορισμένα δωμάτια έχουν θέα στην πισίνα ή την πόλη.\r\n\r\nΟι επισκέπτες μπορούν να ξεκινήσουν τη μέρα τους με πρωινό που σερβίρεται καθημερινά στην τραπεζαρία. Η ρεσεψιόν του καταλύματος λειτουργεί όλο το 24ωρο.\r\n\r\nΣτο ξενοδοχείο διατίθεται επίσης υπηρεσία ενοικίασης ποδηλάτων. Το Olympic Hotel Santorini απέχει 3,1χλμ. από τα Φηρά και 3,5χλμ. από το Καμάρι. Το αεροδρόμιο της Σαντορίνης (Θήρα) είναι το πλησιέστερο, στα 2χλμ. από το Olympic Hotel Santo.','false','true','true','true','false','true','true','true','true','false','false','false','true','true','false'),('Plaza Hotel','Θεσσαλονίκης','Θεσσαλονίκη','Δοζέως και Παγκαίου 5',2314237565,3,'username11','Το Plaza Hotel βρίσκεται στην περιοχή Λαδάδικα, σε απόσταση μόλις 50μ. από το λιμάνι και κοντά στο κέντρο της πόλης. Διαθέτει κομψό μπαρ και δωρεάν Wi-Fi σε όλους τους χώρους.\r\n\r\nΌλα τα ζεστά διακοσμημένα καταλύματα παρέχουν κλιματισμό, τηλεόραση και μίνι μπαρ. Περιλαμβάνουν επίσης μπάνιο με στεγνωτήρα μαλλιών και δωρεάν προϊόντα περιποίησης.\r\n\r\nΚαθημερινά σερβίρεται μπουφές πρωινού με σπιτικές γεύσεις. Στις εγκαταστάσεις του Plaza Hotel λειτουργεί ένα καφέ-μπαρ Ristretto.\r\n\r\nΗ βολική τοποθεσία εξασφαλίζει εύκολη πρόσβαση και συνδέσεις με όλα τα σημεία της Θεσσαλονίκης, καθώς και απευθείας πρόσβαση σε εμπορικά κέντρα, κέντρα νυχτερινής διασκέδασης και παραδοσιακές ταβέρνες. Σε κοντινή απόσταση παρέχεται ιδιωτικός χώρος στάθμευσης με πρόσθετη χρέωση.','false','true','true','true','false','true','true','true','false','false','true','false','false','false','false'),('Rotonda Hotel','Θεσσαλονίκης','Θεσσαλονίκη','Μοναστηρίου 97',2314563462,3,'username12','Σε εξαιρετική τοποθεσία δίπλα στον κεντρικό σιδηροδρομικό σταθμό της Θεσσαλονίκης, το Rotonda Hotel προσφέρει σύγχρονα καταλύματα με δωρεάν μπουφέ πρωινού, δωρεάν χώρο στάθμευσης και δωρεάν Wi-Fi.\r\n\r\nΤα δωμάτια στο Rotonda είναι ευρύχωρα με δορυφορική τηλεόραση επίπεδης οθόνης, μικρό ψυγείο και μπαλκόνι. Όλα περιλαμβάνουν δωρεάν Wi-Fi, επιφάνεια εργασίας και θυρίδα ασφαλείας μεγέθους φορητού υπολογιστή.\r\n\r\nΤο Rotonda Hotel προσφέρει ρεσεψιόν 24ωρης λειτουργίας, ενώ οι επισκέπτες μπορούν να χρησιμοποιήσουν την υπηρεσία δωματίου κατά τη διαμονή τους.\r\n\r\nΤο Rotonda απέχει 2χλμ. ή 15 λεπτά με τα πόδια από την πλατεία Αριστοτέλους. Το αεροδρόμιο της Θεσσαλονίκης είναι εύκολα προσβάσιμο από τον κοντινό σταθμό λεωφορείων. Το κέντρο της πόλης βρίσκεται σε απόσταση μόλις 1 χιλιομέτρου.','true','true','false','true','false','true','true','true','true','true','true','false','false','true','false'),('Scorpios Beach Hotel','Κυκλάδων','Σαντορίνη','Μονόλιθος 84700',2365161375,4,'username24','Αυτό το μικρό και φιλόξενο ξενοδοχείο βρίσκεται σε μια προνομιακή τοποθεσία στον Μονόλιθο, μόλις 20μ. μακριά από την παραλία και σε μικρή απόσταση με τα πόδια από τον σταθμό λεωφορείων. Αυτό το κατάλυμα προσφέρει ένα χαλαρωτικό καταφύγιο. Οι επισκέπτες μπορούν επίσης να απολαύσουν υπηρεσία μεταφοράς και εκδρομές με επιπλέον χρέωση.\r\n\r\nΤο ξενοδοχείο είναι σε απόσταση 5χλμ. από την πόλη των Φηρών. Επίσης παρέχει μίνι λεωφορείο με επιπλέον χρέωση, για τους επισκέπτες που θέλουν να περιηγηθούν σε όλο το νησί. Επιπλέον, διατίθενται αθλητικές δραστηριότητες στην Παραλία Μονόλιθος με πρόσθετη χρέωση.\r\n\r\nΕπιστρέφοντας στο ξενοδοχείο, οι επισκέπτες μπορούν να χαλαρώσουν γύρω από την εξαιρετική πισίνα, μια ιδανική επιλογή για στιγμές χαλάρωσης μαζί με την παρέα τους. Εναλλακτικά, μπορούν να επιλέξουν την παραλία μαύρης άμμου και να συνοδεύσουν τα παιδιά τους στην απέναντι παιδική χαρά.\r\n\r\nΤο Hotel Scorpios είναι μια ιδανική επιλογή απόδρασης και διαθέτει φωτεινή, παραδοσιακή κυκλαδίτικη αρχιτεκτονική, εκπληκτική θέα στον ωκεανό και ζεστή οικογενειακή ατμόσφαιρα.','false','true','true','true','true','true','true','true','false','false','false','false','true','true','false'),('The Boathouse Hotel','Κυκλάδων','Σαντορίνη','Καμάρι 84700',2341457898,3,'username26','Το Boathouse Hotel είναι ένα κατάλυμα φιλικό προς το περιβάλλον, το οποίο βρίσκεται ακριβώς μπροστά στην παραλία του Καμαρίου. Διαθέτει εξωτερική πισίνα, επιπλωμένη ηλιόλουστη βεράντα, εστιατόριο και δωρεάν Wi-Fi στους κοινόχρηστους χώρους. Οι επισκέπτες φιλοξενούνται σε κλιματιζόμενα δωμάτια με μπαλκόνι.\r\n\r\nΤα δωμάτια του ξενοδοχείου περιλαμβάνουν επιφάνεια εργασίας, ιδιωτικό μπάνιο και δωρεάν προϊόντα περιποίησης. Υπάρχει επίσης ψυγείο.\r\n\r\nΣτο κατάλυμα σερβίρεται καθημερινά μπουφές πρωινού.\r\n\r\nΤο Οινοποιείο απέχει 3χλμ. από το Boathouse Hotel. Το Διεθνές Αεροδρόμιο της Σαντορίνης είναι 5χλμ. μακριά.','false','true','true','true','true','true','true','true','true','false','false','false','true','true','false'),('The Stanley','Αττικής','Αθήνα','Οδυσσέως 1,Πλατεία Καραϊσκάκη',2413245347,4,'username16','Το Stanley Hotel βρίσκεται σε βολική τοποθεσία στο κέντρο της Αθήνας, πολύ κοντά στον Σταθμό Μεταξουργείο του Μετρό. Διαθέτει πισίνα στον τελευταίο όροφο, καθώς και 2 εστιατόρια και 2 μπαρ. Το ένα από τα μπαρ είναι υπαίθριο και βρίσκεται στον τελευταίο όροφο. Το κατάλυμα προσφέρει κλιματιζόμενες μονάδες με δωρεάν WiFi και 24ωρη ρεσεψιόν.\r\n\r\nΤα δωμάτια του Stanley Hotel έχουν μοντέρνα διακόσμηση σε γήινες αποχρώσεις. Διαθέτουν δορυφορική τηλεόραση και μπαλκόνι. Επίσης περιλαμβάνουν ιδιωτικό μπάνιο με προϊόντα περιποίησης και στεγνωτήρα μαλλιών. Ορισμένα δωμάτια έχουν θέα στην Ακρόπολη. Η υπηρεσία δωματίου διατίθεται καθημερινά από τις 06:30 έως τις 01:30.\r\n\r\nΤο Icarus Restaurant ειδικεύεται στην ελληνική κουζίνα και σερβίρει πρωινό, μεσημεριανό γεύμα και δείπνο. Το εστιατόριο στον τελευταίο όροφο προσφέρει μεσογειακή και ελληνική κουζίνα και πανοραμική θέα στην πόλη, στην Ακρόπολη και στον Λόφο του Λυκαβηττού.\r\n\r\nΟι επισκέπτες μπορούν να χαλαρώσουν στην επιπλωμένη βεράντα του τελευταίου ορόφου με την πισίνα και τη θέα στην Ακρόπολη. Επιπλέον, μπορούν να απολαύσουν κοκτέιλ στο διπλανό μπαρ, το οποίο παρέχει θέα 360° στην Αθήνα.\r\n\r\nΗ Εμπορική Περιοχή της Οδού Ερμού απέχει 1χλμ. από το Stanley, ενώ το Μουσείο της Ακρόπολης είναι προσβάσιμο σε μόλις 5 λεπτά με το μετρό. Οι επισκέπτες μπορούν να επισκεφτούν πολλές παραλίες μέσα σε 30 λεπτά με το αυτοκίνητο. Το Stanley βρίσκεται εκτός του δακτυλίου της Αθήνας και συνδέεται πολύ εύκολα με τις εθνικές οδούς. Το Διεθνές Αεροδρόμιο Αθηνών είναι 36χλμ. μακριά. Στις εγκαταστάσεις παρέχεται ιδιωτικός χώρος στάθμευσης με πρόσθετη χρέωση.','true','true','true','true','true','true','true','true','false','true','true','false','true','false','false'),('Ξενοδοχείο Βύρων','Αττικής','Αθήνα','Βύρωνος 19',2433412341,2,'username20','Το Byron Hotel βρίσκεται ακριβώς κάτω από την Ακρόπολη, μόλις 50μ. από το σταθμό του μετρό και 100μ. από το νέο Μουσείο της Ακρόπολης.\r\n\r\nΤο Hotel Byron προσφέρει προνομιακή τοποθεσία στην Πλάκα, την παραδοσιακή περιοχή της Αθήνας με τα νεοκλασικά αρχοντικά και τις πολλές παραδοσιακές ταβέρνες και καφέ.\r\n\r\nΤα κλιματιζόμενα δωμάτια παρέχουν σύγχρονες ανέσεις, όπως internet. Ορισμένα έχουν επίσης υπέροχη θέα στην Ακρόπολη και τον διάσημο λόφο του Λυκαβηττού.\r\n\r\nΟι επισκέπτες που διαμένουν στο Byron μπορούν να επωφεληθούν από το δωρεάν Wi-Fi internet που διατίθεται σε όλους τους χώρους του ξενοδοχείου.\r\n\r\nΤο πρωινό σερβίρεται στον κήπο στον τελευταίο όροφο με ανεμπόδιστη θέα στην Ακρόπολη.','false','true','true','true','false','false','true','true','true','false','true','false','false','true','false');
/*!40000 ALTER TABLE `hotels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `images` (
  `idimages` varchar(38) DEFAULT NULL,
  `image_name` varchar(30) DEFAULT NULL,
  `image_caption` varchar(45) DEFAULT NULL,
  `hotels_TITLE` varchar(35) NOT NULL,
  `hotels_users_USERNAME` varchar(10) NOT NULL,
  PRIMARY KEY (`hotels_TITLE`,`hotels_users_USERNAME`),
  UNIQUE KEY `idimages` (`idimages`),
  UNIQUE KEY `idimages_2` (`idimages`),
  KEY `fk_images_hotels1_idx` (`hotels_TITLE`,`hotels_users_USERNAME`),
  CONSTRAINT `fk_images_hotels1` FOREIGN KEY (`hotels_TITLE`, `hotels_users_USERNAME`) REFERENCES `hotels` (`TITLE`, `users_USERNAME`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images`
--

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` VALUES ('{6691AED3-2231-4CCD-8227-25FD50D3FD04}','Anatolia Hotel.jpg','Πρόσοψη Anatolia Hotel','Anatolia Hotel','username13'),('{78E70E51-3B06-4E03-9F27-B6FC59566D6A}','Aqua Blue Beach Hotel.jpg','Μία από τις πισίνες του Aqua Blue Beach Hotel','Aqua Blue Beach Hotel','username25'),('{38E0C606-9E71-493B-84EB-88C3CB42F54A}','B4B Athens Signature Hotel.jpg','Θέα στην ακρόπολη από το ξενοδοχείο','B4B Athens Signature Hotel','username17'),('{7998A76F-7ACA-4D4F-848D-672405B9B3C4}','Centrotel Hotel.jpg','Η πρόσοψη του Centrotel Hotel','Centrotel Hotel','username19'),('{FC685F9D-29B4-461E-8548-15E4B70407A8}','Crystal City Hotel.jpg',' Η πρόσοψη του Crystal City Hotel','Crystal City Hotel','username18'),('{4585517A-4419-4583-97F1-DAE295683A68}','electra place.jpg','Πρόσοψη του Electra Palace','Electra Palace Thessaloniki','username10'),('{6D98DEEB-E4FA-4DF4-AD61-03F80C8D9192}','Grand Hyatt Athens Hotel.jpg','Πρόσοψη Grand Hyatt Athens Hotel','Grand Hyatt Athens Hotel','username15'),('{BF3FB4FD-5C4C-4EF8-8EA5-2F704382BB61}','Hotel Rex.jpg','Το κτίριο του Hotel Rex','Hotel Rex','username14'),('{B61FB694-FF41-436E-938B-7E49054D3510}','Memories Beach Hotel.jpg','Η θέα στην πισίνα του Memories Beach Hotel','Memories Beach Hotel','username23'),('{2F0963A7-63B7-49B1-8FA4-F6F00224635C}','Olympic Hotel Santorini.jpg','Πισίνα στο Olympic Hotel Santorini','Olympic Hotel Santorini','username22'),('{4D8000CC-292F-42AE-89A5-31D95CDB34A3}','Plaza Hotel.jpg','Δωμάτιο στο Plaza Hotel','Plaza Hotel','username11'),('{3E06276D-1E35-4598-8E37-E09AD405C96E}','Rotonda Hotel.jpg','Πρόσοψη του Rotonda Hotel','Rotonda Hotel','username12'),('{98BEB48F-A02B-4BDE-9A53-B2817FDAFB82}','Scorpios Beach Hotel.jpg','Πισίνα και μπάρ του Scorpios Beach Hotel ','Scorpios Beach Hotel','username24'),('{3BE619D1-B866-4439-802B-5365856ACC57}','The Boathouse Hotel.jpg','Θέα από πάνω του Boathouse Hotel','The Boathouse Hotel','username26'),('{B138487C-7785-4D8F-B2D5-9A1F0FA28DD7}','The Stanley.jpg','Πρόσοψη του The Stanley','The Stanley','username16'),('{8B03C95D-6E46-4398-B17F-70BC3FA449E7}','Ξενοδοχείο Βύρων.jpg','Θέα από το ξενοδοχείο Βύρων','Ξενοδοχείο Βύρων','username20');
/*!40000 ALTER TABLE `images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `USERNAME` varchar(10) NOT NULL,
  `PASSWORD` varchar(106) NOT NULL,
  `EMAIL` varchar(45) NOT NULL,
  `SALT` varchar(19) NOT NULL,
  `ACTIVATE_KEY` int(5) NOT NULL,
  `ISACTIVATED` tinyint(1) NOT NULL,
  PRIMARY KEY (`USERNAME`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('username10','$6$4683669805629638$4.rAOuansMgdaGcpGKxHHNKTUGhpJ2kqKCaWY4Tz90yV4u83KU4t2IlfVG.iQ8USIJYCYAdmFwv4ODFbsdGr40','test@gmail.com','$6$4683669805629638',87569,1),('username11','$6$8270926222764779$Xsa.byBRduy6i1YKXcVzhuYKVVgjwbFDiSDVegxx7D1MSjKzmnI6i03pzSr69ZD3t2gsQbwTRVfvOWvt3oJjt/','123dsafa@gmail.com','$6$8270926222764779',44682,1),('username12','$6$9411442131801554$JD8t5D3Jh68OZ53j.W/40JvoKyAUL3y1.3Gajm1MgyRzxJcPKA15yaj6H0Pue9aAzHIY3QKhzOO9XPHV5wQYA/','123sd@gmail.com','$6$9411442131801554',36958,1),('username13','$6$1402210443683451$PtbbuCmz0aP/J/USQm4bbhr89uRv69CpcCbjhdjul65wpUhXrbee4Rf4BgbKD.D8Jicn8UAFZtANKfAP.SLZ3.','412234@gmail.com','$6$1402210443683451',12426,1),('username14','$6$3157282645306951$klS31fMD8cys5DJ.hTesPUGxwCXzJujXMbdL8aYP0PBLCV9JBfl4rcd98h7NfpsRtv2wAJ5gH2ts0dv3Z1hJh0','41234@gmail.com','$6$3157282645306951',50392,1),('username15','$6$6030713088894106$vXiLbyophMl2/9Bafvb67R97Ts2MzzhWFIDNm8xEs35WFbVc32eGzLnyBogIcZXKVTwecMSC3GYgX8B9wPktE/','1dfsa@gmail.com','$6$6030713088894106',92871,1),('username16','$6$2098079195268838$lDL3xkxFzgf3GNdk4noZLFeI8O44r7bse/D8lMO/rbC46QYEdWuS91zjerg6CAhorowrVvAKp3np2yjUZu/sQ.','gsdfg@gmail.com','$6$2098079195268838',38704,1),('username17','$6$5717132939269008$r1plzXVrRBMIugUEDUbyp.JllPfV2h3GBGHyuEPooSFIRJujlalLt4FWDuFCXSAhNruCY4SzX9ruJMdxP1lA0.','123sdas@gmail.com','$6$5717132939269008',13466,1),('username18','$6$7269355826492838$pG4iYXIRyDfrMLmTUPu4FXqrx.PmI1ZO4ULZYAvJSz2NUOAguI0TEfXlY1.sHGnvgpEi4kyk/aTiw4BF/Fxei1','sdfgsd@gmail.com','$6$7269355826492838',71545,1),('username19','$6$9536447989471085$tcYXRebGc3dRAcTazOm2oV5MUtVDM9M2AolgZYYIoFxWlcY24.mFwBYYlIsjGiUD.q.WCSEyBII1NeRu5Of3w0','123dfsad@gmail.com','$6$9536447989471085',31040,1),('username20','$6$6931550940494718$Z2kCq8QD4M64oKQAcONDcyoxnxt.ZJtS/XtrK2x/MAMDwH0XHT7flDHLfYGw94f5wvYbiHmjfPhZ618TIad8G.','1232sdf@gmail.com','$6$6931550940494718',13463,1),('username21','$6$4583067541901454$PKNOD2m3MPcLyXt9rdbf3BdiVUuwCflnuZILaKOLvUhLhakfERr8jgUre3AISI2CJ93zTtCdsxdxjMc7fZlkm1','1232@gmail.com','$6$4583067541901454',75512,1),('username22','$6$4229155795343778$PlwL7FUEDvF93A3sEWiF9jkmYzyAwNTwKTzu.9tEB6GirjRsOJVrf6J/KvlQT60eVkEPmOSnDkj7Pe6nDFA7S.','fas@gmail.com','$6$4229155795343778',39260,1),('username23','$6$5090490185671182$S4WyEnI8hAHI6G/i9gD883trZd1HuzXS1qAKzyEPTy7rL4ATpYzSKHXgks5VjWEptZw0flI.Ys.G7t3JUuY2h.','fasd@gmail.com','$6$5090490185671182',46011,1),('username24','$6$9830896505192780$goBEGY0F2NN.DJvLj.5K3KvCfKEDZYehjsLZPz2x2PKAyLUlLrBJjYDxAATXMMf53Uz09OO6DbvjccyxmLucj.','fasdf@gmail.com','$6$9830896505192780',72591,1),('username25','$6$1554363554653260$OGQuKYsdz6FOd8wEHuqDgl//wPi5MKgvWbRkNRFa4VLkuaIi4h/KIcEZFd5PHL8bXTLPPjv46sPACplOwBQAj1','fas12df@gmail.com','$6$1554363554653260',78663,1),('username26','$6$1715829197740776$kQaG2umZHkCeJbaoKRubK.XzU/1M1fDq00TuxGbliWbGnSNbojKq8QQ2Ande3HQx.j50pQBG3FfEHDYFy.EM60','123dfs@gmail.com','$6$1715829197740776',35328,1);
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

-- Dump completed on 2021-06-11 17:10:11
