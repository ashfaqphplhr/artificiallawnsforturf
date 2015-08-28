<?php
class Tentura_Ngroups_Block_Adminhtml_Ngroups_Render_Number extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        
        $subscribers = Mage::getModel("ngroups/ngroups")->getGroupSubscribers($row->getId(), true);
        
        $string = $subscribers;
        if ($row->getCustomerGroups()){
            $string .= "<div class='ngroups_grid_groupsinfo'><h5>".Mage::helper("ngroups")->__("Assigned to User groups:")."</h5><p>";
            $cGroups = explode(',', $row->getCustomerGroups());
            foreach ($cGroups as $cGroup){
                $groupName = Mage::getModel("customer/group")->load($cGroup)->getCode();
                $string .= $groupName."<br />";
            }
            $string .= "</p></div>";
       }
        
        
        return $string;

    }
}