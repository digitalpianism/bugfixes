<?php

class DigitalPianism_BugFixes_Model_CatalogSearch_Resource_Fulltext_Collection extends Mage_CatalogSearch_Model_Resource_Fulltext_Collection
{
    /**
     * Apply collection search filter
     *
     * @return Mage_CatalogSearch_Model_Resource_Fulltext_Collection
     */
    protected function _applySearchFilters()
    {
        $foundIds = $this->getFoundIds();
        if (!empty($foundIds)) {
            $this->addIdFilter($foundIds);
        } else {
            /**
             * @see http://magento.stackexchange.com/q/140707/2380
             */
            $this->getSelect()->where('FALSE'); // replacement
        }
        $this->_isSearchFiltersApplied = true;

        return $this;
    }
}
