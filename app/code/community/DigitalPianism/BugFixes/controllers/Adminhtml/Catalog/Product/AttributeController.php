<?php

require_once 'Mage/Adminhtml/controllers/Catalog/Product/AttributeController.php';

class DigitalPianism_BugFixes_Adminhtml_Catalog_Product_AttributeController
    extends Mage_Adminhtml_Catalog_Product_AttributeController
{
    /**
     * Filter post data
     *
     * @param array $data
     * @return array
     */
    protected function _filterPostData($data)
    {
        if ($data) {
            /** @var $helperCatalog Mage_Catalog_Helper_Data */
            $helperCatalog = Mage::helper('catalog');
            //labels
            foreach ($data['frontend_label'] as & $value) {
                if ($value) {
                    $value = $helperCatalog->stripTags($value);
                }
            }

            if (!empty($data['option']) && !empty($data['option']['value']) && is_array($data['option']['value'])) {
                foreach ($data['option']['value'] as $key => $values) {
                    /**
                     * Removed the array_fill part, this causes issues when you removed a store view once and the
                     * IDs of your store views don't follow up.
                     */
                    $data['option']['value'][$key] = array_map(
                        array($helperCatalog, 'stripTags'),
                        $values
                    );
                }
            }
        }
        return $data;
    }
}