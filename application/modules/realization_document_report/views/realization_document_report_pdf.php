<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?=lang('realization_document_report')?></title>
</head>

<body>

<style>
    table th,td{
        font-size: 11px;
    }
	body{
	   font-size: 11px;
       font-family: sans-serif;
	}
	 @page { margin: 15px 30px 15px 20px; }
     
     #header { left: 0px; top: 0px; right: 0px; text-align: center;  }
     #footer { left: 0px; bottom: 30px; right: 0px; font-size: 11px; font-family: sans-serif; text-align:right; }
	 #content{
	   border-bottom:0px solid #000000;
       margin-top: 10px;
	 }
     #footer .page:after { content: counter(page, upper-roman); }
	#content{
	background-color:#FFFFFF;
	}
</style>

<table width="100%" cellpadding="2" cellspacing="0">
    <tr>
        <td width="50%" align="left"><?=$this->config->item('comp_name')?></td>
        <td width="50%" align="right">Print Date Time : <?=date('d F Y H:i:s')?> </td>
    </tr>
</table>
<br />
<div id="header">
    <span style="font-size: 16px;"><?=strtoupper(lang('realization_document_report'))?></span>    
</div>
<div id="content">
<table width="100%">
    <tr>
        <td width="50%" align="left">
            Period : <?=$str_start_date.' to '.$str_end_date;?>
        </td>
        <td width="50%" align="right" style="font-size: 10px;">
            Pool : <b><?=$dep_name?></b>
        </td>
    </tr>
</table>
<table width="100%" cellpadding="1" cellspacing="0">
	<tr>
        <th style="border: #000000 solid 1px;" width="2%"><?=lang('no')?></th>
		<th style="border: #000000 solid 1px;" width="12%"><?=lang('driver')?>/<?=lang('employee')?> Name</th>
		<th style="border: #000000 solid 1px;" width="9%"><?=lang('realization_no')?></th>
        <th style="border: #000000 solid 1px;" width="8%"><?=lang('receipt_date')?></th>
        <th style="border: #000000 solid 1px;" width="8%"><?=lang('delivery_order_date')?> </th>
        <th style="border: #000000 solid 1px;" width="8%"><?=lang('delivery_order_no')?> </th>
		<th style="border: #000000 solid 1px;" width="10%"><?=lang('vessel_name')?></th>
		<th style="border: #000000 solid 1px;">From - To </th>
		<th style="border: #000000 solid 1px;" width="8%">Container No </th>
		<th style="border: #000000 solid 1px;" width="7%"><?=lang('police_no')?></th>
		<th style="border: #000000 solid 1px;" width="7%">Container Type</th>
		<th style="border: #000000 solid 1px;" width="10%"><?=lang('cash_advance_amt')?> (Rp)</th>
    </tr> 
	<?php 
    $i=0;
    if (!empty($realization_lists)) {
        foreach ($realization_lists as $doc) {
            $i++;
    ?>
        	<tr valign="top">
        		<td style="border: #000000 solid 1px;" align="center"><?=$i?></td>
        		<td style="border: #000000 solid 1px;"><?= $doc->debtor_name;?></td>
                <td style="border: #000000 solid 1px;"><?= $doc->trx_no;?></td> 
                <td style="border: #000000 solid 1px;"><?= date('d-m-Y',strtotime($doc->received_date))?></td> 
                <td style="border: #000000 solid 1px;"><?= date('d-m-Y',strtotime($doc->do_date))?></td> 
        		<td style="border: #000000 solid 1px;"><?= $doc->do_no == '' ? '-' : $doc->do_no;?></td>
        		<td style="border: #000000 solid 1px;"><?= $doc->vessel_name == '' ? '-' : $doc->vessel_name;?></td>
        		<td style="border: #000000 solid 1px;"><?= $doc->from_name.' - '.$doc->to_name;?></td>
        		<td style="border: #000000 solid 1px;"><?= $doc->container_no == '' ? '-' : $doc->container_no;?></td>
        		<td style="border: #000000 solid 1px;"><?= $doc->police_no;?></td>
        		<td style="border: #000000 solid 1px;"><?= $doc->type_name;?></td>
        		<td style="border: #000000 solid 1px;" align="right"><?= number_format($doc->advance_amount,0,',','.');?></td>
        	</tr>
	<?php 
        }
        
    }
    
    if($i == 0){
    ?>
        <tr>
            <td colspan="12" align="center" style="border: #000000 solid 1px;">Data not available.</td>
        </tr>
    <?php
    }
    ?>
</table>
</div>

</body>
</html>
