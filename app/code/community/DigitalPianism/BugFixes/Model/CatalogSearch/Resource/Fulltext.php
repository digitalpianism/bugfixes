<?php

class DigitalPianism_BugFixes_Model_CatalogSearch_Resource_Fulltext extends Mage_CatalogSearch_Model_Resource_Fulltext
{

    /**
     * Prepare results for query
     *
     * @param Mage_CatalogSearch_Model_Fulltext $object
     * @param string $queryText
     * @param Mage_CatalogSearch_Model_Query $query
     * @return Mage_CatalogSearch_Model_Resource_Fulltext
     */
    public function prepareResult($object, $queryText, $query)
    {
        $adapter = $this->_getWriteAdapter();
        $searchType = $object->getSearchType($query->getStoreId());

        $preparedTerms = Mage::getResourceHelper('catalogsearch')
            ->prepareTerms($queryText, $query->getMaxQueryWords());

        $bind = array();
        $like = array();
        $likeCond = '';

        /**
         * @see http://magento.stackexchange.com/q/140707/2380
         */

        if ($searchType == Mage_CatalogSearch_Model_Fulltext::SEARCH_TYPE_LIKE
            || $searchType == Mage_CatalogSearch_Model_Fulltext::SEARCH_TYPE_COMBINE
        ) {
            $helper = Mage::getResourceHelper('core');
            $words  = Mage::helper('core/string')->splitWords($queryText, true, $query->getMaxQueryWords());
            foreach ($words as $word) {
                $like[] = $helper->getCILike('s.data_index', $word, ['position' => 'any']);
            }

            if ($like) {
                $likeCond = '(' . join(' OR ', $like) . ')';
            }
        }

        $mainTableAlias = 's';
        $fields = array('product_id');

        $select = $adapter->select()
            ->from(array($mainTableAlias => $this->getMainTable()), $fields)
            ->joinInner(array('e' => $this->getTable('catalog/product')),
                'e.entity_id = s.product_id',
                array())
            ->where($mainTableAlias . '.store_id = ?', (int)$query->getStoreId());

        $where = "";
        if ($searchType == Mage_CatalogSearch_Model_Fulltext::SEARCH_TYPE_FULLTEXT
            || $searchType == Mage_CatalogSearch_Model_Fulltext::SEARCH_TYPE_COMBINE
        ) {
            $bind[':query'] = implode(' ', $preparedTerms[0]);
            $where = Mage::getResourceHelper('catalogsearch')
                ->chooseFulltext($this->getMainTable(), $mainTableAlias, $select);
        }
        if ($likeCond != '' && $searchType == Mage_CatalogSearch_Model_Fulltext::SEARCH_TYPE_COMBINE) {
            $where .= ($where ? ' OR ' : '') . $likeCond;
        } elseif ($likeCond != '' && $searchType == Mage_CatalogSearch_Model_Fulltext::SEARCH_TYPE_LIKE) {
            $select->columns(array('relevance' => new Zend_Db_Expr(0)));
            $where = $likeCond;
        }

        if ($where != '') {
            $select->where($where);
        }

        $this->_foundData = $adapter->fetchPairs($select, $bind);

        return $this;
    }
}
