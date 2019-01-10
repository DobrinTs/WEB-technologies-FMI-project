var addStopButton = document.getElementById('addStopButton');
addStopButton.addEventListener('click', addStop);

var nextStopIndex = 1;

function addStop() {
  var stopsSection = document.getElementById('stopsSection');

  var newStopFieldset = document.createElement('fieldset');
  newStopFieldset.setAttribute('class', 'inputGroup');

  var newStopNameField = document.createElement('input');
  newStopNameField.setAttribute('type', 'text');
  newStopNameField.setAttribute('placeholder', 'Enter location name');
  newStopNameField.setAttribute('name', `stop${nextStopIndex}name`);
  newStopFieldset.appendChild(newStopNameField);

  var newStopTimeField = document.createElement('input');
  newStopTimeField.setAttribute('type', 'datetime-local');
  newStopTimeField.setAttribute('name', `stop${nextStopIndex}time`);
  newStopFieldset.appendChild(newStopTimeField);

  stopsSection.appendChild(newStopFieldset);
  nextStopIndex++;
}
