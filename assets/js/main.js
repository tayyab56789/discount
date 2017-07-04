$(document).ready(function(){	
	$(document).on("click",".sidebar-toggle",function(){
	    $(".wrapper").toggleClass("toggled");
	});


});
$(document).ready(function(){
    $("#test").dataTable();
})

define(['pace'], function(pace){
  pace.start({
    document: false
  });
});

