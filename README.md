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

Αντικείμενο της εργασίας είναι η δημιουργία ενός website αναζήτησης ξενοδοχείων που τροφοδοτείται με δεδομένα από μία βάση δεδομένων MySQL.

Σε αυτή την εφαρμογή ο χρήστης μπορεί να βρεί το ξενοδοχείο που επιθυμεί στην περιοχή που θέλει. Όλα τα δεδομένα της εφαρμογής λαμβάνονται με PDO από την βαση δεδομένων.

Το project αποτελείται από ένα φάκελο που περιέχει το website (webhotels.gr) και ένα αρχείo SQL με export την db (schema και data).

## Τι έμαθα

- Να εξοικειωθώ με την CSS
- Να χρησιμοποιώ την JavaSCript για form validation
- Nα χρησιμοποιώ AJAX κλήσεις
- Να δημιουργώ σύστημα μεταφόρτωσης (upload) αρχείων και δημιουργία GUID (Globally Unique Identifier) για κάθε αρχείο
- Να δημιουργώ σύστημα εγγραφής και ενεργοποίησης λογιαριασμού χρήστη
- Nα δημιουργώ σύστημα σύνδεσης (login) με SESSION
- Nα δημιουργώ σύστημα αναζήτησης ξενοδοχείων και σελιδοποίησης των αποτελεσμάτων αναζήτησης


## Τεχνολογίες που χρησιμοποιήθηκαν

**Client:** HTML, CSS, JavaScript

**Server:** XAMPP, WAMP, Apache, MySQL 8.0.27, PHP 8.0.13

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

**Σημείωση: Σιγουρευτείτε ότι έχετε PHP έκδοση 8.0.13 και MySQL 8.0.27 για την σωστή λειτουργία της εφαρμογής!! Από το WAMP μπορείτε να την τσεκάρετε κατά την εγκατάσταση.
Επίσης όταν ανοίγετε το WAMP ή το XAMPP πρέπει να το ανοίγετε σαν διαχειριστής(Admin)!!**


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

