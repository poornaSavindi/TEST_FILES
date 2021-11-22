<?php
namespace Ninja;

interface Routes
{
  public function getRoute():array;
  public function getAuthentication():\Ninja\Authentication;
}
