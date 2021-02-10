<?php
include_once './conn.php';

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Nirmana Home Decor</title>
    <link rel="shortcut icon" href="../images/logo.jpg" type="image/jpg">
    <link rel="stylesheet" href="../bootstrap4/css/bootstrap.css">
    <link rel="stylesheet" href="../css/view.css">
    <link rel="stylesheet" href="../css/formstyle.css">
    <link rel="stylesheet" href="../css/font.css">
</head>

<body>

    <div class="container-fluid bg-dark d-flex align-items-center justify-content-sm-start" style="height: 50px;">
        <a href="./admin.php">Back</a>

    </div>



    <style>
        .with-border {
            border: 0.4px solid grey;
            border-radius: 5px;
        }

        td {
            text-align: center !important;
        }

        .of {
            overflow-x: scroll !important;
        }

        th {
            text-align: center;
            font-weight: 500;
        }

        .loc-table {
            border: 1px solid black !important;
            border-radius: 5px !important;
        }

        .mes {
            border-radius: 5px !important;
            border-color: grey !important;
        }
    </style>





    <div class="container mb-3">
        <h5 class=" display-3 text-center" style="font-size: 50px!important;">Search Measurement</h5>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-10 col-lg-8 col-xl-8 mx-auto">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="search-form">
                    <div class="form-row">
                        <div class="col label">
                            <p class=" col-form-label text-center">Select the date</p>
                        </div>
                        <div class="col">
                            <input type="date" class="form-control" id="date" name="inputdate" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-6 mx-auto mt-3">
                            <input type="submit" value="Search" class="w-100 h-100 btn btn-success" name="show">
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <p class="text-center">
        OR
    </p>
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-10 col-lg-8 col-xl-8 mx-auto">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="search-form">
                    <div class="form-row">
                        <div class="col label">
                            <p class=" col-form-label text-center">Enter Customer Name</p>
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" id="name" name="cusname" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-6 mx-auto mt-3">
                            <input type="submit" value="Search" class="w-100 h-100 btn btn-success" name="customer_show">
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="container">
        <div class="col-3">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <input type="submit" value="clear" class="w-100 btn btn-success" name="reset">

            </form>

        </div>
    </div>
    <hr>

    <div class="container-fluid  error-box mt-2">
        <?php

        if (isset($_COOKIE['msg'])) {
            echo '<p class="alert alert-success text-center">' . $_COOKIE['msg'] . '</p>';
        } else if (isset($_COOKIE['error'])) {
            echo '<p class="alert alert-warning text-center">' . $_COOKIE['error'] . '</p>';
        }
        ?>
    </div>

    <div class="loading mx-auto mt-5 ">
    </div>



    <div class="container w-100 container-lg main-view d-none ">

        <?php

        $getcus = "SELECT ref_id FROM customers ORDER BY ref_id DESC ";

        if (isset($_POST)) {
            unset($_POST);
        }
        //ORDER BY ref_id DESC

        if (isset($_POST['show'])) {
            $reqdate = $_POST['inputdate'];
            $getcus = "SELECT ref_id FROM customers WHERE register_date=" . "'" . $reqdate . "'";

            echo '<p class="alert alert-success text-center">By Date:- ' . $reqdate . '</p>';
        }

        if (isset($_POST['customer_show'])) {
            $reqname = $_POST['cusname'];
            $getcus = "SELECT ref_id FROM customers WHERE name LIKE " . "'" . "%" . $reqname . "%" . "'";

            echo '<p class="alert alert-success text-center">Results For:- ' . $reqname . '</p>';
        }
        if (isset($_POST['reset'])) {
            $getcus = "SELECT ref_id FROM customers ORDER BY ref_id DESC ";
            unset($_POST);
        }




        $res = $conn->query($getcus);
        if ($res == TRUE) {
            if ($res->num_rows > 0) {

                while ($row = $res->fetch_assoc()) {

                    FetchData($conn, $row['ref_id']);
                }
            } else {

                echo '<p class="alert alert-warning text-center mt-2">No customers Found ! .<br>Try again With a differant date</p>';
            }
        } else {
            echo '<p class="alert alert-danger text-center mt-2">Error in SQL -500 !..' . $conn->error . '</p>';
            header('Location:view.php');
        }





        function FetchData($conn, $ref)
        {
            echo '<div class="container" style="margin-bottom:10px;">';
            $sql_1 = "SELECT ref_id,name,email,number,address,reg_date,fix_date,remarks FROM customers WHERE ref_id=" . $ref;
            $result_1 = $conn->query($sql_1);
            if ($result_1 == TRUE) {

                if ($result_1->num_rows > 0) {

                    while ($row_1 = $result_1->fetch_assoc()) {
                        $select = "SELECT peace_id FROM carton WHERE ref_id=" . $row_1['ref_id'];

                        $r = $conn->query($select);
                        if ($r == TRUE) {
                            if ($r->num_rows > 0) {
                                $colapseID = RandomString();

                                echo

                                '
                                        <div class="row pb-3" style="border-bottom: 2px solid black;">
                                            <div class="col-12 col-sm-12 col-md-10 col-lg-8 col-xl-8 mx-auto ">
                                                <div class="row mt-3">
                                                    <div class="col with-border label">
                                                        <p class="text-center col-form-label">Referance Number</p>
                                                    </div>
                                                    <div class="col with-border label ml-1">
                                                        <p class="text-center col-form-label">' . $row_1['ref_id'] . '</p>
                                        
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col with-border label">
                                                        <p class="text-center  col-form-label">Measurement Date</p>
                                                    </div>
                                                    <div class="col with-border label ml-1">
                                                        <p class="text-center col-form-label">' . date('Y-m-d D ', (int)($row_1["reg_date"])) . '</p>
                                        
                                                    </div>
                                                </div>
                                                <div class="row mt-3">
                                                    <div class="col-6 with-border  label">
                                                        <p class="text-center col-form-label">Fixing  Date</p>
                                                    </div>
                                                    
                                                    <div class="col-6  p-0">
                                                        <form class="editfixdate w-100 h-100 m-0">
                                                            <div class="form-row">
                                                            <div class="col-9">
                                                                <input type="hidden" name="id" value="' . $row_1["ref_id"] . '">
                                                                <input readonly class="ml-1 col-form-label form-control text-center w-100 h-100" name="fix"  value="' . $row_1["fix_date"] . '">
                                                            </div>
                                                            <div class="col-3">
                                                                <button type="submit"  class=" text-center w-100  btn btn-success" data-column="fix_date" name="edit">Edit</button>
                                                            </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                    
                                            <div class="col-12  col-sm-12 col-md-10 col-lg-8 col-xl-8 mx-auto  ">
    
                                                    <div class="form-row">
                                                        <div class="col-12 mt-3">
                                                        
                                                            <div class="row">
                                                                <div class="col-6 label ">
                                                                <p class="col-form-label text-center">Customer Name</p>
                                                                </div>
                                                                <div class="col-6  p-0">
                                                                    <form class="editfixdate w-100 h-100 m-0">
                                                                        <div class="form-row">
                                                                        <div class="col-9">
                                                                            <input type="hidden" name="id" value="' . $row_1["ref_id"] . '">
                                                                            <input readonly class="ml-1 col-form-label form-control text-center w-100 h-100" name="fix"  value="' . ucfirst($row_1["name"]) . '">
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <button type="submit"  class=" text-center w-100  btn btn-success" data-column="name" name="edit">Edit</button>
                                                                        </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                
                                                                
                                                            </div>
                                                        </div>
                                                
                                                        <div class="col-12 mt-3">
                                                            <div class="row">
                                                                <div class="col-6 label ">
                                                                <p class="col-form-label text-center">Contact Number</p>
                                                                </div>
                                                                <div class="col-6  p-0">
                                                                    <form class="editfixdate w-100 h-100 m-0">
                                                                        <div class="form-row">
                                                                        <div class="col-9">
                                                                            <input type="hidden" name="id" value="' . $row_1["ref_id"] . '">
                                                                            <input readonly class="ml-1 col-form-label form-control text-center w-100 h-100" name="fix"  value="' . $row_1["number"] . '">
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <button type="submit"  class=" text-center w-100  btn btn-success" data-column="number" name="edit">Edit</button>
                                                                        </div>
                                                                        </div>
                                                                    </form>
                                                                
                                                                </div>
                                                                
                                                                
                                                            </div>
                                                
                                                        </div>
                                                
                                                        <div class="col-12 mt-3">
                                                
                                                            <div class="row">
                                                                <div class="col-6 label ">
                                                                <p class="col-form-label text-center">Site Location</p>
                                                                </div>
                                                                <div class="col-6  p-0">
                                                                    <form class="editfixdate w-100 h-100 m-0">
                                                                        <div class="form-row">
                                                                        <div class="col-9">
                                                                            <input type="hidden" name="id" value="' . $row_1["ref_id"] . '">
                                                                            <input readonly class="ml-1 col-form-label form-control text-center w-100 h-100" name="fix"  value="' . ucfirst($row_1["address"]) . '">
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <button type="submit"  class=" text-center w-100  btn btn-success" data-column="address" name="edit">Edit</button>
                                                                        </div>
                                                                        </div>
                                                                    </form>
                                                                
                                                                </div>
                                                                
                                                                
                                                            </div>
                                                
                                                        </div>
                                                
                                                        <div class="col-12 mt-3">
                                                
                                                            <div class="row">
                                                                <div class="col-6 label ">
                                                                <p class="col-form-label text-center">Customer E-mail</p>
                                                                </div>
                                                                <div class="col-6  p-0">
                                                                    <form class="editfixdate w-100 h-100 m-0">
                                                                        <div class="form-row">
                                                                        <div class="col-9">
                                                                            <input type="hidden" name="id" value="' . $row_1["ref_id"] . '">
                                                                            <input readonly class="ml-1 col-form-label form-control text-center w-100 h-100" name="fix"  value="' . $row_1["email"] . '">
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <button type="submit"  class=" text-center w-100  btn btn-success" data-column="email" name="edit">Edit</button>
                                                                        </div>
                                                                        </div>
                                                                    </form>
                                                                
                                                                </div>
                                                                
                                                                
                                                            </div>
                                                
                                                        </div>
                                                        <div class="col-12 mt-3">
                                                            <div class="row">
                                                                <div class="col-6 label ">
                                                                    <p class="col-form-label text-center">Remarks</p>
                                                                </div>
                                                                <div class="col-6  p-0">
                                                                    <form class="editfixdate w-100 h-100 m-0">
                                                                        <div class="form-row">
                                                                        <div class="col-9">
                                                                            <input type="hidden" name="id" value="' . $row_1["ref_id"] . '">
                                                                            <input readonly class="ml-1 col-form-label form-control text-center w-100 h-100" name="fix"  value="' . $row_1["remarks"] . '">
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <button type="submit"  class=" text-center w-100  btn btn-success" data-column="remarks" name="edit">Edit</button>
                                                                        </div>
                                                                        </div>
                                                                    </form>
                                                                
                                                                </div>
                                                        
                                                        
                                                            </div>
                                        
                                                        </div>
                
                                                        
                                                    </div>
                                            
                                            </div>
    
                                            <div class="col-12  col-sm-12 col-md-10 col-lg-8 col-xl-8 mx-auto mt-2 m-0 ">
                                                <div class="row">
                                                    <div class="col-6 ">
                                                        <form action="./customer.php" method="POST">
                                                            <input type="hidden" value="' . $row_1['ref_id'] . '" name="ref">
                                                            <input type="submit" name="take" value="ADD MEASURMENT " class="btn w-100 btn-success">
                                                        </form>
                                                    </div>
                                                    <div class="col-6 ">
                                                        <form action="./customer.php" method="POST"  onsubmit="return ask()">
                                                            <input type="hidden" value="' . $row_1['ref_id'] . '" name="ref">
                                                            <input type="submit" name="del" value="DELETE CUSTOMER " class="btn w-100 btn-warning">
                                                        </form>
                                                    </div>
    
                                                </div>
                                            </div>
                                                
                                        
                                            <div class="col-12  col-sm-12 col-md-10 col-lg-8 col-xl-8 mx-auto mt-2 m-0">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <button type="button" class="btn btn-success view-btn w-100 h-100 " data-toggle="collapse" data-target="#' . $colapseID . '" aria-expanded="false" aria-controls="' . $colapseID . '" >Show &downarrow; </button>
                                                    </div>
                                                    <div class="col-6">
                                                        <form action="./createcortation.php" method="GET">
                                                            <input type="hidden" name="qid" value="' . $row_1['ref_id'] . '">
                                                            <input type="submit" name="createQuo" value="Create Quotation" class="btn btn-success view-btn w-100 h-100">
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-10 col-xl-10 mx-auto m-0">
                                                
                                            
                                                <div id="' . $colapseID . '" class="collapse overflow-auto table-div my-2">
                                            ';

                                //geting the carton details
                                $sql_2 = "SELECT peace_id,product_name,color_code,width,height,control
                                    ,additional FROM carton WHERE ref_id=" . $row_1['ref_id'];
                                $result_2 = $conn->query($sql_2);
                                if ($result_2 == TRUE) {
                                    if ($result_2->num_rows > 0) {
                                        while ($row_2 = $result_2->fetch_assoc()) {
                                            //slect location name from the database for above carton
                                            $sql_3 = "SELECT name FROM carton_locations WHERE peace_id=" . $row_2['peace_id'];
                                            $result_3 = $conn->query($sql_3);
                                            if ($result_3 == TRUE) {
                                                if ($result_3->num_rows > 0) {
                                                    while ($row_3 = $result_3->fetch_assoc()) {
                                                        echo '
                                                                
                                                                        
                                                                        <table  class="w-100 mb-2 loc-table" style="width:100%;" >
                                                                                <tr >
                                                                                    <td class=" text-center">Location Name: ' . ucfirst($row_3["name"]) . '</td>
                                                                                    
                                                                                </tr>
                                                                                <!--<tr>
                                                                                    <td>' . ucfirst($row_3["name"]) . '</td>
                                                                                </tr>-->
                                                                                
                                                                        
                                                                        </table>
        
                                                                        <table border="1" class="w-100 mt-2 mes ">
                                                                                <tr>
                                                                                    <th>PRODUCT NAME</th>
                                                                                    <th>COLOR CODE</th>
                                                                                    <th>WIDTH</th>
                                                                                    <th>HEIGHT</th>
                                                                                    <th>CONTROL</th>
                                                                                    
                                                                                </tr>
                                                                                <form action="./edit.php" method="POST">
                                                                                    <tr class="mb-2">
                                                                                    
                                                                                        <td><input type="text" value="' . ucfirst($row_2["product_name"]) . '" name="pname" class="pname form-control border-0 p-0" readonly></td>
                                                                                        <td><input type="text" value="' . $row_2["color_code"] . '" name="colorcode" class="form-control border-0 p-0" readonly></td>
                                                                                        <td><input type="text" value="' . $row_2["width"] . '"' . '" name="width" class="form-control border-0 p-0" readonly></td>
                                                                                        <td><input type="text" value="' . $row_2["height"] . '"' . '" name="height" class="form-control border-0 p-0" readonly></td>
                                                                                        <td><input readonly value="' . ucfirst($row_2["control"]) . '" name="control" class="form-control border-0 p-0" readonly></td>
                                                                                        
                                                                                        <input type="hidden" value="' . $row_2['peace_id'] . '" name="peace_id">
                                                                                        <input type="hidden" value="' . $row_1['ref_id'] . '" name="ref_id">
                                                                                        <input class="form-control text-center" type="hidden" readonly value="' . ucfirst($row_3["name"]) . '" name="location">
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Remarks</td>
                                                                                        <td colspan="4"><input type="text" value="' . ucfirst($row_2['additional']) . '" name="additional" class="form-control border-0 p-0" readonly></td>

                                                                                    </tr>
                                                                                    <tr></tr>
                                                                                    <tr  style="border: 1px solid white; margin-top: 2px; ">
                                                                                        <td colspan="2" >
                                                                                            <input type="submit" class="w-100 h-100  btn btn-success" name="edit" value="Edit">
                                                                                        </td>
                                                                                    </tr>
                                                                                </form>
                                                                        </table>
        
                                                                        
                                                                        
        
                                                                            
                                                                    ';
                                                    }
                                                } else {
                                                    echo '<p class="text-warning">No any Loctions to this Mesurements</p>';
                                                    echo '
                                                                        
                                                                    
                                                                    <table  class="w-100 mb-2 loc-table" style="width:100%;" >
                                                                        <tr >
                                                                            <td class=" text-center">Location Name: N/A</td>
                                                                            
                                                                        </tr>
                                                                        <!--<tr>
                                                                            <td>N/A</td>
                                                                        </tr>-->
                                                                
                                                        
                                                                    </table>
        
                                                                    <table border="1" class="w-100 mt-2 mes ">
                                                                                <tr>
                                                                                    <th>PRODUCT NAME</th>
                                                                                    <th>COLOR CODE</th>
                                                                                    <th>WIDTH</th>
                                                                                    <th>HEIGHT</th>
                                                                                    <th>CONTROL</th>
                                                                                    
                                                                                </tr>
                                                                                <form action="./edit.php" method="POST">
                                                                                    <tr class="mb-2">
                                                                                    
                                                                                        <td><input type="text" value="' . ucfirst($row_2["product_name"]) . '" name="pname" class="pname form-control border-0 p-0" readonly></td>
                                                                                        <td><input type="text" value="' . $row_2["color_code"] . '" name="colorcode" class="form-control border-0 p-0" readonly></td>
                                                                                        <td><input type="text" value="' . $row_2["width"] . '"' . '" name="width" class="form-control border-0 p-0" readonly></td>
                                                                                        <td><input type="text" value="' . $row_2["height"] . '"' . '" name="height" class="form-control border-0 p-0" readonly></td>
                                                                                        <td><input readonly value="' . ucfirst($row_2["control"]) . '" name="control" class="form-control border-0 p-0" readonly></td>
                                                                                        
                                                                                        <input type="hidden" value="' . $row_2['peace_id'] . '" name="peace_id">
                                                                                        <input type="hidden" value="' . $row_1['ref_id'] . '" name="ref_id">
                                                                                        <input class="form-control text-center" type="hidden" readonly value="No Locations" name="location">
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>Remarks</td>
                                                                                        <td colspan="4"><input type="text" value="' . ucfirst($row_2['additional']) . '" name="additional" class="form-control border-0 p-0" readonly></td>

                                                                                    </tr>
                                                                                    <tr></tr>
                                                                                    <tr  style="border: 1px solid white; margin-top: 2px; ">
                                                                                        <td colspan="2" >
                                                                                            <input type="submit" class="w-100 h-100  btn btn-success" name="edit" value="Edit">
                                                                                        </td>
                                                                                    </tr>
                                                                                </form>
                                                                        </table>
                                                                        
                                                                    ';





                                                    continue;
                                                }
                                            } else {
                                                setcookie('sql_error', 'Error-500! P', time() + 30, '/');

                                                header('Location:../index.php');
                                            }
                                        }
                                        echo '</div></div>';
                                    } else {
                                        echo '<p class="text-warning ml-3">No Mesurements found !</p></div></div>';
                                    }
                                } else {
                                    setcookie('sql_error', 'Error-500! P', time() + 30, '/');
                                    header('Location:../index.php');
                                }

                                echo '</div>';
                            } else {
                                continue;
                            }
                        } else {
                            echo '<h3 class="alert alert-warning mt-4">Error -500 </h3>';
                        }
                    }
                } else {
                    echo '<h3 class="alert alert-warning mt-4">No Customers Found ! </h3>';
                }
            } else {
                setcookie('sql_error', 'Error-500! P', time() + 30, '/');
                header('Location:../index.php');
            }
            echo '</div>';
        }

        function RandomString()
        {
            $charactors = 'ZXCVBNMASDFGHJKLPOIUYTREWQqwertyuioplkjhgfdsazxcvbnm';
            $randomString = '';
            for ($i = 0; $i < 6; $i++) {
                $randomString = $randomString . $charactors[rand(0, strlen($charactors) - 1)];
            }
            return $randomString;
        }





        ?>

    </div>


    <script>
        function ask() {
            let a = confirm('Are You sure?');
            if (a) {
                return true;
            } else {
                return false;
            }
        }
    </script>


    <script src="../js/view.js"></script>
    <script src="../bootstrap4/jquery.js"></script>
    <script src="../bootstrap4/js/bootstrap.js"></script>
</body>

</html>