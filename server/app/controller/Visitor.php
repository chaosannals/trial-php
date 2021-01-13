<?php

namespace app\controller;

use app\BaseController;
use app\attribute\Permission;

#[Permission(Permission::TOLERANT, 'sign')]
class Visitor extends BaseController
{
    #[Permission(Permission::TOLERANT, 'visitor-query')]
    public function query()
    {
    }

    #[Permission(Permission::TOLERANT, 'visitor-add')]
    public function add()
    {
    }

    #[Permission(Permission::TOLERANT, 'visitor-drop')]
    public function drop()
    {
    }

    #[Permission(Permission::TOLERANT, 'visitor-edit')]
    public function edit()
    {
    }
}
