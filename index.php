<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="index.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<h1>Cupcake Fundraiser</h1>
<?php
?>


<form action="index.php" method="post">
    <div class="form-group">
        <label for="name">Your Name:</label>
        <input type="text" class="form-control col-md-6" id="name" placeholder="Please input your name."
               name="full_name" value=<?php if (isset($_POST['full_name'])) echo $_POST['full_name']; ?>>

    </div>
    <label for="cupcakes">Cupcake Flavors</label>
    <?php
    foreach($cupcake_flavors as $flavor => $flavor_string)
    {
        echo "<div class='form-check'>
            <input class='form-check-input' type='checkbox' value=$flavor id='defaultCheck1' name='cupcakes[]'>
            <label class='form-check-label' for='defaultCheck1'>
                $flavor_string
            </label>
        </div>";
    }
    ?>
    <button type="submit" class="btn btn-success">Order</button>
</form>

<!-- Import bootstrap js requireed -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>
</html>