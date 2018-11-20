//$(document).ready(function(){
//alert("hello");
//})




//fetch the Category
$(document).ready(function(){
 var DOMAIN="http://localhost/Mini_Project";

$("#submit").click(function(){
	
	if($("#exampleInputEmail1").val()=="admin")
	{
		$("#exampleInputEmail1").removeClass("border-danger");

	 if($("#exampleInputPassword1").val()=="admin"){
	 	alert("Login Sucessfully");
		window.location = 'http://localhost/Mini_Project/dashboard.php'; 	
		$("#exampleInputEmail1").removeClass("border-danger");
	 }

	$("#exampleInputPassword1").addClass("border-danger"); 
	$("#exampleInputPassword1").html("<span class='text-danger'>Please Enter The correct username password </span>");
	}else{ alert("Login Error"); }
	
	
	$("#exampleInputEmail1").addClass("border-danger"); 
	$("#exampleInputEmail1").html("<span class='text-danger'>Please Enter The correct username password</span>");
	
	
});




 fetch_category();

 function fetch_category(){
	$.ajax({
			url : DOMAIN+"/includes/process.php",
			method : "POST",
			data   : {getcategory:1},
			success : function(data){
				var choose="<option value=''>Choose The Category</option>";
				$("#cat_list").html(choose+data);
			$('#select_cat').html(choose+data);
			//alert(data);
			}

		})
	}



  //Add category

 $("#category_form").on("submit",function(){
		if($("#category_name").val() == ""){
			$("#category_name").addClass("border-danger"); 
			$("#cat_error").html("<span class='text-danger'>Please Enter The Category Name</span>");
			}else{
				 $.ajax({
					url : DOMAIN+"/includes/process.php",
					method :"POST",
					data : $("#category_form").serialize(),
					success : function(data){
						if(data==1){
							fetch_category();
							$("#category_name").removeClass("border-danger"); 
			$("#cat_error").html("<span class='text-success'>Category Added Sucessfully Added...!</span>");
			$("#category_name").val("");
			
						}
						else
						{
							$("#cat_error").html(data);
							//alert(data); 
						}
				}
			})

		} 
	})

 //Add Brand

 $("#brand_form").on("submit",function(){
 	if($("#brand_name").val()==""){
 		$("#brand_name").addClass("border-danger");
 		$("#brand_error").html("<span class='text-danger'>Please Enter The Brand Name</span>");
 	}else{
 		$.ajax({
 			url:DOMAIN+"/includes/process.php",
 			method:"POST",
 			data:$("#brand_form").serialize(),
 			
 			success:function(data){
 				if(data==1){
 					//alert(data);
 					fetch_brand();
 					$("#brand_name").removeClass("border-danger");
 					$("#brand_error").html("<span class='text-success'>Brand Added Sucessfully...!</span>");
 					$("#brand_name").val("");

 					
 				}
 				else
 				{
 					$("#brand_error").html(data);
 					//alert(data);
 				} 
 			}

 		})
 	}

  })

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
 
 
   //add Product
	  $("#product_form").on("submit",function(){
 		$.ajax({
 			url : DOMAIN+"/includes/process.php",
 			method : "POST",
 			data:$("#product_form").serialize(),
 			success:function(data){
 				if(data==1){
 					alert("New Product Added Sucessfully...!");
 					$("#product_name").val("");
 					$("#select_cat").val("");
 					$("#select_brand").val("");
 					$("#product_price").val("");
 					$("#product_qty").val("");
 					$("#product_packing").val("");
 				}else{
 					console.log(data);
 					alert(data);
 				} 
 			}

 		})
 	 
    })
 //Manage Category	

	//  managecategory();
	// function managecategory(){
	 //	$.ajax({
	 //		url:DOMAIN+"/includes/process.php",
	// 		method : "POST",
 	//		data:{managecategory:1},
 	//		success:function(data){
 	//			$("#get_category").html(data);
 	//			//alert(data);
 	//		}
	 		
	 //		})
	//	 }



})
