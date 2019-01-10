var form = document.getElementById('registerForm');
form.addEventListener('submit', validateAndHandleSubmit);

function validateAndHandleSubmit(event) {
  event.preventDefault();
  if (validate(event)) {
    handleSubmit(event);
  }
}

function validate(event) {
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

function handleSubmit(event) {
  var usernameField = form.elements[0];
  var pass1Field = form.elements[1];
  var pass2Field = form.elements[2];

  var formData = {
    username: usernameField.value,
    password: pass1Field.value,
    confirmPassword: pass2Field.value
  }

  var json = JSON.stringify(formData);

  ajax('../server/register/', {
    success: () => window.location.assign('../home'),
    error: formErrorHandler,
    method: 'POST',
    contentType: 'application/json',
    data: json
  });
}

function formErrorHandler(error) {
  console.log(error);
  var formError = document.getElementById('formError');
  formError.textContent = error;
  formError.setAttribute('class', 'errorMessage');
}
