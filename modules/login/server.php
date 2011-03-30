<?php
// Login
if ($_POST) {
  $result = $DB->GetRow("SELECT * FROM users WHERE email = '".addslashes($_POST[email])."' AND password = '".addslashes($_POST[password])."'");
  if (count($result)) {
    $_SESSION[id] = $result[id];
    $_SESSION[email] = $result[email];
    $_SESSION[message][type] = "msgOk";
    $_SESSION[message][text] = "Logado com sucesso";
  } else if ($_POST[logout]) {
    session_destroy();
    unset($_SESSION);
  } else {
    $_SESSION[message][type] = "msgError";
    $_SESSION[message][text] = "Usuário ou senha inválido";
  }
}

header("Location: ../../");
?>
