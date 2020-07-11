<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title></title>
        <link rel="stylesheet" href="styles.css">
        <script
            src="https://code.jquery.com/jquery-3.5.1.js"
            integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
            crossorigin="anonymous">
        </script>
    </head>
    <body>
        
    <?php
        // session_destroy();
    ?>

        <div id="wrapper">
        <h1>Welcome to Tiny Tubies Edu Care Chat</h1>
            <div class="chat_wrapper">
                <div id="chat">

                </div>

                <form id="messageForm" method="post">
                    <textarea name="message" cols="30" rows="7" class="textarea">
                    
                    </textarea>
                </form>
            </div>
        </div>

        <script>
            
            loadChat();

            setInterval(function(){
                loadChat();
            }, 1000);
            
            function loadChat() {
                $.post('messages.php?action=getMessage', function (response) {
                    
                    var scrollpos = $('#chat').scrollTop();
                    var scrollpos = parseInt(scrollpos) + 520;
                    var scrollHeight = $('#chat').prop('scrollHeight'); 
                    
                    $('#chat').html(response);

                    if (scrollpos < scrollHeight) {
                        
                    } else {
                        $('#chat').scrollTop($('#chat').prop('scrollHeight')); 
                    }
                    
                });
            }


            $('.textarea').keyup(function(e) {
                // alert($(this).val()); //alerting the letters 
                // alert(e.which); //alerting the unicodes of the letters 
                
                // aski code for enter is 13
                if (e.which == 13) {
                    // alert("enter is pressed");
                    
                    $('form').submit();
                }

            });
            

            $('form').submit(function() {
                // alert('form is submitted using jquery');

                // getting the value or the message that has been entered by the user
                var message = $('.textarea').val();
                $.post('messages.php?action=sendMessage&message='+message, function (response) {
                    if(response == 1){
                        loadChat();
                        document.getElementByID('messageForm').reset(); 
                    }
                });
                return false;
            });
        </script>
    </body>
</html>