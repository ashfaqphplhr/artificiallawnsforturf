<?php
/**
 * aheadWorks Co.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://ecommerce.aheadworks.com/AW-LICENSE.txt
 *
 * =================================================================
 *                 MAGENTO EDITION USAGE NOTICE
 * =================================================================
 * This software is designed to work with Magento community edition and
 * its use on an edition other than specified is prohibited. aheadWorks does not
 * provide extension support in case of incorrect edition use.
 * =================================================================
 *
 * @category   AW
 * @package    AW_Activitystream
 * @version    1.0.2
 * @copyright  Copyright (c) 2010-2012 aheadWorks Co. (http://www.aheadworks.com)
 * @license    http://ecommerce.aheadworks.com/AW-LICENSE.txt
 */


/**
 *
 */
class AW_Activitystream_Model_Observer {

    /**
     *
     */
    const LANE_REGISTRY_PATH                           = '__activityStream_observer_lane';

    const RC_CHECK_IF_CUSTOMER_HAS_ID_UPON_SAVING      = 'RC_CHECK_IF_CUSTOMER_HAS_ID_UPON_SAVING';
    const RC_CHECK_IF_CUSTOMER_SUBSCRIBED_UPON_SAVING  = 'RC_CHECK_IF_CUSTOMER_SUBSCRIBED_UPON_SAVING';
    const RC_CHECK_IF_CUSTOMER_CONFIRMED_UPON_SAVING   = 'RC_CHECK_IF_CUSTOMER_CONFIRMED_UPON_SAVING';
    const RC_CHECK_IF_ORDER_ITEM_HAS_ID_UPON_SAVING    = 'RC_CHECK_IF_ORDER_HAS_ID_UPON_SAVING';
    const RC_CHECK_IF_CART_ITEM_HAS_ID_UPON_SAVING     = 'RC_CHECK_IF_CART_ITEM_HAS_ID_UPON_SAVING';
    const RC_CHECK_IF_WISHLIST_ITEM_HAS_ID_UPON_SAVING = 'RC_CHECK_IF_WISHLIST_ITEM_HAS_ID_UPON_SAVING';
    const ROUTINE_CODE_SEARCHINGSAVEBEFORE             = 'searchingSaveBefore';
    const ROUTINE_CODE_CHECKOUTCARTINDEX               = 'checkoutcartindex';

    const MSG_STOP                                     = 'stop';


    /**
     *
     */
    public function __construct() {
        $this->__prepareLane();

        return $this;
    }


    /**
     *
     */
    public function getLane() {
        return Mage::registry(self::LANE_REGISTRY_PATH);
    }


    /**
     *
     */
    public function doPass($routine, $parameter) {
        $__lane = $this->getLane();
        if ( $__lane ) $__lane->addItem($routine, $parameter);
    }


    /**
     *
     */
    public function controllerActionPostdispatchNewsletterSubscriberNew($theObserver) {
        if ($this->__moduleIsEnabled()) {
            $__VH = Mage::helper('activitystream/dataValidation');

            try {
                $__VH->mustbeavalidVarienObject($theObserver);
                $__VH->mustbeavalidVarienObject($theObserver->getEvent());
                $__VH->mustbeavalidObject($theObserver->getEvent()->getControllerAction());
                $__VH->mustbeavalidObject($theObserver->getEvent()->getControllerAction()->getRequest());

                $__email = (string) $theObserver->getEvent()->getControllerAction()->getRequest()->getPost('email');
                $__subscriber = Mage::getModel('newsletter/subscriber');
                $__VH->mustbeavalidVarienObject($__subscriber);
                $__subscriber->loadByEmail($__email);
                if ($__subscriber->isSubscribed()) {
                    $__activity = Mage::getModel('activitystream/activity');
                    $__VH->mustbeavalidVarienObject($__activity);
                    $__activity
                        ->setType(AW_Activitystream_Model_Activity::TYPE_CUSTOMER_SUBSCRIBES_TO_NEWSLETTER)
                        ->setSource($__subscriber->getCustomerId())
                        ->setTarget($__subscriber->getId())
                        ->save()
                    ;
                }

            }
            catch (Exception $__E) {
                Mage::logException($__E);
            }
        }

        return $this;
    }

