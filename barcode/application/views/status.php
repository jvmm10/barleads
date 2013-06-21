<script>
$(function(){
	$('.substatusselect').live('click',function(){
			var id = $(this).attr('id');
			$('#preview').html(id);
	});
	$('#stat').keydown(function(e){
		var status = $('#status').val();
		var bank = $('#bank').val();
		var barcode = $('#barcode').val();
		var amount = $('#amount').val();
		var success = '<div class="success"><p>Successfully Saved.</p></div>';
		var error = '<div class="error"><p>Failed to save.</p></div>';
		var key = e.which;
		var radio_checked = $('.substatusselect:checked').val();
		
		var radio = $('.substatusselect').length;
		if(key == 13)
		{
			$('#preview').html('');
			if(radio > 0)
			{
				if($('.substatusselect:checked').length > 0)
				{
					alert("Please select sub status");
					return false
				}
			}
			
			if(bank =='' || status == '' || barcode == '')
			{
				alert("Complete the form");
				return false;
			}else
			{
			
				
				$.ajax({
					url:'savestatus',	
					type:"POST",
					data:{barcode:barcode,status:status,bank:bank,amount:amount,radio_checked:radio_checked},
					dataType:"json",
					beforeSend: function(data){
						$.blockUI();
					},
					success:function(data){
					
						if(data.success)
						{
							$('#barcode').val('');
							$('#barcode').focus();
							$('.success').remove();
							if($('.current_status').parent().find('tr').length > 1)
							{
								$('.current_status').parent().find('tr').next().remove();
							}
							$('.current_status').parent().find('tr').after('<tr><td>'+data.chcode+'</td><td>'+data.chname+'</td><td>'+data.acctno+'</td><td>'+data.status+'</td><td>'+data.radio+'</td><td>'+data.amount+'</td><td>'+data.date+'</td></tr>');
							$('.current_status').show();
							$('.right').append(success);	
							$('#barcode').val('');
							$('#amount').val('');
							$.unblockUI();
						}else{
							$('.right').empty();
							$('.current_status').hide();
							$('.right').append(error);
							$.unblockUI();
						}
					},
				});
				
			}
		}
	});	
	
	$('#bank').change(function(){
		$('#preview').html('');
		$('#list_of_sub').empty();
			var val = $(this).val();
			var status = $('#status').val();
		if(status!='')
		{
				$.ajax({
					url:'substatus',
					type:"POST",
					data:{bank:val,status:status},
					dataType:"json",
					success: function(data)
					{
						if(data.status)
						{
							$.each(data.subs,function(index,value){
									$('#list_of_sub').append('<li><input type="radio" name="substatuschoice" class="substatusselect" id="'+value+'" value="'+value+'"><b>'+index+'</b></li>');	
							});
						}else
						{
							$('#preview').html('No Sub Status');
						}
					}
				});
		}
	});
	
	$('#status').change(function(){
		$('#preview').html('');
		$('#list_of_sub').empty();
			var val = $(this).val();
			var bank = $('#bank').val();
		if(bank!='')
		{
				$.ajax({
					url:'substatus',
					type:"POST",
					data:{bank:bank,status:val},
					dataType:"json",
					success: function(data)
					{
						if(data.status)
						{
							$.each(data.subs,function(index,value){
									$('#list_of_sub').append('<li><input type="radio" name="substatuschoice" class="substatusselect" id="'+value+'" value="'+value+'"><b>'+index+'</b></li>');	
							});
						}else
						{
							$('#preview').html('No Sub Status');
						}
					}
				});
		}
	});
});
</script>
<h1>Transaction Status</h1>
<div class="rows">
	<label>Banks</label>
        <?php 
		$bank  = explode(",",$this->session->userdata('bank'));
		$options = array();
		$options[''] = 'Select';
		foreach($bank as $bnk)
		{
			$options[''.$bnk.''] = $bnk;
		}		
				echo form_dropdown('agentleads', $options, '','class=fields id=bank');?>
</div>


<br / style="clear:both">

<div class="left_right">
	<div class="left">
    	<div class="forms">
        	<form name="" id="stat">
            	<div class="row">
                	<label>Status</label>
                    <?php echo form_dropdown('status',$status_list,'','id=status');?>
                </div>
                <div class="row">
                	<label>Sub Status</label>
                    <ul id="list_of_sub">
                    	
                    </ul>
                    <span id="preview"></span>
                </div>
                <div class="row">
                	<label>Barcode</label>
                    <input type="text" name="barcode" value="" id="barcode" placeholder="Barcode">
                </div>
                
                 <div class="row">
                	<label>Amount</label>
                    <input type="text" name="amount" value="" id="amount" placeholder="Amount">
                </div>
            </form>
        </div>
    </div>
    <div class="right">
 
    
    
    <table class="current_status" style="display:none">
    	<tr>
        	<th>CHCode</th>
            <th>CHName</th>
            <th>AccNo</th>
            <th>Status</th>
            <th>Sub Status</th>
            <th>Amount</th>
            <th>dDatePTP</th>
        </tr>
    </table>
   
    </div>
     <br / style="clear:both">
</div>