var db = {};
$.get('modules/db/server.php', function(result) { db = eval('('+result+')'); });

db.save = function() {
}
