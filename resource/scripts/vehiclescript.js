


function start()
{

		//1-MotoCycle, 2- Car, 3- RV this data has to sit in DB, but for time being a JSON Object is considered, All Available VehicleTypes, Make and corresponding models
		

	$(document).ready(function() {
		console.log("Inside sitescript.js");


         $(document).on("click",".sendEmailBtn",function(e){
         	$(".busy-loader").show();
         	var reqObjPost= {};
         	reqObjPost['mailbody'] = $(".mail-body-seller").val();
         	reqObjPost['vehicleid'] = $(".vehicle-main-details").attr("vehicleid");
         	reqObjPost['sellerid'] = $(".emailSellerBtn").attr("sellerid");

        	$.ajax({
		        url: './EmailController.php',
		        type: 'post',
		        data: reqObjPost,
		        dataType: 'text',
		        success: function (data) {
		        	$(".busy-loader").hide();
		        	if ($.trim(data)=="fail")
		        	{
		        		$('#errorModal .modal-body').html("<p>Contact admin, Something went wrong.</p>");
						$('#errorModal').on('hidden.bs.modal', function (e) {
							$('#errorModal').off();
						});
						
						$("#errorModal").modal("show");
						$("#errorModal").css("z-index","1100");

		        	}
		        	else
		        	{
		        		$('#successModal .modal-body').html("<p>Email sent successful. </p>");
						$('#successModal').on('hidden.bs.modal', function (e) {  
							$('#successModal').off();
								
						});

						$("#successModal").modal("show");
						$("#successModal").css("z-index","1100");
		        	}

		        }

		    });

        });


         
         $(document).on("click",".commenttext-submitBtn",function(e){
         	$(".busy-loader").show();
         	var reqObjPost= {};
         	reqObjPost['comment'] = $(".commenttext-topost-buyer").val();
         	reqObjPost['buyerid'] = '1';
         	reqObjPost['sellerid'] = $(".emailSellerBtn").attr("sellerid");

        	$.ajax({
		        url: './EmailController.php',
		        type: 'post',
		        data: reqObjPost,
		        dataType: 'text',
		        success: function (data) {
		        	$(".busy-loader").hide();
		        	if ($.trim(data)=="fail")
		        	{
		        		$('#errorModal .modal-body').html("<p>Contact admin, Something went wrong.</p>");
						$('#errorModal').on('hidden.bs.modal', function (e) {
							$('#errorModal').off();
						});
						
						$("#errorModal").modal("show");
						$("#errorModal").css("z-index","1100");

		        	}
		        	else
		        	{
		        		$('#successModal .modal-body').html("<p>Commented successfully. </p>");
						$('#successModal').on('hidden.bs.modal', function (e) {  
							$('#successModal').off();
							location.reload();
								
						});

						$("#successModal").modal("show");
						$("#successModal").css("z-index","1100");

		        	}

		        }

		    });

        });


	});

}


start();

