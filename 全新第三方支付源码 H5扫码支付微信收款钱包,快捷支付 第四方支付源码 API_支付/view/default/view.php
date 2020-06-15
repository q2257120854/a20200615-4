<?php require_once 'header.php' ?>
    <style type="text/css">
            .news-body{padding:20px 0;width:100%;overflow:hidden;} .news-body{max-width:
            100%;height: auto;}
        </style>
        <div class="mt-40">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-volume-up">
                                </i>
                                <span class="text-red">
                                      <?php echo $data['title']?>
                                </span>
                            </div>
                            <div class="panel-body">
                                <h1 class="text-center text-red" style="font-size:16px;padding:20px 0;border-bottom:1px solid #ddd;">
                                      <?php echo $data['title']?>
                                </h1>
                                <div class="clearfix">
                                </div>
                                <div class="news-body">
                                 
								      
                  
                          
                                <?php echo $data['content']?>
            
                						
							
                                </div>
                                <div class="clearfix">
                                </div>
                            </div>
                            <div class="panel-footer clearfix">
                                <div class="text-right">
                         <?php echo $this->config['sitename']?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		
		
		
    <?php require_once 'footer.php' ?>