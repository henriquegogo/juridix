var message = [];
var user = [];
var menu;

$.fn.extend({
  load_menu: function(items) {
    menu = this;
    menu.append("<ul></ul>");
    $.each(items, function(key, value) {
      var active = ((key == module) ? " class='active'" : "") ;
      $("ul", menu).append("<li"+active+"><a href='#"+key+"'><img src='modules/"+key+"/icon.png'><span> "+value+"</span></a></li>");
    });
    // Events
    $("ul > li > a", menu).click(function() {
      module = $(this).attr('href').substring(1);
      $('#content').load_view(module);
    });
  },
  load_view: function(module) {
    var where = this;
    location.hash = module;
    $("ul > li", menu).removeClass('active');
    $("ul > li:has(a[href='#"+module+"'])", menu).addClass('active');
    if (env.message) { $("#message").html("<div class='"+env.message.type+"'>"+env.message.text+"</div>"); }
    else { $("#message").html(""); }
    env.message = null;
    where.html('Carregando...');
    where.load("modules/"+module+"/view.html", function() {
      where.append("<script src='modules/"+module+"/view.js' type='text/javascript'></script>");
    });
  },
  load_block: function(modules_array) {
    var where = this;
    $.each(modules_array, function(index, module) {
      $.ajax({ type: "GET", url: "modules/"+module+"/block.html", async: false, success: function(block){
        where.append(block);
        where.append("<script src='modules/"+module+"/block.js' type='text/javascript'></script>");
      }});
    });
  }
});
