var vehicleMakeAndModel={
			"1":{
				"Yamaha":['R1','R15'],
				"Suzuki":['HayaBusa','Hayate']
			},
			"2":{
				"Honda":['Accord','Amaze','CRV'],
				"Bmw":['X1','X5','X6','I8'],
				"Audi":['A3','A5','A8','Q7']
			},
			"3":{
				"ForestRiver":['Model1','Model2'],
				"Keystone":['Model1','Model2']
			},
			"4":{
				"Make1":['Model1','Model2'],
				"Make2":['Model1','Model2']
			}
		};

		var vehicleBodyType={
			"1":["Single Seater","Naked"],
			"2":["Sedan","SUV","Convertable"],
			"3":["BodyType1","BodyType2"],
			"4":["BodyType1","BodyType2"]
		};


function start()
{

		//1-MotoCycle, 2- Car, 3- RV this data has to sit in DB, but for time being a JSON Object is considered, All Available VehicleTypes, Make and corresponding models
		

	$(document).ready(function() {
		console.log("Inside buyerscript.js");

		uiInitialisations();

		 $(document).on("change",".additional-filter-items-form input[type=checkbox]",function(e){         	
         	var filterInputObj={};
         	filterInputObj["vehicleTypeId"] = $(".vehicleTypeSel").val();
         	filterInputObj["keyword"] = $(".keyword-identifier-vehicle").val();

         	var additionalFilterAttrArr=['price','mileage','make','model','year','body','color','transmission'];

         	for(i=0;i<additionalFilterAttrArr.length;i++){
         		var vauesArr = [];

				$('input[name="'+additionalFilterAttrArr[i]+'_checkedList[]"]:checked').each(function() {
				    vauesArr.push($(this).val());
				});

				if(vauesArr.length ==0){
					vauesArr ='';
				}
				filterInputObj[additionalFilterAttrArr[i]] = vauesArr;
         	}
         	console.log(filterInputObj);
         	$(".busy-loader").show();
         	$.post('./HomeController.php',filterInputObj,function (data){
				$(".filtered-vehicles-wrapper").html(data);
				$(".busy-loader").hide();
			});

        });


		// to get the dropup action on the hover instood of click
        $(document).on("mouseover",".additional-filter-items-form .dropdown-toggle",function(e){
        	$(this).trigger("click");	
        });


        // to get the dropup action on the hover instood of click
        $(document).on("click",".filtered-vehicles-wrapper .card img, .filtered-vehicles-wrapper .card-footer button",function(e){
        	window.location.href= $(this).parents(".card").find("a").attr("href");
        });


          // handler to change the Make and Body on vehicle type slection, just as a sample,
          // Here the values are read from JSON instood they got be fetched from DB on UI Initialization itslef All Ajax calls are made.
	    $(document).on("change",".vehicleTypeSel",function(e){
	    	// for make value updation
	    	var curVehicleType = $(this).val();
	    	var makeArry = Object.keys(vehicleMakeAndModel[curVehicleType]);
	    	var makeCheckBoxListHTML ="";

	    	for(var i=0;i<makeArry.length;i++){
	    		makeCheckBoxListHTML += '<li> <a href="#"><label>'+makeArry[i]+'<input type="checkbox" name="make_checkedList[]" value="'+makeArry[i]+'"> </label></a></li>';
	    		if(i < makeArry.length-1){
	    			makeCheckBoxListHTML +='<li class="divider"></li>'
	    		}
	    	}
	    	$(".make-dropdown .dropdown-menu").html(makeCheckBoxListHTML);

	    	// for Bodytype value updation
	    	var bodyTypeArry = vehicleBodyType[curVehicleType];
	    	var bodyTypeCheckBoxListHTML ="";
	    	for(var i=0;i<bodyTypeArry.length;i++){
	    		bodyTypeCheckBoxListHTML += '<li> <a href="#"><label>'+bodyTypeArry[i]+'<input type="checkbox" name="body_checkedList[]" value="'+bodyTypeArry[i]+'"> </label></a></li>';
	    		if(i < bodyTypeArry.length-1){
	    			bodyTypeCheckBoxListHTML +='<li class="divider"></li>'
	    		}
	    	}
	    	$(".bodytype-dropdown .dropdown-menu").html(bodyTypeCheckBoxListHTML);

	    	console.log("Inside on change of vehicleTypeSel");
	    });



	    // Model List building on type checking
	    $(document).on('click','.model-dropdown .dropdown-toggle',function(){
		   
		   // get all the selected Makes
		   var selectedMakes = [];
			$('.make-dropdown input:checked').each(function() {
			    selectedMakes.push($(this).val());
			});
			
			// Build the HTML fro Model
			var modelTypeCheckBoxListHTML ="";
			var curVehicleType = $(".vehicleTypeSel").val();
			if(selectedMakes.length == 0){
				modelTypeCheckBoxListHTML = "First select a Make"
			}
			for(var i=0;i<selectedMakes.length;i++){
				var curMake = selectedMakes[i];
				var modelArry = vehicleMakeAndModel[curVehicleType][curMake];
	    		  modelTypeCheckBoxListHTML +='<li class="dropdown-header">'+curMake+'</li>';
	    		for(var j=0;j<modelArry.length;j++){
		    		modelTypeCheckBoxListHTML += '<li> <a href="#"><label>'+modelArry[j]+'<input type="checkbox" name="model_checkedList[]" relmake="'+ curMake+'" value="'+modelArry[j]+'"> </label></a></li>';
		    	}
		    	modelTypeCheckBoxListHTML +='<li class="divider"></li>';
			}
	    	$(".model-dropdown .dropdown-menu").html(modelTypeCheckBoxListHTML);

		});



	//suggestions
		$('input.keyword-identifier-vehicle').keyup(function(){
			$(".resSuggDiv").remove();
			var inputStr = $(this).val().trim();
			if(inputStr.length <2){
				return;
			}
			var searchInput=$(this);
			var inputObj={};
			inputObj["getKeywordsByInput"] =inputStr;
			inputObj["vehicleTypeId"] = $(".vehicleTypeSel").val();

            $(".busy-loader").hide().show();
            $.post('./HomeController.php',inputObj,function (data){
				$(".busy-loader").hide();
                console.log(data);
				if(data!='[]')
				{
					var usersData=$.parseJSON(data);
					var listGroupDiv = $("<div class='resSuggDiv'><ul class='list-group'></ul></div>");
					var liComp = "";
					$.each(usersData,function(i,obj){
						liComp += '<li class="list-group-item userSuggList">'+obj+'</li>';

					});
					listGroupDiv.find("ul").append(liComp);
	                $("body").append(listGroupDiv);
	                var eleWidth=$('.keyword-identifier-vehicle').width();
	                listGroupDiv.css({
	                 	position:'absolute',
	                  	top:searchInput.offset().top+31,
	                    left:searchInput.offset().left,
	                    width:$('.keyword-identifier-vehicle').width()
	                });
	                $(".userSuggList").click(function(){
	                	$('.keyword-identifier-vehicle').val($(this).html());
	                	$(".resSuggDiv").remove();
                       $(".busy-loader").show();
	                });
           		}

			});


		});


	});

}