    /**
     *
     */
    public function customerSaveAfter($theObserver) {
        if ($this->__moduleIsEnabled()) {
            $__VH = Mage::helper('activitystream/dataValidation');

            try {
                $__VH->mustbeavalidVarienObject($theObserver);
                $__VH->mustbeavalidVarienObject($theObserver->getEvent());

                $__customer = $theObserver->getEvent()->getCustomer();
                $__VH->mustbeavalidVarienObject($__customer);

                $__lane = $this->getLane();
                if ( $__lane ) {
                    /* Registration when confirmation isn't required */
                    if ( $__customer->getId() ) {
                        $__messages = $__lane->popItems(self::RC_CHECK_IF_CUSTOMER_HAS_ID_UPON_SAVING);
                        if ( !is_array($__messages) ) $__messages = array();
                        foreach ($__messages as $__customerEmail) {
                            if ( $__customer->getEmail() == $__customerEmail ) {
                                $__activity = Mage::getModel('activitystream/activity');
                                $__VH->mustbeavalidVarienObject($__activity);
                                $__activity
                                    ->setType(AW_Activitystream_Model_Activity::TYPE_NEW_CUSTOMER_IS_REGISTERED)
                                    ->setSource($__customer->getId())
                                    ->setTarget(0)
                                    ->save()
                                ;
                            }
                        }
                    }

                    /* Subscription */
                    if (
                           ( ! $__customer->getId() )
                        or ( ! $__customer->getConfirmation() )
                        or ( ! $__customer->isConfirmationRequired() )
                    ) {
                        $__messages = $__lane->popItems(self::RC_CHECK_IF_CUSTOMER_SUBSCRIBED_UPON_SAVING);
                        if ( !is_array($__messages) ) $__messages = array();
                        foreach ($__messages as $__customerEmail) {
                            if ( $__customer->getEmail() == $__customerEmail ) {
                                $__subscriber = Mage::getModel('newsletter/subscriber');
                                $__VH->mustbeavalidVarienObject($__subscriber);

                                $__subscriber->loadByEmail($__customer->getEmail());

                                if ( $__subscriber->isSubscribed() ) {
                                    $__activity = Mage::getModel('activitystream/activity');
                                    $__VH->mustbeavalidVarienObject($__activity);

                                    $__activity
                                        ->setType(AW_Activitystream_Model_Activity::TYPE_CUSTOMER_SUBSCRIBES_TO_NEWSLETTER)
                                        ->setSource($__customer->getId())
                                        ->setTarget($__subscriber->getSubscriberId())
                                        ->save()
                                    ;
                                }
                            }
                        }
                    }

                    /* Confirmation */
                    if (
                            ( ! $__customer->getConfirmation() )
                        and ( $__customer->getOrigData('confirmation') )
                    ) {
                        $__messages = $__lane->popItems(self::RC_CHECK_IF_CUSTOMER_CONFIRMED_UPON_SAVING);
                        if ( !is_array($__messages) ) $__messages = array();
                        foreach ($__messages as $__customerId) {
                            if ( $__customer->getId() == $__customerId ) {
                                $__activity = Mage::getModel('activitystream/activity');
                                $__VH->mustbeavalidVarienObject($__activity);

                                $__activity
                                    ->setType(AW_Activitystream_Model_Activity::TYPE_NEW_CUSTOMER_IS_REGISTERED)
                                    ->setSource($__customer->getId())
                                    ->setTarget(0)
                                    ->save()
                                ;
                            }
                        }
                    }
                }
            }
            catch (Exception $__E) {
                Mage::logException($__E);
            }
        }

        return $this;
    }


    /**
     *
     */
    public function customerSaveBefore($theObserver) {
        if ($this->__moduleIsEnabled()) {
            $__VH = Mage::helper('activitystream/dataValidation');

            try {
                $__VH->mustbeavalidVarienObject($theObserver);
                $__VH->mustbeavalidVarienObject($theObserver->getEvent());

                $__customer = $theObserver->getEvent()->getCustomer();
                $__VH->mustbeavalidVarienObject($__customer);

                /* Check if customer is about to sign up ( and no confirmation required ) */
                if ( ! $__customer->isConfirmationRequired() ) {
                    if ( !$__customer->getId() ) {
                        $this->doPass(self::RC_CHECK_IF_CUSTOMER_HAS_ID_UPON_SAVING, $__customer->getEmail());
                    }
                }

                /* Check if customer isn't subscribed */
                $__subscriber = Mage::getModel('newsletter/subscriber');
                $__VH->mustbeavalidVarienObject($__subscriber);

                $__subscriber->loadByEmail($__customer->getEmail());

                if (
                    ( !$__subscriber->getSubscriberId() )
                    or
                    ( $__subscriber->getSubscriberId() and !$__subscriber->isSubscribed() )
                ) {
                    $this->doPass(self::RC_CHECK_IF_CUSTOMER_SUBSCRIBED_UPON_SAVING, $__customer->getEmail());
                }

                /* Check if customer is about to be confirmed */
                if (
                        ( $__customer->getId() )
                    and ( ! $__customer->getData('confirmation') )
                    and ( $__customer->getOrigData('confirmation') )
                ) {
                    $this->doPass(self::RC_CHECK_IF_CUSTOMER_CONFIRMED_UPON_SAVING, $__customer->getId());
                    $this->doPass(self::RC_CHECK_IF_CUSTOMER_SUBSCRIBED_UPON_SAVING, $__customer->getEmail());
                }
            }
            catch (Exception $__E) {
                Mage::logException($__E);
            }
        }

        return $this;
    }


