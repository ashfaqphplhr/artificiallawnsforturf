<?php

class Tentura_Ngroups_IndexController extends Mage_Core_Controller_Front_Action {

    public function indexAction() {

        $this->loadLayout();
        $this->renderLayout();
    }

    public function saveAction() {
        if ($data = $this->getRequest()->getPost()) {

            $session = Mage::getSingleton('core/session');

            $status = Mage::getModel('newsletter/subscriber')->subscribe(trim($data['mail']));
            if ($status > 0) {
                
                $additionallData = $data;
                unset($additionallData['mail']);
                unset($additionallData['group']);
                
                $user = Mage::getModel('newsletter/subscriber')->loadByEmail(trim($data['mail']));
                $id = $user->getId();
                $user->confirm($user->getCode());
                
//                Mage::getModel('newsletter/subscriber')->load($id)->setData($additionallData)->save();
//                Mage::getModel('newsletter/subscriber')->setData($additionallData)->setId($id)->save();
            }
            if (Mage::getStoreConfig('newsletter/ngroups/multiply') == '1') {

                if (isset($data['cgroup']) && sizeof($data['cgroup']) > 0) {
                    foreach ($data['cgroup'] as $checkbox) {

                        $model = Mage::getModel('ngroups/ngroups')->getCollection()->addFieldToFilter('ngroups_id', $checkbox)->toArray();
                        $addData['customers'] = $model['items'][0]['customers'] . "," . $id;
                        $model = Mage::getModel('ngroups/ngroups');
                        $model->setData($addData)
                                ->setId($checkbox);
                        try {
                            $model->save();
                        } catch (Exception $e) {
                            
                        }
                    }
                }
            } else {

                if (isset($data['group']) && $data['group'] != '0') {
                    $model = Mage::getModel('ngroups/ngroups')->addSubscriber($id, $data['group']);
                }
            }

            $session->addSuccess($this->__('Thank you for your subscription'));
        }
        $this->_redirectReferer();
    }

}