function uiInitialisations(){

	// Few initialisations soon after page load

		// Make initialisations
		var makeArry = Object.keys(vehicleMakeAndModel[$(".vehicleTypeSel").val()]);
	    	var makeCheckBoxListHTML ="";
	    	for(var i=0;i<makeArry.length;i++){
	    		makeCheckBoxListHTML += '<li> <a href="#"><label>'+makeArry[i]+'<input type="checkbox" name="make_checkedList[]" value="'+makeArry[i]+'"> </label></a></li>';
	    		if(i < makeArry.length-1){
	    			makeCheckBoxListHTML +='<li class="divider"></li>'
	    		}
	    	}
	    	$(".make-dropdown .dropdown-menu").html(makeCheckBoxListHTML);

	    // Body Type initialisations
	    var bodyTypeArry = vehicleBodyType[$(".vehicleTypeSel").val()];
	    var bodyTypeCheckBoxListHTML ="";
	    	for(var i=0;i<bodyTypeArry.length;i++){
	    		bodyTypeCheckBoxListHTML += '<li> <a href="#"><label>'+bodyTypeArry[i]+'<input type="checkbox" name="body_checkedList[]" value="'+bodyTypeArry[i]+'"> </label></a></li>';
	    		if(i < bodyTypeArry.length-1){
	    			bodyTypeCheckBoxListHTML +='<li class="divider"></li>'
	    		}
	    	}
	    	$(".bodytype-dropdown .dropdown-menu").html(bodyTypeCheckBoxListHTML);

			
}

start();

