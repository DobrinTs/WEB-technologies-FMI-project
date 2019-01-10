var registerButton = document.getElementById('registerButton');
registerButton.addEventListener('click', redirectToRegister);

function redirectToRegister() {
  window.location.assign('../register');
}


var form = document.getElementById('loginForm');
form.addEventListener('submit', validateAndHandleSubmit);

function validateAndHandleSubmit(event) {
  event.preventDefault();
  if (validateLoginData()) {
    var formData = {
      username: form.elements[0].value,
      password: form.elements[1].value,
    }
    handleSubmit('../server/login/', formData);
  }
}

function validateLoginData(event) {
  var usernameField = form.elements[0];
  var passwordField = form.elements[1];

  var usernameLabel = document.getElementById('username');
  var passwordLabel = document.getElementById('password');

  var nameRegex = /^\w{3,15}$/;
  if (usernameField.value.match(nameRegex) === null) {
    usernameLabel.textContent = 'Името трябва да съдържа само букви, цифри и _ и \
      да е между 3 и 15 символа дължина';
    usernameLabel.setAttribute('class', 'errorMessage');
    return false;
  } else {
    usernameLabel.textContent = '';
    usernameLabel.setAttribute('class', 'hide');
  }

  if (passwordField.value.match(/.{6,}/)) {
    passwordLabel.textContent = '';
    passwordLabel.setAttribute('class', 'hide');
  } else {
    passwordLabel.textContent = 'Паролата трябва да е поне 6 символа';
    passwordLabel.setAttribute('class', 'errorMessage');
    return false;
  }

  return true;
}
