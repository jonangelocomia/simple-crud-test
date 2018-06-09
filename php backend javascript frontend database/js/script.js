

jQuery( function() {
    initRecordTableTrigger();
    initRecordInputFinder();
    initModalButtonTrigger();
    initModalInputChecker();
});

function initRecordTableTrigger() {
    jQuery('.staff-record-table-row').unbind("click");
    jQuery('.staff-record-table-row').click(function(e) {
        jQuery("#updatestaffmodal_staffid").val(jQuery(this).data("staffdata").staff_id);
        jQuery("#updatestaffmodal_lname").val(jQuery(this).data("staffdata").lname);
        jQuery("#updatestaffmodal_fname").val(jQuery(this).data("staffdata").fname);
        jQuery("#updatestaffmodal_mname").val(jQuery(this).data("staffdata").mname);
        jQuery("#updatestaffmodal_age").val(jQuery(this).data("staffdata").age);
        jQuery("#updatestaffmodal_birthday").val(jQuery(this).data("staffdata").birthday);
        jQuery("#updatestaffmodal_address").val(jQuery(this).data("staffdata").address);
        jQuery("#updatestaffmodal_contact").val(jQuery(this).data("staffdata").contact);

        jQuery("#prime-container").val(jQuery(this).data("staffdata").status);
    });
}

function initRecordInputFinder() {
    jQuery('#controlstaffmaininput').unbind("keyup");
    jQuery('#controlstaffmaininput').keyup(function(e) {
        jQuery.ajax({
            data: {
                type_r: "staff_find",
                key: jQuery("#controlstaffmaininput").val()
            },
            type: "post",
            url: "action.php",
            success: function(data){
                jQuery('#controlstaffmainoutput').html(data);
                initRecordTableTrigger();
                initRecordInputFinder();
                initModalButtonTrigger();
                initModalInputChecker();
            }
        });
    });
}

