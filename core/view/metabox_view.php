<?php

defined('ABSPATH') || exit;
?>
<div class="container">
    <div class="tab-content" id="tabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="row fs-category-list mt-3" id="fs-category-list-tab-1">
                <div class="col-12">
                    <label class="my-2" for="fnpc_category_1_select"><?php _e(' category 1', $this->FNPC_domain); ?></label>
                    <select id="fnpc_category_1_select" class="form-select fnpc_category_1_select" aria-label="Select Service" name="fnpc_category_1">
                        <?php foreach ($fs_categories as $fs_category) : ?>
                            <option value="<?php echo $fs_category->term_id  ?>"><?php echo $fs_category->name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-12">
                    <label class="my-2" for="fnpc_category_2_select"><?php _e(' category 2', $this->FNPC_domain); ?></label>
                    <select id="fnpc_category_2_select" class="form-select fnpc_category_2_select" aria-label="Select Service" name="fnpc_category_2">
                        <?php foreach ($fs_categories as $fs_category) : ?>
                            <option value="<?php echo  $fs_category->term_id ?>"><?php echo  $fs_category->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-12">
                    <label class="my-2" for="fnpc_category_3_select"><?php _e(' category 3', $this->FNPC_domain); ?></label>
                    <select id="fnpc_category_3_select" class="form-select fnpc_category_3_select" aria-label="Select Service" name="fnpc_category_3">
                        <?php foreach ($fs_categories as $fs_category) : ?>
                            <option value="<?php echo  $fs_category->term_id ?>"><?php echo  $fs_category->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-12">
                    <label class="my-2" for="fnpc_category_4_select"><?php _e(' category 4', $this->FNPC_domain); ?></label>
                    <select id="fnpc_category_4_select" class="form-select fnpc_category_4_select" aria-label="Select Service" name="fnpc_category_4">
                        <?php foreach ($fs_categories as $fs_category) : ?>
                            <option value="<?php echo  $fs_category->term_id ?>"><?php echo  $fs_category->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-12">
                    <label class="my-2" for="fnpc_category_5_select"><?php _e(' category 5', $this->FNPC_domain); ?></label>
                    <select id="fnpc_category_5_select" class="form-select fnpc_category_5_select" aria-label="Select Service" name="fnpc_category_5">
                        <?php foreach ($fs_categories as $fs_category) : ?>
                            <option value="<?php echo  $fs_category->term_id ?>"><?php echo  $fs_category->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-12">
                    <label class="my-2" for="fnpc_category_6_select"><?php _e(' category 6', $this->FNPC_domain); ?></label>
                    <select id="fnpc_category_6_select" class="form-select fnpc_category_6_select" aria-label="Select Service" name="fnpc_category_6">
                        <?php foreach ($fs_categories as $fs_category) : ?>
                            <option value="<?php echo  $fs_category->term_id ?>"><?php echo  $fs_category->name; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$nonce = "";
if (isset($_REQUEST['tag_ID']) && $_REQUEST['tag_ID']) {
    $nonce = $_REQUEST['tag_ID'] . get_current_user_id();
} else {
    $nonce = get_the_ID() . get_current_user_id();
}
wp_nonce_field($nonce, $this->FNPC_nonce, false)
?>