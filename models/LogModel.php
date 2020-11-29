<?php

class LogModel extends Model
{
    public function getTodos() {
        $this->db->query("SELECT * FROM user_pass");
        return $this->db->fetchAll();
    }

    public function hash($pass) {
        $this->db->query("SELECT sha1($pass) as hash");
        return $this->db->fetch();
    }

    public function existeUsuario($user, $pass)
    {
        $this->db->validar(array('$user' => $user), array('$user' => TipoDato::ALFANUMERICO));
        $this->db->query("SELECT * FROM user_pass WHERE username='$user' AND password='$pass'");
        if ($this->db->numRows() != 1) return false;
        return true;
    }

    public function getUsuario($user, $pass) {
        $usuarioaux = new LogModel();
    	if (!$usuarioaux->existeUsuario($user, $pass)) die ('no existe este usuario');
        $this->db->query("SELECT * FROM user_pass join sucursales WHERE username='$user' AND password='$pass' and user_pass.idempresas=sucursales.idempresas");
        return $this->db->fetch();
    }
}