function initModalButtonTrigger() {
    jQuery('#createstaffmodalbutton').unbind("click");
    jQuery('#createstaffmodalbutton').click(function(e) {
        var ready = true;
        if( jQuery("#createstaffmodal_lname").val().trim() == "" ) {
            jQuery("#createstaffmodal_lname").attr("placeholder","this is a required field").addClass("required-feilds");
            ready = false;
        } else {
            jQuery("#createstaffmodal_lname").attr("placeholder","this is a required field").removeClass("required-feilds");
        }
        if( jQuery("#createstaffmodal_fname").val().trim() == "" ) {
            jQuery("#createstaffmodal_fname").attr("placeholder","this is a required field").addClass("required-feilds");
            ready = false;
        } else {
            jQuery("#createstaffmodal_fname").attr("placeholder","this is a required field").removeClass("required-feilds");
        }
        if( jQuery("#createstaffmodal_mname").val().trim() == "" ) {
            jQuery("#createstaffmodal_mname").attr("placeholder","this is a required field").addClass("required-feilds");
            ready = false;
        } else {
            jQuery("#createstaffmodal_mname").attr("placeholder","this is a required field").removeClass("required-feilds");
        }
        if(ready) {
            jQuery.ajax({
                data: {
                    type_r: "staff_create",
                    lname: jQuery("#createstaffmodal_lname").val(),
                    fname: jQuery("#createstaffmodal_fname").val(),
                    mname: jQuery("#createstaffmodal_mname").val(),
                    age: jQuery("#createstaffmodal_age").val(),
                    birthday: jQuery("#createstaffmodal_birthday").val(),
                    address: jQuery("#createstaffmodal_address").val(),
                    contact: jQuery("#createstaffmodal_contact").val(),
                    status: 1
                },
                type: "post",
                url: "action.php",
                success: function(data){
                    alert(data);
                    jQuery('.modal').modal('hide');
                    setTimeout(function(){
                        jQuery.ajax({
                            data: {
                                type_r: "refresh_tab",
                                tab: "controlstaff.php"
                            },
                            type: "post",
                            url: "action.php",
                            success: function(data){
                                jQuery("#staff_tab").html(data);
                                initRecordTableTrigger();
                                initRecordInputFinder();
                                initModalButtonTrigger();
                                initModalInputChecker();
                                feather.replace();
                            }
                        });
                    }, 900);
                }
            });
        }
    });
    jQuery('#updatestaffmodalbutton').unbind("click");
    jQuery('#updatestaffmodalbutton').click(function(e) {
        var ready = true;
        if( jQuery("#updatestaffmodal_lname").val().trim() == "" ) {
            jQuery("#updatestaffmodal_lname").attr("placeholder","this is a required field").addClass("required-feilds");
            ready = false;
        } else {
            jQuery("#updatestaffmodal_lname").attr("placeholder","this is a required field").removeClass("required-feilds");
        }
        if( jQuery("#updatestaffmodal_fname").val().trim() == "" ) {
            jQuery("#updatestaffmodal_fname").attr("placeholder","this is a required field").addClass("required-feilds");
            ready = false;
        } else {
            jQuery("#updatestaffmodal_fname").attr("placeholder","this is a required field").removeClass("required-feilds");
        }
        if( jQuery("#updatestaffmodal_mname").val().trim() == "" ) {
            jQuery("#updatestaffmodal_mname").attr("placeholder","this is a required field").addClass("required-feilds");
            ready = false;
        } else {
            jQuery("#updatestaffmodal_mname").attr("placeholder","this is a required field").removeClass("required-feilds");
        }
        if(ready) {
            jQuery.ajax({
                data: {
                    type_r: "staff_update",
                    staffid: jQuery("#updatestaffmodal_staffid").val(),
                    lname: jQuery("#updatestaffmodal_lname").val(),
                    fname: jQuery("#updatestaffmodal_fname").val(),
                    mname: jQuery("#updatestaffmodal_mname").val(),
                    age: jQuery("#updatestaffmodal_age").val(),
                    birthday: jQuery("#updatestaffmodal_birthday").val(),
                    address: jQuery("#updatestaffmodal_address").val(),
                    contact: jQuery("#updatestaffmodal_contact").val(),
                    status: jQuery("#updatestaffmodal_status").val()
                },
                type: "post",
                url: "action.php",
                success: function(data){
                    alert(data);
                    jQuery('.modal').modal('hide');
                    setTimeout(function(){
                        jQuery.ajax({
                            data: {
                                type_r: "refresh_tab",
                                tab: "controlstaff.php"
                            },
                            type: "post",
                            url: "action.php",
                            success: function(data){
                                jQuery("#staff_tab").html(data);
                                initRecordTableTrigger();
                                initRecordInputFinder();
                                initModalButtonTrigger();
                                initModalInputChecker();
                                feather.replace();
                            }
                        });
                    }, 900);
                }
            });
        }
    });
}

function initModalInputChecker() {
    jQuery('#createstaffmodal_code').unbind("change");
    jQuery('#createstaffmodal_code').change(function(e) {
        jQuery.ajax({
            data: {
                type_r: "user_check",
                for: "all",
                code: jQuery("#createstaffmodal_code").val()
            },
            type: "post",
            url: "action.php",
            success: function(data){
                if(data != "fine") {
                    jQuery("#createstaffmodal_code").val("");
                    jQuery("#createstaffmodal_code").attr("placeholder",data);
                }
            }
        });
    });
    jQuery('#updatestaffmodal_code').unbind("change");
    jQuery('#updatestaffmodal_code').change(function(e) {
        jQuery.ajax({
            data: {
                type_r: "user_check",
                for: "staff",
                staff_id: jQuery("#updatestaffmodal_staffid").val(),
                code: jQuery("#updatestaffmodal_code").val()
            },
            type: "post",
            url: "action.php",
            success: function(data){
                if(data != "fine") {
                    jQuery("#updatestaffmodal_code").val("");
                    jQuery("#updatestaffmodal_code").attr("placeholder",data);
                }
            }
        });
    });
}