    /**
     *
     */
    public function customerLogin($theObserver) {
        if ($this->__moduleIsEnabled()) {
            $__VH = Mage::helper('activitystream/dataValidation');

            try {
                $__VH->mustbeavalidVarienObject($theObserver);

                $__customer = $theObserver->getCustomer();
                $__VH->mustbeavalidVarienObject($__customer);

                $__activity = Mage::getModel('activitystream/activity');
                $__VH->mustbeavalidVarienObject($__activity);
                $__activity
                    ->setType(AW_Activitystream_Model_Activity::TYPE_CUSTOMER_IS_SIGNED_IN)
                    ->setSource($__customer->getId())
                    ->setTarget(0)
                    ->save()
                ;
            }
            catch (Exception $__E) {
                Mage::logException($__E);
            }
        }

        return $this;
    }


    /**
     *
     */
    public function catalogsearchQuerySaveBefore($theObserver) {
        if ($this->__moduleIsEnabled()) {
            $__VH = Mage::helper('activitystream/dataValidation');

            try {
                if ( !$this->getLane() or (count($this->getLane()->pickItems(self::ROUTINE_CODE_SEARCHINGSAVEBEFORE)) == 0) ) {
                    $__VH->mustbeavalidVarienObject($theObserver);
                    $__VH->mustbeavalidVarienObject($theObserver->getEvent());

                    $__catalogsearchQuery = $theObserver->getEvent()->getCatalogsearchQuery();
                    $__VH->mustbeavalidVarienObject($__catalogsearchQuery);

                    if ( $__catalogsearchQuery->getQueryId() ) {
                        $__customerId = Mage::getSingleton('customer/session')->getId();

                        $__activity = Mage::getModel('activitystream/activity');
                        $__VH->mustbeavalidVarienObject($__activity);
                        $__activity
                            ->setType(AW_Activitystream_Model_Activity::TYPE_SEARCHING_IS_PERFORMED)
                            ->setSource($__customerId)
                            ->setTarget($__catalogsearchQuery->getQueryId())
                            ->save()
                        ;

                        $this->doPass(self::ROUTINE_CODE_SEARCHINGSAVEBEFORE, self::MSG_STOP);
                    }
                }
            }
            catch (Exception $__E) {
                Mage::logException($__E);
            }
        }

        return $this;
    }


    /**
     *
     */
    public function controllerActionPostdispatchCatalogsearchResultIndex($theObserver) {
        if ($this->__moduleIsEnabled()) {
            $__VH = Mage::helper('activitystream/dataValidation');

            try {
                $__VH->mustbeavalidVarienObject($theObserver);
                $__VH->mustbeavalidVarienObject($theObserver->getEvent());

                $__action = $theObserver->getEvent()->getControllerAction();
                $__VH->mustbeavalidObject($__action);
                $__VH->mustbeavalidObject($__action->getRequest());

                $__query = $theObserver->getEvent()->getControllerAction()->getRequest()->getQuery();
                if ( is_array($__query) and isset($__query['q']) ) {
                    $__searchQuery = Mage::getModel('catalogsearch/query');
                    $__VH->mustbeavalidVarienObject($__searchQuery);
                    $__searchQuery->loadByQuery($__query['q']);

                    $__customerId = Mage::getSingleton('customer/session')->getId();

                    $__activity = Mage::getModel('activitystream/activity');
                    $__VH->mustbeavalidVarienObject($__activity);
                    $__activity
                        ->setType(AW_Activitystream_Model_Activity::TYPE_SEARCHING_IS_PERFORMED)
                        ->setSource($__customerId)
                        ->setTarget(intval($__searchQuery->getId()))
                        ->save()
                    ;
                }
            }
            catch (Exception $__E) {
                Mage::logException($__E);
            }
        }

        return $this;
    }


