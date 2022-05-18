$('#googleLogin').click(function() {
    firebase.auth()
        .signInWithPopup(googleProvider)
        .then((result) => {
            /** @type {firebase.auth.OAuthCredential} */
            var credential = result.credential;

            // This gives you a Google Access Token. You can use it to access the Google API.
            var token = credential.accessToken;
            // The signed-in user info.
            var user = result.user;
            //console.log(user)

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                    url: window.location.href + "/googleLogin",
                    type: "post",
                    dataType: "json",
                    data: user.providerData[0],
                    success: function(data) {

                        if (data.html["estado"] === "succeso") {
                            //console.log(data.html["mensaje"]);
                            $('#mensaje-succeso div').text(data.html["mensaje"]);
                            $('#mensaje-succeso').css('opacity', '1')
                            setTimeout(function() {
                                $('#mensaje-succeso').css('opacity', '0');
                                if (window.location.pathname === "/admin-login") {
                                    window.location.href = "/admin";
                                } else if (window.location.pathname === "/cliente-login") {
                                    window.location.href = "/";
                                }
                            }, 1500);
                        } else {
                            $('#mensaje-error div').text(data.html["mensaje"]);
                            $('#mensaje-error').css('opacity', '1')
                            setTimeout(function() { $('#mensaje-error').css('opacity', '0') }, 1500);
                        }

                    },
                    error: function(error) {
                        $('#mensaje-error div').text('Error interno');
                        $('#mensaje-error').css('opacity', '1')
                        setTimeout(function() { $('#mensaje-error').css('opacity', '0') }, 1500);
                    }
                })
                // ...
        }).catch((error) => {
            // Handle Errors
            var errorCode = error.code;
            var errorMessage = error.message;
            $('#mensaje-error div').text(errorMessage);
            $('#mensaje-error').css('opacity', '1')
            setTimeout(function() { $('#mensaje-error').css('opacity', '0') }, 1500);
        });

})
