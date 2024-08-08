<?php
namespace app\controller;

use app\basic\BaseController;
use app\attribute\Permission;

#[Permission(Permission::NONE)]
class Index extends BaseController
{
    public function index()
    {
        trace('aaaa', 'aaa');
        return 'aaa';
    }
}
