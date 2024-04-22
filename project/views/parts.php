<?php
function footer_show() {
    echo '<footer style="background-color: #3c424b; height: 100px;">';
    echo 'bye bye asdjfkhasdfjkh';
    echo '</footer>';
}


function header_show(){
    echo '<fieldset style="margin: 2px;border-radius: 10px;box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);">
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
?>

