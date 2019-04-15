<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?=lang('ritase_report')?></title>
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
    <span style="font-size: 16px;">
        <?=strtoupper(lang('ritase_report'))?><br/>
        <b><?=$police_no?></b>
    </span><br/>
    <?=$str_start_date.' to '.$str_end_date;?>
</div>
<p></p>

<div id="content">
    <table width="60%" cellpadding="1" cellspacing="0">
        <tr>
            <th style="border: #000000 solid 1px;" width="5%"><?=lang('no')?></th>
            <th style="border: #000000 solid 1px;">Commission No</th>
            <th style="border: #000000 solid 1px;" width="30%">Commission Date</th>
            <th style="border: #000000 solid 1px;" width="20%"><?=lang('periods')?></th>
            <th style="border: #000000 solid 1px;" width="20%">Ritase Total</th>
        </tr> 
        <?php 
        $i=0;
        if (!empty($ritase_lists)) {
            foreach ($ritase_lists as $row) {
                $i++;
        ?>
                <tr valign="top">
                    <td style="border: #000000 solid 1px;" align="center"><?=$i?></td>
                    <td style="border: #000000 solid 1px;" align="center"><?= $row->commission_no;?></td>
                    <td style="border: #000000 solid 1px;" align="center"><?= date('d-m-Y',strtotime($row->until_date))?></td> 
                    <td style="border: #000000 solid 1px;" align="center"><?= $row->period;?></td>
                    <td style="border: #000000 solid 1px;" align="center"><?= number_format($row->total_ritase);?></td>
                </tr>
        <?php 
            }
        }
        
        if($i == 0){
        ?>
            <tr>
                <td colspan="5" align="center" style="border: #000000 solid 1px;">Data not available.</td>
            </tr>
        <?php
        }
        ?>
    </table>
</div>

</body>
</html>
