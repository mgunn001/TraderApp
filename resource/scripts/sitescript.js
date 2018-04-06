function start()
{
		var vehicleMakeAndModel={
			"car":{
				"honda":['Accord','Amaze','CRV'],
				"bmw":['X1,X5,X6,I8'],
				"audi":['A3','A5','A8','Q7']
			},
			"bike":{
				"Yamaha":['R1','R15'],
				"Suzuki":['HayaBusa','Hayate']
			},
			"rv":{
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

     
	});

}
start();