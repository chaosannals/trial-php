<?php

namespace Demo\Logsrv;

class LogAccountsDefault implements LogAccounts
{
    public function getPass($key)
    {
        return 'bbb';
    }
}
