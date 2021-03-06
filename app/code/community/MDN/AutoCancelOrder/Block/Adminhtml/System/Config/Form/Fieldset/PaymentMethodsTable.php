<?php

/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @copyright  Copyright (c) 2009 Maison du Logiciel (http://www.maisondulogiciel.com)
 * @author : ALLAIRE Benjamin
 * @mail : benjamin@boostmyshop.com
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class MDN_AutoCancelOrder_Block_Adminhtml_System_Config_Form_Fieldset_PaymentMethodsTable extends Mage_Adminhtml_Block_System_Config_Form_Field {

    /**
     * get different payment method
     * @return <type>
     */
    public function getPaymentMethod() {

        return Mage::helper('Payment')->getPaymentMethodList();
    }

    /**
     * render table
     *
     * @param Varien_Data_Form_Element_Abstract $element
     * @return string
     */
    public function render(Varien_Data_Form_Element_Abstract $element) {

        $payMethods = $this->getPaymentMethod();

        // path for default value
        $defaultValue = Mage::getStoreConfig('autocancelorder/delay_cancelation/default');

        $translation = $this->__('in hours');
        
        //default element
        $element = "<tr id=\"row_aco_default\"><td class=\"label\"><b>".$this->__('Default')."</b></td><td class=\"value\"><input id=\"aco_default\" class=\"input-text\" type=\"text\" style=\"width:110px !important;\" value=\"" . $defaultValue . "\" name=\"groups[delay_cancelation][fields][default][value]\"> ".$translation." </td></tr>";

        //element by payment method
        foreach ($payMethods as $key => $method) {

            $value = Mage::getStoreConfig('autocancelorder/delay_cancelation/' . $key);

            if(!$method){
                //sometime method is empty
                $method = ucfirst(strtolower($key));
            }

            $element .= "<tr id=\"row_aco_" . $key . "\"><td class=\"label\"> " . $method . " </td>";
            $element .= "<td class=\"value\"><input id=\"aco_" . $key . "\" class=\"input-text\" type=\"text\" style=\"width:110px !important;\" value=\"" . $value . "\" name=\"groups[delay_cancelation][fields][" . $key . "][value]\"> ".$translation." </td></tr>";
        }

        return $element;
    }
   
}
