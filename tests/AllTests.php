<?php
if (!defined('PHPUnit_MAIN_METHOD')) {
    define('PHPUnit_MAIN_METHOD', 'HTML_Template_IT_AllTests::main');
}



require_once 'ITTest.php';
require_once 'ITXTest.php';


class HTML_Template_IT_AllTests
{
    private static $runner;

    public static function main()
    {
        $runner = new PHPUnit\TextUI\TestRunner;
        $runner->run(self::suite());
    }

    public static function suite()
    {
        $suite = new PHPUnit\Framework\TestSuite('HTML_Template_IT tests');

        $suite->addTestSuite('ITTest');
        $suite->addTestSuite('ITXTest');

        return $suite;
    }
}

if (PHPUnit_MAIN_METHOD == 'HTML_Template_IT_AllTests::main') {
    HTML_Template_IT_AllTests::main();
}
?>
