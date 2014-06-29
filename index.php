<!DOCTYPE html>
<html lang = "en">
<meta charset="utf-8">
<head>
  <title>Notes</title>
  <link href="notes.css" rel="stylesheet">
</head>
<body>
  <div class="form-container">
  <div id="msg"></div>
  <form method="post" action="notes.php"> 
    <fieldset> 
      <legend>Add note</legend> 
      <div> 
        <textarea name="note" cols="" rows="10"></textarea> 
      </div> 
    </fieldset> 
    <div> 
     <button type="submit" name="save">Save</button> 
   </div> 
 </form> 
</div>
<div class="table-container">
 <table border = "1">
  <thead>
    <th>Note</th>
    <th>ID</th>
    <th>Date</th>
    <th><a href='#' id = "delete">Delete Note</a></th>
  </thead>
  <tbody>
    <?php
    require_once('database.php');

    $select = mysqli_query(db_connect(),'select * from notes');

    $result = "";

    while($note = mysqli_fetch_assoc($select)){
      $result .= "<tr>";

      $result .= "<td>" . $note['note'] . "</td>";
      $result .= "<td>" . $note['id'] . "</td>";
      $result .= "<td>" . $note['date'] . "</td>";
      $result .= "<td><input type='checkbox' name='checkbox' value='" . $note['id'] . "'></td>";

      $result .= "</tr>";
    }

    print  $result;
    ?>
  </tbody>
</table>
</div>
<script src="notes.js"></script>
</body>
</html>