    /**
     *
     */
    public function controllerActionPredispatchCatalogsearchAdvancedResult($theObserver) {
        if ($this->__moduleIsEnabled()) {
            $__VH = Mage::helper('activitystream/dataValidation');

            try {
                $__VH->mustbeavalidVarienObject($theObserver);
                $__VH->mustbeavalidVarienObject($theObserver->getEvent());

                $__action = $theObserver->getEvent()->getControllerAction();
                $__VH->mustbeavalidObject($__action);
                $__VH->mustbeavalidObject($__action->getRequest());

                $__query = $theObserver->getEvent()->getControllerAction()->getRequest()->getQuery();
                if ( is_array($__query) and isset($__query['name']) ) {
                    $__searchQuery = Mage::getModel('catalogsearch/query');
                    $__VH->mustbeavalidVarienObject($__searchQuery);
                    $__searchQuery->loadByQuery($__query['name']);

                    $__customerId = Mage::getSingleton('customer/session')->getId();

                    $__activity = Mage::getModel('activitystream/activity');
                    $__VH->mustbeavalidVarienObject($__activity);
                    $__activity
                        ->setType(AW_Activitystream_Model_Activity::TYPE_SEARCHING_IS_PERFORMED)
                        ->setSource($__customerId)
                        ->setTarget(intval($__searchQuery->getId()))
                        ->save()
                    ;
                }
            }
            catch (Exception $__E) {
                Mage::logException($__E);
            }
        }

        return $this;
    }


    /**
     *
     */
    public function catalogControllerProductView($theObserver) {
        if ($this->__moduleIsEnabled()) {
            $__VH = Mage::helper('activitystream/dataValidation');

            try {
                $__VH->mustbeavalidVarienObject($theObserver);

                $__product = $theObserver->getProduct();
                $__VH->mustbeavalidVarienObject($__product);

                $__customerId = Mage::getSingleton('customer/session')->getId();

                if (
                        ( ! $this->__isCurrentPageTheSameAsPrevious() )
                    and ( ! $this->__isAjaxRequest() )
                ) {
                    $__activity = Mage::getModel('activitystream/activity');
                    $__VH->mustbeavalidVarienObject($__activity);
                    $__activity
                        ->setType(AW_Activitystream_Model_Activity::TYPE_PRODUCT_IS_VIEWED)
                        ->setSource($__customerId)
                        ->setTarget($__product->getId())
                        ->save()
                    ;
                }
            }
            catch (Exception $__E) {
                Mage::logException($__E);
            }
        }

        return $this;
    }


    /**
     *
     */
    public function controllerActionPostdispatchCatalogCategoryView($theObserver) {
        if ($this->__moduleIsEnabled()) {
            $__VH = Mage::helper('activitystream/dataValidation');

            try {
                $__VH->mustbeavalidVarienObject($theObserver);
                $__VH->mustbeavalidObject($theObserver->getControllerAction());
                $__VH->mustbeavalidObject($theObserver->getControllerAction()->getRequest());

                $__categoryId = $theObserver->getControllerAction()->getRequest()->getParam('id');
                $__customerId = Mage::getSingleton('customer/session')->getId();

                if (
                        ( ! $this->__isCurrentPageTheSameAsPrevious() )
                    and ( ! $this->__isAjaxRequest() )
                ) {
                    $__activity = Mage::getModel('activitystream/activity');
                    $__VH->mustbeavalidVarienObject($__activity);
                    $__activity
                        ->setType(AW_Activitystream_Model_Activity::TYPE_CATEGORY_IS_VIEWED)
                        ->setSource($__customerId)
                        ->setTarget($__categoryId)
                        ->save()
                    ;
                }
            }
            catch (Exception $__E) {
                Mage::logException($__E);
            }
        }

        return $this;
    }


    /**
     *
     */
    public function catalogProductCompareAddProduct($theObserver) {
        if ($this->__moduleIsEnabled()) {
            $__VH = Mage::helper('activitystream/dataValidation');

            try {
                $__VH->mustbeavalidVarienObject($theObserver);

                $__product = $theObserver->getProduct();
                $__VH->mustbeavalidVarienObject($__product);

                $__customerId = Mage::getSingleton('customer/session')->getId();

                $__activity = Mage::getModel('activitystream/activity');
                $__VH->mustbeavalidVarienObject($__activity);
                $__activity
                    ->setType(AW_Activitystream_Model_Activity::TYPE_ITEM_IS_ADDED_FOR_COMPARISON)
                    ->setSource($__customerId)
                    ->setTarget($__product->getId())
                    ->save()
                ;
            }
            catch (Exception $__E) {
                Mage::logException($__E);
            }
        }

        return $this;
    }


