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

//suggestions
		$('input.vehicle-type').keyup(function(){
			$(".resSuggDiv").remove();
			var inputStr = $(this).val().trim();
			var searchInput=$(this);
			var inputData='{"inputString":"'+inputStr+'","workspaceid":"'+workspaceid+'"}';
            $("#wholebody_loader").show();
            $.post('./Controller.php',{"getWorkspaceUsersByInput":inputData},function (data){
                $("#wholebody_loader").hide();

                // console.log(data);
				if(data!='[]')
				{
					var usersData=$.parseJSON(data);
					var listGroupDiv = $("<div class='resSuggDiv'><ul class='list-group'></ul></div>");
					var liComp = "";
					$.each(usersData,function(i,obj){
						liComp += '<li class="list-group-item userSuggList" id="'+obj['id'] +'">'+obj['name']+'</li>';

					});
					listGroupDiv.find("ul").append(liComp);
	                $("body").append(listGroupDiv);
	                var eleWidth=$('.left-inner-addon').width();
	                listGroupDiv.css({
	                 	position:'absolute',
	                  	top:searchInput.offset().top+31,
	                    left:searchInput.offset().left,
	                    width:$('.left-inner-addon').width()
	                });
	                $(".userSuggList").click(function(){
	                	$('.userProfileSearchInput').val($(this).html());
	                	$(".resSuggDiv").remove();
                        $("#wholebody_loader").show();
                        // window.location.href = "ProfilePage.php?userid="+$(this).attr("id");
	                });
           		}
			});

		});



	});

}
start();