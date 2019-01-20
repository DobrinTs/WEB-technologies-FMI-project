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
    hideResultLabel();

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

function hideResultLabel() {
  var resultLabel = document.getElementById('submitResultLabel');
  resultLabel.setAttribute('class', 'hide');
}

function hideTripArticle() {
  var article = document.getElementById('tripInfo');
  article.setAttribute('class', 'hide');
}

function showTripArticle() {
  var article = document.getElementById('tripInfo');
  article.setAttribute('class', 'tripArticle');
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
  stopArticle.setAttribute('class', 'stopArticle');

  var textSection = document.createElement('section');
  textSection.setAttribute('class', 'textSection');
  addSemanticalHeading(textSection, `Спирка ${stop.stopIndex}: ${stop.placeName}`);
  addParagraph(textSection, `Планиран час: ${stop.plannedTime}`)
  addTextArea(textSection, stop);
  stopArticle.appendChild(textSection);

  var imageSection = document.createElement('section');
  imageSection.setAttribute('class', 'imageSection');
  addImage(imageSection, stop);
  stopArticle.appendChild(imageSection);

  return stopArticle;
}

function addSemanticalHeading(parentElement, headingContent) {
  var header = document.createElement('header');
  parentElement.appendChild(header);

  var h2 = document.createElement('h2');
  header.appendChild(h2);
  h2.appendChild(document.createTextNode(headingContent));
}

function addParagraph(parentElement, paragraphContent) {
  var p = document.createElement('p');
  p.appendChild(document.createTextNode(paragraphContent));

  parentElement.appendChild(p);
}

function addTextArea(parentElement, stop) {
  var textAreaLabel = document.createElement('label');
  textAreaLabel.innerText = 'Коментари: ';

  var textArea = document.createElement('textarea');
  textArea.setAttribute('name', `stop${stop.stopIndex}comment`);
  textArea.setAttribute('form', 'saveCommentsForm');
  textArea.setAttribute('class', 'commentTextArea');
  textArea.setAttribute('placeholder', 'Въведи текст тук');
  textArea.setAttribute('rows', '5');
  textArea.innerText = stop.notes;

  textAreaLabel.appendChild(textArea);
  parentElement.appendChild(textAreaLabel);
}

function addImage(parentElement, stop) {
  var img = document.createElement('img');
  ajax(`../server/myTrips/getStopImage.php?stopId=${stop.id}`, {
    success: function(res) {
      setImageSrc(img, res)
    },
    error: console.error
  });
  img.setAttribute('id', `stop${stop.id}Image`);
  img.setAttribute('class', 'stopImage');
  parentElement.appendChild(img);

  var newImageLabel = document.createElement('label');
  newImageLabel.setAttribute('for', `imageInputStop${stop.id}`);
  newImageLabel.setAttribute('class', 'newImageLabel');
  newImageLabel.innerText = 'Качи ново изображение:';
  parentElement.appendChild(newImageLabel);

  var newImageInput = document.createElement('input');
  newImageInput.setAttribute('type', 'file');
  newImageInput.setAttribute('accept', 'image/png, image/jpeg');
  newImageInput.setAttribute('id', `imageInputStop${stop.id}`);
  newImageInput.addEventListener('change', handleImageInputChange, false);
  parentElement.appendChild(newImageInput);
}

function setImageSrc(img, res) {
  img.setAttribute('src', res);
}