    /**
     *
     */
    public function wishlistItemSaveBefore($theObserver) {
        if ($this->__moduleIsEnabled()) {
            $__VH = Mage::helper('activitystream/dataValidation');

            try {
                $__VH->mustbeavalidVarienObject($theObserver);
                $__VH->mustbeavalidVarienObject($theObserver->getItem());

                if ( ! $theObserver->getItem()->getData('wishlist_item_id') ) {
                    $this->doPass(
                        self::RC_CHECK_IF_WISHLIST_ITEM_HAS_ID_UPON_SAVING,
                        array(
                            $theObserver->getItem()->getWishlistId(),
                            $theObserver->getItem()->getProductId()
                        )
                    );
                }
            }
            catch (Exception $__E) {
                Mage::logException($__E);
            }
        }

        return $this;
    }


    /**
     *
     */
    public function wishlistItemSaveAfter($theObserver) {
        if ($this->__moduleIsEnabled()) {
            $__VH = Mage::helper('activitystream/dataValidation');

            try {
                $__VH->mustbeavalidVarienObject($theObserver);
                $__VH->mustbeavalidVarienObject($theObserver->getItem());

                if ( $theObserver->getItem()->getData('wishlist_item_id') ) {
                    $__item = $theObserver->getItem();
                    $__lane = $this->getLane();
                    if ( $__lane ) {
                        $__messages = $__lane->popItems(self::RC_CHECK_IF_WISHLIST_ITEM_HAS_ID_UPON_SAVING);
                        if ( !is_array($__messages) ) $__messages = array();
                        $__customerId = Mage::getSingleton('customer/session')->getId();
                        foreach ($__messages as $__message) {
                            list($__wishlistId, $__productId) = $__message;
                            if (
                                    ( $__item->getWishlistId() == $__wishlistId )
                                and ( $__item->getProductId() == $__productId )
                            ) {
                                $__activity = Mage::getModel('activitystream/activity');
                                $__VH->mustbeavalidVarienObject($__activity);
                                $__activity
                                    ->setType(AW_Activitystream_Model_Activity::TYPE_ITEM_IS_ADDED_TO_WISHLIST)
                                    ->setSource($__customerId)
                                    ->setTarget($__productId)
                                    ->save()
                                ;
                            }
                        }
                    }
                }
            }
            catch (Exception $__E) {
                Mage::logException($__E);
            }
        }

        return $this;
    }


    /**
     *
     */
    public function salesQuoteAddItem($theObserver) {
        if ($this->__moduleIsEnabled()) {
            $__VH = Mage::helper('activitystream/dataValidation');

            try {
                $__VH->mustbeavalidVarienObject($theObserver);
                $__quoteItem = $theObserver->getQuoteItem();
                $__VH->mustbeavalidVarienObject($__quoteItem);

                $this->doPass(
                    self::RC_CHECK_IF_CART_ITEM_HAS_ID_UPON_SAVING,
                    array(
                        $__quoteItem->getQuoteId(),
                        $__quoteItem->getProduct()->getId()
                    )
                );
            }
            catch (Exception $__E) {
                Mage::logException($__E);
            }
        }

        return $this;
    }


    /**
     *
     */
    public function checkoutCartSaveAfter($theObserver) {
        if ($this->__moduleIsEnabled()) {
            $__VH = Mage::helper('activitystream/dataValidation');

            try {
                $__VH->mustbeavalidVarienObject($theObserver);
                $__VH->mustbeavalidVarienObject($theObserver->getCart());

                $__lane = $this->getLane();
                if ( $__lane ) {
                    $__customerId = Mage::getSingleton('customer/session')->getId();

                    $__messages = $__lane->popItems(self::RC_CHECK_IF_CART_ITEM_HAS_ID_UPON_SAVING);
                    if ( !is_array($__messages) ) $__messages = array();
                    foreach ($__messages as $__message) {
                        list($__quoteId, $__productId) = $__message;
                        foreach ($theObserver->getCart()->getQuote()->getAllVisibleItems() as $__quoteItem) {
                            if ( $__quoteItem->getItemId() ) {
                                if ($__quoteItem->getBuyRequest()->getData('super_product_config/product_id')) {
                                    $__productId = $__quoteItem->getBuyRequest()->getData('super_product_config/product_id');
                                }

                                if ($__quoteItem->getProduct()->getId() == $__productId ) {
                                    $__activity = Mage::getModel('activitystream/activity');
                                    $__VH->mustbeavalidVarienObject($__activity);
                                    $__activity
                                        ->setType(AW_Activitystream_Model_Activity::TYPE_ITEM_IS_ADDED_TO_SHOPPING_CART)
                                        ->setSource($__customerId)
                                        ->setTarget($__productId)
                                        ->save()
                                    ;

                                    break;
                                }
                            }
                        }
                    }
                }
            }
            catch (Exception $__E) {
                Mage::logException($__E);
            }
        }

        return $this;
    }


