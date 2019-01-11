var addButton = document.getElementById('addButton');
addButton.addEventListener('click', addStop);

var nextStopIndex = 1;

function addStop() {
  var stopsSection = document.getElementById('stopsSection');
  stopsSection.setAttribute('class', 'customSection');

  var newStopFieldset = document.createElement('fieldset');
  newStopFieldset.setAttribute('class', 'customFieldset');
  newStopFieldset.innerHTML += `<legend> Спирка ${nextStopIndex}: </legend>`;

  var newStopNameField = document.createElement('input');
  newStopNameField.setAttribute('type', 'text');
  newStopNameField.setAttribute('placeholder', 'Enter location name');
  newStopNameField.setAttribute('name', `stop${nextStopIndex}name`);
  newStopNameField.setAttribute('class', 'inputField');
  newStopFieldset.appendChild(newStopNameField);

  var newStopTimeField = document.createElement('input');
  newStopTimeField.setAttribute('type', 'datetime-local');
  newStopTimeField.setAttribute('name', `stop${nextStopIndex}time`);
  newStopTimeField.setAttribute('class', 'inputField');
  newStopFieldset.appendChild(newStopTimeField);

  stopsSection.appendChild(newStopFieldset);
  nextStopIndex++;
}

var tripForm = document.getElementById('tripForm');
tripForm.addEventListener('submit', validateNameAndCreateTrip);

function validateNameAndCreateTrip(event) {
  event.preventDefault();
  var tripFormData = new FormData(tripForm);

  if (tripNameNotEmpty(tripFormData)) {
    var formDataKeyValues = {};
    for (var f of tripFormData) {
      var key = f[0];
      var value = f[1];
      formDataKeyValues[key] = value;
    }
    handleSubmit('../server/newTrip/', formDataKeyValues);

  } else {
    var formError = document.getElementById('formError');
    formError.textContent = 'Името не може да е празно';
    formError.setAttribute('class', 'errorMessage');
  }

}

function tripNameNotEmpty(tripFormData) {
  return tripFormData.get('tripName').length > 0;
}
