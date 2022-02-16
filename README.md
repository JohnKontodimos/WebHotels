## Κατασκευή Website αναζήτησης ξενοδοχείων (WebHotels)

Εργασία που κατασκευάστηκε στα πλαίσια διδασκαλίας προγραμματισμού διαδικτύου στη σχολή μου. 

## Περιεχόμενα

* [Σχετικά](#σχετικά)
* [Τι έμαθα](#τι-έμαθα)
* [Τεχνολογίες που χρησιμοποιήθηκαν](#τεχνολογίες-που-χρησιμοποιήθηκαν)
* [Λειτουργίες](#λειτουργίες)
* [Οδηγίες Εγκατάστασης](#οδηγίες-εγκατάστασης)
* [Άδεια](#άδεια)
* [Συγγραφέας](#συγγραφέας)

## Σχετικά

Αντικείμενο της εργασίας είναι η δημιουργία μιας αλληλεπιδραστικής web εφαρμογής που τροφοδοτείται με δεδομένα μέσω ενός REST API.

## Τι έμαθα

- Να υλοποίω και να χρησιμοποιώ REST API
- Να χρησιμοποιώ κάποιο PHP framework (Slim)
- Nα χρησιμοποιώ Leaflet JS και OpenStreetMaps
- Να χρησιμοποιώ κάποιου CSS framework (Bootstrap 5)
- Να δημιουργώ popup modal παράθυρα με το Bootstrap 5
- Nα δημιουργώ αλληλεπιδραστικές web εφαρμογές (με χρήση AJAX κλήσεων)
- Nα δημιουργώ stateless μηχανισμό login βασισμένος σε JWT (JSON Web Tokens)


## Τεχνολογίες που χρησιμοποιήθηκαν

**Client:** HTML, CSS, JavaScript

**Server:** XAMPP, WAMP, Apache, MySQL, PHP

## Λειτουργίες

- Δημιουργία Λογαριασμού με χρήση Captcha
- Ενεργοποίηση Λογαριασμού (Ο χρήστης λαμβάνει τον κωδικό ενεργοποίησης αμέσως μετά την εγγραφή στην οθόνη του)
- Διαπίστευση Χρήστη (login)
- Καταχώριση/Επεξεργασία Στοιχείων Ξενοδοχείων
- Μεταφόρτωση Εικόνας Ξενοδοχείου
- Αναζήτηση Ξενοδεοχείων και Προβολή Λεπτομερειών ενός Ξενοδοχείου
- Προτιμήσεις Χρήστη (Αλλαγή θέματος και διατήρηση του θέματος που επέλεξε ο χρήστης)
- AJAX λειτουργικότητα (έλενχος για υπάρχον email και username)

## Οδηγίες Εγκατάστασης

### Προαπαιτούμενα

Για να μπορέσετε να χρησιμοποιήσετε το project θα πρέπει πρώτα να έχετε εγκατεστημένο το [XAMPP](https://www.apachefriends.org/download.html) (Windows/Linux/OS X). 'Επειτα επειδή το project χρησιμοποιεί MySQL, θα πρέπει να αντικαταστήσετε την προεγκατεστημένη MariaDB με την MySQL σύμφωνα με τις οδηγίες [εδώ](https://gist.github.com/imron02/ea233267c6664345d1021866b91459d7). 


Εάν δεν θέλετε να κάνετε την παραπάνω διαδικασία μία άλλη εναλλακτική είναι το [WAMP](https://sourceforge.net/projects/wampserver/) (Μόνο για windows) καθώς είναι πιο εύρηστο και έχει προεγκατεστημένη την MySQL.

### XAMPP

Εαν χρησιμοποιείτε XAMPP πηγαίνετε στον φάκελο όπου εγκαταστήσατε το XAMPP και μετά πηγάινετε στο apache\conf\extra και εισάγετε: 

#### Αρχείο httpd-vhosts.conf
```bash
<VirtualHost *:80>
DocumentRoot "C:/xampp/htdocs"
ServerName localhost
</VirtualHost>

<VirtualHost *:80>
    DocumentRoot "C:/xampp/htdocs/webhotels.gr"
    ServerName webhotels.gr
	<Directory "C:/xampp/htdocs/webhotels.gr">
	AllowOverride All
    Require all granted
	</Directory>	
</VirtualHost>

```

*Σημείωση: Πρέπει να αλλάξετε το πρόθεμα C:/xampp σε όλες τις περιπτώσεις παραπάνω, εάν έχετε εγκαταστήσει το XAMPP σε άλλη τοποθεσία*

#### Εισαγωγή δεδομένων στο XAMPP με phpMyAdmin

Για να εισάγουμε δεδομένα στην MySQL του XAMPP πρεπει να μεταβείτε στον εξής σύνδεσμο:

[http://localhost/phpmyadmin/](http://localhost/phpmyadmin/)

Έπειτα κανουμε login ως root με κενό κωδικό πρόσβασης (αυτά είναι τα προεπιλεγμένα και αυτά χρησιμοιποιεί και η εφαρμογή,σε production φυσικά θα ήταν διαφορετικά για λόγους ασφάλειας). Στην συνέχεια κάνουμε κλίκ στην καρτέλα SQL. Από το αρχείο [εδώ](https://raw.githubusercontent.com/JohnKontodimos/WebHotels/main/webhotels_FULL_EXPORT.sql?token=GHSAT0AAAAAABRQ6E6WSWT2BR6USNWFRGOSYQWQFPA) αντιγράφουμε όλο το κείμενο του και το επικολλούμε στην καρτέλα SQL στο phpMyAdmin.

Τέλος, για να εισάγουμε τα δεδομένα πατάμε το κουμπί Go. 

Εφόσον ολοκληρωθεί κλείνουμε το παράθυρο με το phpMyAdmin. 

### WAMP

Εαν χρησιμοποιείτε WAMP μπορείτε εφόσον το έχετε ήδη ανοιχτό μπορείτε να κάνετε αριστερό κλικ στο εικονίδιο και πηγαίνετε το ποντίκι στο Apache και μετά κάνετε κλικ στο httpd-vhosts.conf (κάτω από Files & Documentation).
Αυτό θα σας ανοίξει το αρχείο στον επιλεγμένο text editor σας που ορίσατε κατα την διάρκεια της εγκατάστασης του WAMP, έτσι ώστε να μπορεσετε να το επεξεργαστείτε όπως παρακάτω: 

#### Αρχείο httpd-vhosts.conf
```bash
<VirtualHost *:80>
  ServerName localhost
  ServerAlias localhost
  DocumentRoot "${INSTALL_DIR}/www"
  <Directory "${INSTALL_DIR}/www/">
    Options +Indexes +Includes +FollowSymLinks +MultiViews
    AllowOverride All
    Require local
  </Directory>
</VirtualHost>

<VirtualHost *:80>
  DocumentRoot "${INSTALL_DIR}/www/webhotels.gr"
  ServerName webhotels.gr
	<Directory "${INSTALL_DIR}/www/webhotels.gr">
	  AllowOverride All
    Require all granted
	</Directory>	
</VirtualHost>
```
*Σημείωση: Σε αντίθεση με το XAMPP εδώ δε χρειάζεται να αλλάξουμε τίποτα, το αντιγράφουμε ως έχει παραπάνω.*
<br></br>

#### Εισαγωγή δεδομένων στο WAMP με phpMyAdmin

Για να εισάγουμε δεδομένα στην MySQL του WAMP πρεπει να μεταβείτε στον εξής σύνδεσμο:

[http://localhost/phpmyadmin/](http://localhost/phpmyadmin/)

Έπειτα κανουμε login ως root με κενό κωδικό πρόσβασης και με επιλογή την MySQL (αυτά είναι τα προεπιλεγμένα και αυτά χρησιμοιποιεί και η εφαρμογή,σε production φυσικά θα ήταν διαφορετικά για λόγους ασφάλειας). Στην συνέχεια κάνουμε κλίκ στην καρτέλα SQL. Από το αρχείο [εδώ](https://raw.githubusercontent.com/JohnKontodimos/WebHotels/main/webhotels_FULL_EXPORT.sql?token=GHSAT0AAAAAABRQ6E6WSWT2BR6USNWFRGOSYQWQFPA) αντιγράφουμε όλο το κείμενο του και το επικολλούμε στην καρτέλα SQL στο phpMyAdmin. 

Τέλος, για να εισάγουμε τα δεδομένα πατάμε το κουμπί Go. 

Εφόσον ολοκληρωθεί κλείνουμε το παράθυρο με το phpMyAdmin.

#### Αρχείο hosts του λειτουργικού συστήματος

Ανεξαρτήτως τι χρησιμοποιείτε είναι απαραίτητο να προσθέσετε στο αρχείο του λειτουργικού σας συστήματος  τις εξής εγγραφές:

```bash
127.0.0.1 webhotels.gr
```


### Τρέξτε το project τοπικά στον υπολογιστή σας

Εφόσον ακολουθήσαμε τα παραπάνω βήματα τώρα μπορούμε να τρέξουμε το project τοπικά στον υπολογιστή μας.

#### XAMPP
Πηγαίνετε στον φάκελο htdocs (εκεί αποθηκεύει το XAMPP τα αρχεία των web apps).

```bash
  cd htdocs
```
#### WAMP
Πηγαίνετε στον φάκελο www (εκεί αποθηκεύει το WAMP τα αρχεία των web apps) κάνοντας αριστερό κλίκ στο είκονίδιο του WAMP και έπειτα κάνετε κλίκ στην επιλογή **www directory**

Κάντε clone το project με το terminal (εφόσον έχετε πάει στον αντίστοιχο φάκελο από παραπάνω)

```bash
  git clone https://github.com/JohnKontodimos/WebHotels
```
Ή μπορείτε χειροκίνητα να αντιγράψετε τους φακέλους **webhotels.gr** μέσα στον φάκελο htdocs (για XAMPP) www (για WAMP) έφοσον κατεβάσατε τον κώδικα ως zip.

Έπειτα μπορείτε να ανοίξετε το site στον browser σας με το link:

[http://webhotels.gr/](http://webhotels.gr/)

**Σημείωση: Σιγουρευτείτε ότι έχετε PHP έκδοση 8.0 και παραπάνω για την σωστή λειτουργία της εφαρμογής!! Δείτε έδω: [phpinfo XAMP](http://localhost/dashboard/phpinfo.php), [phpinfo WAMP](http://localhost/?phpinfo=-1)**

Για να τεστάρετε τις κλήσεις στο Rest API μπορείτε να χρησιμοποιήσετε λογισμικό όπως το [Postman](https://www.postman.com/downloads/).
Έπειτα μπορείτε να χρησιμοποιήσετε τις [δοθέντες κλήσεις στο Rest API](#κλήσεις-rest-api).
<br><br/>
## Άδεια

[MIT](https://choosealicense.com/licenses/mit/)

## Συγγραφέας

[Ιωάννης Κοντοδήμος](https://github.com/JohnKontodimos)
