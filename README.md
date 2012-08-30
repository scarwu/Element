Element
=======

### Description

HTML Generator

### Requirement

* PHP 5.3+

### Example

	<?php
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
	// if tag without endtag then use single
	// <img src="#" />
	echo $e->tag('img')->set('src', '#')->single()."\n";
	
	// create tag a with some attribute
	// <a href="http://scar.simcz.tw" target="_blank">ScarShow</a>
	echo $e->tag('a')->set(array(
		'href' => 'http://scar.simcz.tw',
		'target' => '_blank'
	))->add('ScarShow')."\n";
	
	// create div with some content
	// <div id="main"><span>Hello, My blog is </span><a href="http://scar.simcz.tw" target="_blank">ScarShow</a></div>
	echo $e->tag('div')->set('id', 'main')->add(
		'Hi, My blog is ',
		$e->tag('a')->set(array(
			'href' => 'http://scar.simcz.tw',
			'target' => '_blank'
		))->add('ScarShow')->result()
	);
