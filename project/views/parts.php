<?php
function footer_show() {
    echo '<footer style="background-color: #3c424b; height: 100px;">';
    echo 'bye bye asdjfkhasdfjkh';
    echo '</footer>';
}

function header_show(){
    echo '<fieldset>
        <table width="100%">
            <tr>
                <td align="left">
                    <img width="150px" src="../public/imgs/Creative.png" alt="Courseway Logo">
                </td>
                <td align="right">
                    Hello, <?php echo $_SESSION["username"]; ?>!
                </td>
            </tr>
        </table>
    </fieldset>';
}
?>