<?php
include "header.php";
?>
        <div class="container">
            <div class="row mt-3">
                <div class="col-6 offset-3">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                              <th>Login</th>
                              <th>Password</th>
                              <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $fd = @fopen(__DIR__ . '/users.csv', 'r') or die('Нет запрашиваемого вами файла!');
                                $buffer = [];
                                while(!feof($fd)) {
                                   $row = fgets($fd);
                                   if ($row) {
                                       $row = rtrim($row);
                                       $row = explode(',', $row);
                                       $buffer[] = $row;
                                       echo '<tr>';
                                       foreach($row as $col) {
                                           echo "<td>$col</td>";
                                       }
                                       echo '<tr>';
                                   }
                                }
                                fclose($fd)
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>