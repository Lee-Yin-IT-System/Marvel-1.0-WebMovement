<style type="text/css">
    .kanan {
        text-align: right;
    }

    .bgcolor {
        background-color: #98FB98;
    }
</style>
<script type="text/javascript" src="https://unpkg.com/@zxing/library@latest"></script>

<div id="content" class="">
    <!-- content starts -->
    <div>
        <ul class="breadcrumb">
            <li>
                <a href="<?php echo base_url(); ?>admin">Home</a>
            </li>
            <li>
                <a href="<?php echo base_url(); ?>ccalculationplan/tampil">Calculation Plan</a>
            </li>
            <li>
                <a href="#">Detail</a>
            </li>
        </ul>
    </div>




    <div class=" row" style="margin-top:-18px">
        <div class="box col-md-12">
            <div class="box-inner">
                <!--<div class="box-header well" data-original-title="">
        <h2><i ></i> </h2>

       
    </div>-->
                <div class="box-content">


                    <form id="form2" name="form2">
                        <div id="form20" name="form20">

                            <input type="hidden" name="OrderNo" id="OrderNo" class="form-control input-sm pull-right" value="<?php echo $dataON; ?>" />
                            <input type="hidden" name="Style" id="Style" class="form-control input-sm pull-right" value="<?php echo $dataStyle; ?>" />
                            <input type="hidden" name="ColorDesc" id="ColorDesc" class="form-control input-sm pull-right" value="<?php echo $dataColor; ?>" />

                        </div>


                        <!-- <button type="button" id="save" name="chkEdit" class="btn btn-sm btn-primary btn-flat"><iclass="fa fa-save"></iclass=> Save </button> -->
                        <!-- <button type="button" id="export" href="#" class="btn btn-sm btn-primary btn-flat" style="display:none"><i class="fa fa-file-excel-o"></i> Export </button> -->
                        <button type="button" id="print" href="#" class="btn btn-sm btn-primary btn-flat"><i class="fa fa-retweet"></i> Print </button>
                        <!-- <button type="button" id="print" href="#" class="btn btn-sm btn-primary btn-flat"><i class="fa fa-plus"></i> Add </button> -->
                        <button type="button" id="print" href="#" class="btn btn-sm btn-primary btn-flat" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-edit"></i> Add </button>
                        <!-- <button type="button" id="backdate" data-toggle="modal" data-target="#lastmovement" class="btn btn-sm btn-primary btn-flat"><i class="fa fa-retweet"></i> Back Date </button> -->



                </div>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="box-tools">
                                <div class="input-group" style="width: 150px; margin-top:0px; padding-right:-10px">
                                    <span class="input-group" style="width: 150px; margin-top:0px; padding-right:-10px">
                                        <input type="text" name="table_search" id="table_search"
                                            class="form-control input-sm pull-right" placeholder="Search"
                                            style="z-index:0;" />
                                    </span>
                                    <div class="input-group-btn">
                                        <button type="button" id="btnsrch" class="btn btn-sm btn-default"
                                            style="margin-left:2px;z-index:0;"><i class="fa fa-search"></i> </button>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-header">
                                <div id="groupfabric" class="form-group" style="overflow:auto; margin:5px 0 5px 0;">
                                    <div id="fabric"></div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                            <!-- <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Plan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <?php //foreach ($addlist as $list) :?>
                                    <tr>
                                        <th>QRNumber</th>
                                        <th>Position</th>
                                        <th>Office</th>
                                        <th>Age</th>
                                        <th>Start date</th>
                                        <th>Salary</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>QRNUMBER</td>
                                        <td>System Architect</td>
                                        <td>Edinburgh</td>
                                        <td>61</td>
                                        <td>2011-04-25</td>
                                        <td>$320,800</td>
                                    </tr>
                                </tbody>
                            </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div> -->
                        </div>
                    </div>
                </div>


                </form>

                <div id="lastmovement" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-footer">
                            <button type="button" id="simpanalt" class="btn btn-success" data-dismiss="modal">Save</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            
            <div id="groupinput" class="form-group" style="overflow:auto; margin:5px 0 5px 0;">
                <div id="grid"></div>
            </div>

            <script type="text/javascript">
                    var idstyle;
                    var actsave;

                    $(document).ready(function() {

                        var hgt;
                        var frm;
                        var wnd;
                        var taskb = document.documentElement.clientHeight;
                        hgt = taskb - 166;


                        $('#contact_form').height(hgt + 87);
                        $('#contact_body').height(hgt - 12);

                        $('#groupfabric').height(hgt + 4);
                        $('#fabric').height(hgt + 2);
                        $(window).on("load", function() {
                            loadFabric();
                        });

                        function onChange() {

                            var combobox = $("#fabtypecmb").data("kendoComboBox").value();
                            $("#fabtype").val(combobox);
                        }

                        $("#standardvalue").keypress(function(e) {
                            if (String.fromCharCode(e.keyCode).match(/[^0-9]/g)) return false;
                        });


                        var _scroll = true,
                            _timer = false,
                            _floatbox = $("#contact_form"),
                            _floatbox_opener = $(".contact-opener");
                        _floatbox.css("right", "-350px"); //initial contact form position

                        //Contact form Opener button
                        _floatbox_opener.click(function() {
                        });

                        //Effect on Scroll
                        $(window).scroll(function() {
                            if (_scroll) {
                                _floatbox.animate({
                                    "top": "30px"
                                }, {
                                    duration: 300
                                });
                                _scroll = false;
                            }
                            if (_timer !== false) {
                                clearTimeout(_timer);
                            }
                            _timer = setTimeout(function() {
                                _scroll = true;
                                _floatbox.animate({
                                    "top": "10px"
                                }, {
                                    easing: "linear"
                                }, {
                                    duration: 500
                                });
                            }, 400);
                        });

                    });

                function loadFabric() {
                $("#fabric").kendoGrid({
                    dataSource: {
                        transport: {
                            read: {
                                url: "<?php echo base_url(); ?>ccalculationplan/tampilFabricRoll",
                                contentType: "application/json; charset=utf-8",
                                dataType: "json",
                                type: 'get',
                            },
                        },
                        pageSize: 50,
                        schema: {
                            model: {
                                fields: {
                                    PlanUseQtyKG: {
                                        type: "number",
                                        format: "{0:n2}",
                                    },
                                }
                            }
                        },


                    },




                    sortable: true,
                    selectable: "row",

                    pageable: {
                        pageSizes: [50, 75, 100],
                    },

                    columns: [
                        {
                            title: "Select",
                            width: 75,
                            headerAttributes: {
                                style: "font-weight: bold"
                            },
                            editable: "false",
                            template: "<input name='chk' id='chk' class='chk' type='checkbox' data-bind='checked:'/>"
                        },
                        {
                            field: "QRNumber",
                            title: "QR Number",
                            width: 200,
                            headerAttributes: {
                                style: "font-weight: bold"
                            }
                        },
                        {
                            field: "qSJSupplier",
                            title: "Surat Jalan Supplier",
                            width: 200,
                            headerAttributes: {
                                style: "font-weight: bold"
                            }
                        },
                        {
                            field: "qReceiveDate",
                            title: "Receive Date",
                            width: 200,
                            headerAttributes: {
                                style: "font-weight: bold"
                            }
                        },
                        {
                            field: "qOrderNo",
                            title: "Order No",
                            width: 200,
                            headerAttributes: {
                                style: "font-weight: bold"
                            }
                        },
                        {
                            field: "qStyle",
                            title: "Style",
                            width: 200,
                            headerAttributes: {
                                style: "font-weight: bold"
                            }
                        },
                        {
                            field: "qSeason",
                            title: "Season",
                            width: 200,
                            headerAttributes: {
                                style: "font-weight: bold"
                            }
                        },
                        {
                            field: "qPO",
                            title: "PO",
                            width: 200,
                            headerAttributes: {
                                style: "font-weight: bold"
                            }
                        },
                        {
                            field: "qProdCode",
                            title: "Prod Code",
                            width: 200,
                            headerAttributes: {
                                style: "font-weight: bold"
                            }
                        },
                        {
                            field: "qProdDesc",
                            title: "Prod Desc",
                            width: 200,
                            headerAttributes: {
                                style: "font-weight: bold"
                            }
                        },
                        {
                            field: "qColorCode",
                            title: "Color Code",
                            width: 200,
                            headerAttributes: {
                                style: "font-weight: bold"
                            }
                        },
                        {
                            field: "qColorDesc",
                            title: "Color Desc",
                            width: 200,
                            headerAttributes: {
                                style: "font-weight: bold"
                            }
                        },
                        {
                            field: "qFabType",
                            title: "Type",
                            width: 200,
                            headerAttributes: {
                                style: "font-weight: bold"
                            }
                        },
                        {
                            field: "qLot",
                            title: "LOT",
                            width: 200,
                            headerAttributes: {
                                style: "font-weight: bold"
                            }
                        },
                        {
                            field: "fBlueBin",
                            title: "BlueBin",
                            width: 200,
                            headerAttributes: {
                                style: "font-weight: bold"
                            }
                        },
                        {
                            field: "fLocation",
                            title: "Location",
                            width: 200,
                            headerAttributes: {
                                style: "font-weight: bold"
                            }
                        },
                        {
                            field: "qStockKgs",
                            title: "Stock KG",
                            width: 200,
                            headerAttributes: {
                                style: "font-weight: bold"
                            }
                        },
                        {
                            field: "qStockYard",
                            title: "Stock YD",
                            width: 200,
                            headerAttributes: {
                                style: "font-weight: bold"
                            }
                        },
                        {
                            field: "PlanUseQtyKG",
                            title: "Plan Use Qty KG",
                            width: 200,
                            headerAttributes: {
                                style: "font-weight: bold"
                            }
                        },
                        {
                            field: "PlanUseQtyYd",
                            title: "Plan Use Qty Yd",
                            width: 200,
                            headerAttributes: {
                                style: "font-weight: bold"
                            }
                        },
                    ],
                }).on("click", "tbody td", function(e) {
                    var cell = $(e.currentTarget);
                    var cellIndex = cell[0].cellIndex;
                    var grid = $("#fabric").data("kendoGrid");
                    var column = grid.columns[cellIndex];
                    var dataItem = grid.dataItem(cell.closest("tr"));
                });
                }
            </script>

            <script type="text/javascript">
                var idstyle;
                var actsave;

                $(document).ready(function() {

                    var hgt;
                    var frm;
                    var wnd;
                    var taskb = document.documentElement.clientHeight;
                    hgt = taskb - 166;


                    $('#contact_form').height(hgt + 87);
                    $('#contact_body').height(hgt - 12);

                    $('#groupinput').height(hgt + 4);
                    $('#grid').height(hgt + 2);
                    $(window).on("load", function() {
                        loadgrid();
                    });

                    //Effect on Scroll
                    $(window).scroll(function() {
                        if (_scroll) {
                            _floatbox.animate({
                                "top": "30px"
                            }, {
                                duration: 300
                            });
                            _scroll = false;
                        }
                        if (_timer !== false) {
                            clearTimeout(_timer);
                        }
                        _timer = setTimeout(function() {
                            _scroll = true;
                            _floatbox.animate({
                                "top": "10px"
                            }, {
                                easing: "linear"
                            }, {
                                duration: 500
                            });
                        }, 400);
                    });

                });

                function loadgrid() {

                    var ORDER_NO = $('#OrderNo').val();
                    var STYLE = $('#Style').val();
                    var COLOR_DESC = $('#ColorDesc').val();

                    $("#grid").kendoGrid({
                        dataSource: {
                            transport: {
                                read: {
                                    url: "<?php echo base_url(); ?>ccalculationplan/tampilHeaderDetail",
                                    contentType: "application/json; charset=utf-8",
                                    dataType: "json",
                                    data: {
                                        ORDER_NO: ORDER_NO,
                                        STYLE: STYLE,
                                        COLOR_DESC: COLOR_DESC
                                    },
                                    type: 'get',
                                },
                            },
                            pageSize: 50,
                            schema: {
                                model: {
                                    fields: {
                                        // PercentageCutting: {
                                        //     type: "number",
                                        //     format: "{0:n2}"
                                        // },
                                        //LocCode: { field: "LocCode", defaultValue: 1 },
                                    }
                                }
                            },


                        },

                        sortable: true,
                        selectable: "row",

                        pageable: {
                            pageSizes: [50, 75, 100],
                        },
                        dataBound: function(e) {
                            $(".chkgrp").bind("change", function(e) {
                                if ($(".chkgrp").is(":checked")) {
                                    flaggroup = 1;
                                } else {
                                    flaggroup = 0;
                                }
                            });
                            $(".chk").bind("change", function(e) {
                                var grid = $("#grid").data("kendoGrid");
                                var row = $(e.target).closest("tr");
                                row.toggleClass("k-state-selected");
                                var data = grid.dataItem(row);
                                var GR_NO = data.GR_NO;
                                var chk = data.chk;

                                var grid1 = $("#grid").data("kendoGrid");
                                var ds1 = grid.dataSource.view();
                                totrecord = ds1.length;
                                var dataItem = grid.dataItem(grid.select());
                                var index = grid.dataSource.indexOf(dataItem);
                                var row = grid.table.find("tr[data-uid='" + ds1[index].uid + "']");
                                var checkbox = $(row).find(".chk");
                                if (checkbox.is(":checked")) {
                                    for (var i = 0; i < ds1.length; i++) {
                                        if (flaggroup === 1) {
                                            var gr1 = ds1[i].GR_NO;
                                        }
                                        if (GR_NO == gr1) {
                                            var dataItem = $("#grid").data("kendoGrid").dataSource
                                                .data()[i];
                                            dataItem.chk = 'checked';
                                        } else {
                                            dataItem.chk = 'checked';
                                        }
                                    }
                                    $('#grid').data('kendoGrid').refresh();
                                } else {
                                    for (var i = 0; i < ds1.length; i++) {
                                        if (flaggroup === 1) {
                                            var dataItem = $("#grid").data("kendoGrid").dataSource
                                                .data()[i];
                                            dataItem.chk = 'unchecked';
                                        } else {
                                            dataItem.chk = 'unchecked';
                                        }
                                    }
                                    $('#grid').data('kendoGrid').refresh();
                                }
                            });
                        },
                        detailInit: detailInit,

                        columns: [
                            // {field: "idstyle",title: "ID Style", hidden:true  },
                            //         { title:"<input name='chkgrp' id='chkgrp' class='chkgrp' type='checkbox' data-bind='checked: chkgrp' #= chkgrp ?/>  Check",width:75,headerAttributes: {style: "font-weight: bold"} ,editable: "false",
                            //   template: "<input name='chk' id='chk' class='chk' type='checkbox'  data-bind='checked: chk' #= chk ? checked=chk : '' #/>"
                            // 	},
                            {
                                title: "-",
                                width: 75,
                                headerAttributes: {
                                    style: "font-weight: bold"
                                },
                                editable: "false",
                                template: "<input name='chk' id='chk' class='chk' type='checkbox' data-bind='checked:'/>"
                            },
                            {
                                title: "Percentage", 
                                    width: 200, 
                                    headerAttributes: { style: "font-weight: bold" }, editable: "false",
                                    template: "<div class='Percentage' style = width:100% ;></div>"
                            },
                            {
                                field: "GR_NO",
                                title: "GR Number",
                                width: 200,
                                headerAttributes: {
                                    style: "font-weight: bold"
                                },
                            },
                            {
                                field: "COLOR_DESC",
                                title: "Color Description",
                                width: 250,
                                headerAttributes: {
                                    style: "font-weight: bold"
                                },
                            },
                            {
                                field: "WO_NO",
                                title: "WO Number",
                                // field: "STYLE",
                                // title: "Style Description",
                                width: 250,
                                headerAttributes: {
                                    style: "font-weight: bold"
                                },
                            },
                            {
                                field: "PRODUCT_CODE",
                                title: "Product Code",
                                // field: "COLOR_DESC",
                                // title: "Color Description",
                                width: 250,
                                headerAttributes: {
                                    style: "font-weight: bold"
                                },
                            },
                            {
                                field: "FabricPO",
                                title: "PO",
                                // field: "COLOR_DESC",
                                // title: "Color Description",
                                width: 200,
                                headerAttributes: {
                                    style: "font-weight: bold"
                                },
                            },
                            {
                                field: "STYLE",
                                title: "Style Description",
                                width: 300,
                                headerAttributes: {
                                    style: "font-weight: bold"
                                },
                            },
                            {
                                field: "PORTION",
                                title: "Portion",
                                width: 200,
                                headerAttributes: {
                                    style: "font-weight: bold"
                                },
                            },
                            {
                                field: "LayoutPanel",
                                title: "Layout",
                                width: 100,
                                headerAttributes: {
                                    style: "font-weight: bold"
                                },
                            },
                            // {
                            //     field: "STYLE",
                            //     title: "Style Description",
                            //     // field: "PORTION",
                            //     // title: "Portion",
                            //     width: 200,
                            //     headerAttributes: {
                            //         style: "font-weight: bold"
                            //     },
                            // },
                            {
                                field: "TABLE_INDEX",
                                title: "No Table",
                                width: 100,
                                headerAttributes: {
                                    style: "font-weight: bold"
                                },
                            },
                           
                            
                        ],
                        dataBound: function(e) {
                            var grid = this;

                            grid.tbody.find(".Percentage").each(function(e) {
                                var row = $(this).closest("tr");
                              var model = grid.dataItem(row);

                              $(this).kendoProgressBar({
                                max: 100,
                                value: model.PercentageCutting
                              })
                            });
                          }
                    }).on("click", "tbody td", function(e) {
                        var cell = $(e.currentTarget);
                        var cellIndex = cell[0].cellIndex;
                        var grid = $("#grid").data("kendoGrid");
                        var column = grid.columns[cellIndex];
                        var dataItem = grid.dataItem(cell.closest("tr"));
                        // OrderNo = dataItem.ORDER_NO;
                        // Style = dataItem.STYLE;
                        // ColorDesc = dataItem.COLOR_DESC;
                        // window.open("< //base_url("ccalculationplan/tampilDetail") ?>?ORDER_NO=" + OrderNo +
                        //     "&STYLE=" + Style + "&COLOR_DESC=" + ColorDesc);
                        // console.log(OrderNo, Style, ColorDesc);
                    });
                }

                function detailInit(e) {
                    var GR_NO = e.data.GR_NO;
                    $("<div/>").appendTo(e.detailCell).kendoGrid({
                        columns: [{
                                field: "MaterialPlan",
                                title: "Plan",
                                width: 50,
                                headerAttributes: {
                                style: "font-weight: bold"
                                },
                                template: " <div align='center'><input type='checkbox' ifchecked readonly></div>"
                                },
                            {
                                field: "QRNumber",
                                title: "QRNumber",
                                width: 90,
                                headerAttributes: {
                                    style: "font-weight: bold"
                                },
                            },
                            {
                                field: "PO",
                                title: "PO",
                                width: 110,
                                headerAttributes: {
                                    style: "font-weight: bold"
                                },
                            },
                            // {
                            //     field: "MaterialPlan",
                            //     title: "Mat Plan",
                            //     width: 50,
                            //     headerAttributes: {
                            //         style: "font-weight: bold"
                            //     },
                            // },
                            {
                                field: "qProdDesc",
                                title: "Fabric Material",
                                width: 150,
                                headerAttributes: {
                                    style: "font-weight: bold"
                                },
                            },
                            {
                                field: "qFabType",
                                title: "Type",
                                width: 60,
                                headerAttributes: {
                                    style: "font-weight: bold"
                                },
                            },
                            {
                                field: "qGrouping",
                                title: "Group",
                                width: 60,
                                headerAttributes: {
                                    style: "font-weight: bold"
                                },
                            },
                            {
                                field: "qLot",
                                title: "LOT",
                                width: 80,
                                headerAttributes: {
                                    style: "font-weight: bold"
                                },
                            },
                            {
                                field: "QtyStickerKG",
                                title: "Qty Sticker Kg",
                                width: 90,
                                headerAttributes: {
                                    style: "font-weight: bold"
                                },
                            },
                            {
                                field: "QtyStickerYD",
                                title: "Qty Sticker Yd",
                                width: 90,
                                headerAttributes: {
                                    style: "font-weight: bold"
                                },
                            },
                            {
                                field: "PlanQtyKG",
                                title: "Plan Qty KG",
                                width: 90,
                                headerAttributes: {
                                    style: "font-weight: bold"
                                },
                            },
                            {
                                field: "PlanQtyYd",
                                title: "Plan Qty YD",
                                width: 90,
                                headerAttributes: {
                                    style: "font-weight: bold"
                                },
                            },
                            {
                                field: "Inspect",
                                title: "Inspect",
                                width: 60,
                                headerAttributes: {
                                    style: "font-weight: bold"
                                },
                                template: "<div align='center'><input type='checkbox' checked readonly></div>"
                            },
                            {
                                field: "ActualKG",
                                title: "Act Kg",
                                width: 50,
                                headerAttributes: {
                                    style: "font-weight: bold"
                                },
                            },
                            {
                                field: "ActualYD",
                                title: "Act Yd",
                                width: 50,
                                headerAttributes: {
                                    style: "font-weight: bold"
                                },
                            },
                            {
                                field: "ActWidth",
                                title: "Act Width",
                                width: 70,
                                headerAttributes: {
                                    style: "font-weight: bold"
                                },
                            },
                            {
                                field: "PlanWidth",
                                title: "Plan Width",
                                width: 70,
                                headerAttributes: {
                                    style: "font-weight: bold"
                                },
                            },
                            {
                                field: "Spreading",
                                title: "Spreading",
                                width: 70,
                                headerAttributes: {
                                    style: "font-weight: bold"
                                },
                                template: "<div align='center'><input type='checkbox' checked readonly></div>"
                            },
                            {
                                field: "ConsKG",
                                title: "Cons Kg",
                                width: 60,
                                headerAttributes: {
                                    style: "font-weight: bold"
                                },
                            },
                            {
                                field: "ConsYD",
                                title: "Cons Yd",
                                width: 60,
                                headerAttributes: {
                                    style: "font-weight: bold"
                                },
                            },
                            {
                                field: "TtlLayer",
                                title: "TTL Layer",
                                width: 70,
                                headerAttributes: {
                                    style: "font-weight: bold"
                                },
                            },
                            {
                                field: "RejectRoll",
                                title: "Reject Roll",
                                width: 70,
                                headerAttributes: {
                                    style: "font-weight: bold"
                                },
                            },
                            {
                                field: "Residue",
                                title: "Residue",
                                width: 70,
                                headerAttributes: {
                                    style: "font-weight: bold"
                                },
                            },
                            {
                                // field: "Residue",
                                title: "Status",
                                width: 70,
                                headerAttributes: {
                                    style: "font-weight: bold"
                                },
                                template: "<div align='center'><p>Unplan</p></div>"
                            },
                            // {
                            //     // field: "Residue",
                            //     title: "Action",
                            //     width: 70,
                            //     headerAttributes: {
                            //         style: "font-weight: bold"
                            //     },
                            //     template: "<div align='center'><select id='cars'><option value='volvo'>Volvo</option><option value='saab'>Saab</option><option value='opel'>Opel</option><option value='audi'>Audi</option></select></div>"
                            // },
                            // {
                            //     // field: "Residue",
                            //     title: "Action 2",
                            //     width: 70,
                            //     headerAttributes: {
                            //         style: "font-weight: bold"
                            //     },
                            //     template: "<div align='center'><button>Edit</button></div>"
                            // }
                        ],
                        dataSource: {
                            transport: {
                                read: {
                                    url: "<?php echo base_url(); ?>ccalculationplan/tampilSubMenuDetail",
                                    contentType: "application/json; charset=utf-8",

                                    type: 'get',
                                    dataType: "json",
                                    data: {
                                        GR_NO: GR_NO
                                    },
                                }
                            },
                            schema: {
                                data: "data",
                                model: {
                                    fields: {
                                        QtyStickerKG: {
                                            type: "number",
                                            format: "{0:n2}"
                                        },
                                        QtyStickerYD: {
                                            type: "number",
                                            format: "{0:n2}"
                                        },
                                        ActualKG: {
                                            type: "number",
                                            format: "{0:n2}"
                                        },
                                        ActWidth: {
                                            type: "number",
                                            format: "{0:n2}"
                                        },
                                        PlanWidth: {
                                            type: "number",
                                            format: "{0:n2}"
                                        },
                                        ConsKG: {
                                            type: "number",
                                            format: "{0:n2}"
                                        },
                                        ConsYD: {
                                            type: "number",
                                            format: "{0:n2}"
                                        },
                                        RejectRoll: {
                                            type: "number",
                                            format: "{0:n2}"
                                        },
                                        Residue: {
                                            type: "number",
                                            format: "{0:n2}"
                                        },
                                    }
                                }
                            },
                            serverPaging: true,
                            serverSorting: true,
                            serverFiltering: true,
                            pageSize: 10,

                            aggregate: [
                                // { field: "QtyYard", aggregate: "sum" },
                                // { field: "QtyKgs", aggregate: "sum" },
                                // { field: "Qty", aggregate: "sum" }
                            ]
                        },
                        scrollable: false,
                        sortable: true,
                        pageable: false,
                    });
                }
            </script>

            <script>
                $(document).ready(function () {
                $('#example').DataTable();
                });
            </script>