    /**
     *
     */
    public function controllerActionPredispatchCheckoutCartIndex($theObserver) {
        if ($this->__moduleIsEnabled()) {
            $__VH = Mage::helper('activitystream/dataValidation');

            try {
                if (
                        ( ! $this->__isCurrentPageTheSameAsPrevious() )
                    and ( ! $this->__isAjaxRequest() )
                ) {
                    if ( !$this->getLane() or (count($this->getLane()->pickItems(self::ROUTINE_CODE_CHECKOUTCARTINDEX)) == 0) ) {
                        $__session = Mage::getSingleton('customer/session');
                        $__VH->mustbeavalidVarienObject($__session);

                        $__customerId = $__session->getId();

                        $__activity = Mage::getModel('activitystream/activity');
                        $__VH->mustbeavalidVarienObject($__activity);
                        $__activity
                            ->setType(AW_Activitystream_Model_Activity::TYPE_CUSTOMER_VIEWS_SHOPPING_CART)
                            ->setSource($__customerId)
                            ->setTarget(0)
                            ->save()
                        ;

                        $this->doPass(self::ROUTINE_CODE_CHECKOUTCARTINDEX, self::MSG_STOP);
                    }
                }
            }
            catch (Exception $__E) {
                Mage::logException($__E);
            }
        }

        return $this;
    }


    /**
     *
     */
    public function controllerActionPredispatchCheckoutOnepageIndex($theObserver) {
        if ($this->__moduleIsEnabled()) {
            $__VH = Mage::helper('activitystream/dataValidation');

            try {
                $__session = Mage::getSingleton('customer/session');
                $__VH->mustbeavalidVarienObject($__session);

                $__customerId = $__session->getId();

                if ( ! $this->__isCurrentPageTheSameAsPrevious() ) {
                    $__activity = Mage::getModel('activitystream/activity');
                    $__VH->mustbeavalidVarienObject($__activity);
                    $__activity
                        ->setType(AW_Activitystream_Model_Activity::TYPE_CUSTOMER_PROCEEDS_TO_CHECKOUT)
                        ->setSource($__customerId)
                        ->setTarget(0)
                        ->save()
                    ;
                }
            }
            catch (Exception $__E) {
                Mage::logException($__E);
            }
        }

        return $this;
    }


    /**
     *
     */
    public function salesOrderSaveBefore($theObserver) {
        if ($this->__moduleIsEnabled()) {
            $__VH = Mage::helper('activitystream/dataValidation');

            try {
                $__VH->mustbeavalidVarienObject($theObserver);
                $__VH->mustbeavalidVarienObject($theObserver->getEvent());

                $__order = $theObserver->getEvent()->getOrder();
                $__VH->mustbeavalidVarienObject($__order);
                $__VH->mustbeavalidObject($__order->getItemsCollection());

                foreach ( $__order->getItemsCollection()->getItems() as $__orderItem ) {
                    if (
                            ( ! $__orderItem->getItemId() )
                        and ( ! $__orderItem->getData('quote_parent_item_id') )
                    ) {
                        $this->doPass(self::RC_CHECK_IF_ORDER_ITEM_HAS_ID_UPON_SAVING, $__orderItem->getQuoteItemId());
                    }
                }

            }
            catch (Exception $__E) {
                Mage::logException($__E);
            }
        }

        return $this;
    }


    /**
     *
     */
    public function salesOrderSaveAfter($theObserver) {
        if ($this->__moduleIsEnabled()) {
            $__VH = Mage::helper('activitystream/dataValidation');

            try {
                $__VH->mustbeavalidVarienObject($theObserver);
                $__VH->mustbeavalidVarienObject($theObserver->getEvent());

                $__order = $theObserver->getEvent()->getOrder();
                $__VH->mustbeavalidVarienObject($__order);
                $__VH->mustbeavalidObject($__order->getItemsCollection());

                $__lane = $this->getLane();
                if ( $__lane ) {
                    $__messages = $__lane->popItems(self::RC_CHECK_IF_ORDER_ITEM_HAS_ID_UPON_SAVING);
                    if ( !is_array($__messages) ) $__messages = array();
                    $__customerId = Mage::getSingleton('customer/session')->getId();
                    foreach ( $__order->getItemsCollection()->getItems() as $__orderItem ) {
                        if ( $__orderItem->getItemId() ) {
                            foreach ($__messages as $__quoteItemId) {
                                if ( $__orderItem->getQuoteItemId() == $__quoteItemId ) {
                                    $__activity = Mage::getModel('activitystream/activity');
                                    $__VH->mustbeavalidVarienObject($__activity);
                                    $__activity
                                        ->setType(AW_Activitystream_Model_Activity::TYPE_PRODUCT_IS_PURCHASED)
                                        ->setSource($__customerId)
                                        ->setTarget($__orderItem->getProductId())
                                        ->save()
                                    ;
                                }
                            }
                        }
                    }
                }
            }
            catch (Exception $__E) {
                Mage::logException($__E);
            }
        }

        return $this;
    }


