function handleImageInputChange(event) {
  var formData = new FormData();
  var file = this.files[0];
  formData.append('file', file);
  var stopId = event.target.id.substring(14);
  formData.append('stopId', stopId);

  ajax('../server/myTrips/uploadStopImage.php', {
    success: function(res) {
      refreshImage(stopId, res);
    },
    error: console.error,
    method: 'POST',
    data: formData
  });
}

function refreshImage(stopId, res) {
  var img = document.getElementById(`stop${stopId}Image`);
  img.setAttribute('src', res);
}
