var form = document.getElementById('registerForm');
form.addEventListener('submit', validateAndHandleSubmit);

function validateAndHandleSubmit(event) {
  event.preventDefault();
  if (validateRegisterData()) {
    var formData = {
      username: form.elements[0].value,
      password: form.elements[1].value,
      confirmPassword: form.elements[2].value
    }
    handleSubmit('../server/register/', formData);
  }
}

function validateRegisterData() {
  var usernameField = form.elements[0];
  var pass1Field = form.elements[1];
  var pass2Field = form.elements[2];

  var usernameLabel = document.getElementById('username');
  var pass1Label = document.getElementById('pass1');
  var pass2Label = document.getElementById('pass2');

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

  if (pass1Field.value.match(/.{6,}/)) {
    pass1Label.textContent = '';
    pass1Label.setAttribute('class', 'hide');
  } else {
    pass1Label.textContent = 'Паролата трябва да е поне 6 символа';
    pass1Label.setAttribute('class', 'errorMessage');
    return false;
  }

  if (pass2Field.value != pass1Field.value) {
    pass2Label.textContent = 'Паролите трябва да съвпадат';
    pass2Label.setAttribute('class', 'errorMessage');
    return false;
  } else {
    pass2Label.textContent = '';
    pass2Label.setAttribute('class', 'hide');
  }

  return true;
}
