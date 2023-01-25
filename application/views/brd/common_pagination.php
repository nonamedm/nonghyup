<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php
if( isset($lists) && count($lists) )
{
    echo $this->pagination->create_links();
}
?>