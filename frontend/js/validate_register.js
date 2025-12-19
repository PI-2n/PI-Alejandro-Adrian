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

  const username = document.querySelector("#username");
  const usernameError = username.nextElementSibling;

  const email = document.querySelector("#email");
  const emailError = email.nextElementSibling;

  const password = document.querySelector("#password");
  const passwordError = password.nextElementSibling;

  const password2 = document.querySelector("#password2");
  const password2Error = password2.nextElementSibling;

  const nameInput = document.querySelector("#name");
  const nameError = nameInput.nextElementSibling;

  const lastName = document.querySelector("#lastName");
  const lastNameError = lastName.nextElementSibling;

  const usernameMsg = customErrorValidationMessage(username);
  const emailMsg = customErrorValidationMessage(email);
  const passwordMsg = customErrorValidationMessage(password);
  const password2Msg = customErrorValidationMessage(password2);
  const nameMsg = customErrorValidationMessage(nameInput);
  const lastNameMsg = customErrorValidationMessage(lastName);

  usernameError.textContent = usernameMsg;
  emailError.textContent = emailMsg;
  passwordError.textContent = passwordMsg;
  password2Error.textContent = password2Msg;
  nameError.textContent = nameMsg;
  lastNameError.textContent = lastNameMsg;

  if (password.value !== password2.value) {
    password2Error.textContent = "Las contraseñas no coinciden";
    isValid = false;
  }

  if (usernameMsg !== "") isValid = false;
  if (emailMsg !== "") isValid = false;
  if (passwordMsg !== "") isValid = false;
  if (password2Msg !== "") isValid = false;
  if (nameMsg !== "") isValid = false;
  if (lastNameMsg !== "") isValid = false;

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
