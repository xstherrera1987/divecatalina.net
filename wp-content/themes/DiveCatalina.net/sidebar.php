<!-- this creates the 3 widget areas -->
<?php if ( is_sidebar_active('primary_widget_area') ) : ?>
        <div id="primary-widget" class="widget-area">
            <ul class="widgetlist">
                <?php dynamic_sidebar('primary_widget_area'); ?>
            </ul>
        </div>
<?php endif; ?>          
<?php if ( is_sidebar_active('secondary_widget_area') ) : ?>
        <div id="secondary-widget" class="widget-area">
            <ul class="widgetlist">
                <?php dynamic_sidebar('secondary_widget_area'); ?>
            </ul>
        </div>
<?php endif; ?>  
<?php if ( is_sidebar_active('ternary_widget_area') ) : ?>
        <div id="ternary-widget" class="widget-area">
            <ul class="widgetlist">
                <?php dynamic_sidebar('ternary_widget_area'); ?>
            </ul>
        </div>
<?php endif; ?>
