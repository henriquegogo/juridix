$.get('modules/user/server.php', function(profile) {
  profile = eval('('+profile+')');
  jQuery.extend(env.user, profile);
});
$("#block-user").prepend("<b>" + env.user.email + "</b> | ");
// Events
$("#block-user > a[rel='profile']").click(function() {
  $('#content').load_view('user');
});
