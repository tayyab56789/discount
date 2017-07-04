$('.carousel').carousel({
    interval: 5000 //changes the speed
})
jQuery(document).ready(function () {

    jQuery('.carousel[data-type="multi"] .item').each(function () {
        var next = jQuery(this).next();
        if (!next.length) {
            next = jQuery(this).siblings(':first');
        }
        next.children(':first-child').clone().appendTo(jQuery(this));

        for (var i = 0; i < 2; i++) {
            next = next.next();
            if (!next.length) {
                next = jQuery(this).siblings(':first');
            }
            next.children(':first-child').clone().appendTo($(this));
        }
    });

});




$(function () {
    $("#dialog").dialog();
    $(document).tooltip();
    var availableTags = [];



    $.post("api/", {
            action: "showAllProductName"
        })
        .done(function (data) {
            for (var i = 0; i < data.p_name.length; i++) {
                availableTags.push(data.p_name[i]);
            }
        })
        .fail(function () {
            $.notify("Something went wrong", "error");
        });


    $("#search").autocomplete({
        source: availableTags
    });
});
$(function () {
    $("#selectable").selectable();
});

(function () {

    $('#itemslider').carousel({
        interval: 3000
    });
}());

(function () {
    $('.carousel-showmanymoveone .item').each(function () {
        var itemToClone = $(this);

        for (var i = 1; i < 6; i++) {
            itemToClone = itemToClone.next();


            if (!itemToClone.length) {
                itemToClone = $(this).siblings(':first');
            }


            itemToClone.children(':first-child').clone()
                .addClass("cloneditem-" + (i))
                .appendTo($(this));
        }
    });
}());

$(function () {
    $('#button-login').click(function (e) {

        var email = $('#login_username').val().trim();
        var password = $('#login_password').val().trim();
        if (email.length == 0 || password.length == 0) {
            $.notify("Fiels must not be blank.", "error");
            return false;
        }
        e.preventDefault();

        $.post("api/", {
                action: "signin",
                e_mail: email,
                "password": password
            })
            .done(function (data) {
                if (data.error != undefined) {
                    $.notify("Invalid username or password", "error");
                    $('#login_password').val('');
                } else {
                    $.notify("Welcome " + data.shopowner[0].e_mail + '!', "success");
                    $.notify("Redirecting to dashboard.", "success");
                    setTimeout(function () {
                        $('.close').trigger('click');
                        $('#login_username').val('');
                        $('#login_password').val('');
                    }, 1000);

                    setTimeout(function () {
                        window.location.href = "dashboard.php";
                    }, 3000);

                }

            })
            .fail(function () {
                $.notify("Invalid username or password", "error");
                $('#login_password').val('');
            });

    });

    //setInterval(function(){ alert("Hello"); }, 3000);
    /*setInterval(function(){
         $.post( "api/", { action: "checkUserLogin" })
            .done(function( data ) {
              if(data.user_login == false ){
                $('#login-button-popup').html('<a href="javascript:void(0);" data-toggle="modal" data-target="#loginModal" >Login</a>');
              }
              else{
                $('#login-button-popup').html('<a href="dashboard.php" >Dashboard</a>');
              }
              
            })
            .fail(function() {
            });

    }, 1000);*/
});
