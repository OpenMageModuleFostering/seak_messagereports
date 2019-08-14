<?php

/**
 * Seak Ecommerce Group :: Magento Extension Development
 *
 * NOTICE OF LICENSE
 * This source file is subject to the Open Software License (OSL 3.0)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
 
class Seak_Messagereports_Model_Mysql4_Messagereports extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        // Note that the mods_id refers to the key field in your database table.
        $this->_init('messagereports/messagereports', 'id');
    }

    protected function _afterLoad(Mage_Core_Model_Abstract $object)
    {

        $select = $this->_getReadAdapter()->select()
            ->from($this->getTable('messagereports_store'))
            ->where('id = ?', $object->getId());

        if ($data = $this->_getReadAdapter()->fetchAll($select)) {
            $storesArray = array();
            foreach ($data as $row) {
                $storesArray[] = $row['store_id'];
            }
            $object->setData('store_id', $storesArray);
        }

        return parent::_afterLoad($object);

    }

    // Process before saving
    protected function _afterSave(Mage_Core_Model_Abstract $object)
    {

        $condition = $this->_getWriteAdapter()->quoteInto('id = ?', $object->getId());
        $this->_getWriteAdapter()->delete($this->getTable('messagereports_store'), $condition);

        foreach ((array)$object->getData('stores') as $store) {
            $storeArray = array();
            $storeArray['id'] = $object->getId();
            $storeArray['store_id'] = $store;
            $this->_getWriteAdapter()->insert($this->getTable('messagereports_store'), $storeArray);
        }

        return parent::_afterSave($object);

    }
}