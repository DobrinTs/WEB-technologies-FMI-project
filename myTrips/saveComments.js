var commentsForm = document.getElementById('saveCommentsForm');
commentsForm.addEventListener('submit', handleCommentsSubmit);

function handleCommentsSubmit(event) {
  event.preventDefault();
  var data = {
    tripName: document.getElementById('tripSelect').value,
    comments: {}
  };
  for (var idx in commentsForm.elements) {
    var el = commentsForm.elements[idx];
    if (el.type === 'textarea') {
      var stopIdx = el.name[4];
      data.comments[stopIdx] = el.value;
    }
  }

  var json = JSON.stringify(data);
  ajax('../server/myTrips/saveComments.php', {
    success: function(res) {
      console.log(res)
    },
    error: function(res) {
      console.error(res)
    },
    method: 'PATCH',
    contentType: 'application/json',
    data: json
  });
}
