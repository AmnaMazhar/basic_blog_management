<?php
    require_once 'session_maintenance.php';
    require_once('../require/connection.php');

    function AddPostForm($action = "", $method = "GET")
    {
    ?>
        <center>
            <fieldset>
                <legend>Add Post Here...!</legend>
                <form action="<?php echo $action; ?>" method="<?php echo $method; ?>">
                    <table>
                        <tr>
                            <td>Post Title: </td>
                            <td><input type="text" name="post_title" placeholder="Enter Title Here" required /></td>
                        </tr>
                        <tr>
                            <td>Post Description: </td>
                            <td><textarea name="post_description" placeholder="Enter Post Description Here" required></textarea></td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center"><input type="submit" name="add_post" value="Add Post" /></td>
                        </tr>
                    </table>
                </form>
            </fieldset>
            <br><br>
        </center>
    <?php
    }

    function getRoleType($user_role_id)
    {
        global $connect;
        $select_query = "SELECT U.full_name, R.role_type FROM role R 
                            INNER JOIN user_role UR ON R.role_id = UR.role_id
                            INNER JOIN user U ON U.user_id  = UR.user_id
                            AND UR.user_role_id = " . $user_role_id;
        $result       = mysqli_query($connect, $select_query);
        $data    = mysqli_fetch_assoc($result);
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
                        <th>Action</th>
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
                                <td>
                                    <a href="index.php?action=edit&post_id=<?php echo $post['post_id']; ?>">Edit</a> ||
                                    <a href="index.php?action=delete&post_id=<?php echo $post['post_id']; ?>">Delete</a>
                                </td>
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

    function getPostByPostId($post_id)
    {
        global $connect;
        $select_query = "SELECT * FROM post P
                            WHERE post_id = " . $post_id;
        $result       = mysqli_query($connect, $select_query);
        $post         = mysqli_fetch_assoc($result);
        return $post;
    }

    function editPost($action = "", $method = "GET", $post_id)
    {
        $post = getPostByPostId($post_id);
        ?>
            <fieldset>
                <legend>Update Post Here...!</legend>
                <form action="<?php echo $action; ?>" method="<?php echo $method; ?>">
                    <input type="hidden" name="post_id" value="<?php echo $post['post_id']; ?>" />
                    <table>
                        <tr>
                            <td>Post Title: </td>
                            <td><input type="text" name="post_title" value="<?php echo $post['post_title']; ?>" required /></td>
                        </tr>
                        <tr>
                            <td>Post Description: </td>
                            <td><textarea name="post_description" required><?php echo $post['post_description']; ?></textarea></td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center"><input type="submit" name="update_post" value="Update Post" /></td>
                        </tr>
                    </table>
                </form>
            </fieldset>
            <br><br>
        <?php
    }
?>