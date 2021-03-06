<div class="bb-field-row" data-dependency="<?php echo ($dependency!='')?'true':'false' ?>" data-element="<?php if($dependency!='') echo esc_attr($field['dependency']['element']) ?>" data-value="<?php  if($dependency!='') echo esc_attr(implode(',', $field['dependency']['value'])) ?>">
    <div class="bb-label">
        <label for="<?php echo esc_attr($field['param_name']) ?>">
            <?php if(!empty($field['heading'])) esc_html_e($field['heading']) ?>
        </label>
    </div>
    <div class="bb-field bb-max-width-none">
        <textarea id="<?php echo esc_attr($field['param_name']) ?>" class="bb-textfield" name="<?php echo esc_attr($field['param_name']) ?>" type="text" value="" ><?php echo esc_attr($field['value']) ?></textarea>
        <div class="bb-desc">
            <?php if(!empty($field['description'])) echo bb_esc_html('<br/>'.($field['description'])) ?>
        </div>
    </div>
</div>