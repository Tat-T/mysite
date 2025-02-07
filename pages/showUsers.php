        <div class="container">
            <div class="row mt-3">
                <div class="col-6 offset-3 position-absolute top-50 start-0 translate-middle-y">
                    <table class="table table-striped">
                        <thead>
                            <div>
                                <tr>
                                    <th>Id</th>
                                    <th>Login</th>
                                    <th>Password</th>
                                    <th>Email</th>
                                    <th>Image</th>
                                </tr>
                            </div>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($users as $row) {
                                echo '<tr>';
                                foreach ($row as $i => $col) {
                                    if ($i == 4) {
                                        echo "<td><img src=\"/images/$col\" alt=\"\" width=\"100\"></td>";
                                    } else {
                                        echo "<td>$col</td>";
                                    }
                                }
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>