# HTML_Template_IT - Integrated Templates

[![Build Status](https://travis-ci.org/pear/HTML_Template_IT.svg?branch=master)](https://travis-ci.org/pear/HTML_Template_IT)
    

HTML_Template_IT is a templating engine designed to allow easy separation of concerns.
It does this by clearly separating the presentational code from the PHP code.
The presentation code may be of any format, however generally XML or HTML is used.
This engine works on the foundation of blocks and placeholders.
It uses the hierarchy of blocks to determine which presentational code is instantiated when blocks are parsed.
The placeholders allow the insertion of &quot;dynamic&quot; information.
There are two classes to use for templating.
HTML_Template_IT is used for basic templating needs.
HTML_Template_ITX gives you full power over the templating engine, allowing blocks to be added, and function callbacks to be used.

[Homepage](http://pear.php.net/package/HTML_Template_IT/)


## Installation
For a PEAR installation that downloads from the PEAR channel:

`$ pear install pear/html_template_it`

For a PEAR installation from a previously downloaded tarball:

`$ pear install HTML_Template_IT-*.tgz`

For a PEAR installation from a code clone:

`$ pear install package.xml`

For a local composer installation:

`$ composer install`

To add as a dependency to your composer-managed application:

`$composer require pear/html_template_it`


## Tests
Run  the tests from a local composer installation:

`$ ./vendor/bin/phpunit`


## License
Modified BSD license
