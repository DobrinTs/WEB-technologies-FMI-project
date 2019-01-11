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
    setNoTripsSectionHeading();
    return;
  }

  setHeadingContent('tripSectionHeading', 'Избери пътешествие, за да видиш детайли');
  addTripsAsOptions();
}

function changeTripSectionHeading() {
  setHeadingContent('tripSectionHeading', 'Опаа. Все още нямате пътешествия :/');
}

function setHeadingContent(headingId, content) {
  var heading = document.getElementById(headingId);
  heading.appendChild(document.createTextNode(content));
}

function addTripsAsOptions() {
  var select = document.getElementById('tripSelect');
  select.addEventListener('change', handleSelectChange);
  select.setAttribute('class', '');

  var i;
  for (i = 0; i < trips.length; i++) {
    var newOption = document.createElement('option');
    newOption.setAttribute('value', trips[i].name);
    newOption.appendChild(document.createTextNode(trips[i].name));

    select.appendChild(newOption);
  }
}

function handleSelectChange(event) {
  var article = document.getElementById('tripInfo');
  if (event.target.value === "") {
    article.setAttribute('class', 'hide');
    return;
  } else {
    article.innerHTML = "";
    addHeaderToArticle(article, event.target.value);

    var tripId = getTripIdByName(event.target.value);
    ajax(`../server/myTrips/getTripStops.php?tripId=${tripId}`, {
      success: addTripStopsToPage,
      error: console.error
    });
  }
}

function addHeaderToArticle(article, headerText) {
  var articleHeader = document.createElement('header');
  var articleH1 = document.createElement('h1');
  articleH1.appendChild(document.createTextNode(headerText));
  articleHeader.appendChild(articleH1);
  article.appendChild(articleHeader);
}

function getTripIdByName(name) {
  for (var i = 0; i < trips.length; i++) {
    if (trips[i]['name'] === name) {
      return trips[i].id;
    }
  }
}

function addTripStopsToPage(stopsJSON) {
  var mainArticle = document.getElementById('tripInfo');
  mainArticle.setAttribute('class', '');
  var stops = JSON.parse(stopsJSON);

  for (var i = 0; i < stops.length; i++) {
    var subArticle = document.createElement('article');
    var stopName = `Спирка ${stops[i].stopIndex}: ${stops[i].placeName}`;
    addHeaderToArticle(subArticle, stopName);

    var stopTime = document.createElement('p');
    stopTime.appendChild(document.createTextNode(
      `Планиран час: ${stops[i].plannedTime}`
    ));
    subArticle.appendChild(stopTime);

    var notes = document.createElement('p');
    notes.appendChild(document.createTextNode(
      `Коментар: ${stops[i].notes}`
    ));
    subArticle.appendChild(notes);


    mainArticle.appendChild(subArticle);
  }
}
