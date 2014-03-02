<?php
/**
 * Example
 *
 * @package		Element
 * @author		ScarWu
 * @copyright	Copyright (c) 2012-2014, ScarWu (http://scar.simcz.tw/)
 * @link		http://github.com/scarwu/Element
 */

require_once realpath(__DIR__ . '/../src/Element/HTML.php');

use Element\HTML;

// New HTML
$_ = new HTML();

// create tag div
// <div></div>
echo $_->tag('div')."\n";

// create tag span with content
// <span>Hello world</span>
echo $_->tag('span')->add('Hello world')."\n";

// create tag img
// if tag without endtag then use function single()
// <img src="/path/to/img" />
echo $_->tag('img')->set('src', '/path/to/img')->single()."\n";

// create tag a with some attribute
// <a href="http://scar.simcz.tw" target="_blank">ScarShow</a>
echo $_->tag('a')->set([
    'href' => 'http://scar.simcz.tw',
    'target' => '_blank'
])->add('ScarShow')."\n";

// create div with some content
// if you want to get element result then use function str() and at the last
// <div id="main"><span>Hello, My blog is </span><a href="http://scar.simcz.tw" target="_blank">ScarShow</a></div>
echo $_->tag('div')->set('id', 'main')->add(
    'Hi, My blog is ',
    $_->tag('a')->set([
        'href' => 'http://scar.simcz.tw',
        'target' => '_blank'
    ])->add('ScarShow')->str()
)."\n";

/**
 * Simple Function
 */

// <div id="main"></div>
echo $_('div')->id('main')."\n";

// <img src="/path/to/img" />
echo $_('img', ['src' => '/path/to/img'])->single()."\n";
// or
echo $_->img('/path/to/img')."\n";

// <a href="http://scar.simcz.tw" target="_blank">ScarShow</a>
echo $_('a', [
    'href' => 'http://scar.simcz.tw',
    'target' => '_blank'
], 'ScarShow')."\n";
// or
echo $_->a('http://scar.simcz.tw', '_blank', 'ScarShow')."\n";
