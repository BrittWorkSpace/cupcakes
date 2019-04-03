<?php
//array of flavors
$cupcake_flavors = array("grasshopper"=>"The Grasshopper", "maple"=>"Whiskey Maple Bacon",
    "Carrot"=>"Carrot Walnut", "Caramel"=>"Salted Caramel Cupcake",  "Velvet"=>"Red Velvet",  "lemon"=>"Lemon Drop",
    "tiramisu"=>"Tiramisu");
//error array to verify errors have been checked for.
$errors = array("nameErr"=>"", "checkErr"=>"");
$submitted = $_SERVER['REQUEST_METHOD'] == 'POST';

/**
 * Taks an associative array checks if errors have message then errors still occuring in code
 * @param $data array provided that holds error messages
 * @return bool wether errors still exist or not
 */
function checkErrors($data)
{
    foreach ($data as $error=> $errors)
    {
        if(!empty($errors))
        {
            return false;
        }
    }
    return true;
}

function createSummary($data)
{
    $total = number_format(count($data)* 3.50, 2, '.', '');
    echo '<p>Order Summary</p>';
    echo '<ul>';
    foreach ($data as $item)
    {
        echo "<li>$item</li>";
    }
    echo '</ul>';
    echo "<p> Order Total: $". $total;
}


if($submitted)
{

    //save post data to variables
    $name = $_POST['full_name'];
    $checked_flavors = $_POST['cupcakes'];
    //check only letters contained in type
    if (preg_match('/[^A-Za-z0-9]/', $name))
    {
        $errors["nameErr"] = "Special characters are not allowed!";
    }
    else
    {
        //trim and sanitize string
        $name = filter_var(trim($name), FILTER_SANITIZE_STRING);
        if(empty($name))
        {
            $errors["nameErr"] = "Name is required. Please type a name!";
        }
    }
    //validate if one value is selected
    if(count($checked_flavors) < 1)
    {
        $errors["checkErr"] = "Must select at least one flavor!";
    }
    else
    {
        //make sure values provided match a value in our array of cupcake flavors
        foreach ($checked_flavors as $item)
        {
            $item = filter_var(trim($item), FILTER_SANITIZE_STRING);
            if(!array_key_exists($item, $cupcake_flavors)) $errors["checkErr"] ="Invalid value provided";
        }
    }

}

?>

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

<form action="index.php" method="post">
    <div class="form-group">
        <label for="name">Your Name:</label>
        <input type="text" class="form-control col-md-6" id="name" placeholder="Please input your name."
               name="full_name" value=<?php if (isset($_POST['full_name'])) echo $_POST['full_name']; ?>>

    </div>
    <?php
    if(!empty($errors['nameErr'])) echo "<p class=\"btn btn-outline-danger\">" . $errors['nameErr'] . "</p><br>";
    ?>
    <label for="cupcakes">Cupcake Flavors</label>
    <?php
    foreach($cupcake_flavors as $flavor => $flavor_string)
    {
        echo "<div class='form-check'>
            <input class='form-check-input' type='checkbox' value=$flavor id='defaultCheck1' name='cupcakes[]' ";
        //if check that one item was checked if so check each item to find out if it has been selected
        //then keep checked those items checked on post
        if($checked_flavors!=null)
        {
            if (in_array($flavor, $checked_flavors, true)) echo 'checked';
        }
        echo ">
            <label class='form-check-label' for='defaultCheck1'>
                $flavor_string
            </label>
        </div>";
    }
    ?>
    <?php if(!empty($errors['checkErr'])) echo "<p class=\"btn btn-outline-danger\">" . $errors['checkErr'] . "</p><br>";
    ?>
    <button type="submit" class="btn btn-success">Order</button>
</form>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
<script src="modal.js"></script>
</body>
</html>