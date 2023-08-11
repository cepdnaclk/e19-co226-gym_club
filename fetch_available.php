<table>
    <tr>
        <th>Name</th>
        <th>Gender</th>
        <th>Goal Type</th>
    </tr>
    <?php
    @include 'config.php';
    $u_id = $_POST["user_id"];
    $sql = "SELECT uf.id, uf.name, uf.gender, fg.goal_type
               FROM user_form uf 
               JOIN target t ON uf.id = t.UId
               JOIN fitness_goal fg ON t.goal_id = fg.goal_id
               LEFT JOIN trainer tr ON uf.id = tr.trainee_id
               WHERE user_type = 'user' AND tr.trainer_id IS NULL";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr class='data_row'>";
            echo "<td><span class='a_add_trainee' data-trainer-id='" . $u_id . "' data-trainee-id='" . $row["id"] . "'>" . $row["name"] . "</span></td>";
            echo "<td>" . $row["gender"] . "</td>";
            echo "<td>" . $row["goal_type"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<td colspan='3' class='warn'>There are no currently available trainees.</td>";
    }
    ?>
</table>