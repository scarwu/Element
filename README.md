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
	$_ = new Element();
	
#### Create tag div

	// <div></div>
	echo $_->tag('div');
	
#### Create tag span with content

	// <span>Hello world</span>
	echo $_->tag('span')->add('Hello world');
	
#### Create tag img

	// if tag without endtag then use function single()
	// <img src="/path/to/img" />
	echo $_->tag('img')->set('src', '/path/to/img')->single();
	
#### Create tag a with some attribute

	// <a href="http://scar.simcz.tw" target="_blank">ScarShow</a>
	echo $_->tag('a')->set(array(
		'href' => 'http://scar.simcz.tw',
		'target' => '_blank'
	))->add('ScarShow');
	
#### Create tag div with some content

	// if you want to get element result then use function result() and at the last
	// <div id="main"><span>Hello, My blog is </span><a href="http://scar.simcz.tw" target="_blank">ScarShow</a></div>
	echo $_->tag('div')->set('id', 'main')->add(
		'Hi, My blog is ',
		$_->tag('a')->set(array(
			'href' => 'http://scar.simcz.tw',
			'target' => '_blank'
		))->add('ScarShow')->result()
	);
	
### Simple Function

	// <div></div>
	echo $_('div');
	
	// <img src="/path/to/img" />
	echo $_('img', array('src', '/path/to/img'))->single();
	// or
	echo $_->img('/path/to/img');
	
	// <a href="http://scar.simcz.tw" target="_blank">ScarShow</a>
	echo $_('a', array(
		'href' => 'http://scar.simcz.tw',
		'target' => '_blank'
	), 'ScarShow');
	// or
	echo $_->a('http://scar.simcz.tw', '_blank', 'ScarShow');
