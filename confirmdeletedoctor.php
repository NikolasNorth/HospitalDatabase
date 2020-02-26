<!DOCTYPE html>
<html>
<head>
    <title>Delete Confirmation</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<body>
<h3 class="subtitle">This doctor is treating patients. Are you sure you want to delete?</h3>
<form class="confirmation-form" method="post" action="deletedoctor.php">
    <input type="hidden" name="license-number" value="<?= $_GET['licenseNumber'] ?>"/>
    <button class="btn" type="submit" name="delete">Delete</button>
    <button class="btn" type="submit" name="cancel">Cancel</button>
</form>
</body>
</html>