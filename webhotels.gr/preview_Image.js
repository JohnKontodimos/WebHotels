const previewImage = (e) => {
  //όταν δωθεί εικόνα
  const preview = document.getElementById("preview"); //στο image tag με id preview
  //δώσε του το DataURL από τον πίνακα files
  //και πέρνα το στην ιδιότητα src
  preview.src = URL.createObjectURL(e.target.files[0]);
  preview.onload = () => URL.revokeObjectURL(preview.src);
};
