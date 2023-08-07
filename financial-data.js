jQuery(document).ready(function($){
    $("select#years").change(function(){
        $(this).children("option:selected").addClass("selected").siblings().removeClass("selected");
        var selectedYearValue = $("#selection.selected").val();

        $.ajax({
            url: ajax_object.ajax_url,

            data:{
                action: "ajax_load_data",
                yearSelected: selectedYearValue
            },

            success: function(data){
                $(".data-box").html(data);
            },

            error:function(data) {
				console.log(data);
   			}
        });

    });
});