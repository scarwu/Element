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
	private $content;
	
	public function __construct() {
		$this->content = array();
		$this->attribute = array();
		$this->single = array();
		
		$this->index = -1;
	}
	
	/**
	 * Attribute Encode
	 * 
	 * @return string
	 */
	private function attributeEncode() {
		$attribute = '';
		
		foreach((array)$this->attribute[$this->index] as $key => $value) {
			$attribute .= sprintf('%s="%s" ', $key, $value);
		}
		
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
		$this->attribute[$this->index] = array();
		$this->tag[$this->index] = $tag;
		
		return $this;
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
	
	/**
	 * Add content
	 * 
	 * @param string, string, ...
	 * 
	 * @return object
	 */
	public function add() {
		$args = func_get_args();
		
		foreach((array)$args as $value)
			$this->content[$this->index] .= $value;
		
		return $this;
	}
	
	/**
	 * Single tag
	 * 
	 * @return object
	 */
	public function single() {
		$this->single[$this->index] = TRUE;
		
		return $this;
	}
	
	/**
	 * Return Result to String
	 * 
	 * @return string
	 */
	public function __toString() {
		return $this->result();
	}
	 
	public function result() {
		if(!$this->single[$this->index]) {
			if(count($this->attribute[$this->index]) > 0)
				$result = sprintf(
					'<%s %s>%s</%s>',
					$this->tag[$this->index],
					$this->attributeEncode(),
					$this->content[$this->index],
					$this->tag[$this->index]
				);
			else
				$result = sprintf(
					'<%s>%s</%s>',
					$this->tag[$this->index],
					$this->content[$this->index],
					$this->tag[$this->index]
				);
		}
		else {
			if(count($this->attribute[$this->index]) > 0)
				$result = sprintf( '<%s %s />', $this->tag[$this->index], $this->attributeEncode());
			else
				$result = sprintf('<%s />', $this->tag[$this->index]);
		}
		
		// unset
		unset($this->content[$this->index]);
		unset($this->single[$this->index]);
		unset($this->attribute[$this->index]);
		unset($this->tag[$this->index]);
		
		$this->index--;
		
		return $result;
	}
}
