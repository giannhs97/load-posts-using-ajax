<?php
    function financialDataTemplate(){
        ob_start();
        ?>
            <div class="financial-data-block">
                    <?php 
                        $years = new WP_Query( array( 
                            'post_type' => 'financial-data', 
                            'posts_per_page' => -1, 
                            'orderby' => 'date' ,
                            'order' => 'DEC'
                        ));

                        if($years->have_posts()){
                            $firstPost = $years->posts[0];
                            $firstPostTitle = $firstPost->post_title;
                        }

                        $posts = new WP_Query( array( 
                            'post_type' => 'financial-data', 
                            'posts_per_page' => -1, 
                            'title' => $firstPostTitle
                        ));


                    ?>

                    <div id="year-selector">
                        <label for="years"><?php _e("Chouse year:", "the7dtchild") ?></label>
                            <select name="years" id="years">
                                <?php
                                    while($years->have_posts()) : $years->the_post(); ?>
                                        <option id="selection" value="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></option>
                                    <?php endwhile; wp_reset_query();

                                ?>
                            </select> 
                    </div>
                        
                    <?php while ( $posts->have_posts() ) : $posts->the_post(); ?>
                        
                        <?php 
                            $pdfInfo = get_field('financial_pdf');
                            if(get_field('financial_pdf')){
                        ?>
                            <div class="data-box">
                                <div class = "financial-data">
                                    <div class="pdf-title"><img src="https://costopoulosfoundation.org/wp-content/uploads/2022/09/info-1.svg" alt="info"><span> <?php echo $pdfInfo["title"] ?> </span></div> <a href="<?php echo $pdfInfo["url"] ?>" target="_blank" class="dotted-underline-link"><?php _e("Download PDF", "the7dtchild") ?></a>
                                </div>

                                <?php
                                    if(get_field('second_financial_pdf')){
                                        $secondPdfInf = get_field('second_financial_pdf');
                                        ?>
                                            <div class = "financial-data">
                                                <div class="pdf-title"><img src="https://costopoulosfoundation.org/wp-content/uploads/2022/09/info-1.svg" alt="info"><span> <?php echo $secondPdfInf["title"] ?> </span></div> <a href="<?php echo $secondPdfInf["url"] ?>" target="_blank" class="dotted-underline-link"><?php _e("Download PDF", "the7dtchild") ?></a>
                                            </div>
                                        <?php
                                    }

                                    if(get_field('third_financial_pdf')){
                                        $secondPdfInf = get_field('third_financial_pdf');
                                        ?>
                                            <div class = "financial-data">
                                                <div class="pdf-title"><img src="https://costopoulosfoundation.org/wp-content/uploads/2022/09/info-1.svg" alt="info"><span> <?php echo $secondPdfInf["title"] ?> </span></div> <a href="<?php echo $secondPdfInf["url"] ?>" target="_blank" class="dotted-underline-link"><?php _e("Download PDF", "the7dtchild") ?></a>
                                            </div>
                                        <?php
                                    }
                                ?>
                            </div>
                        <?php } ?>
                        
                        
                    <?php endwhile; 
                    wp_reset_query(); ?>
            </div>
        <?php
        return ob_get_clean();
    }
    add_shortcode('financial-data', 'financialDataTemplate');


    function ajax_load_data(){

        $yearSelected = $_GET["yearSelected"];

        $posts = new WP_Query( array( 
            'post_type' => 'financial-data', 
            'posts_per_page' => -1, 
            'title' => $yearSelected
        ));

        while ( $posts->have_posts() ) : $posts->the_post(); ?>
                        
            <?php 
                $pdfInfo = get_field('financial_pdf');
                if(get_field('financial_pdf')){
            ?>

                <div class="data-box">
                    <div class = "financial-data">
                        <div class="pdf-title"><img src="https://costopoulosfoundation.org/wp-content/uploads/2022/09/info-1.svg" alt="info"><span> <?php echo $pdfInfo["title"] ?> </span></div> <a href="<?php echo $pdfInfo["url"] ?>" target="_blank" class="dotted-underline-link"><?php _e("Download PDF", "the7dtchild") ?></a>
                    </div>

                    <?php
                        if(get_field('second_financial_pdf')){
                            $secondPdfInf = get_field('second_financial_pdf');

                            ?>
                                <div class = "financial-data">
                                    <div class="pdf-title"><img src="https://costopoulosfoundation.org/wp-content/uploads/2022/09/info-1.svg" alt="info"><span> <?php echo $secondPdfInf["title"] ?> </span></div> <a href="<?php echo $secondPdfInf["url"] ?>" target="_blank" class="dotted-underline-link"><?php _e("Download PDF", "the7dtchild") ?></a>
                                </div>
                            <?php
                        }

                        if(get_field('third_financial_pdf')){
                            $secondPdfInf = get_field('third_financial_pdf');

                            ?>
                                <div class = "financial-data">
                                    <div class="pdf-title"><img src="https://costopoulosfoundation.org/wp-content/uploads/2022/09/info-1.svg" alt="info"><span> <?php echo $secondPdfInf["title"] ?> </span></div> <a href="<?php echo $secondPdfInf["url"] ?>" target="_blank" class="dotted-underline-link"><?php _e("Download PDF", "the7dtchild") ?></a>
                                </div>
                            <?php
                        }
                    ?>
                </div>
            <?php } ?>

                        
                        
        <?php endwhile; 
        wp_reset_query();
        
        wp_reset_postdata();

        wp_die();
    }
    add_action('wp_ajax_ajax_load_data', 'ajax_load_data');
    add_action('wp_ajax_nopriv_ajax_load_data', 'ajax_load_data');
    
?>