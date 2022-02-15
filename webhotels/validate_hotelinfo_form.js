var errorString = "";
var result = true;

function check_limit(element1, limit, element2) {
  // διάβασε τι γράφει μέσα στο textarea
  var myText = document.getElementById(element1).value;

  // μέτρα το μήκος του (πόσοι χαρακτήρες είναι)
  var myTextLength = myText.length;

  // συνδέσου στο element2
  var counterElement = document.getElementById(element2);

  if (myTextLength > limit) {
    //αν το κείμενο ειναι μεγαλύτερο από limit
    // αντικατέστησε το κείμενο στο textarea με τους πρώτους limit χαρακτήρες
    document.getElementById(element1).value = myText.substr(0, limit);
    // βγάλε alert
    errorString = errorString + "Δεν επιτρέπεται παραπάνω κείμενο! \n";
    // τύπωσε σχετικό κείμενο στο element2
    counterElement.innerHTML =
      "Δεν μπορείτε να γράψετε πάνω από " + limit + " χαρακτήρες!";
  } else {
    // τύπωσε σχετικό κείμενο στο element2
    counterElement.innerHTML =
      "Απομένουν " + (limit - myTextLength) + " χαρακτήρες";
  }
}

function validate_hotelinfo_form() {
  //"Καθαρισμός" του error σε περιπτωση διόρθωσης
  if (errorString !== "") {
    errorString = "";
  }
  var result = true;
  var title = document.getElementById("title").value;
  if (title.length > 36) {
    result = false;
    errorString =
      errorString +
      "Ο τίτλος της επειχήρησης πρέπει να έχει μεχρι 36 χαρακτήρες! \n";
  }
  var state = document.getElementById("state").value;
  if (state.length > 16) {
    result = false;
    errorString =
      errorString +
      "Ο νομός της επειχήρησης πρέπει να έχει μεχρι 16 χαρακτήρες! \n";
  }
  var destination = document.getElementById("destination").value;
  if (destination.length > 30) {
    result = false;
    errorString =
      errorString +
      "Ο προορισμός της επειχήρησης πρέπει να έχει μεχρι 30 χαρακτήρες! \n";
  }
  var address = document.getElementById("address").value;
  if (address.length > 30) {
    result = false;
    errorString =
      errorString +
      "Η διεύθυνση της επειχήρησης πρέπει να έχει μεχρι 30 χαρακτήρες! \n";
  }
  //έλενχος σωστού τηλεφώνου
  var phone = document.getElementById("phone").value;
  if (
    isNaN(phone) ||
    (!isNaN(phone) && (phone.length > 10 || phone.length < 10))
  ) {
    result = false;
    errorString =
      errorString + "Το τηλέφωνο πρέπει να έχει νούμερα μέχρι 10 ψηφία ! \n";
  }
  //έλενχος εάν είναι τουλάχιστον μια από τις επιλογές των δωματίων επιλεγμένη
  var rooms_opt_1 = document.getElementById("rooms_opt_1").checked;
  var rooms_opt_2 = document.getElementById("rooms_opt_2").checked;
  var rooms_opt_3 = document.getElementById("rooms_opt_3").checked;
  var rooms_opt_4 = document.getElementById("rooms_opt_4").checked;
  var rooms_opt_5 = document.getElementById("rooms_opt_5").checked;
  if (
    rooms_opt_1 == false &&
    rooms_opt_2 == false &&
    rooms_opt_3 == false &&
    rooms_opt_4 == false &&
    rooms_opt_5 == false
  ) {
    result = false;
    errorString =
      errorString + "Επιλέξτε τουλάχιστον ένα από τον Αριθμό Δωματίων! \n";
  }
  //έλενχος εάν έχουν επιλεχθεί αστέρια
  var stars = document.getElementById("stars").value;
  if (stars < 1) {
    result = false;
    errorString = errorString + "Δεν επιλέξατε αστέρια! \n";
  }
  //έλενχος εάν είναι τουλάχιστον μια από τις επιλογές των παροχών επιλεγμένη
  var parking = document.getElementById("parking").checked;
  var wifi = document.getElementById("Wi-Fi").checked;
  var bar = document.getElementById("bar").checked;
  var restaurant = document.getElementById("restaurant").checked;
  var room_service = document.getElementById("room-service").checked;
  var reception = document.getElementById("24-hours-reception").checked;
  var pets = document.getElementById("pets").checked;
  var pool = document.getElementById("pool").checked;
  var ac = document.getElementById("ac").checked;
  var gym = document.getElementById("gym").checked;
  if (
    parking == false &&
    wifi == false &&
    bar == false &&
    restaurant == false &&
    room_service == false &&
    reception == false &&
    pets == false &&
    pool == false &&
    ac == false &&
    gym == false
  ) {
    result = false;
    errorString = errorString + "Επιλέξτε τουλάχιστον μία από τις παροχές! \n";
  }
  // Η περιγραφή ως 1100 χαρακτήρες
  var description = document.getElementById("hotel-description").value;
  if (description.length > 2000) {
    result = false;
    errorString = errorString + "Η περιγραφή να είναι ως 2000 χαρακτήρες! \n";
  }
  //η περιγραφή να μην είναι κενή
  if (description == "") {
    result = false;
    errorString =
      errorString + "Η περιγραφή πρέπει να είναι συμπληρωμένη και όχι κενή! \n";
  }
  if (errorString != "") {
    alert(errorString);
  }
  return result;
}
