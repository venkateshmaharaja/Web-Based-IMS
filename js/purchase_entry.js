$(document).ready(function(){
	var DOMAIN="http://localhost/Mini_Project";
	
	addnewrow();

	$("#add").click(function(){
		addnewrow();
	})



	function addnewrow(){
		$.ajax({
			url:DOMAIN+"/includes/process_purchase.php",
			method:"POST", 
			data:{getpurchaseitem:1},
			success:function(data){
				//alert(data); 
				$("#invoice_item").append(data);
				var n=0;
				$(".number").each(function(){
					$(this).html(++n);
				})

			}
		})
	}
	
	$("#remove").click(function(){
		$("#invoice_item").children("tr:last").remove();
			calculate(0,0);
	})

	$("#invoice_item").delegate(".pid","change",function(){
		var pid = $(this).val();
		var tr =$(this).parent().parent();
		$(".overlay").show();
		$.ajax({
			url:DOMAIN+"/includes/process_purchase.php",
			method:"POST",
			dataType:"json",
			data:{getprice:1,id:pid},
			success:function(data){
				console.log(data);
				tr.find(".price").val(data["product_price"]);
				tr.find(".pro_name").val(data["product_name"]);
				tr.find(".qty").val(0);
				tr.find(".amt").html(tr.find(".qty").val()*tr.find(".price").val());
				
			}

		})
		calculate(0,0);

		//balance stock geting
		$.ajax({
				url:DOMAIN+"/includes/process_purchase.php",
				method:"POST",
				dataType:"json",
				data:{getstockbalance:1,id:pid},
				success:function(data){
				console.log(data);
				//alert(val(data["a"]));
				$c=data["a"]*1;
				tr.find(".tqty").val($c);	
				}
			})
	})


	$("#invoice_item").delegate(".qty","keyup",function(){
		var qty=$(this);
		var tr=$(this).parent().parent();
		if(isNaN(qty.val())){
		alert("please entert the valid quantity");
		qty.val(1);
		}else{

							//if((qty.val()-0)>(tr.find(".tqty").val()-0)){
							//	alert("Sorry ! This much of stock not avilable");
							//	aty.val(1);
							//}else{
								tr.find(".amt").html(qty.val() * tr.find(".price").val());
							//}
			calculate(0);
		}
	})



	//calculate the invoice value

	function calculate(dis){
		var sub_total=0;
		var discount=dis;
		var gst=0;
		var net_total=0;
		$(".amt").each(function(){
			sub_total=sub_total + ($(this).html() * 1	);
		})	
		
		 gst=0.18 * sub_total;
		 net_total= gst+sub_total;
		 net_total= net_total- discount
		$("#gst").val(gst);
		$("#discount").val(discount);
		$("#sub_total").val(sub_total);
		$("#Net_Amount").val(net_total);
	}	
		$("#discount").keyup(function(){
			var discount=$(this).val();
			calculate(discount);
		})


	//get the customer name
	 fetch_customeraddress();

	 function fetch_customeraddress(){
	$.ajax({
			url : DOMAIN+"/includes/process_purchase.php",
			method : "POST",
			data   : {getcustomeraddress:1},
			success : function(data){
		var choose="<option value=''>Choose The Supplier/ Buyer </option>";
			$("#customer").html(choose+data);
				$("#customer").change(function(){
				 var str=$(this);
			   	var cid=str.val();
				console.log(cid);

			//get the customer id the fetch the record of the address
				
				$.ajax({
					url:DOMAIN+"/includes/process_purchase.php",
					method:"POST",
					dataType:"json",
					data : {fetchcustomeraddress:1,id:cid},
					success:function(data){
					//alert(data);
					console.log(data);
					var gst = data["customer_gst"];
					var add1 = data["customer_address1"];
					var add2 = data["customer_address2"];
					var add3 = data["customer_address3"];
					
					//console.log(a);
					$("td.gst").text(gst);
					$("td.address1").text(add1);
					$("td.address2").text(add2);
					$("td.address3").text(add3);
					
					}
					
				})
			})
			
		
		}
		});
		
		

		}




		//purchase invoice accepting
		$("#purchase_entry").click(function(){
			$.ajax({
				url:DOMAIN+"/includes/process_purchase.php",
				method:"POST",
				data:$("#purchase_entry_form").serialize(),
				success:function(data){
					//console.log(data);
					alert("PURCHASE ENTERED");
					if(data)
					{
						location.reload(data); 
					}	
				}				

			})
		})

		
	
});