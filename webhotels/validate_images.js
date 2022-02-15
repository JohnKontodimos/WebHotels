var result = true; //έστω οτι όλα καλά
var errorString = ""; //αρχικοποίηση του μυνήματος
function validate_images() {
  //"Καθαρισμός" του error σε περιπτωση διόρθωσης
  if (errorString !== "") {
    errorString = "";
  }
  var result = true;
  var image = document.getElementById("file").value; //λήψη του path της εικόνας
  var file = document.getElementById("file").files[0]; //λήψη του αρχείου (ιδιος πίνακας με php)
  var validExt = ["jpg"]; //ορίσμος πίνακα σώστων τύπων αρχείων
  var img_ext = image.substring(image.lastIndexOf(".") + 1); //λήψη του τύπου από το path
  //έλενχος έαν υπάρχει το extension του αρχείου που ανέβηκε στον πίνακα επιτρεπτών αρχείιων
  //(επιστρέφει true ή false αναλόγως εάν το βρήκε)
  var correct_ext = validExt.includes(img_ext);
  if (image == "") {
    //έλενχος εάν συμπληρώθηκε εικόνα
    result = false;
    errorString =
      errorString + "Η εικόνα είναι κενή! \nΠαρακαλώ επιλέξτε μία εικόνα.\n";
  }
  //έλενχος σωστού τύπου αρχείου
  if (correct_ext == false) {
    result = false;
    errorString =
      errorString +
      "Λάθος τύπος αρχείου! \nΠαρακαλώ επιλέξετε μόνο εικόνες τύπου JPG!\n";
  }
  //έλενχος σωστού μεγέθους αρχείου
  if (file.size > 300 * 1024) {
    result = false;
    errorString =
      errorString +
      "Μεγάλο μέγεθος αρχείου! \nΠαρακαλώ επιλέξετε μόνο εικόνες ως 300KB!\n";
  }
  var caption = document.getElementById("image_caption").value;
  if (caption.length > 45) {
    //έλενχος εάν συμπληρώθηκε λεζάντα
    result = false;
    errorString =
      errorString + "Η λεζάντα είναι πολύ μεγάλη! \nΜέχρι 45 χαρακτήρες\n";
  }
  if (errorString !== "") {
    //εαν υπάρχει μυνημα
    alert(errorString); //δείξε το στο χρήστη
  }
  return result;
}
