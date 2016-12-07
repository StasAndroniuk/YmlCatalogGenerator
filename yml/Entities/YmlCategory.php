<?php

/**
 * Created by PhpStorm.
 * User: stass
 * Date: 12/5/2016
 * Time: 5:20 PM
 */
class YmlCategory
{
    private $id;
    private $parent;
    private $name;
    public function __construct($id,$name,$parent="")
    {
        if($id===null ||$id=="")
        {
            throw  new InvalidArgumentException("Empty category id");
        }
        if($name===null || $name=="")
        {
            throw new InvalidArgumentException("Empty category name");
        }
        $this->id=$id;
        $this->name=$name;
        $this->parent=$parent;
    }
    public function generate()
    {
        $str="<category id=\"".$this->id."\"";
        if($this->parent!="")
        {
            $str.=" parentId=\"".$this->parent."\" ";
        }
        $str.=">".$this->name."</category>";
        return $str;
    }
    public  function Equal(YmlCategory $category)
    {
        return $this->id==$category->id && $this->name==$category->name && $this->parent==$category->parent;
    }
    public function getCategoryid()
    {
        return $this->id;
    }
}