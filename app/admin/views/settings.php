<div class="wrap uhmi-settings">

    <div class="nav-tab-wrapper">

        <a href="<?php echo esc_url( admin_url( 'admin.php?page=uhmi_settings&tab=general' ) ) ?>" class="nav-tab <?php echo ( $active_tab === 'general' ) ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'General', 'uhmi' ) ?></a>

        <?php if (current_user_can('edit_pages')) { ?>

            <a href="<?php echo esc_url( admin_url( 'admin.php?page=uhmi_settings&tab=button' ) ) ?>" class="nav-tab <?php echo ( $active_tab === 'button' ) ? 'nav-tab-active' : ''; ?>"><?php esc_html_e( 'Button', 'uhmi' ) ?></a>

        <?php } ?>

    </div>

    <?php if ($active_tab) : ?>

        <?php include UHMI_PLUGIN_DIR_ADMIN . "/views/settings/$active_tab.php"; ?>

    <?php else : ?>

        <h3><?php esc_html_e( 'Nothing to see here.', 'uhmi' ) ?></h3>

    <?php endif; ?>

</div>
