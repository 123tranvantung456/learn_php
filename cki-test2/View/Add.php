<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="../View/style/base.css">
    <link rel="stylesheet" href="../View/style/util.css">
</head>
<body>
<script>
        function checkExistence() {
            const one = document.getElementById("one").value;
            const xhr = new XMLHttpRequest();
            xhr.open('GET', `../Controller/C_.php?action=check-exist-one&one=${one}`, true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onload = function () {
                if (xhr.status === 200) {
                    const response = xhr.responseText;
                    if (response === "exists") {
                        alert("one already exists.");
                        e.preventDefault();
                        return true;
                    } else {
                        return false;
                    }
                }
            };

            xhr.send();
        }
</script>

<!-- <script>
        function validateForm(event) {
            const password = document.getElementById("pass").value;
            const confirmPassword = document.getElementById("conpass").value;
            const firstName = document.getElementById("firstName").value;
            const lastName = document.getElementById("lastName").value;
            const username = document.getElementById("username").value;
            
            if(username < 6){
                alert("Username must be at least 6 characters long.");
                event.preventDefault();
                return false;
            }

            if (password.length < 8) {
                alert("Password must be at least 8 characters long.");
                event.preventDefault();
                return false;
            }

            if (password !== confirmPassword) {
                alert("Passwords do not match.");
                event.preventDefault();
                return false;
            }

            if (firstName.length > 50) {
                alert("First name is too long.");
                event.preventDefault();
                return false;
            }
            if (firstName.length === 0) {
                alert("First name is required.");
                event.preventDefault();
                return false;
            }

            if (lastName.length > 50) {
                alert("Last name is too long.");
                event.preventDefault();
                return false;
            }
            if (lastName.length === 0) {
                alert("Last name is required.");
                event.preventDefault();
                return false;
            }

            return true; 
        }
    </script> -->
    
    <!-- onsubmit="return validateForm(event) -->
    <form action="../Controller/C_.php?action=add" method="post" ">
        <h2>ADD</h2>
        <div>
            <label for="one">one:</label>
            <input type="text" id="one" name="one" onblur="checkExistence()"  required>
        </div>
        <div>
            <label for="two">two:</label>
            <input type="text" id="two" name="two">
        </div>
        <div>
            <label for="three">three:</label>
            <input type="number" id="three" name="three">
            <!-- step="any" -->
        </div>

        <div>
            <label for="four">four:</label>
            <input type="date" id="four" name="four">
        </div>


        <div>
            <label for="five">five:</label>
            <select id="five" name="five">
                <?php foreach ($bean1s as $bean1): ?>

                    <option value="<?php echo $bean1->getOne1(); ?>">
                        <?php echo $bean1->getTwo1(); ?>
                    </option>
                
                <?php endforeach; ?>
            </select>
        </div>

        <div class="radio-container">
            <label for="six">Six:</label>
            <input type="radio" id="male" name="six" value="1"style=" padding: 0;
                margin: 0;
                display: inline;
                width: 3%;">
            <label for="male" style=" padding: 0;
                margin: 0;
                display: inline;
                width: 3%;">Nam</label>
            
            <br>

            <input type="radio" id="female" name="six" value="0" style=" padding: 0;
                margin: 0;
                display: inline;
                width: 3%;">
            <label for="female"style=" padding: 0;
                margin: 0;
                display: inline;
                width: 3%;">Nữ</label>
            <br>
            <br>
        </div>


        <div>
            <button type="submit">ADD</button>
        </div>
    </form>

</body>
</html>
