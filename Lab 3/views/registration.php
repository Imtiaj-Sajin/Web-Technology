<!DOCTYPE html>
<html>
<body>

<h1>Registration</h1>
<form action="profile.php" method="post" novalidate>
<table>
    <tr>
        <td>
            <fieldset>
                <legend>General Information:</legend>
                <table>
                    <tr>
                        <td>First name</td>
                        <td>:</td>
                        <td><input type="text" id="firstname" name="firstname"></td>
                    </tr>
                    <tr>
                        <td>Last name</td>
                        <td>:</td>
                        <td><input type="text" id="lastname" name="lastname"></td>
                    </tr>
                    <tr>
                        <td>Gender</td>
                        <td>:</td>
                        <td><input type="radio" id="male" name="gender" value="male">
                            <label for="male">Male</label>
                            <input type="radio" id="female" name="gender" value="female">
                            <label for="female">Female</label>
                        </td>
                    </tr>
                    <tr>
                        <td>Father's name</td>
                        <td>:</td>
                        <td><input type="text" id="fathersName" name="fathersName"></td>
                    </tr>
                    <tr>
                        <td>Mother's name</td>
                        <td>:</td>
                        <td><input type="text" id="mothersname" name="mothersname"></td>
                    </tr>
                    <tr>
                        <td>Blood Group</td>
                        <td>:</td>
                        <td>
                            <select id="bloodgroup" name="bloodgroup">
                                <option value="b+">B+</option>
                                <option value="o+">O+</option>
                                <option value="a+">A+</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Religion</td>
                        <td>:</td>
                        <td>
                            <select id="religion" name="religion">
                                <option value="islam">Islam</option>
                                <option value="islam">Islam</option>
                                <option value="islam">Islam</option>
                            </select>
                        </td>
                    </tr>
                </table>
            </fieldset>
        </td>

        <td>
            <fieldset>
                <legend>General Information:</legend>
                <table>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td><input type="email" id="email" name="email"></td>
                    </tr>
                    <tr>
                        <td>Phone/Mobile</td>
                        <td>:</td>
                        <td><input id="pnumber" name="pnumber"></td>
                    </tr>
                    <tr>
                        <td>Website</td>
                        <td>:</td>
                        <td><input id="website" name="website"></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>:</td>
                        <td>
                            <fieldset>
                                <legend>Present Address</legend>
                                <select id="country" name="country">
                                    <option value="bangladesh">Bangladesh</option>
                                    <option value="japan">Japan</option>
                                    <option value="england">England</option>
                                </select>

                                <select id="city" name="city">
                                    <option value="dhaka">Dhaka</option>
                                    <option value="comilla">Comilla</option>
                                    <option value="chittagong">Chittagong</option>
                                </select>
                                <br>
                                <textarea id="address" name="address" placeholder="Road/Street/City" rows="5" cols="20"></textarea>
                                <br>
                                <input type="text" id="postcode" name="postcode" placeholder="Post Code">
                            </fieldset>
                        </td>
                    </tr>
                </table>
            </fieldset>
        </td>
        <td>
            <fieldset>
                <legend>General Information:</legend>
                <table>
                    <tr>
                        <td>Username</td>
                        <td>:</td>
                        <td><input type="text" id="uname" name="uname"></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td>:</td>
                        <td><input type="text" id="pass" name="pass"></td>
                    </tr>
                    <tr>
                        <td>Confirm Password</td>
                        <td>:</td>
                        <td><input type="text" id="conpass" name="conpass"></td>
                    </tr>
                </table>
            </fieldset>
            <br>
            <button type="submit" id="registerbtn" name="registerbtn">Register</button>
            
        </td>
    </tr>
</table>
</form>

</body>
</html>
