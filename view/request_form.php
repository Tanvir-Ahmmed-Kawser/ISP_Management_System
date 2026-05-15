<!DOCTYPE html>
<html>
<head>
    <title>Request Box</title>
</head>
<body>

<h2>Request Content</h2>

<form action="../controller/MemberController.php" method="POST">

    <input type="text" name="title" placeholder="Content Title"><br><br>

    <input type="text" name="category" placeholder="Category"><br><br>

    <textarea name="message" placeholder="Message"></textarea><br><br>

    <button type="submit" name="submit">Send Request</button>

</form>

</body>
</html>