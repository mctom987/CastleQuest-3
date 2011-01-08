<?php

class Cq_View_Helper_PageTitle extends Zend_View_Helper_Abstract
{
    protected $_text;
    public function pageTitle($text = NULL)
    {
        if ($text)
            $this->_text = $text;
        return $this;
    }

    public function __toString()
    {
        return '<h2 class="title">' . $this->_text . '</h2>';
    }
}