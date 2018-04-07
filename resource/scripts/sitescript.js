function start()
{

		//1-MotoCycle, 2- Car, 3- RV this data has to sit in DB, but for time being a JSON Object is considered, All Available VehicleTypes, Make and corresponding models
		var vehicleMakeAndModel={
			"1":{
				"Yamaha":['R1','R15'],
				"Suzuki":['HayaBusa','Hayate']
			},
			"2":{
				"honda":['Accord','Amaze','CRV'],
				"bmw":['X1,X5,X6,I8'],
				"audi":['A3','A5','A8','Q7']
			},
			"3":{
				"ForestRiver":['Model1','Model2'],
				"Keystone":['Model1','Model2']
			}
		};



	$(document).ready(function() {
		console.log("Inside sitescript.js");


		// to get the dropup action on the hover instood of click
        $(document).on("mouseover",".additional-filter-items-form .dropdown-toggle",function(e){
        	$(this).trigger("click");	
        });


        // to get the dropup action on the hover instood of click
        $(document).on("click",".filtered-vehicles-wrapper .card img, .filtered-vehicles-wrapper .card-footer button",function(e){
        	window.location.href= $(this).parents(".card").find("a").attr("href");
        });


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



	});

}
start();