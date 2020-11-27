<?php

class LogModel extends Model
{
    public function getTodos() {
        $this->db->query("SELECT * FROM user_pass");
        return $this->db->fetchAll();
    }

    public function existeUsuario($user, $pass)
    {
        $this->db->validar(array('$user' => $user), array('$user' => TipoDato::ALFANUMERICO));
        $this->db->validar(array('$pass' => $pass), array('$pass' => TipoDato::ALFANUMERICO));
        $this->db->query("SELECT * FROM user_pass WHERE username='$user' AND password='$pass'");
        if ($this->db->numRows() != 1) return false;
        return true;
    }

    public function getUsuario($user, $pass) {
        $usuarioaux = new LogModel();
    	if (!$usuarioaux->existeUsuario($user, $pass)) die ('no existe este usuario');
        $this->db->query("SELECT * FROM user_pass WHERE username='$user' AND password='$pass'");
        return $this->db->fetch();
    }
}