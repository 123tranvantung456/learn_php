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
    <!-- <Script>
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
    </Script> -->


     <!-- onsubmit="return validateForm(event) -->
     <form action="../Controller/C_.php?action=updatepost" method="post" ">
        <h2>Update</h2>
        <div>
            <label for="one">one:</label>
            <!-- onblur="checkUsernameExistence()" -->
            <input type="text" id="one" name="one" value="<?php echo $bean->getOne(); ?>" readonly>
        </div>
        <div>
            <label for="two">two:</label>
            <input type="text" id="two" name="two" value="<?php echo $bean->getTwo(); ?>">
        </div>
        <div>
            <label for="three">three:</label>
            <input type="number" id="three" name="three" value="<?php echo $bean->getThree(); ?>">
        </div>
        <div>
            <label for="four">four:</label>
            <input type="datetime-local" id="four" name="four" value = "<?php echo $bean->getFour(); ?>">
        </div>

        <!-- <div>
            <label for="four">four:</label>
            <input type="date" id="four" name="four" value="<?php echo $bean->getFour(); ?>">
        </div> -->


        <div>
            <label for="five">five:</label>
            <select id="five" name="five">
                <?php foreach ($bean1s as $bean1): ?>

                    <option value="<?php echo $bean1->getOne(); ?>"
                    <?php echo ($bean1->getOne() === $bean->getFive()) ? 'selected' : ''; ?>
                    >
                        <?php echo $bean1->getTwo(); ?>
                    </option>
                
                <?php endforeach; ?>
            </select>
        </div>


        <div>
            <button type="submit">Update</button>
        </div>
    </form>

</body>
</html>
