<?php
abstract class SingletonContainer
{

   private static $instancias = array();


   private function __construct()
   {
   }

   public static function getInstance()
   {

      $nombreClaseInvocadora = get_called_class();

      if (!isset(self::$instancias[$nombreClaseInvocadora])) {

         self::$instancias[$nombreClaseInvocadora] = new $nombreClaseInvocadora();
      }
      $instancia = self::$instancias[$nombreClaseInvocadora];

      return $instancia;
   }

   
}
