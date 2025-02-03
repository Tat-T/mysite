        <div class="container">
            <div class="row mt-3">
                <div class="col-6 offset-3 position-absolute top-50 start-0 translate-middle-y">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                              <th>Id</th>
                              <th>Login</th>
                              <th>Password</th>
                              <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
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