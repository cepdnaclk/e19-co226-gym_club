<!DOCTYPE html>
<html>

<head>
    <title>Test PHP Script</title>
    <link rel="stylesheet" href="styles/chat_bubble.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

    <script>
        function getchat(main_id, second_id) {
            var dataToSend = {
                main: main_id,
                second: second_id
            };

            $.ajax({
                url: "chat_fetch_msg.php",
                method: "POST",
                data: dataToSend,
                success: function(response) {
                    $("#chat_container").html(response);
                },
                error: function(xhr, status, error) {
                    alert("Error: " + xhr.status + ": " + xhr.statusText);
                }
            });
        }

        $(document).ready(function(){

            $("#get-btn").click(function(){
                var main = $("#main-text").val();
                var second = $("#second-text").val();
                alert(main + " and " + second);
                getchat(main,second);
            })            
        })
    </script>

</head>

<body>
    <form action="chat_fetch_msg.php" method="POST">
        <label for="main">Main:</label>
        <input type="text" id="main-text" name="main"><br><br>

        <label for="second">Second:</label>
        <input type="text" id="second-text" name="second"><br><br>

        <button id="get-btn" type="button" class="btn">Get!</button>
    </form>

    <div id="chat_container">
        <div class="bubble sent">Bro ipsum dolor sit amet gaper backside single track, manny Bike epic clipless. Schraeder drop gondy, rail fatty slash gear jammer steeps</div>
        <div class="bubble recv">Ok, Thank you</div>
        <div class="bubble sent"> ut labore et dolore magna </div>
        <div class="bubble recv">👌</div>
    </div>
</body>

</html>