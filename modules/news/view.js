// Jusbrasil
$("#list-news-jusbrasil").html("<li>Carregando...</li>");
$.get('/url.pl?http://www.jusbrasil.com.br/noticias/rss', function(xml) {
  $("#list-news-jusbrasil").html("");
  var item = $(xml).find("item");
  for (var i = 0; i < 10; i++) {
    var title = $(item[i]).find("title").text();
    var link = $(item[i]).find("link").text();
    var pubDate = $(item[i]).find("pubDate").text().substring(0,10).split('-').reverse().join('/');
    if (title) { $("#list-news-jusbrasil").append("<li>"+pubDate+" <a href='"+link+"' target='_blank'>"+title+"</a></li>"); }
  }
});

// Direito do Estado
$("#list-news-direitodoestado").html("<li>Carregando...</li>");
$.get('/url.pl?http://www.direitodoestado.com.br/rss/noticias.rss', function(xml) {
  $("#list-news-direitodoestado").html("");
  var item = $(xml).find("item");
  for (var i = 0; i < 10; i++) {
    var title = $(item[i]).find("title").text();
    var link = $(item[i]).find("link").text();
    var pubDate = $(item[i]).find("pubDate").text().substring(5,16).split(' ').join('/');
    if (title) { $("#list-news-direitodoestado").append("<li>"+pubDate+" <a href='"+link+"' target='_blank'>"+title+"</a></li>"); }
  }
});
