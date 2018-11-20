$(document).ready(function(){
var DOMAIN="http://localhost/Mini_Project";



	
	//MANAGE CATEGORIES
	managepurchase(1);
	 function managepurchase(){
	 	$.ajax({
	 		url:DOMAIN+"/includes/process_purchase.php",
	 		method : "POST",
 			data:{managepurchase:1},
 			success:function(data){
 				$("#get_purchase").html(data);
 				//alert(data);
 			}
	 	})
	}
	$("body").delegate(".del_purchase","click",function(){
		var did = $(this).attr("did");
		if (confirm("Are you sure ? You want to delete...!")) {
		 		$.ajax({
				 	url:DOMAIN+"/includes/process_purchase.php",
				 	method : "POST",
			 		data:{deletepurchase:1,id:did}, 
			 		success:function(data){
			 				if (data == 1) {
			 					alert("Purchase Delete Successfully...!");
			 					managepurchase(1);
			 				}else{		
			 					alert("Somethink wrong"); 
			 					managepurchase(1);
			 				}
			 			}
			 	});
			 					
			}
			else
			{
				
			}
			
	})



	$("body").delegate(".view_purchase","click",function(){
		var eid = $(this).attr("eid");

		$.ajax({
			url:DOMAIN+"/includes/process_purchase.php",
			method:"POST",
		  //dataType:"json",
			data:{viewpurchaserecordsouter:1,id:eid},
			success:function(data){
				console.log(data);
				
				
					
			}
		})
	})



	total_purchase_calculate(1);
	 function total_purchase_calculate(){
	 	$.ajax({
	 		url:DOMAIN+"/includes/process_purchase.php",
	 		method:"POST",
	 		data:{total_purchase_calculate:1},
	 		success:function(data){
	 			$("#total_calc").html(data);
	 			//alert(data);
	 		}
	 	})
	 }

	 
	

			$("#searchbt").click(function(){
					//alert("oi");
					managepurchasereport(1);
					total_purchase_calculate_date(1);
	
					var c=confirm("You want some printable report");
					if(c==true){
						window.print();
					}
				})


	 //managepurchasereport(1);
	 function managepurchasereport(){
	 	var std = $("#std").val();
	 	var etd = $("#etd").val();
	 	//alert(std);
	 	//alert(etd);
	 
	 $.ajax({

	 		url:DOMAIN+"/includes/process_purchase.php",
	 		method : "POST",
 			data:{managepurchasereport:1,sd:std,ed:etd},
 			success:function(data){
 				$("#get_purchase_report").html(data);
 				//alert(data);
 			}
	 	})
	}
	
			 function total_purchase_calculate_date(){
			 	var std = $("#std").val();
	 			var etd = $("#etd").val();
			 	$.ajax({
			 		url:DOMAIN+"/includes/process_purchase.php",
			 		method:"POST",
			 		data:{total_purchase_calculate_date:1,sd:std,ed:etd},
			 		success:function(data){
			 			$("#total_calc_date").html(data);
			 			//alert(data);
			 		}
			 	})
			 }
			 	

})