    /**
     *
     */
    public function tagSaveAfter($theObserver) {
        if ($this->__moduleIsEnabled()) {
            $__VH = Mage::helper('activitystream/dataValidation');

            try {
                $__VH->mustbeavalidVarienObject($theObserver);
                $__VH->mustbeavalidVarienObject($theObserver->getEvent());

                $__tagModel = $theObserver->getEvent()->getObject();
                $__VH->mustbeavalidVarienObject($__tagModel);

                if (
                        ( $__tagModel->getData('status') == Mage_Tag_Model_Tag::STATUS_APPROVED )
                    and ( $__tagModel->getOrigData('status') != Mage_Tag_Model_Tag::STATUS_APPROVED )
                ) {
                    $__activity = Mage::getModel('activitystream/activity');
                    $__VH->mustbeavalidVarienObject($__activity);
                    $__activity
                        ->setType(AW_Activitystream_Model_Activity::TYPE_PRODUCT_TAG_IS_ADDED)
                        ->setSource($__tagModel->getFirstCustomerId())
                        ->setTarget($__tagModel->getTagId())
                        ->setStoreId($__tagModel->getFirstStoreId())
                        ->save()
                    ;
                }
            }
            catch (Exception $__E) {
                Mage::logException($__E);
            }
        }

        return $this;
    }


    /**
     *
     */
    public function reviewSaveBefore($theObserver) {
        if ($this->__moduleIsEnabled()) {
            $__VH = Mage::helper('activitystream/dataValidation');

            try {
                $__VH->mustbeavalidVarienObject($theObserver);
                $__VH->mustbeavalidVarienObject($theObserver->getEvent());

                $__reviewModel = $theObserver->getEvent()->getObject();
                $__VH->mustbeavalidVarienObject($__reviewModel);

                if (
                    ( $__reviewModel->getData('status_id') == Mage_Review_Model_Review::STATUS_APPROVED )
                    and
                    ( $__reviewModel->getOrigData('status_id') != Mage_Review_Model_Review::STATUS_APPROVED )
                ) {
                    $__activity = Mage::getModel('activitystream/activity');
                    $__VH->mustbeavalidVarienObject($__activity);
                    $__activity
                        ->setType(AW_Activitystream_Model_Activity::TYPE_REVIEW_IS_ADDED)
                        ->setSource($__reviewModel->getCustomerId())
                        ->setTarget($__reviewModel->getEntityPkValue())
                        ->setStoreId($__reviewModel->getStoreId())
                        ->save()
                    ;
                }
            }
            catch (Exception $__E) {
                Mage::logException($__E);
            }
        }

        return $this;
    }

    /**
     *
     */
    public function controllerActionPredispatchAdvancednewsletterSubscribe($observer)
    {
        if ($this->__moduleIsEnabled()) {
            $__VH = Mage::helper('activitystream/dataValidation');
            try {
                $__VH->mustbeavalidVarienObject($observer);
                $__VH->mustbeavalidVarienObject($observer->getEvent());
                $__VH->mustbeavalidObject($observer->getEvent()->getControllerAction());
                $__VH->mustbeavalidObject($observer->getEvent()->getControllerAction()->getRequest());

                $__email = $observer->getEvent()->getControllerAction()->getRequest()->getParam('email', null);
                if (!$__email) {
                    $__email = Mage::helper('customer')->getCustomer()->getEmail();
                }
                $advanceNewsletterSubscriber = Mage::getModel('advancednewsletter/subscriber')->loadByEmail($__email);
                Mage::register('aw_als_aw_advanced_newsletter_subscriber', $advanceNewsletterSubscriber);

            }
            catch (Exception $__E) {
                Mage::logException($__E);
            }
        }
    }

