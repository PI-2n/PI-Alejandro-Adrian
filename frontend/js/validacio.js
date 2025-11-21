document
  .getElementById("formContacte")
  .addEventListener("submit", function (event) {
    const name = document.getElementById("name").value;
    const email = document.getElementById("email").value;
    const telefon = document.getElementById("telefon").value;
    const regexTelefon = /^[0-9]{9}$/;

    if (name.length < 3) {
      alert("El name ha de tindre almenys 3 caràcters.");
      event.preventDefault();
    }

    if (!email.includes("@")) {
      alert("El correu ha de contindre un '@'.");
      event.preventDefault();
    }

    if (!regexTelefon.test(telefon)) {
      alert("El telèfon ha de tindre exactament 9 dígits numèrics.");
      event.preventDefault();
    }
  });
