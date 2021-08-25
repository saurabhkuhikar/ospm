$(document).ready(function(){
    /* all  */
    $("#checkedBoxAll").change(function(){
        if(this.checked) {
            $(".cylinderList").each(function(){
                this.checked=true;
            });
            $(".cylinderType").each(function() {
                this.checked=true;
            });
            $(".cylinderBooking").each(function(){
                this.checked=true;
            });
            $(".bookingRequest").each(function(){
                this.checked=true;
            });
        }else{
            $(".cylinderList").each(function(){
                this.checked=false;
            });
            $(".cylinderType").each(function(){
                this.checked=false;
            });
            $(".cylinderBooking").each(function(){
                this.checked=false;
            });
            $(".bookingRequest").each(function(){
                this.checked=false;
            });            
        }
    });

    /* cylinderListAll  */
    $("#cylinderListAll").change(function(){
        if(this.checked) {
            $(".cylinderList").each(function(){
                this.checked=true;
            });
        }else{
            $(".cylinderList").each(function(){
                this.checked=false;
            });
        }
    });
 /* cylinderList  */
    $(".cylinderList").click(function (){
        if($(this).is(":checked")){
            var isAllChecked = 0;

            $(".cylinderList").each(function(){
                if (!this.checked)
                    isAllChecked = 1;
            });

            if(isAllChecked == 0){
                $("#cylinderListAll").prop("checked", true);
            }     
        }
        else{
            $("#cylinderListAll").prop("checked", false);
        }
    });

 /* cylinderTypeAll  */
    $("#cylinderTypeAll").change(function(){
        if(this.checked) {
            $(".cylinderType").each(function(){
                this.checked=true;
            });
        }else{
            $(".cylinderType").each(function(){
                this.checked=false;
            });
        }
    });

    /* cylinderType  */
    $(".cylinderType").click(function () {
        if($(this).is(":checked")){
            var isAllChecked = 0;

            $(".cylinderType").each(function(){
                if(!this.checked)
                    isAllChecked = 1;
            });

            if(isAllChecked == 0) {
                $("#cylinderTypeAll").prop("checked", true);
            }     
        }
        else{
            $("#cylinderTypeAll").prop("checked", false);
        }
    });

    /* cylinderBookingAll  */
    $("#cylinderBookingAll").change(function(){
        if(this.checked) {
            $(".cylinderBooking").each(function(){
                this.checked=true;
            });
        }else{
            $(".cylinderBooking").each(function(){
                this.checked=false;
            });
        }
    });
 /* cylinderBooking  */
    $(".cylinderBooking").click(function (){
        if($(this).is(":checked")){
            var isAllChecked = 0;

            $(".cylinderBooking").each(function(){
                if(!this.checked)
                    isAllChecked = 1;
            });

            if(isAllChecked == 0){
                $("#cylinderBookingAll").prop("checked", true);
            }     
        }
        else {
            $("#cylinderBookingAll").prop("checked", false);
        }
    });
 /* bookingRequestAll  */
    $("#bookingRequestAll").change(function() {
        if(this.checked){
            $(".bookingRequest").each(function() {
                this.checked=true;
            });
        }else{
            $(".bookingRequest").each(function() {
                this.checked=false;
            });
        }
    });
    /* bookingRequest  */
    $(".bookingRequest").click(function (){
        if($(this).is(":checked")){
            var isAllChecked = 0;

            $(".bookingRequest").each(function(){
                if(!this.checked)
                    isAllChecked = 1;
            });

            if(isAllChecked == 0){
                $("#bookingRequestAll").prop("checked", true);
            }     
        }
        else{
            $("#bookingRequestAll").prop("checked", false);
        }
    });
});