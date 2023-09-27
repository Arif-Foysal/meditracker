<?php
// Check if form was submitted and username is set in the POST data
if (isset($_POST['username'])) {
    $preFilledUsername = $_POST['username'];
} else {
    // Default value to pre-fill if form is not submitted
    $preFilledUsername = "fuckyou";
}
?>

<form method="post">
  <label for="username">Username:</label>
  <input type="text" id="username" name="username" value="<?php echo $preFilledUsername; ?>">
  <button type="submit">Submit</button>
</form>
