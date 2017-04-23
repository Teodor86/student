<?php
error_reporting(-1);
spl_autoload_register(function ($class) {
    // �������� ���� � ����� �� ����� ������
    $path = __DIR__ .'/'.$class . '.php';
	
	if (file_exists($path)) {
        require_once $path;
    }
});

/*���������� ����������*/
set_exception_handler(function($exception) {
    header('HTTP/1.1 503 Service Temporarily Unavailable');
    header('Status: 503 Service Temporarily Unavailable');
    error_log($exception->__toString(), 0);
    $pageTitle = "������";
    require_once '../views/error.php';
});

?>