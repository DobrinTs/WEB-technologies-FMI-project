function handleSubmit(destPath, formData) {
  var json = JSON.stringify(formData);

  ajax(destPath, {
    success: () => window.location.assign('../home'),
    error: formErrorHandler,
    method: 'POST',
    contentType: 'application/json',
    data: json
  });
}

function formErrorHandler(error) {
  var formError = document.getElementById('formError');
  formError.textContent = error;
  formError.setAttribute('class', 'errorMessage');
}
