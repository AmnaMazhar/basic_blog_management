<?php
    require_once 'session_maintenance.php';
    require_once('../require/connection.php');

    function getRoleType($user_role_id)
    {
        global $connect;
        $select_query = "SELECT * FROM role R 
                        INNER JOIN user_role UR ON R.role_id = UR.role_id
                        INNER JOIN user U ON U.user_id  = UR.user_id
                        AND UR.user_role_id = " . $user_role_id;
        $result       = mysqli_query($connect, $select_query);
        $data         = mysqli_fetch_assoc($result);
        return $data['full_name'] . " (" . $data['role_type'] . ")";
    }

    function ShowAllPosts()
    {
        global $connect;
        ?>
            <center>
                <table width="90%" cellpadding='2' border="2">
                    <tr>
                        <th>Post ID</th>
                        <th>Post Added By</th>
                        <th>Post Title</th>
                        <th>Post Description</th>
                        <!-- <th>Action</th> -->
                    </tr>
                    <?php
                    $select_query = "SELECT * FROM post WHERE is_active = 'Active' ORDER BY post_id DESC";
                    $result       = mysqli_query($connect, $select_query);

                    if ($result->num_rows > 0) {
                        while ($post = mysqli_fetch_assoc($result)) {
                    ?>
                            <tr>
                                <td><?php echo $post['post_id']; ?></td>
                                <td><?php echo getRoleType($post['user_role_id']); ?></td>
                                <td><?php echo $post['post_title']; ?></td>
                                <td><?php echo $post['post_description']; ?></td>
                            </tr>
                        <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="5" align="center">No Posts Available</td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </center>
        <?php
    }
?>