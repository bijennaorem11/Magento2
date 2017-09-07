<?php
namespace Bijen\CategoryAttribute\Model\Category;
 
class DataProvider extends \Magento\Catalog\Model\Category\DataProvider
{
	protected function addUseDefaultSettings($category, $categoryData)
	{
    	$data = parent::addUseDefaultSettings($category, $categoryData);
 
    	if (isset($data['background_image'])) {
            unset($data['background_image']);
 
            $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
            $helper           	= $objectManager->get('\Bijen\CategoryAttribute\Helper\Data');
 
            $data['background_image'][0]['name'] = $category->getData('background_image');
            $data['background_image'][0]['url']  	= $helper->getCategoryThumbUrl($category);
    	}
 
    	return $data;
	}
 
	protected function getFieldsMap()
	{
    	$fields = parent::getFieldsMap();
        $fields['content'][] = 'background_image'; // NEW FIELD
    	
    	return $fields;
	}
}