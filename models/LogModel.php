<?php

class LogModel extends Model
{
    public function existeUsuario($user, $pass)
    {
        $this->db->validar(array('$user' => $user), array('$user' => TipoDato::ALFANUMERICO));
        $this->db->validar(array('$pass' => $pass), array('$pass' => TipoDato::ALFANUMERICO));
        $password=sha1($pass);
        $this->db->query("SELECT * FROM user_pass WHERE username = '$user' AND password = '$password' ");
        if ($this->db->numRows() != 1) return false;
        return true;
    }

    public function getDatosByUsuario($user, $pass) {
        $usuarioaux = new LogModel();
    	if (!$usuarioaux->existeUsuario($user, $pass)) throw new DefaultException ('no existe este usuario');
        $password=sha1($pass);
        $this->db->query("SELECT * FROM user_pass WHERE username='$user' AND password='$password' ");
        return $this->db->fetch();
    }
}