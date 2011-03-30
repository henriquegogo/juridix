$.get("modules/todo/server.php", function(result) {
  result = eval('(' + result + ')');
  $.each(result.todo, function(key, value) {
    $("#block-todo > ul").append("<li><a href=''>"+value+"</a></li>");
  });
  $.each(result.done, function(key, value) {
    $("#block-todo > ul").append("<li class='strike'><a href=''>"+value+"</a></li>");
  });
});

// Events
$("#block-todo > .more").click(function() {
  alert('Você deseja inserir');
});

