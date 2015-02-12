<?php
/*------------------------------------------------------------------------
# JBusinessDirectory
# author CMSJunkie
# copyright Copyright (C) 2012 cmsjunkie.com. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.cmsjunkie.com
# Technical Support:  Forum - http://www.cmsjunkie.com/forum/j-businessdirectory/?p=1
-------------------------------------------------------------------------*/

defined( '_JEXEC' ) or die( 'Restricted access' );

JTable::addIncludePath('/components/'.JRequest::getVar('option').'/tables');

class JBusinessDirectorCategoryLib
{
	function __construct()
	{
	}

	public static function displayInfo(){
		//dump("info");
	}

	function getCategories(){
		$categories = $this->getAllCategories();
		$categories = $this->processCategories($categories);
		$startingLevel = 1;
		$maxLevel=0;
		$path=array();
		$categories["maxLevel"] = $this->setCategoryLevel($categories, $startingLevel, $maxLevel, $path);

		return $categories;
	}

	function getAllCategories(){
		$db =JFactory::getDBO();
		$query = "select * from #__jbusinessdirectory_categories order by parentId,name";
		$db->setQuery($query);
		return $db->loadObjectList();
	}

	function getCompleteCategoryById($categoryId){
		$categoryTable = JTable::getInstance('Categories', 'JTable');
		
		$category = null;
		if(isset($categoryId))
			$category = $categoryTable->getCategoryById($categoryId);
		
		$categories = $categoryTable->getAllCategories();
		$categories = $this->processCategories($categories);

		$startingLevel = 1;
		$maxLevel=0;
		$path=array();
		//set the level by reference
		$this->setCategoryLevel($categories, $startingLevel, $maxLevel,$path);
		//set the category by reference
		$this->findCategory($categories, $category);
		return $category;
	}

	function processCategories($categories){
		$newCategories = array();
		foreach ($categories as $category){
			if($category->parentId!=0){
				$parentCategory = $this->getParent($newCategories, $category);
			}else{
				$newCategories[$category->id] = array($category,"subCategories"=>array());
			}
		}
		return $newCategories;
	}
	
	function processCategoriesByName($categories){
		$newCategories = array();
		foreach ($categories as $category){
			if($category->parentId!=0){
				$parentCategory = $this->getParentByName($newCategories, $category);
			}else{
				$newCategories[$category->name] = array($category,"subCategories"=>array());
			}
		}
		return $newCategories;
	}

	function setCategoryLevel(&$categories, $level, &$maxLevel=0, &$path){
		foreach ($categories as &$cat){
			//dump($cat[0]->name);
			if($maxLevel < $level){
				$maxLevel = $level;
			}
			$cat["level"]= $level;

			$cat["path"]=$path;
			//dump($cat);
			if(is_array($cat["subCategories"]) && count($cat["subCategories"])>0) {
				$path[$level] =array($cat[0]->id,$cat[0]->name,$cat[0]->alias);
				$this->setCategoryLevel($cat["subCategories"], $level+1, $maxLevel, $path);
			}
		}
		// 		echo "------start unset ".(count($path));
		//  		dump($path);
		unset($path[count($path)]);
		// 		dump($path);
		// 		echo "-----end unset -------------";
		//dump((count($path)-1));
		//unset($path[count($path)-1]);
		return $maxLevel;
	}

	function getParent(&$categories, $category){
		foreach ($categories as &$cat){
			if($category->parentId==$cat[0]->id){
				$cat["subCategories"][$category->id] = array($category,"subCategories"=>array());
				return $cat;
			}
			else if(isset($cat["subCategories"])){
				$this->getParent($cat["subCategories"], $category);
			}
		}
	}

	function getParentByName(&$categories, $category){
		foreach ($categories as &$cat){
			if($category->parentId==$cat[0]->id){
				$cat["subCategories"][$category->name] = array($category,"subCategories"=>array());
				return $cat;
			}
			else if(isset($cat["subCategories"])){
				$this->getParent($cat["subCategories"], $category);
			}
		}
	}
	
	function findCategory($categories, &$category){
		if(!isset($category)){
			return null;
		}
		//dump($categories);
		foreach ($categories as $cat){
			if(isset( $category[0]) && $category[0]->id==$cat[0]->id){
				$category=$cat;
				return $cat;
			}
			else if(isset($cat["subCategories"])){
				$this->findCategory($cat["subCategories"], $category);
			}
		}
	}
	
	function findCategoryById($categories, &$category, $id){
		
		//dump($categories);
		foreach ($categories as $cat){
			//dump( $cat[0]->id);
			if($id == $cat[0]->id ){
				$category=$cat;
				return $cat;
			}
			else if(isset($cat["subCategories"])){
				$this->findCategoryById($cat["subCategories"], $category, $id);
			}
		}
	}
	
	function findCategoryByName($categories, &$category, $categoryName){
		foreach ($categories as $cat){
			if(strcmp($cat[0]->name,$categoryName)==0){
				
				$category = $cat;
				return $cat;
			}
			else if(isset($cat["subCategories"])){
				 $this->findCategoryByName($cat["subCategories"],$category, $categoryName);
			}
		}
		return $category;
	}

	function getCategoryLeafs($categoryId){
		$category = $this->getCompleteCategoryById($categoryId);
		$leafsIds = array();
		//dump($category);
		if(isset($category["subCategories"]) && is_array($category["subCategories"]) && count($category["subCategories"])>0){
			$leafsIds = $this->getAllLeafs($category["subCategories"],$leafsIds );
			//dump($leafsIds);
		}else{
			if(isset($categoryId) && isset($category[0])){
				$leafsIds[] = $category[0]->id;
			}
		}
		//dump($leafsIds);
		return $leafsIds;
	}

	function getCategoryChilds($category){
		if(!isset($category)){
			return null;
		}
		$leafsIds = array();
		if(is_array($category["subCategories"]) && count($category["subCategories"])>0){
			$leafsIds = $this->getAllLeafs($category["subCategories"],$leafsIds );
			//dump($leafsIds);
		}else{
			//dump($category);
			$leafsIds[] = $category[0]->id;
		}

		return $leafsIds;
	}

	function getAllLeafs($categories,&$leafIds){
		foreach ($categories as &$cat){
			if(count($cat["subCategories"])==0) {
				//dump($cat);
				$leafIds[]=$cat[0]->id;
				//dump($leafIds);
			}
			if(is_array($cat["subCategories"])) {
				$this->getAllLeafs($cat["subCategories"], $leafIds);
			}
		}
		return $leafIds;
	}

	function getCategory($categoryName){
		
	}
}
?>