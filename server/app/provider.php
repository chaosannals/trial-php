<?php

// 容器Provider定义文件
return [
    'think\Request'          => app\basic\Request::class,
    'think\exception\Handle' => app\basic\ExceptionHandle::class,
];
