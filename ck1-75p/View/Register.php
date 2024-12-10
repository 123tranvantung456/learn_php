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
        function checkUsernameExistence() {
            const username = document.getElementById("username").value;
            const xhr = new XMLHttpRequest();
            xhr.open('GET', `../Controller/C_User.php?action=check-exist-username&username=${username}`, true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onload = function () {
                if (xhr.status === 200) {
                    const response = xhr.responseText;
                    if (response === "exists") {
                        alert("Username already exists. Please choose a different username.");
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

<script>
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
    </script>

    <form action="../Controller/C_User.php?action=register" method="post" onsubmit="return validateForm(event)">
        <h2>Register</h2>
        <div>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" onblur="checkUsernameExistence()" required>
        </div>
        <div>
            <label for="pass">Password:</label>
            <input type="password" id="pass" name="password">
        </div>
        <div>
            <label for="conpass">Confirm Password:</label>
            <input type="password" id="conpass" name="confirmPassword">
        </div>
        <div>
            <label for="firstName">First Name:</label>
            <input type="text" id="firstName" name="firstName">
        </div>
        <div>
            <label for="lastName">Last Name:</label>
            <input type="text" id="lastName" name="lastName">
        </div>
        <div>
            <button type="submit">Register</button>
        </div>
    </form>
</body>
</html>
