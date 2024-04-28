<?php
function footer_show() {
    echo '<footer style="background-color: #3c424b; margin-left: 60px; height: 100px; color: #fff; text-align: center; padding-top: 20px;">';
    echo 'Courseway!<br>';
    echo 'A e-learning Platform';
    echo '</footer>';
}




function header_show(){
    echo '<fieldset style="margin: 2px;border-radius: 10px;margin-left: 65px;box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);">
        <table width="100%">
            <tr>
                <td align="left">
                    <img width="150px" src="../public/imgs/Creative.png" alt="Courseway Logo">
                </td>
                <td align="right">
                    Hello, ' . $_SESSION["username"] . '!
                </td>
            </tr>
        </table>
    </fieldset>';
}

function side_bar_show(){
    echo '<div id="mySidebar" class="sidebar">
        <div class="sidebar-content">
            <a href="#" title="Courses"><i class="fas fa-book"></i><span>Courses</span></a>
            <a href="#" title="Communication"><i class="fas fa-comment-alt"></i><span>Communication</span></a>
            <a href="profile.php" title="Profile"><i class="fas fa-user"></i><span>Profile</span></a>
            <a href="changePass.php" title="Change Password"><i class="fas fa-lock"></i><span>Change Password</span></a>
            <a href="../controllers/logout.php" title="Logout"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a>
        </div>
    </div>';
}
?>

