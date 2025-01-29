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
                                $users = readUsers();
                                foreach($users as $row) {
                                    echo '<tr>';
                                    foreach ($row as $col){
                                       echo "<td>$col</td>";
                                    }
                                    echo '</tr>';
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>