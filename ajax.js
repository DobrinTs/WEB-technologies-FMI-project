function ajax(url, settings) {
  var xhr = new XMLHttpRequest();
  xhr.onload = function() {
    if (xhr.status == 200) {
      settings.success(xhr.responseText);
    } else {
      settings.error(xhr.responseText);
    }
  };
  xhr.open(settings.method || 'GET', url, /* async */ true);
  if(settings.contentType) {
    xhr.setRequestHeader('Content-Type', settings.contentType)
  }
  xhr.send(settings.data || null);
}
