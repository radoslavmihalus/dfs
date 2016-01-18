<?php
error_reporting(1);
session_start();

if (isset($_REQUEST['report']) && $_REQUEST['report'] == 'logout') {
    $_SESSION['loggedin'] = '';
}

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == 'admin') {
    
} else
    header('location: login.php');

require_once ('object.class.php');

$bt = new blueticket_objects();

if (isset($_GET['report'])) {
    switch ($_GET['report']) {
//        case 'print_purchase':
//            $inv = new InvoicePDF();
//            echo $inv->CreateInvoice(TRUE);
//            break;
//        case 'print_shipment':
//            $inv = new InvoicePDF();
//            echo $inv->CreateInvoice();
//            break;
//        case 'print_shipment_cash':
//            $inv = new InvoicePDF();
//            echo $inv->CreateInvoice(FALSE, TRUE);
//            break;
//        case 'print_purchase_cash':
//            $inv = new InvoicePDF();
//            echo $inv->CreateInvoice(TRUE, TRUE);
//            break;
    }
}
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="forms/themes/bootstrap/blueticket_forms.css">        
        <script src="forms/plugins/jquery.min.js"></script>
        <link href="forms/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet">
        <script src="forms/plugins/jquery-ui/jquery-ui.min.js"></script>
        <script src="filedownload/jquery.fileDownload.js"></script>
        <script type="text/javascript">
        </script>

        <style>
            @import "http://fonts.googleapis.com/css?family=Droid+Serif";
            /* Above line is used for online google font */
            h2 {
                text-align:center;
                font-size:24px
            }
            hr {
                margin-bottom:30px
            }
            p {
                color:#000;
                font-size:16px;
                font-weight:700
            }
            #button {
                border:1px solid #0c799e;
                width:250px;
                padding:10px;
                font-size:16px;
                font-weight:700;
                color:#fff;
                border-radius:3px;
                background:linear-gradient(to bottom,#59d0f8 5%,#49c0e8 100%);
                cursor:pointer
            }
            #button:hover {
                background:linear-gradient(to bottom,#49c0e8 5%,#59d0f8 100%)
            }
            input[type=text] {
                margin-top:5px;
                margin-bottom:20px;
                width:96%;
                border-radius:5px;
                border:0;
                padding:5px 0
            }
            #name,#email {
                padding-left:10px
            }
            input[type=submit] {
                width:30%;
                border:1px solid #59b4d4;
                background:#0078a3;
                color:#eee;
                padding:3px 0;
                border-radius:5px;
                margin-left:33%;
                cursor:pointer
            }
            input[type=submit]:hover {
                border:1px solid #666;
                background:#555;
                color:#fff
            }
            .ui-dialog .ui-dialog-content {
                padding:2em
            }
            div.container {
                width:960px;
                height:610px;
                margin:50px auto;
                font-family:'Droid Serif',serif;
                position:relative
            }
            div.main {
                width:600px;
                margin-top:35px;
                float:left;
                padding:10px 55px 25px;
                background-color:rgba(204,204,191,0.51);
                border:15px solid #fff;
                box-shadow:0 0 10px;
                border-radius:2px;
                font-size:13px;
                text-align:center
            }
        </style>
    </head>
    <body>
