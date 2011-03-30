<?php
// Connect into database and create active record
include('libraries/adodb5/adodb.inc.php');
include('libraries/adodb5/adodb-active-record.inc.php');
$DB = NewADOConnection("mysql://root:root@localhost/juridix");
// if ($_SERVER['HTTP_HOST'] == 'localhost') { $DB = NewADOConnection("mysql://root:root@localhost/juridix");
// } else { $DB = NewADOConnection("mysql://gogs:k4ju5oth@localhost/gogs_juridix"); }
$DB->SetFetchMode(ADODB_FETCH_ASSOC);
ADOdb_Active_Record::SetDatabaseAdapter($DB);

// Create class for tables
class user extends ADOdb_Active_Record{}

// Table relations
ADODB_Active_Record::ClassHasMany('user','profile','user_id');

// User...
$user = new user();

// Set logged
@session_start();

// Verify permissions and users options
if ($_SESSION[email]) {
  $env['name'] = "Jorge Pinheiro Advogados Associados";
  $env['modules'] = array('db','login','user','panel','agenda','money','todo','news','mobile');
  $env['start_module'] = "panel";
  $env['menu'] = array('panel'=>'Inicial','agenda'=>'Agenda','money'=>'Financeiro');
  $env['blocks'] = array('agenda','todo','news');
} else {
  $env['name'] = "Jorge Pinheiro Advogados Associados";
  $env['modules'] = array('login','user','news','mobile');
  $env['start_module'] = "login";
  $env['menu'] = array('login'=>'Login');
  $env['blocks'] = array('news');
}
$env['message'] = $_SESSION[message]; unset($_SESSION[message]);
$env['user']['email'] = $_SESSION[email];

// Call routes
$path = array_values(array_diff(explode("/", $_SERVER['REDIRECT_URL']),explode("/", $_SERVER['SCRIPT_NAME'])));
if (count($path) && (count($path) == 1 || in_array("$path[1]", $env['modules']))) {
  include(implode($path, "/"));
} else if (!count($path)) {
  include('template.html');
  echo "<script>var env = ".json_encode($env)."</script>";
} else {
  echo "Você não tem permissão";
}
?>
