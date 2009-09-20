<?php

require_once 'IT_usage_testcase.php';

class ITX_usage_testcase extends IT_usage_test
{
    function setUp()
    {
        $this->tpl = new HTML_Template_ITX('./templates');
    }
}
?>