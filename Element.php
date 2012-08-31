<?php
/**
 * Element
 * 
 * @package		Element
 * @author		ScarWu
 * @copyright	Copyright (c) 2012, ScarWu (http://scar.simcz.tw/)
 * @link		http://github.com/scarwu/Element
 */

class Element {
	
	/**
	 * @var integer
	 */
	private $index;
	
	/**
	 * @var array
	 */
	private $tag;
	
	/**
	 * @var array
	 */
	private $attribute;
	
	/**
	 * @var array
	 */
	private $single;
	
	/**
	 * @var array
	 */
	private $slash;
	
	/**
	 * @var array
	 */
	private $content;
	
	/**
	 * Magic Function
	 */
	public function __construct() {
		$this->content = array();
		$this->attribute = array();
		$this->single = array();
		
		$this->index = -1;
	}
	
	public function __toString() {
		return $this->result();
	}
	
	public function __invoke($tag, $attribute = NULL, $content = NULL) {
		return $this->tag($tag)->set($attribute)->add($content);
	}
	
	/**
	 * Attribute Encode
	 * 
	 * @return string
	 */
	private function attributeEncode() {
		$attribute = '';
		
		foreach((array)$this->attribute[$this->index] as $key => $value)
			if('' !== $value && NULL !== $value)
				$attribute .= sprintf('%s="%s" ', $key, $value);
		
		return trim($attribute);
	}
	
	/**
	 * Start tag
	 * 
	 * @param string
	 * @return object
	 */
	public function tag($tag) {
		$this->index++;
		
		$this->content[$this->index] = '';
		$this->single[$this->index] = FALSE;
		$this->slash[$this->index] = TRUE;
		$this->attribute[$this->index] = array();
		$this->tag[$this->index] = $tag;
		
		return $this;
	}
	
	// extend tag function
	public function a($href = NULL, $target = NULL, $content) {
		return $this->tag('a')->set(array(
			'href' => $href,
			'target' => $target
		))->add($content);
	}
	
	// extend tag function
	public function img($src = NULL) {
		return $this->tag('img')->set('src', $src)->single();
	}
	
	/**
	 * Set attributes
	 * 
	 * @param string, string or @param array
	 * @return object
	 */	 
	public function set() {
		$args = func_get_args();
		
		if(1 == count($args) && 'array' == gettype($args[0]))
			$this->attribute[$this->index] = array_merge($this->attribute[$this->index], $args[0]);
		elseif(2 == count($args))
			$this->attribute[$this->index][$args[0]] = $args[1];

		return $this;
	}
	
	// extend set function
	public function id($id = NULL) {
		return $this->set('id', $id);
	}
	
	// extend set function
	public function disable() {
		return $this->set('disabled', 'disabled');
	}
	
	/**
	 * Add content
	 * 
	 * @param string, string, ...
	 * 
	 * @return object
	 */
	public function add() {
		$args = func_get_args();
		
		if(1 == count($args) && 'array' == gettype($args[0])) {
			foreach((array)$args[0] as $value)
				$this->content[$this->index] .= $value;
		}
		else {
			foreach((array)$args as $value)
				$this->content[$this->index] .= $value;
		}
		
		return $this;
	}
	
	/**
	 * Single tag
	 * 
	 * @return object
	 */
	public function single($slash = TRUE) {
		$this->single[$this->index] = TRUE;
		$this->slash[$this->index] = $slash;
		
		return $this;
	}
	
	/**
	 * Return Result to String
	 * 
	 * @return string
	 */
	public function result() {
		$result = "<{$this->tag[$this->index]}";
		
		if(count($this->attribute[$this->index]) > 0)
			$result .= " {$this->attributeEncode()}";
		
		if(!$this->single[$this->index])
			$result .= ">{$this->content[$this->index]}</{$this->tag[$this->index]}";
		elseif($this->slash[$this->index])
			$result .= ' /';
			
		$result .= '>';
		
		// unset
		unset($this->content[$this->index]);
		unset($this->single[$this->index]);
		unset($this->attribute[$this->index]);
		unset($this->tag[$this->index]);
		
		$this->index--;
		
		return $result;
	}
}
