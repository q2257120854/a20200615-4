</div>
<?php include('password.php');?>
<!--js-->
<script charset="utf-8" type="text/javascript" src="../editor/kindeditor.js"></script>
            <script type="text/javascript">
                KindEditor.ready(function(K) {
                    K.create('#i_content');
                    var editor = K.editor();
                    K('#upload-image').click(function() {
                        editor.loadPlugin('image', function() {
                            editor.plugin.imageDialog({
                                imageUrl: K('#s_pic').val(),
                                clickFn: function(url, title, width, height, border, align) {
                                    K('#s_pic').val(url);
                                    editor.hideDialog();
                                }
                            });
                        });
                    });
                });
            </script>
            <script src="http://assets.yilep.com/ylsq/assets/admin/js-plugins/jquery-1.10.0.min.js" type="text/javascript"></script>
    <script src="http://assets.yilep.com/ylsq/assets/admin/js-plugins/bootstrap.min.js" type="text/javascript"></script>
    <script src="http://assets.yilep.com/ylsq/assets/admin/echarts.common.min.js" type="text/javascript"></script>
    <script src="http://assets.yilep.com/ylsq/assets/admin/js-plugins/moment.min.js" type="text/javascript"></script>
    <script src="http://assets.yilep.com/ylsq/assets/admin/js-plugins/daterangepicker.js" type="text/javascript"></script>
    <script src="http://assets.yilep.com/ylsq/assets/admin/js-plugins/wow.min.js" type="text/javascript"></script>
    <script src="http://assets.yilep.com/ylsq/assets/admin/js-plugins/perfect-scrollbar.jquery.min.js"
            type="text/javascript"></script>
    <script src="http://assets.yilep.com/ylsq/assets/admin/js-plugins/selectize.min.js" type="text/javascript"></script>
    <script src="http://assets.yilep.com/ylsq/assets/admin/js-plugins/owl.carousel.min.js" type="text/javascript"></script>
    <script src="http://assets.yilep.com/ylsq/assets/admin/js-plugins/Chart.min.js" type="text/javascript"></script>
    <script src="http://assets.yilep.com/ylsq/assets/admin/js-plugins/circle-progress.min.js" type="text/javascript"></script>

    <!--  MAIN SCRIPTS START FROM HERE  above scripts from plugin   -->
    <script src="http://assets.yilep.com/ylsq/assets/admin/js/customize-chart.js" type="text/javascript"></script>
    <script src="http://assets.yilep.com/ylsq/assets/admin/js/scripts.js" type="text/javascript"></script>
    <script src="http://assets.yilep.com/ylsq/assets/admin/jquery.pjax.min.js" type="text/javascript"></script>
    <script src="http://assets.yilep.com/ylsq/assets/laydate/laydate.js"></script>
    <script src="http://assets.yilep.com/ylsq/assets/datepicker/datepicker.min.js"></script>
    <script src="http://assets.yilep.com/ylsq/assets/datepicker/datepicker.zh.min.js"></script>
    <script src="http://assets.yilep.com/ylsq/assets/colpick/js/colpick.js"></script>
    <script src="http://assets.yilep.com/ylsq/assets/layer/layer.js" type="text/javascript"></script>
    <script src="http://assets.yilep.com/ylsq/js/admin/main.js?v=3.0.9"></script>

    <script type="text/javascript" charset="utf-8"
            src="http://assets.yilep.com/ylsq/assets/umeditor/third-party/template.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="http://assets.yilep.com/ylsq/assets/umeditor/umeditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="http://assets.yilep.com/ylsq/assets/umeditor/umeditor.min.js"></script>
    <script type="text/javascript" src="http://assets.yilep.com/ylsq/assets/umeditor/lang/zh-cn/zh-cn.js"></script>
                <script>
                    $(document).ready(function() {
                        $("#profile_btn").click(function() {
                            var vm = new Vue();
                            vm.$post("ajax.php?act=uppassword", $("#form-profile").serialize()).then(function(data) {
                                if (data.code === 0) {
                                    $("#modal-profile").modal('hide');
                                    vm.$message(data.message, 'success');
                                    $.pjax.reload('#pjax-container');
                                } else {
                                    vm.$message(data.message, 'error');
                                }
                            });
                        });
                    });
                    $(document).ready(function() {
                        $("#profile_btn1").click(function() {
                            var vm = new Vue();
                            vm.$post("ajax.php?act=uppassword1", $("#form-profile").serialize()).then(function(data) {
                                if (data.code === 0) {
                                    $("#modal-profile").modal('hide');
                                    vm.$message(data.message, 'success');
                                    $.pjax.reload('#pjax-container');
                                } else {
                                    vm.$message(data.message, 'error');
                                }
                            });
                        });
                    });
                </script>