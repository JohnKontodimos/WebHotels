var result = true;
var errorString = "";
function looks_like_email(str) {
  var result = true; //έστω ότι όλα είναι καλά - θα κάνουμε διάφορους ελέγχους και
  //εφόσον κάποιος βγάζει πρόβλημα, θα βάλουμε result=false.
  var ampersatPos = str.indexOf("@"); //η θεση του @ στο str
  var dotPos = str.indexOf("."); //η θεση της . στο str
  var dotPosAfterAmpersat = str.indexOf(".", ampersatPos); //θεση της . μετά το @
  // αν το @ δεν βρεθεί, η indexOf επιστρέφει -1 ενώ αν είναι πρώτος χαρακτήρας
  // επιστρέφει 0. Σε κάθε περίτπωση δεν είναι αποδεκτό email
  if (ampersatPos <= 0) result = false;
  // αν δεν υπάρει καθόλου τελεία δεν είναι email
  if (dotPos < 0) result = false;
  // αν δεν υπάρχει . μετά το @ αλλά όχι αμέσως μετά, τότε δεν είναι email
  if (dotPosAfterAmpersat - ampersatPos == 1) result = false;
  // αν ο πρώτος ή ο τελευταίος χαρακτήρας είναι . τότε δεν είναι email
  if (str.indexOf(".") == 0 || str.lastIndexOf(".") == str.length - 1)
    result = false;
  return result;
}
function initAJAX() {
  if (window.XMLHttpRequest) {
    // all modern browsers
    return (xmlhttp = new XMLHttpRequest());
  } else if (window.ActiveXObject) {
    //for IE5, IE6
    return (xmlhttp = new ActiveXObject("Microsoft.XMLHTTP"));
  } else {
    //AJAX not supported
    alert("Your browser does not support AJAX calls!");
    return false;
  }
}
function AJAXcallusername() {
  var ajaxObject = initAJAX();
  var username = document.getElementById("username").value;
  if (ajaxObject) {
    var url = "validate_username.php?username=" + username;
    ajaxObject.open("GET", url, true);
    ajaxObject.send();
    ajaxObject.onreadystatechange = function () {
      if (ajaxObject.readyState == 4 && ajaxObject.status == 200) {
        var myerror = document.getElementById("register_username_error");
        myerror.innerHTML = ajaxObject.responseText;
      }
    };
  }
}
function AJAXcallemail() {
  var ajaxObject = initAJAX();
  var email = document.getElementById("email").value;
  if (ajaxObject) {
    var url = "validate_email.php?email=" + email;
    ajaxObject.open("GET", url, true);
    ajaxObject.send();
    ajaxObject.onreadystatechange = function () {
      if (ajaxObject.readyState == 4 && ajaxObject.status == 200) {
        var emailerror = document.getElementById("register_email_error");
        emailerror.innerHTML = ajaxObject.responseText;
      }
    };
  }
}
function validate_form() {
  var result = true;
  var username = document.getElementById("username").value;
  var username_error = document.getElementById("register_username_error");
  // Ακολουθεί regular expression που περιγράφει τους μη επιτρεπτούς χαρακτήρες.
  // Έστω ότι μη επιτρεπτοί είναι όλα εκτός από 0-9, A-Z, a-z, _ (κάτω παύλα)
  var illegalChars = new RegExp("/W/");
  // αν υπάρχει στο username μη επιτρεπτός χαρακτήρας ή το μήκος είναι < 8 ή >20
  // ΠΡΟΣΟΧΗ: Ο περιορισμός του 8 μπαίνει γιατί πρόκειται για φόρμα εγγραφής.
  // Σε φόρμα login δεν θα πρέπει να βάζετε κανενός είδους βοήθεια
  // καθώς έτσι βοηθάτε τον κακόβουλο χρήστη.
  if (
    illegalChars.test(username) ||
    username.length < 8 ||
    username.length > 10
  ) {
    //σημείωσε ότι υπάρχει πρόβλημα
    result = false;
    //ενημέρωσε τον χρήστη με alert
    //Προσέξτε την δυνατότητα αλλαγή γραμμής με \n μέσα στο alert box
    username_error.innerHTML = "Στο username απαιτούνται 8 ως 10 χαρακτήρες!";
  }
  if (username_error.innerHTML != "") {
    //έλενχος εαν η ajax επέστρεψε μύνημα οτι το username υπάρχει ήδη
    result = false;
  }
  // ----- να έχει καταχωρηθεί password τουλάχιστον από 8 ως 20 χαρακτήρες --------------
  // ΠΡΟΣΟΧΗ: το password θα πρέπει να επιβάλεται να είναι πιο πολύπλοκο
  // και φυσικά να υπάρχουν και οι σχετικοί έλεγχοι (πχ να έχει πεζά και
  // κεφαλαία γράμματα, αριθμούς, κάποιο σύμβολο, κτλ στη λογική του regular
  // expression που είδαμε παραπάνω.
  var password = document.getElementById("password").value;
  var password_error = document.getElementById("register_password_error");
  var illegalpasswordChars = new RegExp("/W/");
  if (
    illegalpasswordChars.test(password) ||
    password.length < 8 ||
    password.length > 20
  ) {
    //σημείωσε ότι υπάρχει πρόβλημα
    result = false;
    //ενημέρωσε τον χρήστη
    password_error.innerHTML = "Στο password απαιτούνται 8 ως 20 χαρακτήρες!";
  }
  var email = document.getElementById("email").value;
  var email_error = document.getElementById("register_email_error");
  if (email.length > 45) {
    result = false;
    email_error.innerHTML = "Το email πρέπει να έχει ως 45 χαρακτήρες! \n";
  }
  if (!looks_like_email(email)) {
    result = false;
    email_error.innerHTML = "Το email δεν είναι αποδεκτό!";
  }
  if (email_error.innerHTML != "") {
    //έλενχος εαν η ajax επέστρεψε μύνημα οτι το email υπάρχει ήδη
    result = false;
  }
  return result;
}
