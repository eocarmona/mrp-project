<?php namespace App\SUtils;

/**
 *
 */
class SMenu
{
    private $iMenu;
    private $sClassNav;

    function __construct($menu, $class)
    {
        $this->iMenu = $menu;
        $this->sClassNav = $class;
    }

    public function getMenu()
    {
      return $this->iMenu;
    }

    public function setMenu($menu = '0')
    {
      $this->iMenu = $menu;
    }

    public function getClassNav()
    {
      return $this->sClassNav;
    }

    public function setClassNav($class = '')
    {
      $this->sClassNav = $class;
    }
}
