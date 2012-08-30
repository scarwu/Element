<?php
/**
 * Example
 * 
 * @package		Element
 * @author		ScarWu
 * @copyright	Copyright (c) 2012, ScarWu (http://scar.simcz.tw/)
 * @link		http://github.com/scarwu/Element
 */

require_once realpath(__DIR__ . '/../Element.php');

// New Element
$e = new Element();

// create tag div
// <div></div>
echo $e->tag('div')."\n";

// create tag span with content
// <span>Hello world</span>
echo $e->tag('span')->add('Hello world')."\n";

// create tag img
// if tag without endtag then use function single()
// <img src="/path/to/img" />
echo $e->tag('img')->set('src', '/path/to/img')->single()."\n";

// create tag a with some attribute
// <a href="http://scar.simcz.tw" target="_blank">ScarShow</a>
echo $e->tag('a')->set(array(
	'href' => 'http://scar.simcz.tw',
	'target' => '_blank'
))->add('ScarShow')."\n";

// create div with some content
// if you want to get element result then use function result() and at the last
// <div id="main"><span>Hello, My blog is </span><a href="http://scar.simcz.tw" target="_blank">ScarShow</a></div>
echo $e->tag('div')->set('id', 'main')->add(
	'Hi, My blog is ',
	$e->tag('a')->set(array(
		'href' => 'http://scar.simcz.tw',
		'target' => '_blank'
	))->add('ScarShow')->result()
);
