<?php

class IT_bugs_TestCase extends PHPUnit_TestCase
{
   /**
    * An HTML_Template_IT object
    * @var object
    */
    var $tpl;

    function IT_api_TestCase($name)
    {
        $this->PHPUnit_TestCase($name);
    }

    function setUp()
    {
        $this->tpl =& new HTML_Template_IT('./templates');
    }

    function tearDown()
    {
        unset($this->tpl);
    }

    /**
     * Test for bug #9501. preg_replace treat $<NUM> and \<NUM> as
     * backreferences. IT escapes them.
     *
     */
    function testBug9501() 
    {
        $this->tpl->setTemplate("Test: {VALUE}");
        $this->tpl->clearCache = true;

        $this->tpl->setVariable("VALUE", '$12.34');
        $this->assertEquals('Test: $12.34', $this->tpl->get());

        $this->tpl->setVariable("VALUE", '$1256.34');
        $this->assertEquals('Test: $1256.34', $this->tpl->get());

        $this->tpl->setVariable("VALUE", '^1.34');
        $this->assertEquals('Test: ^1.34', $this->tpl->get());
        
        $this->tpl->setVariable("VALUE", '$1.34');
        $this->assertEquals('Test: $1.34', $this->tpl->get());
     
        $this->tpl->setVariable("VALUE", '\$12.34');
        $this->assertEquals('Test: \$12.34', $this->tpl->get());   

        $this->tpl->setVariable("VALUE", "\$12.34");
        $this->assertEquals('Test: $12.34', $this->tpl->get());   

        $this->tpl->setVariable("VALUE", "\$12.34");
        $this->assertEquals('Test: $12.34', $this->tpl->get());   

        // $12 is not parsed as a variable as it starts with a number
        $this->tpl->setVariable("VALUE", "$12.34");
        $this->assertEquals('Test: $12.34', $this->tpl->get());

        $this->tpl->setVariable("VALUE", "\\$12.34");
        $this->assertEquals('Test: \$12.34', $this->tpl->get());   

        // taken from the bugreport
        $word = 'Cost is $456.98';
        $this->tpl->setVariable("VALUE", $word);
        $this->assertEquals('Test: Cost is $456.98', $this->tpl->get());

        $word = "Cost is \$" . '183.22';
        $this->tpl->setVariable("VALUE", $word);
        $this->assertEquals('Test: Cost is $183.22', $this->tpl->get());
    }

    function testBug9783 () 
    {
        $this->tpl->setTemplate("<!-- BEGIN entry -->{DATA} <!-- END entry -->", true, true);
        $data = array ('{Bakken}', 'Soria', 'Joye');
        foreach ($data as $name) {
            $this->tpl->setCurrentBlock('entry');
            $this->tpl->setVariable('DATA', $name); 
            $this->tpl->parseCurrentBlock();
        }

        $this->assertEquals('{Bakken} Soria Joye', trim($this->tpl->get()));
        
    }

    function testBug9853 ()
    {
            $this->tpl->loadTemplatefile("bug_9853_01.tpl", true, true);
            
            $this->tpl->setVariable("VAR" , "Ok !");
            $this->tpl->parse("foo1");

            $this->tpl->setVariable("VAR" , "Ok !");
            $this->tpl->parse("foo2");

            $this->tpl->setVariable("VAR." , "Ok !");
            $this->tpl->setVariable("VAR2" , "Okay");
            $this->tpl->parse("bar");

            $this->tpl->parse();
            $output01 = $this->tpl->get();

            $this->tpl->loadTemplatefile("bug_9853_02.tpl", true, true);
            
            $this->tpl->setVariable("VAR" , "Ok !");
            $this->tpl->parse("foo.");

            $this->tpl->setVariable("VAR" , "Ok !");
            $this->tpl->parse("foo2");

            $this->tpl->setVariable("VAR." , "Ok !");
            $this->tpl->setVariable("VAR2" , "Okay");
            $this->tpl->parse("bar");

            $this->tpl->parse();
            $output02 = $this->tpl->get();

            $this->assertEquals($output01, $output02);
    }
}

?>