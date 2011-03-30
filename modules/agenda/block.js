$.get("modules/agenda/server.php", function(result) {
  result = eval('('+result+')');
  $("#block-agenda > ul").append("<li><a href=''><b>"+result.date+"</b> - "+result.event+"</a></li>");
});
// Events
$("#block-agenda > .more").click(function() {
  $('#content').load_view('agenda');
});

