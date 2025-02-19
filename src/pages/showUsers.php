        <div class="container">
            <div class="row mt-3">
                <div class="col">
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
                            foreach ($users as $user) {
                                echo '<tr>';
                                foreach ($user as $i => $col) {
                                    if ($i == 'picture') {
                                        echo "<td><img src=\"/src/images/$col\" alt=\"\" width=\"100\"></td>";
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