<?php
echo $bt->generateMenu();
?>
        <div style="height: auto; padding:10px 10px 10px 10px; border: 1px solid graytext">
        <?php
        if (isset($_GET['report'])) {
            switch ($_GET['report']) {
                case 'forms':
                    // echo $bt->generateForms();
                    break;
                case 'active_users':
                    echo $bt->generateActiveUsers();
                    break;
                case 'users':
                    echo $bt->generateUsers();
                    break;
                case 'users_wo_profile':
                    echo $bt->generateUsersWithoutProfile();
                    break;
                case 'kennels':
                    echo $bt->generateKennels();
                    break;
                case 'owners':
                    echo $bt->generateOwners();
                    break;
                case 'handlers':
                    echo $bt->generateHandlers();
                    break;
                case 'dogs':
                    echo $bt->generateDogs();
                    break;
                case 'puppies':
                    echo $bt->generatePuppies();
                    break;
                case 'payments':
                    echo $bt->generatePayments();
                    break;
                case 'active_payments':
                    echo $bt->generatePayments(NULL, 1);
                    break;
                case 'messages':
                    echo $bt->generateMessages();
                    break;
                case 'timeline':
                    echo $bt->generateTimeline();
                    break;
                case 'comments':
                    echo $bt->generateComments();
                    break;
                case 'likes':
                    echo $bt->generateLikes();
                    break;
                case 'timeline_events_types':
                    echo $bt->generateTimelineEventsTypes();
                    break;
                case 'translate':
                    echo $bt->generateTranslate();
                    break;
                case 'premium':
                    echo $bt->generatePremiumVisits();
                    break;
                case 'photos':
                    echo $bt->generatePhotos();
                    break;
                case 'videos':
                    echo $bt->generateVideos();
                    break;
                case 'router':
                    echo $bt->generateRouter();
                    break;
//                    case 'stats':
//                        if (isset($_GET['type'])) {
//                            $type = $_GET['type'];
//                        } else {
//                            $type = 4;
//                        }
//                        echo $bt->generateInvoices();
//                        break;
//                    case 'docs':
//                        echo $bt->generateTypesDocuments();
//                        break;
//                    case 'movements':
//                        echo $bt->generateMovements();
//                        break;
//                    case 'payments':
//                        echo $bt->generatePayments();
//                        break;
//                    case 'trans':
//                        echo $bt->generateTranslate();
//                        break;
//                    case 'partners':
//                        echo $bt->generatePartners();
//                        break;
//                    case 'doctypes':
//                        echo $bt->generateTypes();
//                        break;
//                    case 'desks':
//                        echo $bt->generateDesks();
//                        break;
//                    case 'groups':
//                        echo $bt->generateGroups();
//                        break;
//                    case 'units':
//                        echo $bt->generateUnits();
//                        break;
//                    case 'users':
//                        echo $bt->generateUsers();
//                        break;
//                    case 'unset_all':
//                        echo $bt->unset_all();
//                        break;
            }
        } else {
            echo $bt->generateUsers();
        }
        ?>
        </div>
        <script type="text/javascript">
            jQuery(document).on("ready blueticket_formsafterrequest", function () {
                $("#regnum").autocomplete({
                    source: function (request, response) {
                        jQuery.ajax({
                            url: "ajax_response.php?name=" + $("#regnum").val(),
                            success: function (result) {
                                var availableTags = [];
                                availableTags = eval(result);
                                response($.map(availableTags, function (item) {
                                    return {label: item.Description,
                                        name: item.Name,
                                        value: item.RegNum,
                                        regnum: item.RegNum,
                                        price: item.Price,
                                        tax: item.Tax,
                                        unit: item.Unit
                                    };
                                }));
                            }
                        });
                    },
                    select: function (event, ui) {
                        //alert(ui.item.label);
                        //$("#regnum").val(ui.item.regnum);
                        $("#price").val(ui.item.price);
                        $("#name").val(ui.item.name);
                        $("#taxpercent").val(ui.item.tax);
                        $("#unit").val(ui.item.unit);
                    },
//                    select: function (event, ui) {
//                        $("#name").val(ui[0]);
//                        $("#regnum").val(ui[1]);
//        $( "#project-description" ).html( ui.item.desc );
//        $( "#project-icon" ).attr( "src", "images/" + ui.item.icon );
//                    },
                    minLength: 3
                });
//                }).autocomplete("instance")._renderItem = function (ul, item) {
//                    return $("<li>").append("<a>" + item.Name + "</a>").appendTo(ul);
//                };
                $("#customerid").autocomplete({
                    source: function (request, response) {
                        jQuery.ajax({
                            url: "ajax_response_partner.php?name=" + $("#customerid").val(),
                            success: function (result) {
                                var availableTags = [];
                                availableTags = eval(result);
                                response($.map(availableTags, function (item) {
                                    return {label: item.Name,
                                        value: item.ID,
                                        description: item.Description
                                    };
                                }));
                            }
                        });
                    },
                    select: function (event, ui) {
                        //alert(ui.item.label);
                        var find = '<br />';
                        var re = new RegExp(find, 'g');

                        str = ui.item.description.replace(re, '\r\n');
                        $("#customerdesc").val(str);
                    },
//                    select: function (event, ui) {
//                        $("#name").val(ui[0]);
//                        $("#regnum").val(ui[1]);
//        $( "#project-description" ).html( ui.item.desc );
//        $( "#project-icon" ).attr( "src", "images/" + ui.item.icon );
//                    },
                    minLength: 3
                });
//                }).autocomplete("instance")._renderItem = function (ul, item) {
//                    return $("<li>").append("<a>" + item.Name + "</a>").appendTo(ul);
//                };
            });
        </script>
    </body>
</html>