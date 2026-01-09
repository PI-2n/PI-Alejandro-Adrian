document.addEventListener("DOMContentLoaded", () => {
  const form = document.querySelector("#registerForm");

  form.addEventListener("submit", (e) => {
    if (!validateRegisterForm()) {
      e.preventDefault();
    }
  });
});

function validateRegisterForm() {
  let isValid = true;

  const fields = [
    { input: document.querySelector("#name"), error: document.querySelector("#name").nextElementSibling },
    { input: document.querySelector("#lastName"), error: document.querySelector("#lastName").nextElementSibling },
    { input: document.querySelector("#email"), error: document.querySelector("#email").nextElementSibling },
    { input: document.querySelector("#username"), error: document.querySelector("#username").nextElementSibling },
    { input: document.querySelector("#password"), error: document.querySelector("#password").nextElementSibling },
    { input: document.querySelector("#password2"), error: document.querySelector("#password2").nextElementSibling }
  ];

  fields.forEach(field => {
    const msg = customErrorValidationMessage(field.input);
    field.error.textContent = msg;

    if (msg !== "") {
      field.input.classList.add("is-invalid");
      isValid = false;
    } else {
      field.input.classList.remove("is-invalid");
    }
  });

  const password = document.querySelector("#password");
  const password2 = document.querySelector("#password2");
  const password2Error = password2.nextElementSibling;

  if (password.value !== password2.value && password2.value !== "") {
    password2Error.textContent = "Las contraseñas no coinciden";
    password2.classList.add("is-invalid");
    isValid = false;
  }

  return isValid;
}

function customErrorValidationMessage(input) {
  if (input.checkValidity()) return "";

  if (input.validity.valueMissing) {
    switch (input.id) {
      case "username":
        return "Debe introducir un nombre de usuario";
      case "email":
        return "Debe introducir un correo electrónico";
      case "password":
        return "Debe introducir una contraseña";
      case "password2":
        return "Debe repetir la contraseña";
      case "name":
        return "Debe introducir su nombre";
      case "lastName":
        return "Debe introducir sus apellidos";
      default:
        return "Campo obligatorio";
    }
  }

  if (input.id === "email" && input.validity.typeMismatch) {
    return "Debe introducir un email válido";
  }

  return "Error en el campo";
}
