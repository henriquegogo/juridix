$.get('/url.pl?http://www.jusbrasil.com.br/noticias/rss', function(xml) {
  var item = $(xml).find("item");
  for (var i = 0; i < 5; i++) {
    var title = $(item[i]).find("title").text();
    var link = $(item[i]).find("link").text();
    if (title) { $("#block-news > ul").append("<li><a href='"+link+"' target='_blank'>"+title+"</a></li>"); }
  }
});
// Events
$("#block-news > .more").click(function() {
  $('#content').load_view('news');
});