**Σημείωση: Σιγουρευτείτε ότι έχετε PHP έκδοση 8.0.13 και MySQL 8.0.27 για την σωστή λειτουργία της εφαρμογής!! Από το WAMP μπορείτε να την τσεκάρετε κατά την εγκατάσταση. Ελέγξτε έδω: [phpMyAdmin](http://localhost/phpmyadmin/). Εαν δεν έχετε PHP έκδοση 8.0.13, μπορείτε να κάνετε αριστερό κλικ στο εικονίδιο στην γραμμή εργασίων και πηγαίνετε το ποντίκι στη PHP και μετά στο Version και έπειτα κάνετε κλίκ στο 8.0.13.**

Εαν χρησιμοποιείτε WAMP, εφόσον το έχετε ήδη ανοιχτό, μπορείτε να κάνετε αριστερό κλικ στο εικονίδιο στη γραμμή εργασιών και να πάτε το ποντίκι στο Apache. Μετά κάντε κλικ στο httpd-vhosts.conf (κάτω από Files & Documentation).
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

#### Απενεργοποίηση του XDEBUG Extension

Το XDEBUG Extension μας δείχνει warnings σχετικά με τον κώδικά μας. Όμως στην προκειμένη περίπτωση εμποδίζει την εμφάνιση του website μας καθώς μας δείχνει μυνήματα τα οποία δεν
αφορούν την λειτουργικότητα του. Επομένως θα πρέπει να το απενεργοποιήσουμε για καλύτερη εμφάνιση αλλά και για καλύτερες επιδόσεις στην σελίδα μας.

Εφόσον έχετε το WAMP ήδη ανοιχτό, κάντε αριστερό κλικ στο εικονίδιο στη γραμμή εργασιών και πάτε το ποντίκι στην PHP. Μετά κάντε κλικ στο php.ini (κάτω από Files & Documentation).
Αυτό θα σας ανοίξει το αρχείο στον επιλεγμένο text editor σας που ορίσατε κατα την διάρκεια της εγκατάστασης του WAMP, έτσι ώστε να μπορεσετε να το επεξεργαστείτε. 

Αντικαθιστούμε το παρακάτω (στο τέλος του αρχείου php.ini)
```
XDEBUG Extension
[xdebug]
zend_extension="c:/wamp64/bin/php/php8.0.13/zend_ext/php_xdebug-3.1.1-8.0-vs16-x86_64.dll"
xdebug.mode allowed are : off develop coverage debug gcstats profile trace
xdebug.mode =develop
xdebug.output_dir ="c:/wamp64/tmp"
xdebug.show_local_vars=0
xdebug.log="c:/wamp64/logs/xdebug.log"
xdebug.log_level=7
```

Με αυτό εδώ:
```
; XDEBUG Extension
; [xdebug]
; zend_extension="c:/wamp64/bin/php/php8.0.13/zend_ext/php_xdebug-3.1.1-8.0-vs16-x86_64.dll"
; xdebug.mode allowed are : off develop coverage debug gcstats profile trace
; xdebug.mode =develop
; xdebug.output_dir ="c:/wamp64/tmp"
; xdebug.show_local_vars=0
; xdebug.log="c:/wamp64/logs/xdebug.log"
; xdebug.log_level=7
```

Μετά επανακινήστε το WAMP.

#### Εισαγωγή δεδομένων στο WAMP με phpMyAdmin

Για να εισάγουμε δεδομένα στην MySQL του WAMP πρεπει να μεταβείτε στον εξής σύνδεσμο:

[http://localhost/phpmyadmin/](http://localhost/phpmyadmin/)

Έπειτα κανουμε login ως root με κενό κωδικό πρόσβασης και με επιλογή την MySQL (αυτά είναι τα προεπιλεγμένα και αυτά χρησιμοιποιεί και η εφαρμογή,σε production φυσικά θα ήταν διαφορετικά για λόγους ασφάλειας). Στην συνέχεια κάνουμε κλίκ στην καρτέλα SQL. Από το αρχείο [εδώ](https://raw.githubusercontent.com/JohnKontodimos/WebHotels/main/webhotels_FULL_EXPORT.sql?token=GHSAT0AAAAAABRQ6E6WSWT2BR6USNWFRGOSYQWQFPA) αντιγράφουμε όλο το κείμενο του και το επικολλούμε στην καρτέλα SQL στο phpMyAdmin. 

Τέλος, για να εισάγουμε τα δεδομένα πατάμε το κουμπί Go. 

Εφόσον ολοκληρωθεί κλείνουμε το παράθυρο με το phpMyAdmin.

#### Αρχείο hosts του λειτουργικού συστήματος

Ανεξαρτήτως τι χρησιμοποιείτε είναι απαραίτητο να προσθέσετε στο αρχείο του λειτουργικού σας συστήματος  τις εξής εγγραφές:

(π.χ. για Windows: C:\Windows\System32\drivers\etc\hosts)

```bash
127.0.0.1 webhotels.gr
```


### Τρέξτε το project τοπικά στον υπολογιστή σας

Εφόσον ακολουθήσαμε τα παραπάνω βήματα τώρα μπορούμε να τρέξουμε το project τοπικά στον υπολογιστή μας.

Κάντε clone το project με το terminal (σε ένα φάκελο της επιλογής σας)

```bash
  git clone https://github.com/JohnKontodimos/WebHotels
```
Έπειτα χειροκίνητα αντιγράψτε τον φακέλο **webhotels.gr** μέσα στον φάκελο htdocs (για XAMPP) ή στον φάκελο www (για WAMP).

Έπειτα μπορείτε να ανοίξετε το site στον browser σας με το link:

[http://webhotels.gr/](http://webhotels.gr/)

*Σημείωση: Σιγουρευτείτε ότι έχετε PHP έκδοση 8.0.13 και MySQL 8.0.27 για την σωστή λειτουργία της εφαρμογής!! Δείτε έδω: [phpMyAdmin](http://localhost/phpmyadmin/)*

## Άδεια

[MIT](https://choosealicense.com/licenses/mit/)

## Συγγραφέας

[Ιωάννης Κοντοδήμος](https://github.com/JohnKontodimos)
