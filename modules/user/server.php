<?php
if ($_POST && $_SESSION[id]) { update(); }
elseif ($_POST) { insert(); }
else { edit(); }

function edit() {
  global $DB, $_SESSION;

  $result = $DB->GetRow("SELECT * FROM users_profiles WHERE user_id = '$_SESSION[id]'");
  
  echo json_encode($result);
}

function update() {
  global $DB, $_SESSION, $_POST;

  $result = $DB->Execute("UPDATE users_profiles SET nome='$_POST[nome]', data_nascimento='$_POST[data_nascimento]', celular='$_POST[celular]', telefone='$_POST[telefone]', endereco='$_POST[endereco]' WHERE user_id = '$_SESSION[id]'");

  if ($result) {
    $_SESSION[message][type] = "msgOk";
    $_SESSION[message][text] = "Dados atualizados com sucesso";

    #echo json_encode($_SESSION[message]);
    header("Location: ../../");
  } else {
    $_SESSION[message][type] = "msgError";
    $_SESSION[message][text] = "Erro na atualização de usuário";

    #echo json_encode($_SESSION[message]);
    header("Location: ../../#user");
  }
}

function insert() {
  global $DB, $_SESSION, $_POST;

  $result = $DB->Execute("INSERT INTO users (email, password) VALUES ('$_POST[email]', '$_POST[password]')");

  if ($result) {
    $user_id = $DB->Insert_ID();
    $result = $DB->Execute("INSERT INTO users_profiles (user_id, nome, data_nascimento, celular, telefone, endereco)
                            VALUES ('$user_id', '$_POST[nome]', '$_POST[data_nascimento]', '$_POST[celular]', '$_POST[telefone]', '$_POST[endereco]')");
    
    $_SESSION[message][type] = "msgOk";
    $_SESSION[message][text] = "Usuário criado com sucesso";

    #echo json_encode($_SESSION[message]);
    header("Location: ../../");
  } else {
    $_SESSION[message][type] = "msgError";
    $_SESSION[message][text] = "Erro na criação de usuário";

    #echo json_encode($_SESSION[message]);
    header("Location: ../../#user");
  }
}
?>
