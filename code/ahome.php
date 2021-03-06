<?php
session_start();

if(!isset($_SESSION['user'])){
    header("location:index.php");
}

if(isset($_SESSION['isadmin'])) {
  if (($_SESSION['isadmin'])!=1) {
    header("location:index.php");
  }
}
session_write_close();
?>

<html>

    <?php include 'header.php'; ?>

    <body>

        <div class="container">
            <div class="page-header">
              <h1>Administration Page <small> - XPTO Company</small> </h1>
            </div>
            <div class="row">
                <div class="col-md-11">
                    <h3>Bem vindo! <small><?php echo $_SESSION['name'];?></small></h3>
                </div>
                <div class="col-md-1">
                    <h3><a href="logout.php">Logout</a></h3>
                </div>
            </div>
            <br>
            <div class="panel panel-default">
                <table class="table table-hover table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Admin</th>
                        <th>Respository</th>
                        <th>More</th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                            include_once 'connection.php';
                            $q = "select * from users";
                            $result = $conn->query($q);
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    if($row['status'] == 1){
                                        echo "<tr>";
                                        echo "<td>".$row["id_user"]."</td>";
                                        echo "<td>".$row["username"]."</td>";
                                        echo "<td>".$row["name"]."</td>";
                                        echo "<td>".$row["email"]."</td>";
                                        echo "<td>".$row["status"]."</td>";
                                        echo "<td>".$row["isadmin"]."</td>";
                                        echo '<td><a href="repository.php?id='.$row["id_user"].'">./'.$row["username"].'</a</td>';
                                        echo '<td><a href="delete.php?id='.$row["id_user"].'"><img src="images/delete.png"style="width:30px;height:30px;"></a><a href="edit.php?id='.$row["id_user"].'"><img src="images/activity.png" style="width:30px;height:30px;"></a></td>';
                                        echo "</tr>";
                                    }
                                }
                            } else {
                                echo "0 results";
                            }
                        ?>
                    </tbody>
                </table>
                
            </div>
            <div class="row">
                <div class="col-md-8"></div>
                <div class="col-md-4">
                    <a href="inactiveusers.php"><button type="button" class="btn btn-default">Utilizadores Inativos</button></a>
                    <a href="registar.php"><button type="button" class="btn btn-warning">Novo utilizador</button></a>
                </div>
            </div>
            <div class="col-md-4 col-sm-offset-8">
                
            </div>
            <br><br><br>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Logs</h3>
                </div>
                <?php
                    include_once ("logs.php");
                ?>
            </div>
        </div>
        <?php include 'footer.php'; ?>
        
    </body>
</html>