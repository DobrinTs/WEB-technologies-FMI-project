function handleSubmit(destPath, formData) {
  var json = JSON.stringify(formData);

  ajax(destPath, {
    success: function() { window.location.assign('../myTrips') },
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
