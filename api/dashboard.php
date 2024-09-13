<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>id</th>
            <th>no</th>
            <th>ms</th>
            <th>stat</th>
            <th>comment</th>
            <th>sender</th>
            <th>ype</th>

        </tr>
    </thead>
    <tbody>
        <?php
        include 'connect.php';
        $result = $db->prepare("SELECT * FROM mobile");
        $result->execute();
        while ($row = $result->fetch()) { ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['mobile_no']; ?></td>
                <td><?php echo $row['message']; ?></td>
                <td><?php echo $row['status']; ?></td>
                <td><?php echo $row['comment']; ?></td>
                <td><?php echo $row['send_id']; ?></td>
                <td><?php echo $row['customer_type']; ?></td>


            </tr>
        <?php } ?>
    </tbody>
</table>
