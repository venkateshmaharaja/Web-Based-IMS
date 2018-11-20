$(document).ready(function(){
 var DOMAIN="http://localhost/Mini_Project";
	//Add customer
	  $("#customer_form").on("submit",function(){
 		$.ajax({
 			url : DOMAIN+"/includes/process.php",
 			method : "POST",
 			data:$("#customer_form").serialize(),
 			success:function(data){
 				if(data=="New_Customer_Added"){
 					alert("New Customer Added Sucessfully...!");
 					$("#customer_name").val("");
 					$("#customer_gst").val("");
 					$("#customer_address1").val("");
 					$("#customer_address2").val("");
 					$("#customer_address3").val("");
 				}else{
 					console.log(data);
 					$("#customer_name").val("");
 					$("#customer_gst").val("");
 					$("#customer_address1").val("");
 					$("#customer_address2").val("");
 					$("#customer_address3").val("");
 					alert(data);
 				} 
 			}

 		}) 
    })


	
	//MANAGE CUSTOMER
	managecustomer(1);
	 function managecustomer(){
	 	$.ajax({
	 		url:DOMAIN+"/includes/process.php",
	 		method : "POST",
 			data:{managecustomer:1},
 			success:function(data){
 				$("#get_customer").html(data);
 				//alert(data);
 			}
	 	})
	}




	
	$("body").delegate(".del_customer","click",function(){
		var did = $(this).attr("did");
		if (confirm("Are you sure ? You want to delete...!")) {
		 		$.ajax({
				 	url:DOMAIN+"/includes/process.php",
				 	method : "POST",
			 		data:{deletecustomer:1,id:did}, 
			 		success:function(data){
			 				if (data == "DELETE") {
			 					alert("Category Delete Successfully...!");
			 					managecustomer(1);
			 				}
			 				else if(data == "DELETED"){
			 					alert("Deleted Successfully...");
			 					managecustomer(1);
			 				}
			 				else
			 				{
			 					alert(data); 
			 					managecustomer(1);
			 				}
			 			}
			 	})
			 					
			}else{

			}
			
	})





	//Update customer 
	$("body").delegate(".edit_customer","click",function(){
		var eid = $(this).attr("eid");
		//alert(eid);
		$.ajax({
			url:DOMAIN+"/includes/process.php",
			method:"POST",
			dataType:"json",
			data:{updatecustomer:1,id:eid},
			success:function(data){
				console.log(data);
					$("#update_customer_name").val(data["customer_name"]);
 					$("#update_customer_gst").val(data["customer_gst"]);
 					$("#update_customer_address1").val(data["customer_address1"]);
 					$("#update_customer_address2").val(data["customer_address2"]);
 					$("#update_customer_address3").val(data["customer_address3"]);
		
			}
		})
	})
	
		

	$("#update_customer_form").on("submit",function(){
		$.ajax({

				url:DOMAIN+"/includes/process.php",
				method:"POST",
				data:$("#update_customer_form").serialize(),
				success:function(data){
					alert(data);
					window.location.href="";
				}
			})
		
	})
	


})