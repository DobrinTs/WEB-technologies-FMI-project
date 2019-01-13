window.addEventListener('load', fetchMyTrips);
var trips;

function fetchMyTrips() {
  ajax('../server/myTrips/getAllMyTrips.php', {
    success: parseTrips,
    error: console.error,
  });
}

function parseTrips(tripsJSON) {
  trips = JSON.parse(tripsJSON);

  if (trips.length === 0) {
    setTripSectionHeading('Опаа. Все още нямате пътешествия :/');
    return;
  }

  setTripSectionHeading('Избери пътешествие, за да видиш детайли');
  addTripsAsOptions();
}

function setTripSectionHeading(content) {
  var heading = document.getElementById('tripSectionHeading');
  heading.appendChild(document.createTextNode(content));
}

function addTripsAsOptions() {
  var select = document.getElementById('tripSelect');
  select.setAttribute('class', 'customSelect');

  for (var i = 0; i < trips.length; i++) {
    select.appendChild(generateOption(trips[i].name));
  }
}

function generateOption(optionName) {
  var option = document.createElement('option');
  option.setAttribute('value', optionName);
  option.appendChild(document.createTextNode(optionName));

  return option;
}
