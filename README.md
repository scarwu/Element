Element
=======

### Description

HTML Generator

### Requirement

* PHP 5.3+

### Example

	<?php
	require_once realpath('/path/to/Element.php');
	
	// New Element
	$e = new Element();
	
#### Create tag div

	// <div></div>
	echo $e->tag('div')."\n";
	
#### Create tag span with content

	// <span>Hello world</span>
	echo $e->tag('span')->add('Hello world')."\n";
	
#### Create tag img

	// if tag without endtag then use function single()
	// <img src="/path/to/img" />
	echo $e->tag('img')->set('src', '/path/to/img')->single()."\n";
	
#### Create tag a with some attribute

	// <a href="http://scar.simcz.tw" target="_blank">ScarShow</a>
	echo $e->tag('a')->set(array(
		'href' => 'http://scar.simcz.tw',
		'target' => '_blank'
	))->add('ScarShow')."\n";
	
#### Create div with some content

	// if you want to get element result then use function result() and at the last
	// <div id="main"><span>Hello, My blog is </span><a href="http://scar.simcz.tw" target="_blank">ScarShow</a></div>
	echo $e->tag('div')->set('id', 'main')->add(
		'Hi, My blog is ',
		$e->tag('a')->set(array(
			'href' => 'http://scar.simcz.tw',
			'target' => '_blank'
		))->add('ScarShow')->result()
	);
