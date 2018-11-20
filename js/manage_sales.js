$(document).ready(function(){
var DOMAIN="http://localhost/Mini_Project";
	
	//MANAGE SALES
	managesales(1);
	 function managesales(){
	 	$.ajax({
	 		url:DOMAIN+"/includes/process_sales.php",
	 		method : "POST",
 			data:{managesales:1},
 			success:function(data){
 				$("#get_sales").html(data);
 				//alert(data);
 				
 			}
	 	})
	}
	$("body").delegate(".del_sales","click",function(){
		var did = $(this).attr("did");
		if (confirm("Are you sure ? You want to delete...!")) {
		 		$.ajax({
				 	url:DOMAIN+"/includes/process_sales.php",
				 	method : "POST",
			 		data:{deletesales:1,id:did}, 
			 		success:function(data){
			 				if (data == 1) {
			 					alert("Sales Delete Successfully...!");
			 					managesales(1);
			 				}else{		
			 					alert("Somethink wrong"); 
			 					managesales(1);
			 				}
			 			}
			 	});
			 					
			}
			else
			{
				
			}
			
	})	
	

	total_sales_calculate(1);
	 function total_sales_calculate(){
	 	$.ajax({
	 		url:DOMAIN+"/includes/process_sales.php",
	 		method:"POST",
	 		data:{total_sales_calculate:1},
	 		success:function(data){
	 			$("#total_calc").html(data);
	 		//	alert(data);
	 		}
	 	})
	 }



	 $("#s_searchbt").click(function(){
	 	//alert("oi");
					
					managesalesreport(1);
					total_sales_calculate_date(1);
					var c=confirm("You want some printable report");
					if(c==true){
						window.print();
					}


					//
					
					
				})


	 //managepurchasereport(1);
	 function managesalesreport(){
	 	var std = $("#s_std").val();
	 	var etd = $("#s_etd").val();
	 	//alert(std);
	 	//alert(etd);
	 
	 $.ajax({

	 		url:DOMAIN+"/includes/process_sales.php",
	 		method : "POST",
 			data:{managesalesreport:1,sd:std,ed:etd},
 			success:function(data){
 				$("#get_sales_report").html(data);
 				//alert(data);
 			}
	 	})
	}



	function total_sales_calculate_date(){
			 	var std = $("#s_std").val();
	 			var etd = $("#s_etd").val();
			 	$.ajax({
			 		url:DOMAIN+"/includes/process_sales.php",
			 		method:"POST",
			 		data:{total_sales_calculate_date:1,sd:std,ed:etd},
			 		success:function(data){
			 			$("#total_calc_date").html(data);
			 			//alert(data);
					
			 		}
			 	})
			 }

});