var select = document.getElementById('tripSelect');
select.addEventListener('change', handleSelectChange);

function handleSelectChange(event) {
  var selectedOption = event.target.value;
  if (selectedOption === "") {
    hideTripArticle();
  } else {
    showTripArticle();
    setTripHeading(`Пътешествие: ${selectedOption}`);
    clearPreviousStops();

    ajax(`../server/myTrips/getTripStops.php?tripName=${selectedOption}`, {
      success: addTripStopsToPage,
      error: console.error
    });
  }
}

function clearPreviousStops() {
  var stopsSection = document.getElementById('tripStops');
  stopsSection.innerHTML = "";
}

function hideTripArticle() {
  var article = document.getElementById('tripInfo');
  article.setAttribute('class', 'hide');
}

function showTripArticle() {
  var article = document.getElementById('tripInfo');
  article.setAttribute('class', 'tripInfo');
}

function setTripHeading(headingContent) {
  var tripArticleHeading = document.getElementById('tripArticleHeading');
  tripArticleHeading.innerText = headingContent;
}

function addTripStopsToPage(stopsJSON) {
  var stops = JSON.parse(stopsJSON);
  var stopsSection = document.getElementById('tripStops');

  for (var i = 0; i < stops.length; i++) {
    var stopArticle = generateStopArticle(stops[i]);
    stopsSection.appendChild(stopArticle);
  }
}

function generateStopArticle(stop) {
  var stopArticle = document.createElement('article');
  addSemanticalHeading(stopArticle, `Спирка ${stop.stopIndex}: ${stop.placeName}`);
  addParagraph(stopArticle, `Планиран час: ${stop.plannedTime}`)
  addParagraph(stopArticle, `Коментар: ${stop.notes}`)

  return stopArticle;
}

function addSemanticalHeading(parentElement, headingContent) {
  var header = document.createElement('header');
  parentElement.appendChild(header);

  var h2 = document.createElement('h2');
  header.appendChild(h2);
  h2.setAttribute('class', 'subArticleHeading');
  h2.appendChild(document.createTextNode(headingContent));
}

function addParagraph(parentElement, paragraphContent) {
  var p = document.createElement('p');
  p.appendChild(document.createTextNode(paragraphContent));

  parentElement.appendChild(p);
}
