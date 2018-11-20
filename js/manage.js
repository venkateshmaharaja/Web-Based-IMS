$(document).ready(function(){
var DOMAIN="http://localhost/Mini_Project";
	
	//MANAGE CATEGORIES
	managecategory(1);
	 function managecategory(){
	 	$.ajax({
	 		url:DOMAIN+"/includes/process.php",
	 		method : "POST",
 			data:{managecategory:1},
 			success:function(data){
 				$("#get_category").html(data);
 				//alert(data);
 			}
	 	})
	}	



	$("body").delegate(".del_cat","click",function(){
		var did = $(this).attr("did");
		if (confirm("Are you sure ? You want to delete...!")) {
		 		$.ajax({
				 	url:DOMAIN+"/includes/process.php",
				 	method : "POST",
			 		data:{deletecategory:1,id:did}, 
			 		success:function(data){
			 				if (data == "CATEGORIES_DELETE") {
			 					alert("Category Delete Successfully...!");
			 					managecategory(1);
			 				}
			 				else if(data == "DELETED"){
			 					alert("Deleted Successfully...");
			 					managecategory(1);
			 				}
			 				else
			 				{
			 					alert(data); 
			 					managecategory(1);
			 				}
			 			}
			 	})
			 					
			}else{

			}
			
	})

	//fetch category
	fetch_category();

 	function fetch_category(){
	$.ajax({
			url : DOMAIN+"/includes/process.php",
			method : "POST",
			data   : {getcategory:1},
			success : function(data){
				var choose="<option value=''>Choose The Category</option>";
				$("#cat_list").html(choose+data);
				
			}

		})
	}



	
	//UPDATE CATEGORIES
	$("body").delegate(".edit_cat","click",function(){

		var eid = $(this).attr("eid");
		$.ajax({
			url:DOMAIN+"/includes/process.php",
			method:"POST",
			dataType:"json",
			data:{updatecategory:1,id:eid},
			success:function(data){
				console.log(data);
				$("#cid").val(data["cid"]);
				$("#update_category").val(data["category_name"]);
					
			}
		})
	}) 


	$("#update_category_form").on("submit",function(){

		if($("#update_category").val()==""){
			$("#update_category").addClass("border-danger");
			$("#cat_error").html("<span class='text-danger'>Please Enter Category Name  ");

		}else{
			$.ajax({
				url:DOMAIN+"/includes/process.php",
				method:"POST",
				data:$("#update_category_form").serialize(),
				success:function(data){
					//alert(data);
					window.location.href="";
				}
			})
		}
	})


	




	//-------manage brand----------/
	managebrand(1);
	 function managebrand(){
	 	$.ajax({
	 		url:DOMAIN+"/includes/process.php",
	 		method : "POST",
 			data:{managebrand:1},
 			success:function(data){
 				$("#get_brand").html(data);
 				//alert(data);
 			}
	 	})
	}


	//---------delete brand---------//
	$("body").delegate(".del_brand","click",function(){
		var did = $(this).attr("did");
		if (confirm("Are you sure ? You want to delete...!")) {
		 		$.ajax({
				 	url:DOMAIN+"/includes/process.php",
				 	method : "POST",
			 		data:{deletebrand:1,id:did}, 
			 		success:function(data){
			 				if (data == "DELETED") {
			 					alert("brand Delete Successfully...!");
			 					managebrand(1);
			 				}else{		
			 					alert(data); 
			 					managebrand(1);
			 				}
			 			}
			 	});
			 					
			}
			else
			{
				
			}
			
	})

	

	//Update Brand
	$("body").delegate(".edit_brand","click",function(){
		var eid = $(this).attr("eid");

		$.ajax({
			url:DOMAIN+"/includes/process.php",
			method:"POST",
			dataType:"json",
			data:{updatebrand:1,id:eid},
			success:function(data){
				console.log(data);
				$("#bid").val(data["bid"]);
				$("#update_brand").val(data["brand_name"]);
				
					
			}
		})
	})
	
	

	$("#update_brand_form").on("submit",function(){

		if($("#update_brand").val()==""){
			$("#update_brand").addClass("border-danger");
			$("#cat_error").html("<span class='text-danger'>Please Enter Brand Name  ");

		}else{
			$.ajax({
				url:DOMAIN+"/includes/process.php",
				method:"POST",
				data:$("#update_brand_form").serialize(),
				success:function(data){
					alert(data);
					window.location.href="";
				}
			})
		}
	})




	//------------------Manage Product ---------------------//

	manageproduct(1);
	 function manageproduct(){
	 	$.ajax({
	 		url:DOMAIN+"/includes/process.php",
	 		method : "POST",
 			data:{manageproduct:1},
 			success:function(data){
 				$("#get_product").html(data);
 				//alert(data);
 			}
	 	})
	}
	


	//---------delete product---------//
	$("body").delegate(".del_product","click",function(){
		var did = $(this).attr("did");
		if (confirm("Are you sure ? You want to delete...!")) {
		 		$.ajax({
				 	url:DOMAIN+"/includes/process.php",
				 	method : "POST",
			 		data:{deleteproduct:1,id:did}, 
			 		success:function(data){
			 				if (data == "DELETED") {
			 					alert("Product is Delete Successfully...!");
			 					manageproduct(1);
			 				}else{		
			 					alert(data); 
			 					manageproduct(1);
			 				}
			 			}
			 	});
			 					
			}
			else
			{
				
			}
			
	})


	




	//fetch category

		fetch_category();

	 function fetch_category(){
		$.ajax({
				url : DOMAIN+"/includes/process.php",
				method : "POST",
				data   : {getcategory:1},
				success : function(data){
					var choose="<option value=''>Choose The Category</option>";
					$('#select_cat').html(choose+data);
				}

			})
		}

	//fetch brand

			 fetch_brand();

	 function fetch_brand(){
		$.ajax({
				url : DOMAIN+"/includes/process.php",
				method : "POST",
				data   : {getbrand:1},
				success : function(data){
					var choose="<option value=''>Choose The Brand</option>";
					$('#select_brand').html(choose+data);
				}

			})
		}

	// Update Product 

	$("body").delegate(".edit_product","click",function(){
		var eid = $(this).attr("eid");

		$.ajax({
			url:DOMAIN+"/includes/process.php",
			method:"POST",
			dataType:"json",
			data:{updateproduct:1,id:eid},
			success:function(data){
				console.log(data);
				$("#pid").val(data["pid"]);
				$("#update_product").val(data["product_name"]);
				$("#select_cat").val(data["cid"]);
				$("#select_brand").val(data["bid"]);
				$("#product_price").val(data["product_price"]);
				$("#product_packing").val(data["product_packing"]);
				
					
			}
		})
	})
	

	 // update Product
	  $("#update_product_form").on("submit",function(){
	  	$.ajax({
			url : DOMAIN+"/includes/process.php",
 			method : "POST",
 			data : $("#update_product_form").serialize(),
 			success : function(data){
 				if (data == "UPDATED"){
 					alert("Product Updated Successfully....!");
 					window.location.href="";
				}else{
 					alert(data);
 					window.location.href="";
 				}
 			}


 		})
 	
 	 
    })



})