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
    <Script>
        function validateForm(event) {
            const firstName = document.getElementById("firstName").value;
            const lastName = document.getElementById("lastName").value;

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
    </Script>
    <form action="../Controller/C_User.php?action=updatepost" method="post">
        <h2>Edit User Information</h2>

        <div>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?php echo $user->getUsername(); ?>" readonly>
        </div>
        <div>
            <label for="firstName">First Name:</label>
            <input type="text" id="firstName" name="firstName" value="<?php echo $user->getFirstName(); ?>">
        </div>
        <div>
            <label for="lastName">Last Name:</label>
            <input type="text" id="lastName" name="lastName" value="<?php echo $user->getLastName(); ?>">
        </div>
        <div>
            <label for="role">Role:</label>
            <select id="role" name="roleId"
                <?php 
                    $userSS = unserialize($_SESSION['user']);
                    echo $userSS->getRole()->getId() == 1 ? 'disabled' : '' ;
                ?>>
                <?php foreach ($roles as $role): ?>
                    <option value="<?php echo $role->getId(); ?>" 
                        <?php echo ($role->getId() === $user->getRole()->getId()) ? 'selected' : ''; ?>>
                        <?php echo $role->getName(); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <br>
        <div>
            <button type="submit">Update</button>
        </div>
    </form>
</body>
</html>
