function start()
{
	$(document).ready(function() {
		console.log("Inside sitescript.js");


		// to get the dropup action on the hover instood of click
        $(document).on("mouseover",".additional-filter-items-form .dropdown-toggle",function(e){
        	$(this).trigger("click");	
        });

     
	});

}
start();