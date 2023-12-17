<?php
$cn=mysqli_connect("localhost","root","","test");
// Fetch data
$qry="SELECT * FROM ajax_demo";
$run=mysqli_query($cn,$qry);
while($row=mysqli_fetch_assoc($run)){

    echo "<tr>
    <td>{$row['id']}</td>
    <td>{$row['email']}</td>
    <td>{$row['password']}</td>
    <td><a href='#' class= 'text-decoration-none btn btn-primary'>Edit</a> | <a href='#' id='delete-btn' class= 'text-decoration-none btn btn-danger'>Delete</a></td>";
}
?>
