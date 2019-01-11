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
    setHeadingContent('tripSectionHeading', 'Опаа. Все още нямате пътешествия :/');
    return;
  }

  setHeadingContent('tripSectionHeading', 'Избери пътешествие, за да видиш детайли');
  addTripsAsOptions();
}

function setHeadingContent(headingId, content) {
  var heading = document.getElementById(headingId);
  heading.appendChild(document.createTextNode(content));
}

function addTripsAsOptions() {
  var select = document.getElementById('tripSelect');
  select.addEventListener('change', handleSelectChange);
  select.setAttribute('class', 'customSelect');

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
    var articleHeader = document.createElement('header');
    var articleH1 = document.createElement('h1');
    articleH1.setAttribute('class', 'mainArticleHeading');
    var h1content = `Пътешествие: ${event.target.value}`
    articleH1.appendChild(document.createTextNode(h1content));
    articleHeader.appendChild(articleH1);
    article.appendChild(articleHeader);


    var tripId = getTripIdByName(event.target.value);
    ajax(`../server/myTrips/getTripStops.php?tripId=${tripId}`, {
      success: addTripStopsToPage,
      error: console.error
    });
  }
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

    var articleHeader = document.createElement('header');
    var articleH1 = document.createElement('h2');
    articleH1.setAttribute('class', 'subArticleHeading');
    articleH1.appendChild(document.createTextNode(stopName));
    articleHeader.appendChild(articleH1);
    subArticle.appendChild(articleHeader);

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
