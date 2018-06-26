function getBaseUrl() {
    var l = window.location;
    var base_url = l.protocol + "//" + l.host + "/" + l.pathname.split('/')[1];
    return base_url;
}

$(document).ready(function() {
  setInterval( function () {
      $('#report_list').DataTable().ajax.reload(null, false);
  }, 15000);
});
