var result = true; //έστω οτι όλα καλά
var errorString = ""; //αρχικοποίηση του μυνήματος
function validate_search() {
  //"Καθαρισμός" του error σε περιπτωση διόρθωσης
  if (errorString !== "") {
    errorString = "";
  }
  var result = true;
  var destination = document.getElementById("search_dest").value; //λήψη τιμών από την φόρμα αναζήτησης
  var state = document.getElementById("search_state").value;
  var stars = document.getElementById("search_stars").value;
  var rooms = document.getElementById("noofrooms").value;
  var city_selected = false; //έστω ότι δεν επιλέχθηκε καμία
  var state_selected = false; //παράμετρος αναζήτησης
  var stars_selected = false;
  var rooms_selected = false;
  if (
    destination == "Θεσσαλονίκη" ||
    destination == "Αθήνα" ||
    destination == "Σαντορίνη"
  ) {
    //εαν επιλέχθηκε μία από τις πόλεις
    city_selected = true;
  }
  if (state == "Θεσσαλονίκης" || state == "Αττικής" || state == "Κυκλάδων") {
    //εαν επιλέχθηκε ένας από τους νομούς
    state_selected = true;
  }
  if (stars > 0) {
    //εαν επιλέχθηκε αριθμός αστεριών
    stars_selected = true;
  }
  //εαν επιλέχθηκε μία από τις επιλογές δωματίων
  if (
    rooms == "rooms_opt_1" ||
    rooms == "rooms_opt_2" ||
    rooms == "rooms_opt_3" ||
    rooms == "rooms_opt_4" ||
    rooms == "rooms_opt_5"
  ) {
    rooms_selected = true;
  }
  //εαν δεν επιλέχθηκε τίποτα
  if (
    city_selected == false &&
    state_selected == false &&
    stars_selected == false &&
    rooms_selected == false
  ) {
    result = false; //επιστροφή false για την αποτροπή του submit
    //και δημιουργία κατάλληλου μηνήματος
    errorString =
      errorString +
      "Παρακαλώ επιλέξτε τουλάχιστον μία από τις επιλογές πριν κάνετε αναζήτηση!\n";
  }
  if (errorString !== "") {
    //εαν υπάρχει μυνημα
    alert(errorString); //δείξε το στο χρήστη
  }
  return result;
}