    /**
     *
     */
    public function controllerActionPostdispatchAdvancednewsletterSubscribe($observer)
    {
        if ($this->__moduleIsEnabled()) {
            $__VH = Mage::helper('activitystream/dataValidation');
            try {
                $__VH->mustbeavalidVarienObject($observer);
                $__VH->mustbeavalidVarienObject($observer->getEvent());
                $__VH->mustbeavalidObject($observer->getEvent()->getControllerAction());
                $__VH->mustbeavalidObject($observer->getEvent()->getControllerAction()->getRequest());

                $originalSubscriber = Mage::registry('aw_als_aw_advanced_newsletter_subscriber');

                $__email = $observer->getEvent()->getControllerAction()->getRequest()->getParam('email', null);
                if (!$__email) {
                    $__email = Mage::helper('customer')->getCustomer()->getEmail();
                }
                $subscriber = Mage::getModel('advancednewsletter/subscriber')->loadByEmail($__email);

                if (
                    $originalSubscriber->getStatus() != $subscriber->getStatus()
                    && $subscriber->getStatus() == AW_Advancednewsletter_Model_Subscriber::STATUS_SUBSCRIBED
                ) {
                    $__activity = Mage::getModel('activitystream/activity');
                    $__VH->mustbeavalidVarienObject($__activity);
                    $__activity
                        ->setType(AW_Activitystream_Model_Activity::TYPE_CUSTOMER_SUBSCRIBES_TO_NEWSLETTER)
                        ->setSource($subscriber->getCustomerId())
                        ->setTarget($subscriber->getId())
                        ->save()
                    ;
                }
            }
            catch (Exception $__E) {
                Mage::logException($__E);
            }
        }
    }
    /**
     *
     */
    protected function __moduleIsEnabled() {
        return Mage::getStoreConfig(AW_Activitystream_Helper_Data::CONFIG_PATH_GENERAL_MODULEENABLED);
    }


    /**
     *
     */
    protected function __prepareLane() {
        if ($this->__moduleIsEnabled()) {
            if ( ! Mage::registry(self::LANE_REGISTRY_PATH) ) {
                try {
                    $__lane = Mage::getModel('activitystream/lane');
                    Mage::helper('activitystream/dataValidation')->mustbeavalidObject($__lane);
                    Mage::register(self::LANE_REGISTRY_PATH, $__lane);
                }
                catch (Exception $__E) {
                    Mage::logException($__E);
                }
            }
        }
    }


    /**
     *
     */
    protected function __isAjaxRequest() {
        $__request = Mage::app()->getFrontController()->getRequest();
        return (
               ( method_exists($__request, 'isAjax') and $__request->isAjax() )
            or ( strpos(parse_url(Mage::app()->getFrontController()->getRequest()->getRequestString(), PHP_URL_QUERY), 'awacp=1') !== false )
        );
    }


    /**
     *
     */
    protected function __isCurrentPageTheSameAsPrevious() {
        return ( $this->__getPreviousRequestUri() == $this->__getCurrentRequestUri() );
    }


    /**
     *
     */
    protected function __getPreviousRequestUri() {
        $__uri = $this->__getRefererUrl();
        return parse_url($__uri, PHP_URL_PATH);
    }


    /**
     *
     */
    protected function __getCurrentRequestUri() {
        $__baseUrl = Mage::getBaseUrl();
        if ( substr($__baseUrl, -1) == '/' ) $__baseUrl = substr($__baseUrl, 0, -1);
        $__uri = $__baseUrl . Mage::app()->getFrontController()->getRequest()->getRequestString();
        return parse_url($__uri, PHP_URL_PATH);
    }


    /**
     *
     */
    private function __getRefererUrl() {
        $__controller = Mage::app()->getFrontController();
        $__refererUrl = $__controller->getRequest()->getServer('HTTP_REFERER');
        if ($__url = $__controller->getRequest()->getParam(Mage_Core_Controller_Varien_Action::PARAM_NAME_REFERER_URL)) {
            $__refererUrl = $__url;
        }
        if ($__url = $__controller->getRequest()->getParam(Mage_Core_Controller_Varien_Action::PARAM_NAME_BASE64_URL)) {
            $__refererUrl = Mage::helper('core')->urlDecode($__url);
        }
        if ($url = $__controller->getRequest()->getParam(Mage_Core_Controller_Varien_Action::PARAM_NAME_URL_ENCODED)) {
            $__refererUrl = Mage::helper('core')->urlDecode($__url);
        }

        $__refererUrl = Mage::helper('core')->escapeUrl($__refererUrl);

        if (!$this->__isUrlInternal($__refererUrl)) {
            $__refererUrl = Mage::app()->getStore()->getBaseUrl();
        }
        return $__refererUrl;
    }


    /**
     *
     */
    private function __isUrlInternal($url) {
        if (strpos($url, 'http') !== false) {
            if (
                   (strpos($url, Mage::app()->getStore()->getBaseUrl()) === 0)
                || (strpos($url, Mage::app()->getStore()->getBaseUrl(Mage_Core_Model_Store::URL_TYPE_LINK, true)) === 0)
            ) {
                return true;
            }
        }

        return false;
    }
}