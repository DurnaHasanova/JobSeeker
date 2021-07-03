
<?php
$error="";
if(isset($_POST['login']) && isset($_POST["password"])){
    $user=$_POST["login"];
    $sql="select * from user where email='$user'";
    $result=mysqli_query($connection, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);

        $password = md5($_POST["password"]);
        echo $password;

        if($row["password"]!=$password){
            $error=$INCORRECT_PASSWORD;
        }
        elseif(!$row['status']) $error=$USER_BLOCKED;
        else {


            $_SESSION["userName"] = $row["name"];
            $_SESSION["userId"] = $row["id"];
            $_SESSION["userType"] = $row["userType"];
            header("HTTP/1.1 301 Moved permanently");
            header("location:index.php?page=home");
        }

    }
    else $error=$INCORRECT_USER;

}
?>


<div class="wrapper ">
    <div id="formContent">
        <div class=" first mx-4 my-4 h2 text-muted">
            <?=$login_welcome?>
        </div>
        <form  method="post" >
            <div class="text-center text-danger"><?= $error ?></div>
            <div class="form-group">
                <input type="text" class="form-control" class=" second m-1" name="login" placeholder="<?=$login_user?>">
            </div>
            <div class="form-group">
                <input type="password" class="form-control"  class="second m-1" name="password" placeholder="<?=$login_pass?>">
            </div>

            <input type="submit" class="btn btn-primary" value="<?=$btn_login?>">
        </form>

            <a class="underlineHover" href="#"><?=$login_forgot?></a>


    </div>
</div>