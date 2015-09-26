<script>
	window.onload = get_transactions();				// perform get_data after the page completely loads

	function get_transactions(){  
		$.ajax({
			url: base_url+"index.php/cashier/transaction/get_transactions/",
			type: 'POST',

			success: function(result){
				var results=JSON.parse(result);
				var transactionid=0, total=0, sales=0;
				for(var i=0; i<results.length; i++){
					transactionid=results[i].transaction_id;
					var string="<div class='transactioncontainer'> \
									<div class='transactionarray' name='transaction["+i+"]'><div class='transactiondetails'>";
					while(true){
						total+=results[i].count*results[i].itemprice;
						string+="<span class='itemname'>"+(results[i].itemname)+"</span> \
								<span class='itemprice'> Php "+(results[i].itemprice)+"</span> \
								<span class='count'>"+results[i].count+"</span>";
						if(i+1>=results.length || results[i+1].transaction_id != transactionid) break;
						i++;
					}
					string+="<span class='total'>Total:"+total+"</span></div></div></div>";
					sales+=total;
					total=0;
					$('#transactions').append(string);
				}
				console.log(sales);
			},
			error: function(err){
				$('#transactions').html(err);
			}
		});
	}
</script>

<div id="content">
	<div id="contentheader"><h3>Transactions</h3></div>
	<div id="transactions"></div>
</div>
<script src="<?php echo base_url() ?>assets/js/validate.js"></script>