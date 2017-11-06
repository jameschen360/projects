$(document).ready (function() {
    $(window).load(function() {
        var adminUser = new FormData();
        adminUser.append('admin_id', localStorage.admin_id);
        var tUnit = $('#unitTable').DataTable({
        });
        var tShop = $('#shopTable').DataTable({
        });
        var tCategory = $('#categoryTable').DataTable({
        });
        
        // $.ajax({
        //     type: "POST",
        //     url: "/portal/services/admin/tables/userTable.php",
        //     data: adminUser,
        //     contentType: false,
        //     processData: false,	
        //     cache: false,
        //     beforeSend: function(){},
        //     success: function(data) {
        //         var jsonUserData = $.parseJSON(data);
        //         for (var i = 0; i < jsonUserData.userData.length; i++) {
        //             var userFullName = jsonUserData.userData[i].fname+' '+jsonUserData.userData[i].lname;
        //             tUnit.row.add( [
        //                 userFullName,
        //                 jsonUserData.userData[i].email,
        //                 jsonUserData.userData[i].phone,
        //                 '<button id="button_'+jsonUserData.userData[i].id+'" class="btn btn-primary openMeUser">View Info</button>'
        //             ] ).draw( false );
        //         }
        //     }
        // });
    });

    // $( document ).on('click', '.openMeUser', function(e){
    //     $('#userTable').LoadingOverlay("show");
    //     var userID = $(this).attr('id').split('_')[1];
    //     userInfo = new FormData();
    //     userInfo.append('admin_id', localStorage.admin_id);
    //     userInfo.append('user_id', userID);
    //     $.ajax({
    //         type: "POST",
    //         url: "/portal/services/admin/userInfo.php",
    //         data: userInfo,
    //         contentType: false,
    //         processData: false,	
    //         cache: false,
    //         beforeSend: function(){},
    //         success: function(data) {
    //             var jsonUserData = $.parseJSON(data).userDetail[0];
    //             var userFullName = jsonUserData.fname+' '+jsonUserData.lname;
    //             var email = jsonUserData.email;
    //             var address = jsonUserData.address;
    //             var pcode = jsonUserData.pcode;
    //             var phone = jsonUserData.phone;
    //             $('#userID').html(userFullName);
    //             $('#userAddressInfo').html(address);
    //             $('#userEmailInfo').html(email);
    //             $('#userPhoneInfo').html(phone);

    //             var options = {}
    //             $('[data-remodal-id=userTableModal]').remodal(options).open();
    //             $('#userTable').LoadingOverlay("hide", true);
                
    //         }
    //     });

    // });
    // function cFL(string) {
    //     return string.charAt(0).toUpperCase() + string.slice(1);
    // }
});