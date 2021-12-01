<?php
/*
 * Copyright (c) On Tap Networks Limited.
 */

namespace Citi\PayBySpring\Model;

class SelectedStore
{
    protected $storeId;

    public function setStoreId($storeId)
    {
        $this->storeId = $storeId;
    }

    public function getStoreId()
    {
        return $this->storeId;
    }
}
