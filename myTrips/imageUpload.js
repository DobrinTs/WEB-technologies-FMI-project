function handleImageInputChange(event) {
  var formData = new FormData();
  var file = this.files[0];
  formData.append('file', file);
  formData.append('stopId', event.target.id.substring(14))

  ajax('../server/myTrips/uploadStopImage.php', {
    success: function(res) {
      console.log(res)
    },
    error: console.error,
    method: 'POST',
    data: formData
  });
}
