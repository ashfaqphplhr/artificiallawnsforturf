<?php
/**
 * Adminhtml newsletter templates grid block action item renderer 
 *
 * @Info       Free Extension 
 * @Feature    Add Delete action to the drop down list
 * @author     Website1service.com
 */
 
class Website1service_RemoveNews_Block_Adminhtml_Newsletter_Deletenews extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Action
{

    
	  public function render(Varien_Object $row)
    {
        if($row->isValidForSend()) {
            $actions[] = array(
                'url' => $this->getUrl('*/newsletter_queue/edit', array('template_id' => $row->getId())),
                'caption' => Mage::helper('newsletter')->__('Queue Newsletter...')
            );
        }

        $actions[] = array(
            'url'     => $this->getUrl('*/*/preview', array('id'=>$row->getId())),
            'popup'   => true,
            'caption' => Mage::helper('newsletter')->__('Preview')
        );
		//MP add the delete action
		 $actions[] = array(
            'url'     => $this->getUrl('*/newsletter_template/delete', array('id'=>$row->getId())),           
          'caption' => Mage::helper('newsletter')->__('Delete')
    );

        $this->getColumn()->setActions($actions);

        return parent::render($row);
    }
	
}
